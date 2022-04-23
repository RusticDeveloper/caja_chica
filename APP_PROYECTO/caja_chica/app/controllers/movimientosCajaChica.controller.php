<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('./app/models/connection.php');
require('./app/models/usuarios.php');
require('./app/models/movimientosCajaChica.php');
session_start();
// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo
$monto = filter_input(INPUT_POST, 'monto_mov');
$usuario_autoriza = filter_input(INPUT_POST, 'autorizado');
$usuario_solicita = filter_input(INPUT_POST, 'solicitado');
$tipo_movimiento = filter_input(INPUT_POST, 'solicitado');
$tipo_pago = filter_input(INPUT_POST, 'solicitado');
$descripcion = filter_input(INPUT_POST, 'description');
$comprobante = filter_input(INPUT_POST, 'comprobante');
$authKey = filter_input(INPUT_POST, 'clave_auth');
$action = filter_input(INPUT_POST, 'action');
$file = (isset($_FILES['comprovante'])) ? $_FILES['comprovante'] : 'noFile';
$informacion = array(
    "monto" => $monto, "solicita" => $usuario_solicita, "autoriza" => $usuario_autoriza,
     "descripcion" => $descripcion, "tipoPago"=>$tipo_pago,"tipoMovimiento"=>$tipo_movimiento
);

// DDRC-C: VARIABLES USADAS PARA ACTUALIZAR ANULAR Y REVISAR UN MOVIMIENTO
$futureAction = filter_input(INPUT_GET, 'action');
$idMove = filter_input(INPUT_GET, 'idMove');
if (isset($idMove)) {
    $currentMove = getMove($idMove);
    // foreach ($currentMove as $key => $value) {
    //     echo $key.'=>'.$value.'<br>';
    // }
}

// DDRC-C: comportamiento de la vista dependiendo de una acción y de si hay una caja chica en uso
$current = getCurrentPettyBox();

// DDRC-C: devuelve a la lista de movimientos si no existe una caja chica
if (gettype($current) === 'string') {
    header('Location:moves-list');
    // exit('no exite una caja chica');
} else {

    // DDRC-C: si hay una caja chica que actualmente este en uso
    $idPettyBox = $current['id'];
    $informacion['idCajaChica'] = $idPettyBox;

    switch ($action) {
        case 'crear':
            // DDRC-C: crea un nuevo registro de caja chica
            // echo $idPettyBox.'<br>';
            // echo $currentValue;
            $actualKey = getAuth($usuario_autoriza);
            $currentValue = floatval(getCurrentPettyBoxValue($idPettyBox)['saldo_actual_caja_chica']);
            if ($currentValue<=0 || $monto>$currentValue) {
                header('Location:move-performance?action=fsf');
                $_SESSION['noFunds'] = 'La caja chica no tiene fondos, haga una reposicion de fondos';
            } else {
                if (md5($authKey) === $actualKey['confirma_clave']) {
                    echo addMove($informacion, $file);
                    header('Location:moves-list');
                } else {
                    header('Location:move-performance?action=CREAR');
                    $_SESSION['invalidKey'] = 'la clave de autorizacion no coincide';
                }
            }            
            break;

        case 'actualizar':
            // DDRC-C: actualiza un registro de caja chica 
            echo updateMove($idMove, $informacion, $file);
            header('Location:moves-list');
            break;

        case 'anular':
            // DDRC-C: elimina un registro de caja chica
            echo deleteMove($idPetty, $informacion);
            header('Location:moves-list');
            break;

        default:
            $usuarios = getUserList();
            
            include('./app/views/movimientos.php');
            // echo $futureAction;
            // echo $action;
            // echo $idMove;
            break;
    }
}
