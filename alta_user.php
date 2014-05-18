<?
ob_start();
include("lib/insertLog.php");
$objTiempo = new claseLog();
?>

<?
if($_POST){
$objTiempo->alta_alumno($_POST['legajo'],$_POST['nombre'],$_POST['apellido'],$_POST['carrera']);
ob_start();
//header("Location: ../set.php");
echo 'SUCCEDED POST';
}
if($_GET) 
{
$objTiempo->alta_alumno($_GET['Legajo'],$_GET['Nombre'],$_GET['Apellido'],$_GET['Carrera']);
ob_start();
//header("Location: ../set.php");
echo 'SUCCEDED GET';
} 
?>