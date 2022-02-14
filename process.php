<?php
//Load Smart files and libraries
require_once('include.inc.php');
include('Functions.php');

//Load Functions class
$process = new Functions();

if($_POST){
	$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	$adress = $_POST['adress'];
    
    //Check if the action is adress finder
	if($_POST['action'] == 'adress'){
		//Check is adress already in MySQL
		if($process->search($adress, '', '', 'adress')){

           //Return datas for that adress
		   $return = $process->search($adress, '', '', 'adress');
           
           //Prepare data for JSON
		   $data = [
		   	'lat'=>$return['lat_real'],
		   	'long'=>$return['lng_real'],
		   	'formated'=>$return['formated'],
		   	'encode'=>$return['encode'],
		   	'place_id'=>$return['place_id']
		   ];
		}else{
			//If adress is not in MySQL Show add it and show datas about
			$process->Add($adress, '', '', 'adress');

			$data = $process->geocode_adress($adress, '', '', 'adress');
		}
		
	}
	//Check if action is GPS finder
	if($_POST['action'] == 'gps'){
		$lat = $_POST['lat'];
		$long = $_POST['long'];

        //Convert decimal to deg/min/sec
		$lat_c = $process->Format($lat);
		$long_c = $process->Format($long);
        
        //Check if adress is in MySQL
		if($process->search('', $lat_c, $long_c, 'gps')){
			$return = $process->search('', $lat_c, $long_c, 'gps');

			$data = [
				'lat'=>$return['lat_real'],
				'long'=>$return['lng_real'],
				'formated'=>$return['formated'],
				'encode'=>$return['encode'],
				'place_id'=>$return['place_id']
			];

			
		}else{
			$process->Add('', $lat, $long, 'gps');
			$data = $process->geocode_adress('', $lat, $long, 'gps');
		}

	}
	echo json_encode($data);
	
}
?>