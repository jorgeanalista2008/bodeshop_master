<?php
class MunicipioData {
	public static $tablename = "municipios";
	
	public function __construct(){
		$this->id_municipio = '0';
		$this->id_estado = '0';
		$this->municipio = "";	

	}	


	
	public static function getByCampo($campo,$valor){
		$sql = "SELECT m.id_municipio,m.municipio,e.id_estado  FROM ".self::$tablename." m INNER JOIN estados e ON m.id_estado = e.id_estado WHERE $campo='$valor'  ORDER BY m.municipio ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new MunicipioData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id_municipio = $r['id_municipio'];
			$array[$cnt]->municipio = $r['municipio'];			
				
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