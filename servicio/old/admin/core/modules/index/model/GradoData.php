<?php
class GradoData {
	public static $tablename = "grado";
	
	public function __construct(){
		$this->id = 0;
		$this->idComponente = 0;	
		$this->componente = '';	
		$this->abreviatura = '';	
		$this->estatus = 0;	

	}	




	public static function getAll(){
		$sql = "SELECT g.id,g.idComponente,g.grado,c.componente,g.abreviatura,g.estatus  FROM ".self::$tablename." g INNER JOIN componente c ON g.idComponente = c.id ORDER BY g.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new GradoData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idComponente = $r['idComponente'];
			$array[$cnt]->grado = $r['grado'];	
			$array[$cnt]->componente = $r['componente'];	
			$array[$cnt]->abreviatura = $r['abreviatura'];	
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}



	public static function getById($id){
		$sql = "SELECT g.id,g.idComponente,g.grado,c.componente,g.abreviatura,g.estatus  FROM ".self::$tablename." g INNER JOIN componente c ON g.idComponente = c.id  WHERE g.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new GradoData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idComponente = $r['idComponente'];
			$array[$cnt]->grado = $r['grado'];	
			$array[$cnt]->componente = $r['componente'];	
			$array[$cnt]->abreviatura = $r['abreviatura'];	
			$array[$cnt]->estatus = $r['estatus'];		
		$cnt++;
		}
		return $array;
	}

	public static function getByCampo($campo,$valor){
		$sql = "SELECT g.id,g.idComponente,g.grado,c.componente,g.abreviatura,g.estatus  FROM ".self::$tablename." g INNER JOIN componente c ON g.idComponente = c.id  WHERE $campo='$valor'  ORDER BY g.id DESC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new GradoData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idComponente = $r['idComponente'];
			$array[$cnt]->grado = $r['grado'];	
			$array[$cnt]->componente = $r['componente'];	
			$array[$cnt]->abreviatura = $r['abreviatura'];	
			$array[$cnt]->estatus = $r['estatus'];		
				
		$cnt++;
		}
		return $array;
	}

	
}
?>