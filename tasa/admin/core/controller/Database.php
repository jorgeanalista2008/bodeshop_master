<?php
class Database {
	public static $db;
	public static $con;
	public function __construct(){
	
	
	$this->user="u646234231_principal";$this->pass="Gust.123##";$this->host="localhost";$this->ddbb="u646234231_principal";
		//$this->user="jorge_seguros";$this->pass="fDKWY.K7!{Zs";$this->host="localhost";$this->ddbb="jorge_seguros";
	//fDKWY.K7!{Zs
	
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$con->set_charset("utf8");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
