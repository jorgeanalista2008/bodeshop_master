<?php
class MarcaData {
	public static $tablename = "marca";
	
	public function __construct(){
		$this->id = '0';
		$this->idTipo = "";	
		$this->marca = "";	
		$this->estatus = "0";	
	



	}	

	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,idTipo,marca,estatus) ";
		$sql .= "value (NULL,$this->idTipo,\"$this->marca\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set marca=\"$this->marca\",idTipo=$this->idTipo where id='$this->id'";
		//echo $sql;
		Executor::doit($sql);
	}

	public static function getAll(){	

		$sql = "SELECT m.id,t.tipo,t.condicion,m.estatus,m.marca FROM ".self::$tablename." m INNER JOIN tipo t ON m.idTipo = t.id";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MarcaData();
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->tipo = $r['tipo'];
			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->estatus = $r['estatus'];
			$cnt++;		}
		return $array;
	}


	public static function getById($id){
		$sql = "SELECT m.id,t.tipo,m.idTipo,t.condicion,m.estatus,m.marca FROM ".self::$tablename." m INNER JOIN tipo t ON m.idTipo = t.id  WHERE m.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){	
			$array[$cnt] = new MarcaData();
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idTipo = $r['idTipo'];
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->tipo = $r['tipo'];
			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->estatus = $r['estatus'];
				
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
$sql = "SELECT m.id,t.tipo,m.idTipo,t.condicion,m.estatus,m.marca FROM ".self::$tablename." m INNER JOIN tipo t ON m.idTipo = t.id     WHERE $campo='$valor'  ORDER BY t.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new MarcaData();
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idTipo = $r['idTipo'];
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->tipo = $r['tipo'];
			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->estatus = $r['estatus'];
				
		$cnt++;
		}
		return $array;
	}

	
}
?>