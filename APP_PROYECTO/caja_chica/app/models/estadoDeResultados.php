<?php
// DDRC-C: define la zona horaria de Quito por defecto
date_default_timezone_set('America/Lima');

function getResultStateData($idBalanceData,$FInicio=0,$FFin=0)
{
   // DDRC-C: variable global de la base de datos
   global $db;
   // DDRC-C:consulta y ejecución de una petición realizada con PDO
   $query = 'SELECT * FROM balanceajustado WHERE balance_date >= :FIni AND balance_date <= :FFin;';
   
   $statement = $db->prepare($query);
   // $statement->bindValue(':id', $idBalanceData);  
   $statement->bindValue(':FIni', $FInicio);  
   $statement->bindValue(':FFin', $FFin);  
   $statement->execute();
   $estadoResultados = $statement->fetchAll(PDO::FETCH_ASSOC);
   $statement->closeCursor();
   // DDRC-C: verifica si la consulta devuelve resultados
   if (($statement->rowCount())<1)
      return ('No existen resultados de este balance');
   else {
      return $estadoResultados;
   }
}
