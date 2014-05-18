<?
include("lib/insertLog.php");
$objTiempo = new claseLog();

//echo $_SERVER['REMOTE_ADDR'];

?>


<?php

	if($_GET) 
	{
	//$resultado->get_log_tren($_GET['IdTren']);
	$result = ($objTiempo->get_materias_posibles($_GET['Legajo']));
	}
	
	if($_POST) 
	{
	//$resultado->get_log_tren($_GET['IdTren']);
	$result = ($objTiempo->get_materias_posibles($_POST['Legajo']));
	}
	
	
	$lista=array();
	$contador=0;
	while($row = mysql_fetch_assoc($result)){
		$lista[$contador]=$row;
		$contador++;
	}

   
    echo json_encode($lista);
		


   //$result = ($objTiempo->get_log_tren('5272'));
   
   /*$result = ($objTiempo->get_log_tren1('5272'));
 
   $row = mysql_fetch_object($result);*/
   /*$jsondata['codigoTBA'] = $row->codigoTBA;
   $jsondata['nombre'] = $row->nombre;*/
   /*
						 ti.idTren,
		                 ti.nombre,
						 ti.descripcion,
						 (CAST(tl.heading as DECIMAL))AS heading,
						 tl.coordinates,
						 (IF(ISNULL(r.nombre), 'TEST', r.nombre))AS ramal,
						 tl.tren,
						 tl.velocidad,
						 tl.gps1,
						 tl.gps2 
   
   */
   /*
   $jsondata['distancia'] = '';
   
   $jsondata['idTren'] = $row->idTren;
   $jsondata['nombre'] = $row->nombre;
   $jsondata['descripcion'] = $row->descripcion;
   $jsondata['heading'] = $row->heading;
   $jsondata['coordinates'] = $row->coordinates;
   $jsondata['ramal'] = $row->ramal;
   $jsondata['tren'] = $row->tren;
   $jsondata['velocidad'] = $row->velocidad;
   $jsondata['gps1'] = $row->gps1;
   $jsondata['gps2'] = $row->gps2;
 
   //echo $jsondata;
 
   echo json_encode($jsondata);
   
   echo json_encode($row);*/
   
   
   //$result = ($objTiempo->get_estaciones());
	/*$lista=array();
	$contador=0;
	while($row = mysql_fetch_array($result)){
		$lista[$contador]=$row;
		$contador++;
	}

   
   echo json_encode($lista);*/
   //mysql_close($db);
 
?>