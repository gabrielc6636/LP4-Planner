<?php 
include_once("DBManager.php");
?>

<?
class claseSeek{

	function get_seek(){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "SELECT * FROM seeker";
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_seeker';
			}else{
				$campo = mysql_fetch_array($result);
				return $campo['seek'];
			}
		}
	}
		
	function set_seek($unSeek){
		$con = new DBManager;
		if($con->conectar()==true){
			$query = "UPDATE `gabriel2_trenes`.`seeker` SET  `seek` =  ".$unSeek;
			$result = @mysql_query($query);
			echo $result;
		}
	}
	
	

	
	
		
}
?>