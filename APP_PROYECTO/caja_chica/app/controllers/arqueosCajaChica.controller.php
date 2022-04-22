<?php
// DDRC-C: requiere el archivo de coneccion con la base de datos y el modelo de caja chica
require('./app/models/connection.php');
require('./app/models/arqueosCajaChica.php');
require('./app/models/movimientosCajaChica.php');


// DDRC-C:recupera los datos enviados al controlador y estructura los datos para el modelo
// DDRC-C: Datos de la caja chica
$current = getCurrentPettyBox();
$idPettyBox = $current['id'];
$montoCC = floatval($current['monto_caja_chica']);
// DDRC-C: Datos de los movimientos
$movimientos = getMoves($idPettyBox);
$total_movimientos = 0;
if (gettype($movimientos) === 'string') {
    $isEmpthy = true;
} else {
    foreach ($movimientos as $key => $value) {
        $total_movimientos += floatval($value['monto_movimiento']);
    }
}

$b_cien = filter_input(INPUT_POST, 'b_cien');
$b_cincuenta = filter_input(INPUT_POST, 'b_cincuenta');
$b_veinte = filter_input(INPUT_POST, 'b_veinte');
$b_diez = filter_input(INPUT_POST, 'b_diez');
$b_cinco = filter_input(INPUT_POST, 'b_cinco');
$b_uno = filter_input(INPUT_POST, 'b_uno');
$m_un = filter_input(INPUT_POST, 'm_un');
$m_cincuenta = filter_input(INPUT_POST, 'm_cincuenta');
$m_veinticinco = filter_input(INPUT_POST, 'm_veinticinco');
$m_diez = filter_input(INPUT_POST, 'm_diez');
$m_cinco = filter_input(INPUT_POST, 'm_cinco');
$m_uno = filter_input(INPUT_POST, 'm_uno');
$total_caja = floatval(($b_cien * 100) + ($b_cincuenta * 50) + ($b_veinte * 20) + ($b_diez * 10) + ($b_cinco * 5) + ($b_uno) +
    ($m_un) + ($m_cincuenta * 0.5) + ($m_veinticinco * 0.25) + ($m_diez * 0.10) + ($m_cinco * 0.05) + ($m_uno * 0.01));
if (($total_caja + $total_movimientos) > $montoCC) {
    $excedente=($total_caja + $total_movimientos) - $montoCC;
    $descripcion = 'Hay un excedente de $'.$excedente;
} else if (($total_caja + $total_movimientos) < $montoCC) {
    $excedente= $montoCC - ($total_caja + $total_movimientos) ;
    $descripcion = 'Hay un faltante de $'.$excedente;
} else if (($total_caja + $total_movimientos) === $montoCC) {
    $descripcion = 'Sin observaciones. Las cuentas cuadran';
}

$action = filter_input(INPUT_POST, 'action');
$futureAction = filter_input(INPUT_GET, 'action');
$informacion = array("idCC" => $idPettyBox, "totalCC" => $total_caja,"totalMoves" => $total_movimientos,
"b_cien" => $b_cien,"b_cincuenta" => $b_cincuenta,"b_veinte" => $b_veinte,"b_diez" => $b_diez,"descripcion" => $descripcion,
"b_cinco" => $b_cinco,"b_uno" => $b_uno,"m_un" => $m_un,"m_cincuenta" => $m_cincuenta,
"m_veinticinco" => $m_veinticinco,"m_diez" => $m_diez,"m_cinco" => $m_cinco,"m_uno" => $m_uno);

// DDRC-C: comportamiento de la vista dependiendo de una acción y de si hay una caja chica en uso

switch ($action) {
    case 'crear':
        // DDRC-C: crea un nuevo registro de caja chica
         echo addPettyBoxSettlement($informacion);
        echo deletePettyBox($idPettyBox);
        // unset($action);
        header('Location:settlements-list');
        echo $total_caja . '<br>';
        echo $total_movimientos . '<br>';
        echo ($total_caja + $total_movimientos) . '<br>';
        echo $montoCC . '<br>';
        echo $descripcion . '<br>';

        echo 'entro a crear';
        break;

    case 'revisar':
        // DDRC-C: actualiza un registro de caja chica 
        //  echo updatePettyBox($idPettyBox);
        // unset($action);
        // header('Refresh:0');
        echo $idPettyBox;
        echo 'entro a REVISAR';
        break;


    default:
        // $usuarios = getUserList();

        include('./app/views/arqueos.php');
        break;
}
