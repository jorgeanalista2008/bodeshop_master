<?php
class ParroquiaData {
	public static $tablename = "parroquias";
	
	public function __construct(){
		$this->id_parroquia = '0';
		$this->id_municipio = '0';
		$this->parroquia = "";	

	}	


	
	public static function getByCampo($campo,$valor){
		$sql = "SELECT p.id_parroquia,p.parroquia,m.id_municipio  FROM ".self::$tablename." p INNER JOIN municipios m ON p.id_municipio = m.id_municipio WHERE $campo='$valor'  ORDER BY p.parroquia ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new ParroquiaData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id_parroquia = $r['id_parroquia'];
			$array[$cnt]->id_municipio = $r['id_municipio'];
			$array[$cnt]->parroquia = $r['parroquia'];			
				
		$cnt++;
		}
		return $array;
	}

	public static function getAll(){
		$sql = "SELECT *  FROM ".self::$tablename." ORDER BY estado ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MunicipioData();    
			$array[$cnt]->id = $r['estado'];
			$array[$cnt]->estado = $r['estado'];		
		$cnt++;
		}
		return $array;
	}

	public static function getData($id){
		$sql = "SELECT *  FROM ".self::$tablename." ORDER BY estado ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MunicipioData();    
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->estado = $r['estado'];		
		$cnt++;
		}
		return $array;
	}

	
	public static function getAllDatos(){
		$sql = "SELECT *  FROM ".self::$tablename." ORDER BY estado ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MunicipioData();    
			$array[$cnt]->id = $r['estado'];
			$array[$cnt]->estado = $r['estado'];		
		$cnt++;
		}
		return $array;
	}


	
}
?>