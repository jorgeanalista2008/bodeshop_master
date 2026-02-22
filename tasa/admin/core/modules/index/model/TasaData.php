<?php
class TasaData {
	public static $tablename = "sma_exchange_rate";
		
	
	public function __construct(){
		
		$this->id = '0';
		$this->tasa = "0";
		$this->status = "0";	

	}	
	
	public function update($tasa){
		$sql = "UPDATE ".self::$tablename." set tasa=$tasa  WHERE id=1";
		//echo $sql;
		Executor::doit($sql);
	}


}
?>