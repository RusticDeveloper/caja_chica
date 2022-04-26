
<?php

// require_once('./app/core/clases/router/Routes.php');
// require_once('./app/core/clases/router/Route.php');
// spl_autoload_register(function($class_name){
//     require_once 'app/core/clases/router/'.$class_name.'.php';
// });
// echo $_GET['url'];
// echo __DIR__;

$req = $_SERVER['REQUEST_URI'];
$last = explode('/', $req);
$part = end($last);
$request = explode('?', $part);
$urlpath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// echo (explode('?',$request)[1].'<br>');
// echo var_dump($urlpath);
// echo var_dump($request[1]);
// echo $_GET['action'];
switch ($request[0]) {
    case '/':
        require __DIR__ . '/app/views/inicio.php';
        break;
    case 'index':
        require __DIR__ . '/app/views/inicio.php';
        break;
    case '':
        require __DIR__ . '/app/views/inicio.php';
        break;
    case 'cajaChica':
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'reposicion':
        require __DIR__ . '/app/controllers/reposicionCajaChica.controller.php';
        break;
    case 'movimientos':
        require __DIR__ . '/app/controllers/listaMovimientosCajaChica.controller.php';
        break;
    case 'arqueos':
        require __DIR__ . '/app/controllers/listaArqueosCajaChica.controller.php';
        break;
    case 'reportes':
        require __DIR__ . '/app/controllers/reportes.controller.php';
        break;
    case 'manual':
        require __DIR__ . '/app/views/manual.php';
        break;
    case 'update-pettybox':
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'delete-pettybox':
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'create-pettybox':
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'moves-list':
        require __DIR__ . '/app/controllers/listaMovimientosCajaChica.controller.php';
        break;
    case 'move-performance':
        require __DIR__ . '/app/controllers/movimientosCajaChica.controller.php';
        break;
    case 'settlements-list':
        // echo $_GET['action'];
        require __DIR__ . '/app/controllers/listaArqueosCajaChica.controller.php';
        break;
    case 'settlement-report':
        require __DIR__ . '/app/controllers/reportes.controller.php';
        break;
    case 'result-state-report':
        require __DIR__ . '/app/controllers/reportes.controller.php';
        break;
    case 'settlement':
        require __DIR__ . '/app/controllers/arqueosCajaChica.controller.php';
        break;
    case 'reposition':
        require __DIR__ . '/app/controllers/reposicionCajaChica.controller.php';
        break;
    case 'reports':
        require __DIR__ . '/app/controllers/reportes.controller.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/app/views/common/notFound.php';
        break;
}

?>