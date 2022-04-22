<?php
// DDRC-C: connección PDO para la base de datos
$dsn = "mysql:host=localhost;dbname=dbproyecto";
$username = 'root';
$password = '';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error = "Ocurrio un error en la conección";
    $error .= $e->getMessage();
    include('../Views/error.php');
    exit();
}

// $coneccion = mysqli_connect(
//     "localhost",
//     "root",
//     "",
//     "dbproyecto",
//     "3306"
// );
// if ($coneccion->connect_error) {
//     die("Error de coneccion por:" . $coneccion->connect_error);
// } else {
//     echo "Conexion Exitosa";
// }
