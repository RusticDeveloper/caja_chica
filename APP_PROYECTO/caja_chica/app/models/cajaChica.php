<?php


function addPettyBox($information)
{
   // DDRC-C: variable global de la base de datos
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'INSERT INTO caja_chica (monto_caja_chica,usuario_encargado,fecha_apertura) VALUES (:monto,:encargado,:f_apertura);';
   $statement = $db->prepare($query);
   $statement->bindValue(':monto',$information['monto']);
   $statement->bindValue(':encargado',$information['usuario']);
   $statement->bindValue(':f_apertura',date('Y-m-d'));  
   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      exit('No se creo/actualizo la caja chica');
   else {
      return ('La caja chica se creo/actualizo correctamente');
   }

}

function updatePettyBox()
{
   global $db;
}

function deletePettyBox()
{
   global $db;
}

function getPettyBoxes()
{
   global $db;
   $query = 'SELECT * FROM caja_chica';
   $statement = $db->prepare($query);
   $statement->execute();
   $cajas = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$cajas) exit('No existen resultados');
   return $cajas;
}

function getCurrentPettyBox()
{
   global $db;
   $query = 'SELECT * FROM caja_chica WHERE fecha_cierre IS NULL ';
   $statement = $db->prepare($query);
   $statement->execute();
   $caja = $statement->fetch(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$caja) exit('No existen resultados');
   return $caja;
}
