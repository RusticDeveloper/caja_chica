<?php
function getUserList(){
    global $db;
    $query='SELECT id_usuario,nombres,apellidos FROM  usuario INNER JOIN persona ON usuario.id_persona = persona.id_persona;';
    $statement=$db->prepare($query);
    $statement->execute();
    $usuarios = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    if(!$usuarios) exit('No existen resultados');
    return $usuarios;
}