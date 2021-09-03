<?php
class Process{

	private $API_KEY;
	private $con;
    
    //Connect to MySQL and config the API_KEY
	function __construct(){
		require_once('config.php');

		$this->API_KEY = $config['API_KEY'];
		
		$this->con = mysqli_connect($config['host'], $config['user'], $config['password']);
		mysqli_select_db($this->con, $config['db']);

	}
    
    //Convert decimal to deg/min/sec
	public function Format($number){

		$ex = explode('.', $number);
        $temp = ('0.'.$ex[1])*60;
        $ex2 = explode('.', $temp);
        $temp2 = ('0.'.$ex2[1])*60;
		$ex3 = explode('.', $temp2);


		$deg = $ex[0];
		$min = $ex2[0];
		$sec = round($temp2,2);

		return ['deg'=>$deg, 'min'=>$min, 'sec'=>$sec];
	}
    
    //Extract datas from adress if it's adress or decimal values
	public function geocode_adress($adress='', $lat='', $long='', $mode=''){
        
        //For GPS/Decimal
		if($mode == 'gps'){
			$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$long}&key={$this->API_KEY}";
		}elseif($mode == 'adress'){
			//For normal adress
			$adress = urlencode($adress);

			$url = "https://maps.googleapis.com/maps/api/geocode/json?address={$adress}&key={$this->API_KEY}";
		}

		$JSON = file_get_contents($url);

		$response = json_decode($JSON, true);
		
		$lat = $response['results'][0]['geometry']['location']['lat'];
		$long = $response['results'][0]['geometry']['location']['lng'];
		$formated = $response['results'][0]['formatted_address'];
		$place_id = $response['results'][0]['place_id'];

		$adress = urlencode($formated);

		return ['lat'=>$lat, 'long'=>$long, 'formated'=>$formated, 'encode'=>$adress, 'place_id'=>$place_id];
	}
    
    //Search if adress exist already in MySQL
    /**
    If mode is set to adress then search for match urlencode adress such as Centru+Pitesti+Arges....
    If mode is set to GPS take lat and long arrays containing converted coords and search for string such as lat=56;24;05 long=21;10;14
    */
	public function search($adress='', $lat='', $long='', $mode=''){
		$db = $this->con;

		if($mode == 'adress'){
			$adress_url = urlencode($adress);

		    $result = $db->query('SELECT * FROM adress WHERE encode="'.$adress_url.'"')->fetch_assoc();
		}elseif($mode == 'gps'){
            $format_lat = "".$lat['deg'].";".$lat['min'].";".round($lat['sec'])."";
            $format_long = "".$long['deg'].";".$long['min'].";".round($long['sec'])."";		

			$result = $db->query('SELECT * FROM adress WHERE lat="'.$format_lat.'" AND lng="'.$format_long.'"')->fetch_assoc();
		}

		

		return $result;
	}
    
    //Add adress to MySQL
	public function Add($adress='', $lat='', $long='', $mode=''){
		if($mode == 'adress'){
			$data = $this->geocode_adress($adress, '', '', 'adress');
		}elseif($mode == 'gps'){
			$data = $this->geocode_adress('', $lat, $long, 'gps');
		}
        
        //Convert decimal to GPS
		$format_lat = $this->Format($data['lat']);
		$format_long = $this->Format($data['long']);
        
        //Creat gps finder string this string allow better findings, round value is for second.
        $lat_c = "".$format_lat['deg'].";".$format_lat['min'].";".round($format_lat['sec'])."";
        $lng_c = "".$format_long['deg'].";".$format_long['min'].";".round($format_long['sec'])."";
		
		$this->con->query('INSERT INTO adress(lat_real, lng_real,  formated, encode, place_id, lat, lng) VALUES ("'.round($data['lat'],6).'", "'.round($data['long'],6).'", "'.$data['formated'].'", "'.$data['encode'].'", "'.$data['place_id'].'", "'.$lat_c.'", "'.$lng_c.'")');
	}

	
}
?>