<?php
// DDRC-C: rewqquiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('../models/connection.php');
require('../models/cajaChica.php');
require('../models/usuarios.php');

// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo
$monto = filter_input(INPUT_POST, 'monto');
$usuario = filter_input(INPUT_POST, 'usuario');
$action = filter_input(INPUT_POST, 'action');
$informacion = array("monto" => $monto, "usuario" => $usuario);
// DDRC-C: comportamiento de la vista dependiendo de una acción
switch ($action) {
    case 'insertar':
        // DDRC-C: crear un registro nuevo de caja chica en la base de datos
        //  echo addPettyBox($informacion);
        // unset($action);
        // header('Location: ../views/caja_chica.php');
        # code...
        break;
    case 'actualizar':
        $current = getCurrentPettyBox();
        
        echo gettype($current);
        foreach ($current as $key => $value) {
            echo $key . '=>' . $value.'<br>';
        }
        
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
//           
