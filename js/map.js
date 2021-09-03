


var Adress = {
	'converter':function(){
		var adress_i = document.getElementById('adress_field').value;
        var ti = performance.now();
		if(adress_i == ''){
			$('#message').addClass('error').html('Adress field is empty!');
		}else{
			$.ajax({
				type:'POST',
				url:'process.php',
				data:{action:'adress', adress:adress_i},
				success:function(data){
					console.log(adress_i);
					var tf = performance.now();
					let {lat, long, formated, encoded, place_id} = JSON.parse(data);
					$('#message').html(
						"<div id='container'>Adress: "+formated+
						"<br>Latitude: "+lat+
						"<br/>Longitude: "+long+
						"<br/>Generate in: "+(tf-ti)+" ms</div>"
					);
				}
			});
		}
		

		
	},
};

var LatLong = {
	'converter':function(){
		var lat_i = document.getElementById('lat_field').value;

		var long_i = document.getElementById('long_field').value;

		var ti = performance.now();

		if((!(lat_i == '')&&(!isNaN(lat_i)))||(!(long_i == '')&&(!isNaN(long_i)))){
			$.ajax({
				type:'POST',
				url:'process.php',
				data:{action:'gps', lat:lat_i, long:long_i},
				success:function(data){
					var tf = performance.now();
					let {lat, long, formated, encoded, place_id} = JSON.parse(data);
					$('#message').html(
						"<div id='container'>Adress: "+formated+
						"<br/>Latitude: "+lat+
						"<br/>Longitude: "+long+
						"<br/>Generate in: "+(tf-ti)+" ms</div>"
					);	
				}
			});
		}else{
			$('#message').addClass('error').html('Please check your lat or long inputs!');
		}
	},
};