<?
ob_start();
include("insertLog.php");
$objTiempo = new claseLog();
?>

<?
$objTiempo->set_log($_POST['Corrida'],$_POST['IdTren'],$_POST['Heading'],$_POST['Coordinates'],$_POST['Ramal'],$_POST['Tren'],$_POST['Velocidad'],$_POST['GPS1'],$_POST['GPS2']);
ob_start();
//header("Location: ../set.php");
echo 'SUCCEDED';
?>