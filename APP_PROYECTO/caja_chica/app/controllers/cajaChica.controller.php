<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('../models/connection.php');
require('../models/cajaChica.php');
require('../models/usuarios.php');

// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo
$monto = filter_input(INPUT_POST, 'monto');
$usuario = filter_input(INPUT_POST, 'usuario');
$descripcion = filter_input(INPUT_POST, 'descripcion');
$action = filter_input(INPUT_POST, 'action');
$informacion = array("monto" => $monto, "usuario" => $usuario,"descripcion"=>$descripcion);

// DDRC-C: comportamiento de la vista dependiendo de una acción y de si hay una caja chica en uso
$current = getCurrentPettyBox();
$futureAction;
$idPettyBox = null;

if (gettype($current) === 'string') {
    $futureAction = 'create';
} else {
    $idPettyBox = $current['id'];
    $nombre = $current['nombres'];
    $apellido = $current['apellidos'];
    $efectivo_caja_chica = $current['monto_caja_chica'];
    $descripcion_caja_chica = $current['descripcion'];
    $futureAction = 'update';
    // foreach ($current as $key => $value) {
    //     echo $key . '=>' . $value . '<br>';
    // }
}

switch ($action) {
    case 'crear':
        // DDRC-C: crea un nuevo registro de caja chica
         echo addPettyBox($informacion);
        // unset($action);
        header('Refresh:0');
        echo 'entro a crear';
        break;

    case 'actualizar':
        // DDRC-C: actualiza un registro de caja chica 
         echo updatePettyBox($idPettyBox,$informacion);
        // unset($action);
        header('Refresh:0');
        echo $idPettyBox;
        echo 'entro a actualizar';
        break;

    case 'eliminar':
        // DDRC-C: elimina un registro de caja chica
         echo deletePettyBox($idPettyBox);
        // unset($action);
        header('Refresh:0');
        echo $idPettyBox;
        echo 'entro a eliminar';
        break;

    default:
        $usuarios = getUserList();
        include('../views/caja_chica.php');
        break;
}



// DDRC-CI: codigo util para recorrer un array recibido de la base de datos
// <?php 
//         if (isset($test)) {
//             foreach ($test as $key => $value) {
//              echo $key.'=>'.$value;
//                 echo'<br>';
//                 foreach ($value as $key1 => $value1) {
//                     echo $key1.'=>'.$value1.'<br>';
//                 }
//             }
//              echo $test;
//         }else{echo'no users';}   