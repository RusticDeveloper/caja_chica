<?php
// DDRC-C: define la zona horaria de Quito por defecto
date_default_timezone_set('America/Lima');

function addPettyBoxSettlement($information)
{
   // DDRC-C: variable global de la base de datos
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'INSERT INTO arqueo_caja_chica (caja_chica_id,total_caja_chica,total_movimientos,descripcion,fecha_arqueo,
   billetes_cien,billetes_cincuenta,billetes_veinte,billetes_diez,billetes_cinco,billetes_uno,monedas_dolar,
   monedas_cincuenta,monedas_veinticinco,monedas_diez,monedas_cinco,monedas_uno)
    VALUES (:idCC,:totalCC,:totalMov,:descripcion,:f_arqueo,:b_cien,:b_cincuenta,:b_veinte,:b_diez,:b_cinco,:b_uno,:m_dolar
    ,:m_cincuenta,:m_veinticinco,:m_diez,:m_cinco,:m_uno);';

   $statement = $db->prepare($query);
   $statement->bindValue(':idCC',$information['idCC']);
   $statement->bindValue(':descripcion',$information['descripcion']);
   $statement->bindValue(':totalCC',$information['totalCC']);
   $statement->bindValue(':totalMov',$information['totalMoves']);
   $statement->bindValue(':b_cien',$information['b_cien']);
   $statement->bindValue(':b_cincuenta',$information['b_cincuenta']);
   $statement->bindValue(':b_veinte',$information['b_veinte']);
   $statement->bindValue(':b_diez',$information['b_diez']);
   $statement->bindValue(':b_cinco',$information['b_cinco']);
   $statement->bindValue(':b_uno',$information['b_uno']);
   $statement->bindValue(':m_dolar',$information['m_un']);
   $statement->bindValue(':m_cincuenta',$information['m_cincuenta']);
   $statement->bindValue(':m_veinticinco',$information['m_veinticinco']);
   $statement->bindValue(':m_diez',$information['m_diez']);
   $statement->bindValue(':m_cinco',$information['m_cinco']);
   $statement->bindValue(':m_uno',$information['m_uno']);
   $statement->bindValue(':f_arqueo',date('Y-m-d H:i:s'));
   $statement->execute();
   $statement->closeCursor();
   
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      return ('Arqueo guardado');
   else {
      return ('El arqueo no se guardo');
   }
}

function updatePettyBoxSettlement($identification,$archivo)
{
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'UPDATE movimientos_caja_chica 
   SET url_comprobante=:urlC,fecha_modificacion=:f_modificacion,
   WHERE id = :identificacion;';
   $statement = $db->prepare($query);

   // DDRC-C: realiza una copia del archivo enviado en el servidor
   if ($archivo==='noFile') {
      $statement->bindValue(':urlC','');
   } else {
      $url=saveFiles($archivo);
      $statement->bindValue(':urlC',$url);
   }
   
   $statement->bindValue(':f_modificacion',date('Y-m-d H:i:s'));  
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

function deletePettyBoxSettlement($identification,$informacion)
{
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'UPDATE movimientos_caja_chica
   SET fecha_anulacion=:anulacion,descripcion=:descrip WHERE id = :identicacion;';
   $statement = $db->prepare($query);
   $statement->bindValue(':descrip',$informacion['informacion']); 
   $statement->bindValue(':identificacion',$identification); 
   $statement->bindValue(':anulacion',date('Y-m-d H:i:s')); 
   $statement->execute();
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      exit('No se elimino la caja chica');
   else {
      return ('La caja chica eliminada correctamente');
   }
}


function getPettyBoxSettlements($idCC)
{
   global $db;
   $query = 'SELECT fecha_arqueo,arqueo_caja_chica.descripcion,total_caja_chica,total_movimientos,monto_caja_chica,arqueo_caja_chica.id as arqId FROM arqueo_caja_chica
   LEFT JOIN caja_chica ON arqueo_caja_chica.caja_chica_id = caja_chica.id
   WHERE caja_chica_id=:idCC';
   $statement = $db->prepare($query);
   $statement->bindValue(':idCC',$idCC);
   $statement->execute();
   $cajas = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$cajas) return ('No existen resultados');
   return $cajas;
}

function getPettyBoxSettlement($identification)
{
   global $db;
   $query = 'SELECT caja_chica_id,total_caja_chica,total_movimientos,descripcion,fecha_arqueo,
   billetes_cien,billetes_cincuenta,billetes_veinte,billetes_diez,billetes_cinco,billetes_uno,monedas_dolar,
   monedas_cincuenta,monedas_veinticinco,monedas_diez,monedas_cinco,monedas_uno FROM arqueo_caja_chica  
   WHERE id = :ident';
   $statement = $db->prepare($query);
   $statement->bindValue(':ident',$identification); 
   $statement->execute();
   $caja = $statement->fetch(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   if(!$caja) return('No existen resultados');
   return $caja;
}
