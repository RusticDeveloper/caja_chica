<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('./app/models/connection.php');
// require('./app/models/cajaChica.php');
require('./app/models/movimientosCajaChica.php');

// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo

$action = filter_input(INPUT_GET, 'action');
$idMove = filter_input(INPUT_GET, 'identificador');


// DDRC-C: comportamiento de la lista dependiendo de si tiene datos la DB

// $currentPB = getCurrentPettyBox();
// $idPettyBox = $currentPB['id'];


switch ($action) {
    case 'CREAR':
        // DDRC-C: crea un nuevo registro de caja chica
        header('location:move-performance?action=' . $action);
        echo 'entro a crear';
        break;

    case 'REVISAR':
        // DDRC-C: actualiza un registro de caja chica 
        header('location:move-performance?action=' . $action . '&idMove=' . $idMove);
        echo 'entro a revisar';
        break;

    case 'ACTUALIZAR':
        // DDRC-C: elimina un registro de caja chica
        header('location:move-performance?action=' . $action . '&idMove=' . $idMove);
        echo 'entro a actualizar';
        break;

    case 'ANULAR':
        // DDRC-C: elimina un registro de caja chica
        header('location:move-performance?action=' . $action . '&idMove=' . $idMove);
        echo 'entro a eliminar';
        break;

    case 'NULLIFIED':
        // DDRC-C:muestra los registros eliminados un registro de caja chica        
        $movimientosAnulados = getNullifiedMoves();
        if (gettype($movimientosAnulados) === 'string') {
            $isNullifiedEmpthy = true;
        }
        include('./app/views/listaMovimientos.php');
        break;

    default:
        $movimientos = getMoves();
        if (gettype($movimientos) === 'string') {
            $isEmpthy = true;
            // include('./app/views/sinCajaChica.php');
        }
        include('./app/views/listaMovimientos.php');
        break;
}
