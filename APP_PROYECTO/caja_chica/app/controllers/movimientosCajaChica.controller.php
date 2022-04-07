<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('../models/connection.php');
require('../models/usuarios.php');
require('../models/movimientosCajaChica.php');
// require('../models/cajaChica.php');
// require('../controllers/archivos.controller.php');

// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo
$monto = filter_input(INPUT_POST, 'monto_mov');
$usuario_solicita = filter_input(INPUT_POST, 'autorizado');
$usuario_autoriza = filter_input(INPUT_POST, 'solicitado');
$descripcion = filter_input(INPUT_POST, 'description');
$comprobante = filter_input(INPUT_POST, 'comprobante');
$action = filter_input(INPUT_POST, 'action');
$file = (isset($_FILES['comprovante'])) ? $_FILES['comprovante'] : 'noFile';
$informacion = array(
    "monto" => $monto, "solicita" => $usuario_solicita, "autoriza" => $usuario_autoriza, "descripcion" => $descripcion
);

// DDRC-C: VARIABLES USADAS PARA ACTUALIZAR ANULAR Y REVISAR UN MOVIMIENTO
$futureAction = filter_input(INPUT_GET, 'action');
$idMove = filter_input(INPUT_GET, 'idMove');
if (isset($idMove)) {
    $currentMove=getMove($idMove);
    foreach ($currentMove as $key => $value) {
        echo $key.'=>'.$value.'<br>';
    }
} 

// DDRC-C: comportamiento de la vista dependiendo de una acción y de si hay una caja chica en uso
$current = getCurrentPettyBox();
$idPettyBox = null;

if (gettype($current) === 'string') {
    header('Location:listaMovimientosCajaChica.controller.php');
    // exit('no exite una caja chica');
} else {

// DDRC-C: si hay una caja chica que actualmente este en uso
    // $idPettyBox = $current['id'];
    $informacion['idCajaChica']=$current['id'];

    switch ($action) {
        case 'crear':
            // DDRC-C: crea un nuevo registro de caja chica
             echo addMove($informacion,$file);
            header('Location:listaMovimientosCajaChica.controller.php');
            break;

        case 'actualizar':
            // DDRC-C: actualiza un registro de caja chica 
             echo updateMove($idMove,$informacion,$file);
            header('Location:listaMovimientosCajaChica.controller.php');
            break;

        case 'anular':
            // DDRC-C: elimina un registro de caja chica
             echo deleteMove($idPetty,$informacion);
            header('Location:listaMovimientosCajaChica.controller.php');
            break;
            
        default:
            $usuarios = getUserList();
            echo $futureAction;
            echo $action;
            echo $idMove;
            include('../views/movimientos.php');
            break;
    }
}

