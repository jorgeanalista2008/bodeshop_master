<?php
class TipoData {
	public static $tablename = "tipo";
	
	public function __construct(){
		$this->id = '0';
		$this->tipo = "";	
		$this->estatus = "0";	
		$this->condicion = "";	
	


	}	

	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,tipo,condicion,estatus) ";
		$sql .= "value (NULL,\"$this->tipo\",$this->condicion,1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set tipo=\"$this->tipo\",condicion=$this->condicion where id='$this->id'";
		//echo $sql;
		Executor::doit($sql);
	}


	public static function getAll(){	

		$sql = "SELECT * FROM ".self::$tablename." t";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new TipoData();
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->tipo = $r['tipo'];	
			$array[$cnt]->condicion = $r['condicion'];		
			$array[$cnt]->estatus = $r['estatus'];					
			$cnt++;		}
		return $array;
	}


	public function del(){
		$sql = "update ".self::$tablename." set estatus=0 where id=$this->id";
		Executor::doit($sql);
	}
	public function act(){
		$sql = "update ".self::$tablename." set estatus=1 where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){	
			$array[$cnt] = new TipoData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->tipo = $r['tipo'];	
			$array[$cnt]->condicion = $r['condicion'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}
	public static function getByCampo($campo,$valor){
		$sql = "SELECT t.id,t.condicion,t.tipo,t.estatus  FROM ".self::$tablename." t   WHERE $campo='$valor' AND  t.estatus=1  ORDER BY t.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new TipoData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->tipo = $r['tipo'];	
			$array[$cnt]->condicion = $r['condicion'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	
}
?>