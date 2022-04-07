<?php
// DDRC-C: funcion que guarda archivos subidos en una ruta especifica
function saveFiles($file)
{
    // DDRC-C: Crea carpetas para ordenar los comprobantes subidos
    $folderDate = date('m-Y');
    $fileType = $file['type'];
    if (explode('/', $fileType)[0] === 'application') {
        $folderType = 'pdf';
    } else {
        $folderType = 'img';
    }
    $folderPath = dirname(__DIR__,2).'\assets\files\\'.$folderDate.'\\'.$folderType;
    if (!file_exists($folderPath) ) {
       echo mkdir($folderPath,0755,true);
    } 
    // DDRC-C: ruta del archivo junto con un nombre unico para el archivo
    $filePath = $folderPath.'\\'.uniqid().'_'.$file['name'];
    
    // DDRC-C: Mueve el archivo subido a la ruta especificada y si no logra envia una bandera 'notSaved'
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        return $filePath;
    } else {
        return "notSaved";   
    }

    // DDRC-C: comandos utiles para obtener el directorio actual
    // return getcwd(); Regresa la ruta completa de la carpeta, desde el disco local en el que se encuentre
    // return dirname(__FILE__); Regresa lo mismo de arriba 
    // return basename(__DIR__) ; regresa el nombre de la carpeta contenedora
    // return __FILE__ ; Regresa la ruta completa incluido el archivo desde el que se llama
    // return __DIR__ ;  regresa la ruta completa de la carpeta contenedora
    // return basename(dirname(__FILE__,1)) regrsa la nombre de la carpeta contenedora 
    // return pathinfo($file['name'], PATHINFO_EXTENSION); Obtiene la extencion del archivo pasado
}
