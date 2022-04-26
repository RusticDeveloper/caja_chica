<?php
// DDRC-C: define la zona horaria de Quito por defecto
date_default_timezone_set('America/Lima');

// DDRC-C: Archivos requeridos para guardar un archivo

require('cajaChica.php');
require('./app/controllers/archivos.controller.php');

function addMove($information, $archivo = 'noFile')
{
   // DDRC-C: variable global de la base de datos
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'INSERT INTO movimientos_caja_chica (caja_chica_id,monto_movimiento,usuario_solicita
   ,usuario_autoriza,fecha_movimiento,descripcion,url_comprobante,tipo_movimiento,tipo_pago)
    VALUES (:idCC,:monto,:solicita,:autoriza,:f_movimiento,:descripcion,:urlC,:TMOV,:TPAG);';

   $statement = $db->prepare($query);

   if ($information['solicita'] === 'noUser') {
      $statement->bindValue(':solicita', NULL);
   } else {
      $statement->bindValue(':solicita', $information['solicita']);
   }

   // DDRC-C: realiza una copia del archivo enviado en el servidor
   if ($archivo === 'noFile') {
      $statement->bindValue(':urlC', '');
   } else {
      $url = saveFiles($archivo);
      $statement->bindValue(':urlC', $url);
   }
   $statement->bindValue(':monto', $information['monto']);
   $statement->bindValue(':idCC', $information['idCajaChica']);
   $statement->bindValue(':autoriza', $information['autoriza']);
   $statement->bindValue(':TMOV', $information['tipoMovimiento']);
   $statement->bindValue(':TPAG', $information['tipoPago']);
   $statement->bindValue(':descripcion', $information['descripcion']);
   $statement->bindValue(':f_movimiento', date('Y-m-d H:i:s'));

   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: nueva consulta que cambia el valor actual de la caja chica
   $query1  = 'UPDATE caja_chica SET saldo_actual_caja_chica=:restante WHERE id=:idCajaChica';
   $statement1 = $db->prepare($query1);
if ($information['tipoMovimiento']=='EGRESO') {
   $remainingCash = floatval(getCurrentPettyBoxValue($information['idCajaChica'])['saldo_actual_caja_chica']) - floatval($information['monto']);
}else{
   $remainingCash = floatval(getCurrentPettyBoxValue($information['idCajaChica'])['saldo_actual_caja_chica']) + floatval($information['monto']);
}

   $statement1->bindValue(':restante', $remainingCash);
   $statement1->bindValue(':idCajaChica', $information['idCajaChica']);



   $statement1->execute();
   $statement1->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount()) < 1 || ($statement1->rowCount()) < 1)
      return ('El movimiento de caja chica no se realizo');
   else {
      return ('El movimiento de caja chica se realizo correctamente');
   }
}

function updateMove($identification, $information, $archivo)
{
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'UPDATE movimientos_caja_chica 
   SET url_comprobante=:urlC,fecha_modificacion=:f_modificacion,descripcion=:descripcion
   WHERE id = :identificacion;';
   $statement = $db->prepare($query);

   // DDRC-C: realiza una copia del archivo enviado en el servidor
   if ($archivo === 'noFile') {
      $statement->bindValue(':urlC', '');
   } else {
      $url = saveFiles($archivo);
      $statement->bindValue(':urlC', $url);
   }
   
   $statement->bindValue(':descripcion', $information['descripcion']);
   $statement->bindValue(':f_modificacion', date('Y-m-d H:i:s'));
   $statement->bindValue(':identificacion', $identification);
   $statement->execute();
   $statement->closeCursor();

   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount()) < 1)
      return ('No se actualizo la caja chica');
   else {
      return ('La caja chica se creo/actualizo correctamente');
   }
}

