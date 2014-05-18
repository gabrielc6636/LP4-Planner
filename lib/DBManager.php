<?php
class DBManager{
  var $conect;
  
	//Constructor
     function DBManager(){
	 }
	 
	 function getCon(){
		return $this->conect;
	 }
	 
	 function conectar() {
	     if(!($con=@mysql_connect("localhost","gabriel2_trenes","Gaby!6636")))
		 {
			 echo"Error al conectar a db";	
			 exit();
	      }
		  if (!@mysql_select_db("gabriel2_lp4",$con)) {
			echo "Error al seleccionar db";  
			exit();
		  }
	       $this->conect=$con;
		   return true;	
	 }
}
?>