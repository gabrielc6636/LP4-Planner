<?php 
//ob_start();
include_once("lib/insertLog.php");

?>

<?
class claseJson{ 

			function ins_log(){ 
			
			$objTiempo = new claseLog();
	    
			$aUrl = "upload/trenes.json";
			$data = file_get_contents($aUrl);
			/*
			$string='{ "tren": [ 
				{
					"Coordinates": "-58.544320, -34.455830,0", 
					"Corrida": "16", 
					"GPS1": "2182 21\/10\/2011 09:02", 
					"GPS2": "0 00\/00\/0000 00:00", 
					"Heading": "246", 
					"IdTren": "5272", 
					"Ramal": "1", 
					"Tren": "8602", 
					"Velocidad": "3  Km\/h" 
				}
				] 
				}';
				*/
			
			//echo $data;			
				
			$json_a=json_decode($data,true);
			
			// array method
			foreach($json_a[trenes][tren] as $p)
			{
			/*
			echo '

			Coordinadas: '.$p[Coordinates].' '.$p[Corrida].'

			Id: '.$p[IdTren].'

			';
			*/
			$objTiempo->set_log($p['Corrida'],$p['IdTren'],$p['Heading'],$p['Coordinates'],$p['Ramal'],$p['Tren'],$p['Velocidad'],$p['GPS1'],$p['GPS2'],$p['Distancia'],$p['Estacion']);
			ob_start();	
			
			echo 'Id: '.$p[IdTren].' ';

			}


 

 
 
 

 }
 
	
 
 }
?>