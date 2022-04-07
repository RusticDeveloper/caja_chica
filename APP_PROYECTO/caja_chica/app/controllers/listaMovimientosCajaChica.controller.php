<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('../models/connection.php');
require('../models/movimientosCajaChica.php');
require('../models/usuarios.php');

// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo

$usuario = filter_input(INPUT_POST, 'usuario');
$descripcion = filter_input(INPUT_POST, 'descripcion');
$action = filter_input(INPUT_GET, 'action');
$idMove = filter_input(INPUT_GET, 'identificador');


// DDRC-C: comportamiento de la lista dependiendo de si tiene datos la DB
$futureAction;
$currentPB=getCurrentPettyBox();
$idPettyBox = $currentPB['id'];
$movimientos = getMoves($idPettyBox);

if (gettype($movimientos) === 'string') {
    $isEmpthy=true;
}

switch ($action) {
    case 'CREAR':
        // DDRC-C: crea un nuevo registro de caja chica
        //  echo addPettyBox($informacion);
        // unset($action);
        header('location:movimientosCajaChica.controller.php?action='.$action);
        echo 'entro a crear';
        break;

    case 'REVISAR':
        // DDRC-C: actualiza un registro de caja chica 
        //  echo updatePettyBox($idPettyBox);
        // unset($action);
        // header('Refresh:0');
        // echo $idPettyBox;
        header('location:movimientosCajaChica.controller.php?action='.$action.'&idMove='.$idMove);
        echo 'entro a revisar';
        echo $action;
        echo $id;
        break;

    case 'ACTUALIZAR':
        // DDRC-C: elimina un registro de caja chica
        //  echo deletePettyBox($idPetty);
        // unset($action);
        // header('Refresh:0');
        // echo $idPettyBox;
        header('location:movimientosCajaChica.controller.php?action='.$action.'&idMove='.$idMove);
        echo 'entro a actualizar';
        break;
    
    case 'ANULAR':
        // DDRC-C: elimina un registro de caja chica
        //  echo deletePettyBox($idPetty);
        // unset($action);
        // header('Refresh:0');
        // echo $idPettyBox;
        header('location:movimientosCajaChica.controller.php?action='.$action.'&idMove='.$idMove);
        echo 'entro a eliminar';
        break;
    
    case 'NULLIFIED':
        // DDRC-C:muestra los registros eliminados un registro de caja chica        
        echo 'entro a MOSTRAR MOVIMIENOS ELIMINADOS';
        break;

    default:
        $usuarios = getUserList();
        include('../views/listaMovimientos.php');
        break;
}
