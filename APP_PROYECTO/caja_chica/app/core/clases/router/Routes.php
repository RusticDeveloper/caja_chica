<?php 
require_once('Route.php');
Route::set('index.php',function(){
 echo 'esta en el inicio';
});
Route::set('cajaChica',function(){
    include_once('./app/controllers/cajaChica.controller.php');
 echo 'ingeso a caja chica';
});
Route::set('reposicion',function(){
 include_once('./app/controllers/reposicionCajaChica.controller.php');
 echo 'ingeso a reposicion';
});
Route::set('movimientos',function(){
 echo 'ingeso a movimientos';
});
Route::set('movimiento',function(){
 echo 'ingeso a movimiento';
});
Route::set('arqueos',function(){
 echo 'ingeso a arqueos';
});
Route::set('arqueo',function(){
 echo 'ingeso a arqueo';
});
Route::set('reportes',function(){
 echo 'ingeso a reportes';
});
Route::set('manual',function(){
 echo 'ingeso a manual';
});