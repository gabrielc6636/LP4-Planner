 function obtenerEstaciones(id,data){
		
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: 'CargaEstacionesContiguas.php',
			data: {idEstacion: id},
			success: function(json){
						
						
						alert("JSON " + json.length);
						//alert("DATA " + data.length);
						
						//alert("id:" + id);
						
						var size = data.length;
						
						//var tabla = "<table><tr><td>TREN</td><td>FORMACION</td><td>TIPO</td><td>HORARIO</td><td>DIFERENCIA</td><td>DIF</td><td>VELOCIDAD</td><td>DISTANCIA</td><td>ESTACION</td><td>DESTINO</td></tr>";
						
						
						var tabla = "<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Proximos Trenes</title><link href='layout01.css' rel='stylesheet' type='text/css' /></head><body>";
						
						var cant = parseInt(json.length);
						var destino   = "";
						
						
						if(cant>2){					
							destino = json[1].nombre;
						}
						else
						{
							if(json[0].codigoTBA == id){
								destino = json[0].nombre;
							}
							else
							{
								destino = json[1].nombre;
							}
						}
						
						tabla = tabla + "<table><caption>Proximos trenes a pasar por " + destino + "</caption><thead><tr><th scope='col'>TREN</th><th scope='col'>FORMACION</th><th scope='col'>TIPO</th><th scope='col'>HORARIO</th><th scope='col'>DIFERENCIA</th><th scope='col'>DIF</th><th scope='col'>VELOCIDAD</th><th scope='col'>DISTANCIA</th><th scope='col'>ESTACION</th>	<th scope='col'>DESTINO</th></tr></thead><tfoot><tr><td colspan='10'>Compiled by Sauron</td></tr></tfoot><tbody>"
						
						var color     = "";
						
						var estacion  = "";
						var distancia = "";
						
						var d1 = 0;
						var d2 = 0;
						
						var dB = 0;
						var dA = 0;
						var dC = 0;
						
						var eB = "";
						var	eA = "";
						var eC = "";
						
						var pB = 0;
						var pA = 0;
						var pC = 0;
						
						//alert(tabla);
						
						//$("div.info").show();
						for (i = 0; i < size; i++){
																
								color="";
															
								//alert("cantidad: " + cant);
								
								// POSICION VARIABLES
								// ASC: [0]= B [1]= A [2]= C
								// ASC: [0]= B [1]= A 
								
								//alert("ANALIZANDO: " + data[i].idTren + " " + data[i].nTren + " " + data[i].sentido);
								
								if(data[i].sentido=='ASC'){
									destino = "TIGRE";
									
									//alert("ANALIZANDO: " + data[i].idTren + " " + data[i].nTren + " " + data[i].sentido + " " + destino);
									if(cant < 3){
										d1 = parseFloat(calcularDistanciaEst(json[0].coordenadas,json[1].coordenadas));
										d2=0;
										dB = parseFloat(calcularDistanciaEst(data[i].coordinates,json[1].coordenadas));
										dA = parseFloat(calcularDistanciaEst(data[i].coordinates,json[0].coordenadas));
										dC=0;
										eB=json[0].nombre;
										eA=json[1].nombre;
										eC="";
										
										pB=parseInt(json[0].idPos);
										pA=parseInt(json[1].idPos);
										pC=0;
										////alert(eB + " d1:" + d1 + " eA:" + eA + " d2: " + d2 + " " + eC + " " + destino);
									}
									else{
										d1 = parseFloat(calcularDistanciaEst(json[0].coordenadas,json[1].coordenadas));
										d2 = parseFloat(calcularDistanciaEst(json[1].coordenadas,json[2].coordenadas));
										
										dB = parseFloat(calcularDistanciaEst(data[i].coordinates,json[0].coordenadas));
										dA = parseFloat(calcularDistanciaEst(data[i].coordinates,json[1].coordenadas));
										dC = parseFloat(calcularDistanciaEst(data[i].coordinates,json[2].coordenadas));
										
										eB=json[0].nombre;
										eA=json[1].nombre;
										eC=json[2].nombre;
										
										pB=parseInt(json[0].idPos);
										pA=parseInt(json[1].idPos);
										pC=parseInt(json[2].idPos);
										
										//alert(json[0].nombre + " - " + json[1].nombre + " - "  + json[2].nombre);
										//alert(eB + " d1:" + d1 + " eA:" + eA + " d2: " + d2 + " " + eC + " " + destino);
									}
								}
								else{
								
									// DESC: [2]= B [1]= A [0]= C
									// DESC: [1]= B [0]= A 
									destino = "RETIRO";
									//alert("ANALIZANDO: " + data[i].idTren + " " + data[i].nTren + " " + data[i].sentido + " " + destino);
									if(cant < 3){
										d1 = parseFloat(calcularDistanciaEst(json[0].coordenadas,json[1].coordenadas));
										d2=0;
										dB = parseFloat(calcularDistanciaEst(data[i].coordinates,json[1].coordenadas));
										dA = parseFloat(calcularDistanciaEst(data[i].coordinates,json[0].coordenadas));
										dC=0;
										eB=json[1].nombre;
										eA=json[0].nombre;
										eC="";
										
										pB=parseInt(json[1].idPos);
										pA=parseInt(json[0].idPos);
										pC=0;
										//alert(eB + " d1:" + d1 + " eA:" + eA + " d2: " + d2 + " " + eC + " " + destino);
									}
									else{
										d1 = parseFloat(calcularDistanciaEst(json[2].coordenadas,json[1].coordenadas));
										d2 = parseFloat(calcularDistanciaEst(json[0].coordenadas,json[1].coordenadas));
										
										dB = parseFloat(calcularDistanciaEst(data[i].coordinates,json[2].coordenadas));
										dA = parseFloat(calcularDistanciaEst(data[i].coordinates,json[1].coordenadas));
										dC = parseFloat(calcularDistanciaEst(data[i].coordinates,json[0].coordenadas));
										
										eB=json[2].nombre;
										eA=json[1].nombre;
										eC=json[0].nombre;
										
										pB=parseInt(json[2].idPos);
										pA=parseInt(json[1].idPos);
										pC=parseInt(json[0].idPos);
										
										//alert(json[0].nombre + " - " + json[1].nombre + " - "  + json[2].nombre);
										//alert(eB + " d1:" + d1 + " eA:" + eA + " d2: " + d2 + " " + eC + " " + destino);
									}
								}
								
								var llegando = false;
								//alert("dA:" + dA +"dB:" + dB +"dC:" + dC);
								//alert(eA + " dA:" + dA.toFixed(2) + "d1+dB:" + (parseFloat(d1)+parseFloat(dB)).toFixed(2) + " " + eB);
										
										//alert("dA+dB:" + (dA+dB) +"d1:" + (d1+1) );
										if(cant > 2){
											if(dA < dC){
												if(dC > dB){
													//LLEGANDO A ""...
													estacion = eB;//+"2a";
													distancia = dB + d1;
													
													llegando=true;
												}
												else
												{
													if ((dA+dB) <= (d1+0.5)) {
														//LLEGANDO A "A"...
														estacion = eA;//+"2b";
														distancia = dA;
														
														llegando=true;
													}
												}
											}
											else
											{	
													//SE PASÓ
													//alert(data[i].idTren + " REJECTED " + data[i].nTren + " " + destino);
													estacion = eB;//+"5";
													distancia = dB+d1;
													continue;
											}
											
											
										}
										else
										{
											if(pA > pB){
												if(data[i].sentido=='ASC'){
													if(dA > dB){
														if(dA<d1){
															llegando=false; //C
															estacion = "ERROR 1A";
														}
														else
														{
															llegando=false; //C1
															estacion = eB//; + "C11";
															distancia = dB+d1;
														}
													}
													else
													{
														if(dA<d1){
															llegando=true; //C2
															estacion = eA//; + "C21";
															distancia = dA;
														}
														else
														{
															llegando=false; //C
															//estacion = "ERROR 1B";
															estacion = eB;// + "1B";
															distancia = dB+d1;
														}
														
													}
												}
												else
												{
													llegando = false;
													estacion = "ERROR 1";
												}
											}
											else
											{
												if(data[i].sentido=='DESC'){
													if(dA > dB){
														if(dA<d1){
															llegando=false; //C
															estacion = "ERROR 2A";
														}
														else
														{
															llegando=true; //C1
															estacion = eB;// + "C12";
															distancia = dA;
														}
													}
													else
													{
														if(dA<d1){
															llegando=false; //C2
															estacion = eA;// + "C22";
															distancia = dA;
														}
														else
														{
															llegando=false; //C
															estacion = "ERROR 2B";
														}
													}
												}
												else
												{
													llegando = false;
													estacion = "ERROR 2";
												}
											}
									    }
										//alert(estacion + " " + llegando + " " + data[i].sentido);
								
								
								if(parseInt(data[i].timeOnSeconds)<0){ //MENOR
									
									if(llegando==true){
										//alert(data[i].idTren + " DELAYED " + data[i].nTren + " " + destino);
										color = "#FF0000";
									
									}
									else
									{
										color = "#FF00FF";
										//alert(data[i].idTren + " REJECTED " + data[i].nTren + " " + destino);
										continue;
									}
								}
								else
								{
									//ON TIME
									//alert(data[i].idTren + " ON TIME " + data[i].nTren + " " + destino);
									color = "#00FF00";
								}								
								
								
								
								tabla = tabla+ "<tr class='odd'>";
														
								tabla = tabla+ "<th scope='row'>"+data[i].nTren+"</td>";
								
								
								//tabla = tabla+ "<td>"+data[i].nTren+"</td>";
								tabla = tabla+ "<td>"+data[i].idTren+"</td>";
								tabla = tabla+ "<td>"+data[i].nombre+"</td>";
								tabla = tabla+ "<td>"+data[i].horario+"</td>";
								
								tabla = tabla+ "<td>"+data[i].diferencia+"</td>";
								
								tabla = tabla+ "<td bgcolor='"+ color +"'>"+data[i].timeOnSeconds+"</td>";
								
								tabla = tabla+ "<td>"+data[i].velocidad+"</td>";
								//tabla = tabla+ "<td>".$row['coordinates']."</td>";
								tabla = tabla+ "<td>"+distancia.toFixed(2) + " km " +"</td>";
								tabla = tabla+ "<td>"+estacion +"</td>";
								tabla = tabla+ "<td>"+destino + " " + data[i].sentido + "</td>";

								tabla = tabla+ "</tr>";
								
							
						}
						
						tabla = tabla + "</tbody></table></body></html>";
						document.write(tabla);
						//document.write ("<table border='2'><tr><td>texto </td><td>texto</td></tr></table>");

				
			}
		});
 }
 
 function calcularDistancia(coordA,coordB)
	{
		//geocoder = new google.maps.Geocoder(); // creating a new geocode object

		//var address1 = '-34.628090,-58.466960';
		
		//var address1 = coordA;
						
		//var direcciones = coordB;
		
		var R;
		var dLat;
		var dLon;
		var dLat1;
		var dLat2;
		var a;
		var c;
		var d;
		
		//alert(coordA + " " + coordB);
		
		var estacion="";
		var distancia=1000;
		var codigoTBA;
		
		//size = direcciones.length;
		
		//for(i=0;i< size;i++){
						
			var direccion1 = coordB.split(',');
			var direccion2 = coordA.split(',');
			
			dLat = toRad(direccion2[1]-direccion1[1]);
			dLon = toRad(direccion2[0]-direccion1[0]);
			dLat1 = toRad(direccion1[1]);
			dLat2 = toRad(direccion2[1]);
						
			// compute distance between the two points
			R = 6371; 
						
			a = Math.sin(dLat/2) * Math.sin(dLat/2) +
					Math.cos(dLat1) * Math.cos(dLat1) * 
					Math.sin(dLon/2) * Math.sin(dLon/2); 
			c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			d = R * c;
			
			
		
		//}
		
		var respuesta = d;
		
		return respuesta;
		                                                      
	}
	
	function calcularDistanciaEst(coordA,coordB)
	{
		//geocoder = new google.maps.Geocoder(); // creating a new geocode object

		//var address1 = '-34.628090,-58.466960';
		
		//var address1 = coordA;
						
		//var direcciones = coordB;
		
		var R;
		var dLat;
		var dLon;
		var dLat1;
		var dLat2;
		var a;
		var c;
		var d;
		
		//alert(coordA + " " + coordB);
		
		var estacion="";
		var distancia=1000;
		var codigoTBA;
		
		//size = direcciones.length;
		
		//for(i=0;i< size;i++){
						
			var direccion1 = coordB.split(',');
			var direccion2 = coordA.split(',');
			
			dLat = toRad(direccion2[1]-direccion1[1]);
			dLon = toRad(direccion2[0]-direccion1[0]);
			dLat1 = toRad(direccion1[1]);
			dLat2 = toRad(direccion2[1]);
						
			// compute distance between the two points
			R = 6371; 
						
			a = Math.sin(dLat/2) * Math.sin(dLat/2) +
					Math.cos(dLat1) * Math.cos(dLat1) * 
					Math.sin(dLon/2) * Math.sin(dLon/2); 
			c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			d = R * c;
			
			
		
		//}
		
		var respuesta = d;
		
		return respuesta;
		                                                      
	}
 
 function calcular(coordenadas,lugares)
	{
		//geocoder = new google.maps.Geocoder(); // creating a new geocode object

		//var address1 = '-34.628090,-58.466960';
		
		var address1 = coordenadas;
		/*
		var direcciones = new Array('-34.59117712029537,-58.37491035461426',
		'-34.56252041602716,-58.43675136566162',
		'-34.558544445675935,-58.449604511260986',
		'-34.54792325530843,-58.463122844696045',
		'-34.53653180336809,-58.46801519393921',
		'-34.52469682895749,-58.47281098365784',
		'-34.508055194845376,-58.48050892353058',
		'-34.4976309328876,-58.488373160362244',
		'-34.48851858289794,-58.496569991111755',
		'-34.47973246820011,-58.50422501564026',
		'-34.47204220031689,-58.513548374176025',
		'-34.46071998733326,-58.526573181152344',
		'-34.456420682350426,-58.54006469249725',
		'-34.45064811920567,-58.55068624019623',
		'-34.444295626943195,-58.55866312980652',
		'-34.437411740415136,-58.56756806373596',
		'-34.43700028193399,-58.56805622577667');
		var estaciones = new Array('RN','LT','BC','NZ','RV','VZ','OL','LL','N','AS','SW','BE','Z','VY','FB','CU','T');
		*/
		var i = 0;
		var size = lugares.length;
		
		var estaciones = new Array();
		var direcciones = new Array();
		var codigosTBA = new Array();
		
		for (i = 0; i < size; i++){
			estaciones[i] = lugares[i].nombre;
			direcciones[i] = lugares[i].coordenadas;
			codigosTBA[i] = lugares[i].codigoTBA;
		}

		var R;
		var dLat;
		var dLon;
		var dLat1;
		var dLat2;
		var a;
		var c;
		var d;
		
		var estacion="";
		var distancia=1000;
		var codigoTBA;
		
		size = direcciones.length;
		
		for(i=0;i< size;i++){
						
			var direccion1 = direcciones[i].split(',');
			var direccion2 = address1.split(',');
			
			dLat = toRad(direccion2[0]-direccion1[1]);
			dLon = toRad(direccion2[1]-direccion1[0]);
			dLat1 = toRad(direccion1[1]);
			dLat2 = toRad(direccion2[0]);
						
			// compute distance between the two points
			R = 6371; 
						
			a = Math.sin(dLat/2) * Math.sin(dLat/2) +
					Math.cos(dLat1) * Math.cos(dLat1) * 
					Math.sin(dLon/2) * Math.sin(dLon/2); 
			c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			d = R * c;
			
			if(distancia>d){
				distancia = d;
				estacion = estaciones[i];
				codigoTBA = codigosTBA[i];
			}
		
		}
		
		var respuesta = new Array(distancia,estacion,codigoTBA);
		
		return respuesta;
		                                                      
	}
	
	function toRad(deg) 
	{
		return deg * Math.PI/180;
	}
	
	$(document).ready(function(){
		$("#calcular").click(
			function(){
			
			//alert('JS');
				combo1 = document.getElementById('segundoCombo');
		
				//var id = combo1.options[combo1.selectedIndex].value;
				var id = combo1.value;
				//alert(id);
				
				$.ajax(
					{
					data:  {Legajo: id },
					type: "GET",
					dataType: "json",
					url: "CargaAlumnoAprobadas.php",
					success: function(data){
						var i = 0;
						var size = data.length;
				
						 //alert("estacion:" + id);
						 //alert("trenes:" + size);
									
						//obtenerEstaciones(id,data);
						
						//alert("Estaciones : " + estaciones.length);
			
						//alert(size);
						//$("div.info").show();
						//for (i = 0; i < size; i++){
						//results(data[i].idTren,data[i].velocidad);
						//calcular(data[i].coordinates);
						//alert(calcular(data[0].coordinates));
						/*				
						var respuesta = calcular(data[i].coordinates,estacioness);
								
								$("div.info").append(" Tren : "+data[i].nTren);
								$("div.info").append(" Tren TBA: "+data[i].idTren);
								$("div.info").append(" Velocidad: "+data[i].velocidad);
								//$("div.info").append(" Distancia: "+ calcular(data[i].coordinates));
								$("div.info").append(" Distancia: "+ respuesta[0] + " km " + respuesta[1] );
								$("div.info").append(" Diferencia: "+data[i].diferencia);
							
							
						}*/
						//restults(data[0]);
						
						var color = "";
						
						if(size > 0){
						
							//alert(size);
						
						var tabla = "<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
						tabla = tabla + "<title>Materias por Alumno</title>";
						tabla = tabla + "<link href='layout01.css' rel='stylesheet' type='text/css' />";
						tabla = tabla + "<link href='styles/sesion.css' rel='stylesheet' type='text/css' />";
						tabla = tabla + "</head><body>";
						
						tabla = tabla + "<img alt='fondo' src='img/bg.png'  id='full-screen-background-image' /><div id='head'><img src='img/logoplanner_small.png' /></div>";
						tabla = tabla + "<div class='ss-form-container'><div class='ss-form-heading'><h1>Materias aprobadas</h1></div>";
						
							//var tabla = "<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>Materias por Alumno</title><link href='layout01.css' rel='stylesheet' type='text/css' /></head><body>";
							tabla = tabla + "<table><caption>MATERIAS"; 
							
							tabla = tabla + "</caption><thead><tr><th scope='col'>IdMateria</th><th scope='col'>Nombre</th><th scope='col'>IdMateria</th><th scope='col'>Nombre Correlativa</th></tr></thead><tfoot><tr><td colspan='10'>Compiled by Academic Planner</td></tr></tfoot><tbody>";
							
							//alert(tabla);
							
							for (i = 0; i < size; i++){
							//for (i = 0; i < 1; i++){
								/*var estado = parseInt(data[i].Mostrar);
								
								switch (estado)
								{
								case 0:
								  continue;
								  break;
								case 1: 
										color = "#00FF00";
								  break;
								case 2:
										color = "#FF0000";
								  break;
								case 4:
										color = "#FFFF00";
								  break;
								case 5:
										color = "#FF00FF";
								  break;
								 case 6:
										color = "#00FFFF";
								  break;
								 case 7:
										color = "#FF00FF";
								  break;
								default:
								  document.write("I'm looking forward to this weekend!");
								}*/
								/*
								if(parseInt(data[i].timeOnSeconds)<0){ //MENOR
									if(parseInt(data[i].Mostrar)>1){ //MENOR
									
										color = "#FF0000";
										if(parseInt(data[i].Mostrar)>2) {
											color = "#FF00FF";
										}
									}
									else
									{
										color = "#00FF00";
									}
								}	
								else
								{
									color = "#00FF00";
									if(parseInt(data[i].Mostrar)>2) {
										color = "#FF00FF";
									}
								}
								*/
								tabla = tabla+ "<tr class='odd'>";
														
								tabla = tabla+ "<th scope='row'>"+data[i].idMateria+"</th>";
								tabla = tabla+ "<td>"+data[i].Nombre_Materia+"</td>";
								tabla = tabla+ "<td>"+data[i].idMateria_Correlativa+"</td>";
								tabla = tabla+ "<td>"+data[i].Nombre_Correlativa+"</td>";
								
								

								tabla = tabla+ "</tr>";
							}	
							tabla = tabla + "</tbody></table></div></body></html>";
							//alert(tabla);
							document.write(tabla);
						//}
						
					}	
						
					
						
					},
					error: function(dato){
						alert("ERROR FINAL");
					}
				}
			);
		}
	);
});

