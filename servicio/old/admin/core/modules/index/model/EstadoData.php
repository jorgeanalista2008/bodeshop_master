<?php
class EstadoData {
	public static $tablename = "estados";
	
	public function __construct(){
		$this->id_estado = '0';
		$this->estado = "";	

	}	

	public static function getAll(){
		$sql = "SELECT *  FROM ".self::$tablename." ORDER BY estado ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new EstadoData();    
			$array[$cnt]->id_estado = $r['id_estado'];
			$array[$cnt]->estado = $r['estado'];		
		$cnt++;
		}
		return $array;
	}
	


	
}
?>