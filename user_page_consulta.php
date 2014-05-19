<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: index.html");
    exit;
}
$resultado = "";
$resultado = $_SESSION['fname'].' '.$_SESSION['lname'].' - Legajo: '.$_SESSION['username'];

$legajo = "";
$legajo = $_SESSION['username'];
?>
<!DOCTYPE html> 
<html> 
<head> 
<title>Academic Planner</title> 
<link href="styles/sesion.css" rel="stylesheet" type="text/css" />
</head> 
<body>


<img alt="fondo" src="img/bg.png"  id="full-screen-background-image" />
    <div id="head">
    	<img src="img/logoplanner_small.png" />
        
    </div>
<div class="ss-form-container"> 

<div class="ss-form-heading"><h1>Consultar materias aprobadas</h1> <label><?php echo $resultado; ?></label>


</div> 

<input type="hidden" name="segundoCombo" id="segundoCombo" value="<?php echo $legajo; ?>"> 

<br> 

<input type="hidden" name="pageNumber" value="0"> 

<input type="hidden" name="backupCache" value=""> 

<div class="ss-item ss-navigate"><div class="ss-form-entry"> 

<input type="submit" name="submit" class="button" value="Consultar" id="calcular">
</div></div>

<script type="text/javascript"> 

      

      (function() {

var error = false;

var divs = document.getElementById('ss-form').

getElementsByTagName('div');

for (var j in divs) {

if (divs[j].className == 'errorbox-bad') {

error = true;

divs[j].lastChild.firstChild.lastChild.focus();

break;

}

}

if (!error) {

for (var i in divs) {

if (divs[i].className == 'ss-form-entry' && divs[i].

firstChild.className == 'ss-q-title') {

divs[i].lastChild.focus();

break;

}

}

}

})();

      </script>
	  <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/calcular.js"></script>


</div></body>
</html>