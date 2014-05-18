<?php 
include_once("DBManager.php");
?>

<?
class claseLog{ 

	function get_materias_alumno($Legajo){
	   $con = new DBManager;
	   if($con->conectar()==true){
			
		
		
		$query = "select 
					mc.idMaterias,
					m1.Nombre,
					mc.idMaterias_Correlativas,
					m2.Nombre as NombreCorrelativa,
					ma.Legajo from 
				Materias_Correlativas mc,
				Materias m1,
				Materias m2,
				Estado_Materia e,
				Materias_Alumnos ma
				where mc.idMaterias = m1.idMaterias 
				and mc.idMaterias_Correlativas = m2.idMaterias
				and mc.idMaterias_Correlativas = ma.idMaterias 
				and ma.idEstado = e.idEstado_Materia
				and ma.Legajo = ".$Legajo." order by m1.idMaterias";
		
		
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_log';
			}else{
				
				return $result;
			}
		}
	}
	
	function get_materias_posibles($Legajo){
	   $con = new DBManager;
	   if($con->conectar()==true){
			
		
		
		$query = "SELECT m1.idMateria,
       m1.Nombre as Nombre_Materia,
       m1.CargaHoraria,
       m1.Contenido,/*c.*,*/
       m2.idMateria as idMateria_Correlativa,
       m2.Nombre as Nombre_Correlativa 
					FROM Correlatividad c,Materia m1,Materia m2 
					where m1.idMateria = c.Materia_idMateria 
					and m2.idMateria = c.Materia_idMateria1
					and not exists (SELECT * FROM `gabriel2_lp4`.`Alumno-Materia` am 
									where am.Alumno_idAlumno = (select idAlumno from Alumno where Legajo =  ".$Legajo.") 
									and am.Materia_idMateria = m1.idMateria)
					and exists (SELECT * FROM `gabriel2_lp4`.`Alumno-Materia` am 
								where am.Alumno_idAlumno = (select idAlumno from Alumno where Legajo =  ".$Legajo.") 
								and am.Materia_idMateria = m2.idMateria 
								and am.Regular = 1)
				";
		
		
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_log';
			}else{
				
				return $result;
			}
		}
	}
	
	function get_materias_aprobadas($Legajo){
	   $con = new DBManager;
	   if($con->conectar()==true){
			
		
		
		$query = "SELECT m1.idMateria,
       m1.Nombre as Nombre_Materia,
       m1.CargaHoraria,
       m1.Contenido,/*c.*,*/
       m2.idMateria as idMateria_Correlativa,
       m2.Nombre as Nombre_Correlativa 
					FROM Correlatividad c,Materia m1,Materia m2 
					where m1.idMateria = c.Materia_idMateria 
					and m2.idMateria = c.Materia_idMateria1
					
					and exists (SELECT * FROM `gabriel2_lp4`.`Alumno-Materia` am 
								where am.Alumno_idAlumno = (select idAlumno from Alumno where Legajo =  ".$Legajo.") 
								and am.Materia_idMateria = m1.idMateria 
								and am.Regular = 1)
				";
		
		
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_log';
			}else{
				
				return $result;
			}
		}
	}
	
	function alta_alumno($Legajo,$Nombre,$Apellido,$Carrera){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		
		/*echo $result;
			if (!$result){
			   echo 'Error get_tiempo';
			}else{*/
				$query = "select (MAX(idAlumno)+1) as idAlumno from Alumno";
				$result = @mysql_query($query);
		/*
					if (!$result){
					   echo 'Error get_tiempo';
					}else{*/
						$campo = mysql_fetch_array($result);
						//echo $campo['idAlumno'];
						/*
					}
				
			}*/
			
			//$query = "INSERT INTO CorridaLog(fecha,idLog,ip) VALUES (CURRENT_TIMESTAMP,1, '".$_SERVER['REMOTE_ADDR']."')";
		$query = "INSERT INTO `gabriel2_lp4`.`Alumno` (`idAlumno`, `Legajo`, `DNI`, `Nombre`, `Apellido`, `Direccion`,`Telefono`,`Email`) 
					VALUES ( ".$campo['idAlumno'].",  ".$Legajo.", NULL, '".$Nombre."', '".$Apellido."', NULL,NULL,NULL)";
		
		//echo $query;
		$result = @mysql_query($query);
		
		$query = "INSERT INTO `gabriel2_lp4`.`Alumno-Plan` (`Alumno_idAlumno`,`Plandeestudio_idPlandeestudio`,`Plandeestudio_Carrera_idCarrera`) 
				  VALUES (".$campo['idAlumno'].",1,".$Carrera.")";
		
		//echo $query;
		$result = @mysql_query($query);
		
		$query = "INSERT INTO `gabriel2_lp4`.`Alumno-Materia` (`Alumno_idAlumno`,`Materia_idMateria`,`Regular`,`Aprobada`) VALUES (".$campo['idAlumno'].",0,1,1)";
		//echo $query;
		$result = @mysql_query($query);
		
		}
	}
	
	function alta_materia_alumno($Legajo,$Materia){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		
		/*echo $result;
			if (!$result){
			   echo 'Error get_tiempo';
			}else{*/
				$query = "select idAlumno from Alumno where Legajo = ".$Legajo."";
				$result = @mysql_query($query);
		/*
					if (!$result){
					   echo 'Error get_tiempo';
					}else{*/
						$campo = mysql_fetch_array($result);
						//echo $campo['idAlumno'];
						/*
					}
				
			}*/
			
			//$query = "INSERT INTO CorridaLog(fecha,idLog,ip) VALUES (CURRENT_TIMESTAMP,1, '".$_SERVER['REMOTE_ADDR']."')";
		
		
		
		
		$query = "INSERT INTO `gabriel2_lp4`.`Alumno-Materia` (`Alumno_idAlumno`,`Materia_idMateria`,`Regular`,`Aprobada`) VALUES (".$campo['idAlumno'].",".$Materia.",1,1)";
		//echo $query;
		$result = @mysql_query($query);
		
		}
	}
	
	
	function get_corrida_ins(){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "INSERT INTO CorridaLog(fecha,idLog,ip) VALUES (CURRENT_TIMESTAMP,1, '".$_SERVER['REMOTE_ADDR']."')";
		$result = @mysql_query($query);
		/*echo $result;
			if (!$result){
			   echo 'Error get_tiempo';
			}else{*/
				$query = "select MAX(idCorridaLog) as idCorridaLog from CorridaLog";
				$result = @mysql_query($query);
		/*
					if (!$result){
					   echo 'Error get_tiempo';
					}else{*/
						$campo = mysql_fetch_array($result);
						echo $campo['idCorridaLog'];/*
					}
				
			}*/
		}
	}
	
	
	
	function get_carreras(){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "select * from Carrera";
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_carreras';
			}else{
				return $result;
			}
		}
	}
	
	function get_alumnos_carrera($idCarrera){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "select CONCAT(a.Nombre,' ',a.Apellido) as NombreApellido,a.* from Carrera c,Plandeestudio p, `Alumno-Plan` ap,Alumno a 
where  c.idCarrera = p.Carrera_idCarrera 
and ap.Plandeestudio_idPlandeestudio = p.idPlandeestudio 
and ap.Plandeestudio_Carrera_idCarrera = p.Carrera_idCarrera
and ap.Alumno_idAlumno = a.idAlumno
and c.idCarrera = ".$idCarrera." order by 2";
		
		
		
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_estacion_ramal';
			}else{
				
				return $result;
			}
		}
	}
	
	function get_materias_carrera($idCarrera){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "select m.* from Carrera c,Plandeestudio p, `Materia-Plan` mp,Materia m 
					where  c.idCarrera = p.Carrera_idCarrera 
					and mp.Plandeestudio_idPlandeestudio = p.idPlandeestudio 
					and mp.Materia_idMateria = m.idMateria
					and c.idCarrera = ".$idCarrera."
					order by m.idMateria ";
		
		
		
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_estacion_ramal';
			}else{
				
				return $result;
			}
		}
	}
	
	
	
	function get_alumnos_legajo($Legajo){
	   $con = new DBManager;
	   if($con->conectar()==true){
		
		$query = "select Legajo,Concat(Apellido,' ',Nombre) as Nombre from Alumno where Legajo = ".$Legajo." order by 2";
		
		
		
		$result = @mysql_query($query);
		
			if (!$result){
			   echo 'Error get_estacion_ramal';
			}else{
				
				return $result;
			}
		}
	}
 
 }
?>