<html>
<head>
<title>Alumno</title>
</head>
<body>

<?php
ob_start();
include("lib/insertLog.php");
$objTiempo = new claseLog();


$objTiempo->alta_materia_alumno($_REQUEST['alumno'],$_REQUEST['materia']);
ob_start();
//header("Location: ../set.php");
echo 'CARGA COMPLETA';


?>
</body>
</html>