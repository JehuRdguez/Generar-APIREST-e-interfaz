<?php 

class conexion {

	private $server;
	private $user;
	private $password;
	private $database;
	private $port;
	private $conexion;

	private function conectionData(){
		$dir = dirname(__FILE__);
		$json = file_get_contents($dir . "/config");
		return json_decode($json, true);
	}

	function __construct(){
		$dataList = $this->conectionData();
		foreach ($dataList as $row => $value){
			$this->server = $value['server'];
			$this->user = $value['user'];
			$this->password = $value['password'];
			$this->database = $value['database'];
			$this->port = $value['port'];
		}
		$this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
		if($this->conexion->connect_errno){
			echo "Error de conexión!!";
			die();
		}
	}

}

?>