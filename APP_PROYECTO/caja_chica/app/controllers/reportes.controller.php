<?php

// DDRC-C:obtiene datos de la base de datos y reportes

include('./app/models/connection.php');
// DDRC-C: utiliza la libreria para generar reportes
require('./app/core/dependencies/TCPDF/tcpdf.php');
// DDRC-C: objeto con los valores por defecto para los reportes
$report = new TCPDF('P', 'mm', 'A4');
//set metadata
$report->setCreator(PDF_CREATOR);
$report->setAuthor('Daniel Rivas');
$report->setTitle('Proyecto caja Chica');
$report->setSubject('APP Proyecto');
$report->setKeywords('caja chica, clinica divino niño, reporte');
//set header and footer data
$report->setHeaderData('', 10, 'REPORTES', 'reporte de caja chica', array(0, 0, 0), array(0, 0, 0));
$report->setFooterData(array(250, 2, 21), array(6, 255, 33));
// set header and footer fonts
$report->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$report->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$report->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$report->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$report->SetHeaderMargin(PDF_MARGIN_HEADER);
$report->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$report->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$report->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$report->SetFont('dejavusans', '', 14, '', true);

// DDRC-C: crea una nueva pagina
$report->AddPage();

// DDRC-C obtienen valores de la Base de datos

$accion = filter_input(INPUT_GET, 'action');
$id = filter_input(INPUT_GET, 'identificador');

switch ($accion) {
    case 'moves':
        // echo 'entro a movmientos';
        ReporteMovimientos();
        break;
    case 'settlements':
        // echo 'entro a movmientos';
        ReporteArqueos();
        break;
    case 'settlement':
        // echo 'entro a movmientos';
        ReporteArqueo($id);
        break;

    default:
        include('./app/views/reportes.php');
        break;
}

// DDRC-C: funciones para los distintos reportes
function ReporteMovimientos()
{
    global $report;

    // DDRC-C: datos de la base
    include('./app/models/movimientosCajaChica.php');
    $listaMovimientos = getMoves();

    // DDRC-C: contruir el reporte
    if (gettype($listaMovimientos) === 'string') {
        $html = '<h1>No hay registros de movimientos</h1>';
    } else {
        $html = <<<EOD
    <h1>Lista de Movimientos de caja actual</h1>
    <table cellspacing="0" cellpadding="1" border="1">
        <tr>
            <th>Solicitado</th>
            <th>Autorizado</th>
            <th>Descipción</th>
            <th>Fecha movimiento</th>
        </tr>
    EOD;
        foreach ($listaMovimientos as $key => $value) {
            $html .= '<tr><td>' . $value['nsol'] . ' ' . $value['apsol'] . '</td>';
            $html .= '<td>' . $value['nauth'] . ' ' . $value['apauth'] . '</td>';
            $html .= '<td>' . $value['descripcion'] . '</td>';
            $html .= '<td>' . $value['fecha_movimiento'] . '</td></tr>';
        };
        $html .= '</table>';
    }

    // imprime la tabla html
    $report->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Clean any content of the output buffer
ob_end_clean();
    // DDRC-C: imprime el reporte
    $report->output('Reporte-Movimientos.pdf', 'I');
}

function ReporteArqueos()
{
    global $report;

    // DDRC-C: datos de la base
    include('./app/models/cajaChica.php');
    include('./app/models/arqueosCajaChica.php');
    $caja = getCurrentPettyBox();
    $idcaja = $caja['id'];
    $listaArqueos = getPettyBoxSettlements($idcaja);

    // DDRC-C: contruir el reporte
    if (gettype($listaArqueos) === 'string') {
        $html = '<h1>No hay registros de arqueos</h1>';
    } else {
        $html = <<<EOD
    <h1>Lista de Arqueos de caja actual</h1>
    <table cellspacing="0" cellpadding="1" border="1">
        <tr>
            <th>fecha arqueo</th>
            <th>total movimientos</th>
            <th>total caja</th>
            <th>monto caja</th>
            <th>descripción</th>
        </tr>
    EOD;
        foreach ($listaArqueos as $key => $value) {
            $html .= '<tr><td>' . $value['fecha_arqueo'] . '</td>';
            $html .= '<td>' . $value['total_movimientos'] . '</td>';
            $html .= '<td>' . $value['total_caja_chica'] . '</td>';
            $html .= '<td>' . $value['monto_caja_chica'] . '</td>';
            $html .= '<td>' . $value['descripcion'] . '</td></tr>';
        };
        $html .= '</table>';
    }

    // imprime la tabla html
    $report->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Clean any content of the output buffer
ob_end_clean();
    // DDRC-C: imprime el reporte
    $report->output('Reporte-Arqueos.pdf', 'I');
}