function deleteMove($identification, $informacion)
{
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'UPDATE movimientos_caja_chica
   SET fecha_anulacion=:anulacion,descripcion=:descrip WHERE id = :identicacion;';
   $statement = $db->prepare($query);
   $statement->bindValue(':descrip', $informacion['informacion']);
   $statement->bindValue(':identificacion', $identification);
   $statement->bindValue(':anulacion', date('Y-m-d H:i:s'));
   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount()) < 1)
      exit('No se elimino la caja chica');
   else {
      return ('La caja chica eliminada correctamente');
   }
}

function getMoves()
{

   // DDRC-C: id caja
   $currentPB = getCurrentPettyBox();
   if (gettype($currentPB) === 'string') {return 'sin caja';}
   $idCC = $currentPB['id'];
   global $db;
   $query = 'SELECT pSol.nombres as nsol,pSol.apellidos as apsol,pAuth.nombres as nauth,pAuth.apellidos as apauth
   ,descripcion,fecha_movimiento,monto_movimiento,id,fecha_modificacion,fecha_anulacion FROM movimientos_caja_chica
   LEFT JOIN usuario uSol ON movimientos_caja_chica.usuario_solicita = uSol.id_usuario 
   LEFT JOIN usuario uAuth ON movimientos_caja_chica.usuario_autoriza = uAuth.id_usuario 
   LEFT JOIN persona pSol ON uSol.id_persona = pSol.id_persona
   LEFT JOIN persona pAuth ON uAuth.id_persona = pAuth.id_persona
   WHERE fecha_anulacion IS NULL
   AND caja_chica_id=:idCC';
   $statement = $db->prepare($query);
   $statement->bindValue(':idCC', $idCC);
   $statement->execute();
   $cajas = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if (!$cajas) return ('No existen resultados');
   return $cajas;
}
function getNullifiedMoves()
{
   // should not use for now 
   // DDRC-C: id caja
   $currentPB = getCurrentPettyBox();
   if (gettype($currentPB) === 'string') {return 'sin caja';}
   $idCC = $currentPB['id'];
   global $db;
   $query = 'SELECT pSol.nombres as nsol,pSol.apellidos as apsol,pAuth.nombres as nauth,pAuth.apellidos as apauth
   ,descripcion,fecha_movimiento,monto_movimiento,id,fecha_modificacion,fecha_anulacion FROM movimientos_caja_chica
   LEFT JOIN usuario uSol ON movimientos_caja_chica.usuario_solicita = uSol.id_usuario 
   LEFT JOIN usuario uAuth ON movimientos_caja_chica.usuario_autoriza = uAuth.id_usuario 
   LEFT JOIN persona pSol ON uSol.id_persona = pSol.id_persona
   LEFT JOIN persona pAuth ON uAuth.id_persona = pAuth.id_persona
   WHERE fecha_anulacion IS NOT NULL
   AND caja_chica_id=:idCC';
   $statement = $db->prepare($query);
   $statement->bindValue(':idCC', $idCC);
   $statement->execute();
   $cajas = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if (!$cajas) return ('No existen resultados');
   return $cajas;
}

function getMove($identification)
{
   global $db;
   $query = 'SELECT pSol.nombres as nsol,pSol.apellidos as apsol,pAuth.nombres as nauth,pAuth.apellidos as apauth,
   uSol.id_usuario as solID,uAuth.id_usuario as authID,descripcion,monto_movimiento,id,url_comprobante,tipo_movimiento,tipo_pago FROM movimientos_caja_chica 
   LEFT JOIN usuario uSol ON movimientos_caja_chica.usuario_solicita = uSol.id_usuario 
   LEFT JOIN usuario uAuth ON movimientos_caja_chica.usuario_autoriza = uAuth.id_usuario 
   LEFT JOIN persona pSol ON uSol.id_persona = pSol.id_persona
   LEFT JOIN persona pAuth ON uAuth.id_persona = pAuth.id_persona
   WHERE id=:ident';
   $statement = $db->prepare($query);
   $statement->bindValue(':ident', $identification);
   $statement->execute();
   $caja = $statement->fetch(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if (!$caja) return ('No existen resultados');
   return $caja;
}
