<?php
// DDRC-C: define la zona horaria de Quito por defecto
date_default_timezone_set('America/Lima');

function addPettyBox($information)
{
   // DDRC-C: variable global de la base de datos
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'INSERT INTO caja_chica (monto_caja_chica,restante_caja_chica,usuario_encargado,fecha_apertura,descripcion) VALUES (:monto,:encargado,:f_apertura,:descripcion,:restante);';
   $statement = $db->prepare($query);
   $statement->bindValue(':monto',$information['monto']);
   $statement->bindValue(':restante',$information['monto']);
   $statement->bindValue(':encargado',$information['usuario']);
   $statement->bindValue(':descripcion',$information['descripcion']); 
   $statement->bindValue(':f_apertura',date('Y-m-d H:i:s'));  
   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      return ('No se creo la caja chica');
   else {
      return ('La caja chica se creo/actualizo correctamente');
   }
}

function updatePettyBox($identification,$information)
{
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'UPDATE caja_chica SET monto_caja_chica=:monto,descripcion=:descripcion,restante_caja_chica=:restante WHERE id = :identificacion;';
   $statement = $db->prepare($query);
   $statement->bindValue(':monto',$information['monto']);  
   $statement->bindValue(':restante',$information['monto']);  
   $statement->bindValue(':descripcion',$information['descripcion']);  
   $statement->bindValue(':identificacion',$identification);  
   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      return ('No se actualizo la caja chica');
   else {
      return ('La caja chica se creo/actualizo correctamente');
   }
}

function deletePettyBox($identification)
{
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'UPDATE caja_chica SET fecha_cierre=:f_cierre WHERE id = :identificacion;';
   // $query = 'DELETE FROM caja_chica WHERE id = :identicacion;';
   $statement = $db->prepare($query);
   $statement->bindValue(':f_cierre',date('Y-m-d H:i:s')); 
   $statement->bindValue(':identificacion',$identification); 
   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      exit('No se elimino la caja chica');
   else {
      return ('La caja chica eliminada correctamente');
   }
}

function getPettyBoxes()
{
   // should not use for now 
   global $db;
   $query = 'SELECT * FROM caja_chica';
   $statement = $db->prepare($query);
   $statement->execute();
   $cajas = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$cajas) return ('No existen resultados');
   return $cajas;
}

function getCurrentPettyBox()
{
   global $db;
   $query = 'SELECT id,monto_caja_chica,descripcion,nombres,apellidos,id_usuario FROM caja_chica 
   INNER JOIN usuario ON caja_chica.usuario_encargado = usuario.id_usuario 
   INNER JOIN persona ON usuario.id_persona = persona.id_persona
   WHERE fecha_cierre IS NULL ';
   $statement = $db->prepare($query);
   $statement->execute();
   $caja = $statement->fetch(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$caja) return('No existen resultados');
   return $caja;
}

// ******* funciones personalizadas aparte del crud *********

// DDRC-C: funciona para realizar la reposición de caja chica en la base datos
function resetPettyBox()
{
   global $db;
   $query = 'SELECT id,monto_caja_chica,descripcion,nombres,apellidos,id_usuario FROM caja_chica 
   INNER JOIN usuario ON caja_chica.usuario_encargado = usuario.id_usuario 
   INNER JOIN persona ON usuario.id_persona = persona.id_persona
   WHERE fecha_cierre IS NULL ';
   $statement = $db->prepare($query);
   $statement->execute();
   $caja = $statement->fetch(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$caja) return('No existen resultados');
   return $caja;
}

// DDRC-C: funciona para realizar la reposición de caja chica en la base datos
function getCurrentPettyBoxValue($identification)
{
   global $db;
   $query = 'SELECT restante_caja_chica FROM caja_chica 
   WHERE id = :identification';
   $statement = $db->prepare($query);
   $statement->bindValue(':identification',$identification); 
   $statement->execute();
   $caja = $statement->fetch(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$caja) return('No existen resultados');
   return $caja;
}
