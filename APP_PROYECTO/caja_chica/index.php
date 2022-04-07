<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/general.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <!-- DDRC-C: custom icon for the tab -->
    <link rel="icon" type="image/svg" href="assets/img/favicon.svg">
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
                            <img src="assets/img/beer.svg" class="img" alt="description image">
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
                            <img src="assets/img/beer.svg" class="img" alt="description image">
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
                        <img src="assets/img/beer.svg" class="img-fluid" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Movimientos</h3>
            </div>
        </a>
        </div>
        <div class="card ACC">
        <a href="app/views/arqueo.php">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="our-team">
                    <div class="picture">
                        <img src="assets/img/beer.svg" class="img" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Arqueo de caja chica</h3>
            </div>
        </a>
        </div>
        <div class="card RECC">
        <a href="app/views/reportes.php">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="our-team">
                    <div class="picture">
                        <img src="assets/img/beer.svg" class="img" alt="description image">
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
                        <img src="assets/img/beer.svg" class="img" alt="description image">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h3>Manual de uso</h3>
            </div>
        </a>
        </div>
    </section>
    <!-- <a href="app/controllers/cajaChica.controller.php"> ir a caja chica</a> -->

</body>

</html>
<?php
require('app/models/connection.php');

?>