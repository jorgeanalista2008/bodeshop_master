<?php
class ZodiData {
	public static $tablename = "zodi";
	
	public function __construct(){
		$this->id = 0;
		$this->idRedi = 0;	
		$this->redi = '';	
		$this->zodi = '';	
		$this->estatus = 0;	

	}	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,idRedi,zodi,estatus) ";
		$sql .= "value (NULL,$this->idRedi,\"$this->zodi\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set idRedi=$this->idRedi,zodi=\"$this->zodi\" where id=$this->id";
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
		$sql = "SELECT z.id,z.idRedi,z.zodi,r.redi,z.estatus  FROM ".self::$tablename." z INNER JOIN redi r ON z.idRedi = r.id ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ZodiData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->redi = $r['redi'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}



	public static function getById($id){
		$sql = "SELECT z.id,z.idRedi,z.zodi,r.redi,z.estatus  FROM ".self::$tablename."  z INNER JOIN redi r ON z.idRedi = r.id  WHERE z.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new ZodiData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idRedi = $r['idRedi'];
			$array[$cnt]->zodi = $r['zodi'];
			$array[$cnt]->redi = $r['redi'];		
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
		$sql = "SELECT z.id,z.idRedi,z.zodi,r.redi,z.estatus  FROM ".self::$tablename." z INNER JOIN redi r ON z.idRedi = r.id  WHERE $campo='$valor'  ORDER BY z.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new ZodiData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->redi = $r['redi'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	
}
?>