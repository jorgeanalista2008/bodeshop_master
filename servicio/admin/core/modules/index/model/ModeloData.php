<?php
class ModeloData {
	public static $tablename = "modelo";
	
	public function __construct(){
		$this->id = '0';
		$this->idMarca = "";	
		$this->modelo = "";	
		$this->estatus = "0";	
	



	}	

	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,idMarca,modelo,estatus) ";
		$sql .= "value (NULL,$this->idMarca,\"$this->modelo\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set modelo=\"$this->modelo\",idMarca=$this->idMarca where id='$this->id'";
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

		$sql = "SELECT m.id,m.idMarca,mr.marca,m.estatus,m.modelo FROM ".self::$tablename." m INNER JOIN marca mr ON m.idMarca = mr.id";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ModeloData();
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idMarca = $r['idMarca'];
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->modelo = $r['modelo'];		
			$array[$cnt]->estatus = $r['estatus'];
			$cnt++;		}
		return $array;
	}


	public static function getById($id){
		$sql = "SELECT m.id,m.idMarca,mr.marca,m.estatus,m.modelo,t.condicion,mr.idTipo,t.tipo FROM ".self::$tablename." m 
		INNER JOIN marca mr ON m.idMarca = mr.id  
		INNER JOIN tipo t ON mr.idTipo = t.id
		WHERE m.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){	
			$array[$cnt] = new ModeloData();
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idMarca = $r['idMarca'];
			$array[$cnt]->idTipo = $r['idTipo'];
			$array[$cnt]->tipo = $r['tipo'];
			
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->modelo = $r['modelo'];		
			$array[$cnt]->condicion = $r['condicion'];		
			$array[$cnt]->estatus = $r['estatus'];
				
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
		$sql = "SELECT m.id,m.estatus,m.modelo FROM ".self::$tablename." m   WHERE $campo='$valor'  ORDER BY m.id ASC";
				
				//echo $sql;
				$query = Executor::doit($sql);
				$array = array();
				$cnt = 0;
				while($r = $query[0]->fetch_array()){
				
					$array[$cnt] = new ModeloData();
					$array[$cnt]->responsive_id = "";  
					$array[$cnt]->id = $r['id'];
					$array[$cnt]->modelo = $r['modelo'];		
					$array[$cnt]->estatus = $r['estatus'];
						
				$cnt++;
				}
				return $array;
			}

	
}
?>