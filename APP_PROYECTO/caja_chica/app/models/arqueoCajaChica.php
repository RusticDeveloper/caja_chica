<?php


function addPettyBox($information){
   global $db; 

}

function updatePettyBox(){
   global $db; 
}

function getaPettyBox(){
   global $db; 
   $query='SELECT * FROM caja_chica';
   $statement=$db->prepare($query);
   $statement->execute();
   $statement->closeCursor();
}
