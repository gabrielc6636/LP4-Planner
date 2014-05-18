<html>
<head>
<title>Alumno</title>
</head>
<body>

<?php
ob_start();
include("lib/insertLog.php");
$objTiempo = new claseLog();


$objTiempo->alta_alumno($_REQUEST['legajo'],$_REQUEST['nombre'],$_REQUEST['apellido'],$_REQUEST['carrera']);
ob_start();
//header("Location: ../set.php");
echo 'CARGA COMPLETA';


?>
</body>
</html>