<?php 
include_once("DBManager.php");
?>

<?
class claseTiempo{

	function get_tiempo(){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "SELECT * FROM actualizar";
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_tiempo';
			}else{
				$campo = mysql_fetch_array($result);
				return $campo['iteracion'];
			}
		}
	}
	
	function set_log(){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		//inserto ip
		$query_insert = "INSERT INTO `gabriel2_trenes`.`log` (`id`, `fecha`, `ip`) VALUES (NULL, CURRENT_TIMESTAMP, '".$_SERVER['REMOTE_ADDR']."')";
		@mysql_query($query_insert);
		//fin isnerto ip
		}
	}
	
	
	
	
		
	function set_tiempo($unTiempo){
		$con = new DBManager;
		if($con->conectar()==true){
			$query = "UPDATE `gabriel2_trenes`.`actualizar` SET  `iteracion` =  ".$unTiempo;
			$result = @mysql_query($query);
		}
	}
	
	
	function get_log(){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		
		$query = "SELECT * FROM log order by id DESC LIMIT 5";
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_log';
			}else{
				$campo = mysql_fetch_array($result);
				return $campo['fecha']." | ".$campo['ip'];
			}
		}
	}
	
	function get_log2(){
	   $con = new DBManager;
	   if($con->conectar()==true){
				
		$query = "select cl.idCorridaLog,(select count(*) from TablaLog where idCorridaLog = cl.idCorridaLog group by idCorridaLog) as cant,cl.fecha,cl.ip
from CorridaLog cl order by 1 desc limit 10";
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_log';
			}else{
				while ($row = mysql_fetch_array($result))
				{
				echo ("<p>" . $row['idCorridaLog']." | ".$row['cant'] ." | ".$row['fecha'] ." | ".$row['ip'] ."</p>");
				}
			}
		}
	}
	
	function get_rss(){
	   $con = new DBManager;
	   
		$rss_titulo = 'Actualizacion Sauron';
		$rss_url = 'http://gabrielcastelo.com.ar';
		$rss_descripcion = 'Actualizaciones';
		$rss_email = 'email@myweb.com';
	   
	   if($con->conectar()==true){
				
		$query = "SELECT * FROM log order by id DESC LIMIT 5";
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_log';
			}else{
				
				$texto= "";
				/* $texto .=  "<?xml version=\"1.0\" encoding=\"utf-8\"?>"; NO VA MAS*/
				$texto .= "<rss version=\"2.0\">";
				
				$texto .= "<channel><docs>http://blog.unijimpe.net/rss</docs>";
				$texto .= "<title>".$rss_titulo."</title>";
				$texto .= "<link>".$rss_url."</link>";
				$texto .= "<description>".$rss_descripcion."</description>";
				$texto .= "<language>es</language><managingEditor>".$rss_email."</managingEditor>";
				$texto .= "<webMaster>".$rss_email."</webMaster>";
			
				while ($row = mysql_fetch_array($result))
				{
				//echo ("<p>" . $row['fecha']." | ".$row['ip'] ."</p>");
				
				$texto .= "<item>" ;
				$texto .= "<title>".$rss_titulo."</title>" ;
				$texto .= "<link>".$rss_url."?id=".$item['id']."</link>";
				$texto .= "<pubDate>".$row[fecha]."</pubDate>";
				$texto .= "<description>".$item['ip']."</description>";
				$texto .= "</item>";
				
				}
				
				$texto .= "</channel>";
				$texto .= "</rss>";
				
				return $texto;
			}
		}
	}
	
		
}
?>