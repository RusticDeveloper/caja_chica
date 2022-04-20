<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('../models/connection.php');
require('../models/cajaChica.php');
require('../models/arqueosCajaChica.php');

// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo

$action = filter_input(INPUT_GET, 'action');
$identification = filter_input(INPUT_GET, 'identificador');

// DDRC-C: comportamiento de la vista dependiendo de una acción y de si hay una caja chica en uso
$current = getCurrentPettyBox();
if (gettype($current) !== 'string') {
    $idPettyBox = $current['id'];
}


switch ($action) {
    case 'REVISAR':
        // DDRC-C: crea un nuevo registro de caja chica
        // header('location:reportes.controller.php?action=' . $action);
        // include('reportes.controller.php');
        // ReporteArqueo($identification);
        echo 'entro a crear';
        break;
    case 'CREAR':
        // DDRC-C: crea un nuevo registro de caja chica
        header('location:arqueosCajaChica.controller.php?action=' . $action);
        echo 'entro a crear';
        break;

    default:
    if (isset($idPettyBox)) {
        $arqueos=getPettyBoxSettlements($idPettyBox);
        if (gettype($arqueos) === 'string') {
            $isEmpthy = true;
        }
        include('../views/listaArqueos.php');
    }else{
        include('../views/sinCajaChica.php');
    }
        break;
}

// DDRC-C: genera el reporte que se muestra al presionar en revisar
function Report(){

}
