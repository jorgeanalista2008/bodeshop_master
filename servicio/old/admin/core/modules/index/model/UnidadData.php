<?php
class UnidadData {
	public static $tablename = "unidad";
	
	public function __construct(){
		$this->id = 0;
		$this->idBrigada = 0;	
		$this->brigada = '';	
		$this->unidad = '';	
		$this->estatus = 0;	

	}	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,idBrigada,unidad,estatus) ";
		$sql .= "value (NULL,$this->idBrigada,\"$this->unidad\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set idBrigada=$this->idBrigada,unidad=\"$this->unidad\" where id=$this->id";
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
		$sql = "SELECT u.id,u.unidad,b.brigada,u.estatus  FROM ".self::$tablename." u INNER JOIN brigada b ON u.idBrigada = b.id ORDER BY u.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new UnidadData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->unidad = $r['unidad'];	
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}



	public static function getById($id){
		$sql = "SELECT u.id,u.unidad,u.idBrigada,b.brigada,b.idZodi,z.zodi,z.idRedi,r.redi,u.estatus  FROM ".self::$tablename." u 
		INNER JOIN brigada b ON u.idBrigada = b.id 
		INNER JOIN zodi z ON b.idZodi = z.id 
		INNER JOIN redi r ON z.idRedi = r.id WHERE u.id='$id'";

		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			
		$array[$cnt] = new UnidadData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idZodi = $r['idZodi'];
			$array[$cnt]->idRedi = $r['idRedi'];
			$array[$cnt]->idBrigada = $r['idBrigada'];
			$array[$cnt]->redi = $r['redi'];
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->unidad = $r['unidad'];
			$array[$cnt]->estatus = $r['estatus'];		
		$cnt++;
		}
		return $array;
	}


	public static function getByCampo($campo,$valor){
		$sql = "SELECT u.id,u.unidad,b.brigada,u.estatus  FROM ".self::$tablename." u INNER JOIN brigada b ON u.idBrigada = b.id  WHERE $campo='$valor'  ORDER BY b.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new UnidadData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->unidad = $r['unidad'];	
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->estatus = $r['estatus'];			
				
		$cnt++;
		}
		return $array;
	}

	
}
?>