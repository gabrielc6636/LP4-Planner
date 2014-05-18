<?
include("lib/insertLog.php");
$objTiempo = new claseLog();

//echo $_SERVER['REMOTE_ADDR'];

?>


<?php

if($_GET) 
{

   $result = ($objTiempo->get_alumnos_legajo($_GET['Legajo']));
   
	$lista=array();
	$contador=0;
	while($row = mysql_fetch_assoc($result)){
		$lista[$contador]=$row;
		$contador++;
	}

   echo json_encode($lista);
 }
?>