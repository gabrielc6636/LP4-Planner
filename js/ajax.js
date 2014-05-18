function restults(data) {

		alert(idTren);
		
     //$("div.info").show();
     /*
	 $("div.info").append(" Codigo TBA: "+data.codigoTBA);
     $("div.info").append(" Nombre: "+data.nombre);
     $("div.info").append(" Distancia: "+calcular());
     */
	 /*
		$jsondata['idTren'] = $row->idTren;
	   $jsondata['nombre'] = $row->nombre;
	   $jsondata['descripcion'] = $row->descripcion;
	   $jsondata['heading'] = $row->heading;
	   $jsondata['coordinates'] = $row->coordinates;
	   $jsondata['ramal'] = $row->ramal;
	   $jsondata['tren'] = $row->tren;
	   $jsondata['velocidad'] = $row->velocidad;
	   $jsondata['gps1'] = $row->gps1;
	   $jsondata['gps2'] = $row->gps2;
	   */
	   
	   $("div.info").append(" Tren TBA: "+data.idTren);
	   $("div.info").append(" Velocidad: "+data.velocidad);
	   //$("div.info").append(" Distancia: "+ calcular(data[i].coordinates));
	   

	 
 }
 
 function calcular(coordenadas)
	{
		//geocoder = new google.maps.Geocoder(); // creating a new geocode object

		//var address1 = '-34.628090,-58.466960';
		
		var address1 = coordenadas;
		
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

		var R;
		var dLat;
		var dLon;
		var dLat1;
		var dLat2;
		var a;
		var c;
		var d;
		
		mensaje="";
		var distancia=1000;
		
		for(i=0;i<17;i++){
			/*
			if (geocoder) 
			{
				geocoder.geocode( { 'address': direcciones[i]}, function(results, status) 
				{location1 = results[0].geometry.location;});
				geocoder.geocode( { 'address': address1}, function(results, status) 
				{location2 = results[0].geometry.location;});
				
			}
			dLat = toRad(location2.lat()-location1.lat());
			dLon = toRad(location2.lng()-location1.lng());
			dLat1 = toRad(location1.lat());
			dLat2 = toRad(location2.lat());
			*/
			
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
				mensaje = estaciones[i];
			}
		
		}
		
		return distancia + " km " + mensaje;
		
		//return " Distancia: " + distancia + " km entre " + mensaje + " y TREN";
		
		//document.getElementById("distance_direct").innerHTML = mensaje;
		                                                      
	}
	
	function toRad(deg) 
	{
		return deg * Math.PI/180;
	}
$(document).ready(function(){
	$("#myid").click(function(){
	  $.ajax({
		data: "id=2",
		type: "GET",
		dataType: "json",
		url: "CargaTrenes.php",
		success: function(data){
		   var i = 0;
			var days = 0;
			var size = data.length;
			
			//alert(size);
			 $("div.info").show();
			for (i = 0; i < size; i++){
				//results(data[i].idTren,data[i].velocidad);
				//calcular(data[i].coordinates);
				//alert(calcular(data[0].coordinates));
				$("div.info").append(" Tren TBA: "+data[i].idTren);
				$("div.info").append(" Velocidad: "+data[i].velocidad);
				$("div.info").append(" Distancia: "+ calcular(data[i].coordinates));
			}
		   //restults(data[0]);
		 },
		error: function(dato){
			alert("ERROR");
		}
	   });
	  });
});

