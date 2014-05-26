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
<link href="styles/estilos_globales.css" rel="stylesheet" type="text/css" />
</head> 
<body onload="load('materia')">

    <img alt="fondo" src="img/bg.png"  id="full-screen-background-image" />
    <div id="head">
        <img src="img/logoplanner_small.png" />
        
    </div>
    <div class="ss-form-container"> 
        <div class="ss-form-heading">
            <h1>Alta de Materias</h1>             	
            <label><?php echo $resultado; ?></label>
        </div> 
        
        <form action="pagina3.php" method="post">
        <br> 
        <input type="hidden" name="alumno" value="<?php echo $legajo; ?>"> 
        <div class="errorbox-good"> 
            <div class="ss-item ss-item-required ss-text">
                <div class="ss-form-entry">
                    <label class="ss-q-title" for="materia">* Materia</label> 
                    <select id="materia" name="materia"></select>
                </div>
            </div>
        </div>  
        
        <br> 
        
        <input type="hidden" name="pageNumber" value="0"> 
        
        <input type="hidden" name="backupCache" value=""> 
    
        <div class="ss-item ss-navigate">
        
            <div class="ss-form-entry">         
                <input type="submit" name="submit" class="button" value="Registrar">
                
            </div>
            
        </div>
        </form>
	
	</div>
    
	<div id="footer">
    	<div style="float:right;margin-top: 10px;">
        	<p style="margin:0px;color: #CCC;font-size:10px">Disponible en</p>
        	<img src="img/android.png" />
        </div>
    </div>
    <div id="footer2" align="center" style="color:#CCCCCC;">
    	<p style="font-size:10px;margin:0;padding-top:8px;">Copyright© 2014 - Todos los derechos reservados a Academic Planner</p>
    </div>


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
<script type="text/javascript">
function LimpiarCombo(combo){
	while(combo.length > 0){
		combo.remove(combo.length-1);
	}
}


function LlenarComboMateria(json, combo){
	combo.options[0] = new Option('Selecciona una Materia', '');
	for(var i=0;i<json.length;i++){
		combo.options[combo.length] = new Option(json[i].Nombre_Materia, json[i].idMateria);
	}
}


function load(combo){
	combo1 = document.getElementById(combo); //con jquery: $("#"+combo2)[0];
	idUsuario="<?php echo $legajo; ?>"; 
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: 'CargaAlumnoPendientes.php',
			data: {Legajo: idUsuario},
			success: function(json){
				LlenarComboMateria(json, combo1);
				
			}
		});
	//}
}

</script>

</body>
</html>