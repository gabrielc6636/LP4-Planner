<?php 
function Conectarse() 
   {  //conectamos a la base 
      if (!($link=@mysql_connect("localhost","gabriel2_trenes","Gaby!6636"))) 
    { 
   echo “Error conectando a la base de datos.”; 
   exit(); 
  }   //Seleccionamos la base 
     if (!mysql_select_db("gabriel2_trenes",$link)) 
  { 
    echo “Error seleccionando la base de datos.”; 
    exit(); 
   } 
    return $link; 
    } 
?>