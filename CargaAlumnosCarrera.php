<?
include("lib/insertLog.php");
$objTiempo = new claseLog();

//echo $_SERVER['REMOTE_ADDR'];

?>


<?php

if($_GET) 
{

   $result = ($objTiempo->get_alumnos_carrera($_GET['idCarrera']));
   
	$lista=array();
	$contador=0;
	/*while($row = mysql_fetch_array($result)){
		$lista[$contador]=$row;
		$contador++;
	}*/

	//echo $lista;
   //echo json_encode($lista, JSON_PRETTY_PRINT);
   
   $rows = array();
	while($r = mysql_fetch_assoc($result)) {
		$lista[$contador]=$r;
		$contador++;
	}

echo json_encode($lista);
 }
?>