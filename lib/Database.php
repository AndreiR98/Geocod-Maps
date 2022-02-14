<?php
class Database{
	private $con;

	function __construct(){
		include('config.php');

		$this->con = mysqli_connect($config['host'], $config['user'], $config['password']);
		mysqli_select_db($this->con, $config['db']);
	}

	public function query($query){
		return $this->con->query($query);
	}
}
?>