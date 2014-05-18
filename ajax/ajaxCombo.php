<?php
$_valor = $_GET['valor'];
switch($_valor){
	case 'opcion1':
		$_arreglo[] = array('id' => 1, 'data' => 'Valor 1.1');
		$_arreglo[] = array('id' => 2, 'data' => 'Valor 1.2');
		$_arreglo[] = array('id' => 3, 'data' => 'Valor 1.3');
		break;
	case 'opcion2':
		$_arreglo[] = array('id' => 1, 'data' => 'Valor 2.1');
		$_arreglo[] = array('id' => 2, 'data' => 'Valor 2.2');
		$_arreglo[] = array('id' => 3, 'data' => 'Valor 2.3');
		break;
	case 'opcion3':
		$_arreglo[] = array('id' => 1, 'data' => 'Valor 3.1');
		$_arreglo[] = array('id' => 2, 'data' => 'Valor 3.2');
		$_arreglo[] = array('id' => 3, 'data' => 'Valor 3.3');
		break;
}
echo json_encode($_arreglo);
?>