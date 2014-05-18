<?
include("lib/insertLog.php");
$objTiempo = new claseLog();
?>
<?php
if(isset($_POST['submit'])){
    $usr = $_POST['username'];
	$pas  =$_POST['password'];
	$result = ($objTiempo->get_alumnos_legajodni($usr,$pas));
	if(mysql_num_rows($result) == 1){
        $row = mysql_fetch_array($result);
	    session_start();
        $_SESSION['username'] = $row['Legajo'];
        $_SESSION['fname'] = $row['Nombre'];
        $_SESSION['lname'] = $row['Apellido'];
        $_SESSION['logged'] = TRUE;
        header("Location: user_page.php"); // A la página a la que tenemos que ir
        exit;
    }else{
        header("Location: index.html");
        exit;
    }
}else{    //Si no se ha mandado nada, volvemos al index o la página del login
    header("Location: index.html");
    exit;
}
?>