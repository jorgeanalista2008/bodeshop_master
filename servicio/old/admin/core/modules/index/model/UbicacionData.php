<?php
class UbicacionData {
	public static $tablename = "ubicacion";
	//id	ubicacion	descripcion	estatus	

	public function __construct(){
		$this->id = '0';
		$this->ubicacion = "";	
		$this->descripcion = "";	
		$this->estatus = 0;	

	}	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,ubicacion,descripcion,estatus) ";
		$sql .= "value (NULL,\"$this->ubicacion\",\"$this->descripcion\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){		
		$sql = "update ".self::$tablename." set ubicacion=\"$this->ubicacion\", descripcion=\"$this->descripcion\" where id='$this->id'";
		//echo $sql;
		Executor::doit($sql);
	}

	public function del(){
		$sql = "update ".self::$tablename." set estatus=0 where id=$this->id";
		Executor::doit($sql);
	}
	public function act(){
		$sql = "update ".self::$tablename." set estatus=1 where id=$this->id";
		Executor::doit($sql);
	}

	public static function getAll(){
		$sql = "SELECT *  FROM ".self::$tablename." ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new UbicacionData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->ubicacion = $r['ubicacion'];				
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}



	public static function getById($id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new UbicacionData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->ubicacion = $r['ubicacion'];	
			$array[$cnt]->descripcion = $r['descripcion'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
		$sql = "SELECT *  FROM ".self::$tablename."  WHERE $campo='$valor'  ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new UbicacionData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->ubicacion = $r['ubicacion'];	
			$array[$cnt]->descripcion = $r['descripcion'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	
}
?>