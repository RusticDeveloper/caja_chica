<!-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/general.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    DDRC-C: custom icon for the tab
    <link rel="icon" type="image/svg" href="./assets/img/favicon.svg">
    <title>APP PROYECTO</title>
</head>

<body>
    <section class="bodyContent">
        <div class="contentHeader">
            <h1>Caja Chica </h1>
        </div>

        <div class="card CACC">
            <a href="app/controllers/cajaChica.controller.php">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="our-team">
                        <div class="picture">
                            <img src="assets/img/4.svg" class="img" alt="description image">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <h3>Crear/Actualizar caja chica</h3>
                </div>
            </a>
        </div>
        <div class="card RCC">
            <a href="app/controllers/reposicionCajaChica.controller.php">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="our-team">
                        <div class="picture">
                            <img src="assets/img/6.svg" class="img" alt="description image">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <h3>Reposición de caja chica</h3>
                </div>
            </a>
        </div>
        <div class="card MCC">
        <a href="app/controllers/listaMovimientosCajaChica.controller.php">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="our-team">
                    <div class="picture">
                        <img src="assets/img/8.svg" class="img" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Movimientos</h3>
            </div>
        </a>
        </div>
        <div class="card ACC">
        <a href="app/controllers/listaArqueosCajaChica.controller.php">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="our-team">
                    <div class="picture">
                        <img src="assets/img/14.svg " class="img" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Arqueo de caja chica</h3>
            </div>
        </a>
        </div>
        <div class="card RECC">
        <a href="app/controllers/reportes.controller.php">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="our-team">
                    <div class="picture">
                        <img src="assets/img/reports.svg " class="img" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Reportes</h3>
            </div>
        </a>
        </div>
        <div class="card MACC">
        <a href="app/views/manual.php">
            <div class="card-header">
                <p></p>
            </div>
            <div class="card-body">
                <div class="our-team">
                    <div class="picture">
                        <img src="assets/img/manual.svg" class="img" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Manual de uso</h3>
            </div>
        </a>
        </div>
    </section>
</body>

</html> -->
<?php

// require_once('./app/core/clases/router/Routes.php');
// require_once('./app/core/clases/router/Route.php');

// spl_autoload_register(function($class_name){
//     require_once 'app/core/clases/router/'.$class_name.'.php';
// });

// echo $_GET['url'];
// echo __DIR__;
$request1 = $_SERVER['REQUEST_URI'];
$part=explode('/',$request1);
$request = end($part);
// echo (explode('?',$request)[1].'<br>');
// echo var_dump($part);
switch ($request) {
    case '/' :
        require __DIR__ . '/app/views/inicio.test.php';
        break;
    case '' :
        require __DIR__ . '/app/views/inicio.test.php';
        break;
    case 'manual' :
        require __DIR__ . '/app/views/manual.php';
        break;
    case 'reposicion' :
        require __DIR__ . '/app/views/manual.php';
        break;
    case 'cajaChica?action' :
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'movimientos' :
        require __DIR__ . '/app/controllers/listaMovimientosCajaChica.controller.php';
        break;
    case 'cajaChica' :
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'cajaChica' :
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    case 'cajaChica' :
        require __DIR__ . '/app/controllers/cajaChica.controller.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/app/views/common/notFound.php';
        break;
}

?>