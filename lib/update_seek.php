<?
ob_start();
include("claseSeek.php");
$objTiempo = new claseSeek();
?>

<?
$objTiempo->set_seek($_POST['seek']);
ob_start();
header("Location: ../setSeek.php");
?>