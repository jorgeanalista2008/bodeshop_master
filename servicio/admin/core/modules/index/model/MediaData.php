<?php
class MediaData {
	public static $tablename = "media";
	public $id;
	public $codigo;
	public $media;
	public $estatus;	
		 	


	public function __construct(){
		$this->id = "";
		$this->codigo = "";
		$this->media = "";	
		$this->estatus = "1";	
	}
	
	public function add(){
		$sql = "insert into ".self::$tablename." (id,codigo,media,estatus) ";
		$sql .= "value (NULL,\"$this->codigo\",\"$this->media\",$this->estatus)";
		//echo $sql;
	Executor::doit($sql);	
	}
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}
	public function delByCode($codigo,$estatus){
		$sql = "delete from ".self::$tablename." where codigo='$codigo' and estatus=$estatus";
		Executor::doit($sql);
	}

	public static function delByIdL($id){
		$sql = "update ".self::$tablename." set estatus=0 where id=$id";
		Executor::doit($sql);
	}
	
	public function delL(){
		$sql = "update ".self::$tablename." set estatus=0 where id=$this->id";
		Executor::doit($sql);
	}

	public function update_image(){
		$sql = "update ".self::$tablename." set image='$this->image' where id=$this->id";
		Executor::doit($sql);
	}

	public static function getAllSlider($key,$id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE ".$key." =$id";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MediaData();
            $array[$cnt]->id = $r['id'];
			$array[$cnt]->image = $r['media'];					
			$cnt++;
		}
		return $array;
	}


	public static function getData($key,$id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE ".$key." =$id";
		//echo $sql;
		$query = Executor::doit($sql);
		$found = null;
		$data = new MediaData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];		
			$data->image = $r['media'];			
			$found = $data;
			break;
		}
		return $found;
	}

	public static function getDataImagenes($key,$id){
		$sql = "SELECT * FROM ".self::$tablename." WHERE ".$key." =$id";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MediaData();
            $array[$cnt]->id = $r['id'];
			$array[$cnt]->image = $r['media'];		
		
			$cnt++;
		}
		return $array;
	}


	public static function getDataImagenesCodigo($codigo){
		$sql = "SELECT * FROM ".self::$tablename." WHERE codigo ='$codigo'";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new MediaData();
            $array[$cnt]->id = $r['id'];
			$array[$cnt]->image = $r['media'];		
		
			$cnt++;
		}
		return $array;
	}

	

	

	public static function getAllCodigo(){
		$sql = "select * from ".self::$tablename. " where estatus=1";
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new IngredienteData();
            $array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];			
			$array[$cnt]->image = $r['image'];			
			$array[$cnt]->is_active = $r['estatus'];		
			$cnt++;
		}
		return $array;
	}


}

?>