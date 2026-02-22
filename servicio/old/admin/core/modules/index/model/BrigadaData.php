<?php
class BrigadaData {
	public static $tablename = "brigada";
	
	public function __construct(){
		$this->id = 0;
		$this->idZodi = 0;	
		$this->zodi = '';	
		$this->brigada = '';	
		$this->estatus = 0;	

	}	
	public function add(){
		
		$sql = "insert into ".self::$tablename." (id,idZodi,brigada,estatus) ";
		$sql .= "value (NULL,$this->idZodi,\"$this->brigada\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set idZodi=$this->idZodi,brigada=\"$this->brigada\" where id=$this->id";
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
		$sql = "SELECT b.id,b.idZodi,b.brigada,z.zodi,b.estatus  FROM ".self::$tablename." b INNER JOIN zodi z ON b.idZodi = z.id ORDER BY b.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new BrigadaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}



	public static function getById($id){
		$sql = "SELECT b.id,b.idZodi,b.brigada,z.zodi,b.estatus  FROM ".self::$tablename." b INNER JOIN zodi z ON b.idZodi = z.id WHERE b.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			
			$array[$cnt] = new BrigadaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idZodi = $r['idZodi'];
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];		
		$cnt++;
		}
		return $array;
	}

	public static function getByIdInner($id){
		$sql = "SELECT * FROM ".self::$tablename." b INNER JOIN zodi z ON b.idZodi = z.id INNER JOIN redi r ON z.idRedi = r.id WHERE b.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			
			$array[$cnt] = new BrigadaData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idZodi = $r['idZodi'];
			$array[$cnt]->idRedi = $r['idRedi'];
			$array[$cnt]->redi = $r['redi'];
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];		
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
		$sql = "SELECT b.id,b.idZodi,b.brigada,z.zodi,z.estatus  FROM ".self::$tablename." b INNER JOIN zodi z ON b.idZodi = z.id  WHERE $campo='$valor'  ORDER BY b.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new BrigadaData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idZodi = $r['idZodi'];
			$array[$cnt]->brigada = $r['brigada'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	
}
?>