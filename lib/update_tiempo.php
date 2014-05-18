<?
ob_start();
include("claseTiempo.php");
$objTiempo = new claseTiempo();
?>

<?
$objTiempo->set_tiempo($_POST['tiempo']);
ob_start();
header("Location: ../set.php");
?>