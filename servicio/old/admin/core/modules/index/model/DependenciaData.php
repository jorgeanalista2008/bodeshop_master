<?php
class DependenciaData {
	public static $tablename = "dependencia";
	
	public function __construct(){
		$this->id = 0;
		$this->idUnidad = 0;	
		$this->dependencia = '';		
		$this->estatus = 0;	

	}	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,idUnidad,dependencia,estatus) ";
		$sql .= "value (NULL,$this->idUnidad,\"$this->dependencia\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set idUnidad=$this->idUnidad,dependencia=\"$this->dependencia\" where id=$this->id";
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
		$sql = "SELECT d.id,d.dependencia,u.unidad,u.estatus  FROM ".self::$tablename." d INNER JOIN unidad u ON d.idUnidad = u.id ORDER BY d.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new DependenciaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->dependencia = $r['dependencia'];	
			$array[$cnt]->unidad = $r['unidad'];	
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}



	public static function getById($id){
		$sql = "SELECT  d.id,d.dependencia,u.unidad,u.estatus  FROM ".self::$tablename." d INNER JOIN unidad u ON d.idUnidad = u.id WHERE d.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			
			$array[$cnt] = new DependenciaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->dependencia = $r['dependencia'];	
			$array[$cnt]->unidad = $r['unidad'];	
			$array[$cnt]->estatus = $r['estatus'];	
					
		$cnt++;
		}
		return $array;
	}

	public static function getByIdInner($id){
		$sql = "SELECT d.id,d.depenencia,d.idUnidad,u.unidad,u.idBrigada,b.brigada,b.idZodi,z.zodi,z.idRedi,r.redi,u.estatus  FROM ".self::$tablename." d 
		INNER JOIN unidad u ON d.idUnidad = u.id 
		INNER JOIN brigada b ON u.idBrigada = b.id 
		INNER JOIN zodi z ON b.idZodi = z.id 
		INNER JOIN redi r ON z.idRedi = r.id WHERE u.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			
			$array[$cnt] = new DependenciaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idZodi = $r['idZodi'];
			$array[$cnt]->idRedi = $r['idRedi'];
			$array[$cnt]->idBrigada = $r['idBrigada'];
			$array[$cnt]->idBrigada = $r['idBrigada'];
			$array[$cnt]->redi = $r['redi'];
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->unidad = $r['unidad'];
			$array[$cnt]->depenencia = $r['depenencia'];
			$array[$cnt]->estatus = $r['estatus'];		
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
		$sql = "SELECT d.id,d.dependencia,u.unidad,u.estatus  FROM ".self::$tablename." d INNER JOIN unidad u ON d.idUnidad = u.id WHERE $campo='$valor'  ORDER BY d.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new DependenciaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->dependencia = $r['dependencia'];	
			$array[$cnt]->unidad = $r['unidad'];	
			$array[$cnt]->estatus = $r['estatus'];			
				
		$cnt++;
		}
		return $array;
	}

	
}
?>