function ReporteArqueo($idReporte)
{
    global $report;

    // DDRC-C: datos de la base
    include('./app/models/arqueosCajaChica.php');
    include('./app/models/movimientosCajaChica.php');
    
    $caja=getCurrentPettyBox();
    $arqueo = getPettyBoxSettlement($idReporte);
    $listaMovimientos = getMoves();

    $nombre=$caja['nombres'].'  '.$caja['apellidos'];
    $cantidad=$caja['monto_caja_chica'];
    $fecha=$caja['fecha_apertura'];
    $sumaBilletes=floatval((intval($arqueo['billetes_cien']) * 100)+(intval($arqueo['billetes_cincuenta']) * 50)+(intval($arqueo['billetes_veinte']) * 20)+
    (intval($arqueo['billetes_diez']) * 10)+(intval($arqueo['billetes_cinco']) * 5)+(intval($arqueo['billetes_uno'])));

    $sumaMonedas=floatval((intval($arqueo['monedas_dolar']))+(intval($arqueo['monedas_cincuenta']) * 0.5)+(intval($arqueo['monedas_veinticinco']) * 0.25)+
    (intval($arqueo['monedas_diez']) * 0.1)+(intval($arqueo['monedas_cinco']) * 0.05)+(intval($arqueo['monedas_uno']) * 0.01));
    // DDRC-C: contruir el reporte
    if (gettype($arqueo) === 'string') {
        $html = '<h1>No existe el arqueo</h1>';
    } else {
        $html = <<<EOD
    <h2>Arqueo de caja chica</h2>
    <br>
    <h4>Encardado: $nombre</h4>
    <h4>Cantidad asignada: $cantidad</h4>
    <h4>Fecha de creación: $fecha</h4>
    
    <h2>Lista de movimientos</h2>
    <table cellspacing="0" cellpadding="1" border="1" style="border-color:gray;text-align:center;">
        <tr style="background-color:green;color:white;">
            <th>Fecha movimiento</th>
            <th>Concepto</th>
            <th>Importe</th>
            
        </tr>
    EOD;
        foreach ($listaMovimientos as $key => $value) {
            $html .= '<tr><td>' . $value['fecha_movimiento'] . '</td>';
            $html .= '<td>' . $value['descripcion'] . '</td>';
            $html .= '<td>' . $value['monto_movimiento'] . '</td></tr>';
        };
        $html .= '<tr>
        <td colspan="2"> Total en movimientos:</td>
        <td>' . $arqueo['total_movimientos'] . '</td>
        </tr>
        </table>
        
        <h2>Dinero en caja</h2>
        <table cellspacing="3" cellpadding="1" border="1" style="border-color:gray; text-align:center;">
        <tr style="background-color:black;color:white;">
            <th colspan="3">Billetes</th>
        </tr>
        <tr>
        <td>Del corte de $100</td>
        <td>' . $arqueo['billetes_cien'] . ' unidades</td>
        <td>' . intval($arqueo['billetes_cien']) * 100 . '</td>
        </tr>

        <tr>
        <td>Del corte de $50</td>
        <td>' . $arqueo['billetes_cincuenta'] . ' unidades</td>
        <td>' . intval($arqueo['billetes_cincuenta']) * 50 . '</td>
        </tr>

        <tr>
        <td>Del corte de $20</td>
        <td>' . $arqueo['billetes_veinte'] . ' unidades</td>
        <td>' . intval($arqueo['billetes_veinte']) * 20 . '</td>
        </tr>

        <tr>
        <td>Del corte de $10</td>
        <td>' . $arqueo['billetes_diez'] . ' unidades</td>
        <td>' . intval($arqueo['billetes_diez']) * 10 . '</td>
        </tr>

        <tr>
        <td>Del corte de $5</td>
        <td>' . $arqueo['billetes_cinco'] . ' unidades</td>
        <td>' . intval($arqueo['billetes_cinco']) * 5 . '</td>
        </tr>

        <tr>
        <td>Del corte de $1</td>
        <td>' . $arqueo['billetes_uno'] . ' unidades</td>
        <td>' . intval($arqueo['billetes_uno']) . '</td>
        </tr>

        <tr>
        <td colspan="2">Total billetes</td>
        <td> $ ' . $sumaBilletes . '</td>
        </tr>

        <tr style="background-color:black;color:white;">
        <th colspan="3">Monedas</th>
        </tr>  
    
        <tr>
        <td>Del corte de $1</td>
        <td>' . $arqueo['monedas_dolar'] . ' unidades</td>
        <td>' . intval($arqueo['monedas_dolar']) . '</td>
        </tr>
        
        <tr>
        <td>Del corte de $0.50</td>
        <td>' . $arqueo['monedas_cincuenta'] . ' unidades</td>
        <td>' . intval($arqueo['monedas_cincuenta']) * 0.5 . '</td>
        </tr>
        
        <tr>
        <td>Del corte de $0.25</td>
        <td>' . $arqueo['monedas_veinticinco'] . ' unidades</td>
        <td>' . intval($arqueo['monedas_veinticinco']) * 0.25 . '</td>
        </tr>
        
        <tr>
        <td>Del corte de $0.10</td>
        <td>' . $arqueo['monedas_diez'] . ' unidades</td>
        <td>' . intval($arqueo['monedas_diez']) * 0.1 . '</td>
        </tr>
        
        <tr>
        <td>Del corte de $0.05</td>
        <td>' . $arqueo['monedas_cinco'] . ' unidades</td>
        <td>' . intval($arqueo['monedas_cinco']) * 0.05 . '</td>
        </tr>
        
        <tr>
        <td>Del corte de $0.01</td>
        <td>' . $arqueo['monedas_uno'] . ' unidades</td>
        <td>' . intval($arqueo['monedas_uno']) * 0.01 . '</td>
        </tr>

        <tr>
        <td colspan="2">Total Monedas</td>
        <td> $ ' . $sumaMonedas . '</td>
        </tr>

        <tr style="background-color:grey;color:white;">
        <td colspan="2">Total en caja chica:</td>
        <td>'. $arqueo['total_caja_chica'] . '</td>
        </tr>  


        </table>
        <hr>
        <h3>Observaciones del arqueo:'. $arqueo['descripcion'] . '</h3>
        ';
    }

    // imprime la tabla html
    $report->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Clean any content of the output buffer
ob_end_clean();
    // DDRC-C: imprime el reporte
    $report->output('Reporte-Arqueos.pdf', 'I');
}
