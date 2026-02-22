<?php
class ClienteData {
	public static $tablename = "cliente";


		public $id = 0;
		public $cedula = 0;	
		public $nombreCompleto = '';	
		public $telefono = '';	
		public $correo = '';	
		public $idParroquia = '';	
		public $direccion = '';	
		public $genero = '';	
		public $responsive_id = '';	
		public $estatus = 0;	
	
	public function __construct(){
		$this->id = 0;
		$this->cedula = 0;	
		$this->nombreCompleto = '';	
	
		$this->telefono = '';	
		$this->correo = '';	
		$this->idParroquia = '';	
		$this->direccion = '';	
		$this->estatus = 0;	


	}	
	public function add(){


		$sql = "insert into ".self::$tablename." (id,cedula,nombreCompleto,genero,telefono,correo,idParroquia,direccion,estatus) ";
		$sql .= "value (NULL,\"$this->cedula\",\"$this->nombreCompleto\",$this->genero,\"$this->telefono\",\"$this->correo\",$this->idParroquia,\"$this->direccion\",1)";
		
		Executor::doit($sql);
	
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set nombreCompleto=\"$this->nombreCompleto\",genero=$this->genero,
		telefono=\"$this->telefono\",correo=\"$this->correo\",idParroquia=$this->idParroquia,direccion=\"$this->direccion\"  where id=$this->id";
		
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
		//$sql = "SELECT p.id,p.cedula,p.nombreCompleto  FROM ".self::$tablename." p WHERE p.id NOT IN (SELECT c.idPersonal from contrato c)	
		// BY p.id ASC";	
		//echo $sql;
		$sql = "SELECT p.id,p.cedula,p.nombreCompleto,p.genero,p.telefono,p.correo  FROM ".self::$tablename." p 	
		WHERE p.estatus=1 ORDER BY p.id ASC";

		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ClienteData(); 
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->cedula = $r['cedula'];
			$array[$cnt]->nombreCompleto = $r['nombreCompleto'];
			$array[$cnt]->genero = $r['genero'];
			$array[$cnt]->telefono = $r['telefono'];
			$array[$cnt]->correo = $r['correo'];
			
		$cnt++;
		}
		return $array;
	}
	public static function getByClausule($key,$valor){
		//$sql = "SELECT p.id,p.cedula,p.nombreCompleto  FROM ".self::$tablename." p WHERE p.id NOT IN (SELECT c.idPersonal from contrato c)	
		// BY p.id ASC";	
		//echo $sql;
		$sql = "SELECT p.id,p.cedula,p.nombreCompleto,p.genero,p.telefono,p.correo  FROM ".self::$tablename." p 	
		WHERE p.estatus=1  and ".$key."= '".$valor."' ORDER BY p.id ASC";

		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ClienteData(); 
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->cedula = $r['cedula'];
			$array[$cnt]->nombreCompleto = $r['nombreCompleto'];
			$array[$cnt]->genero = $r['genero'];
			$array[$cnt]->telefono = $r['telefono'];
			$array[$cnt]->correo = $r['correo'];
			
		$cnt++;
		}
		return $array;
	}


	public static function getById($id){
		//$sql = "SELECT p.id,p.cedula,p.nombreCompleto  FROM ".self::$tablename." p WHERE p.id NOT IN (SELECT c.idPersonal from contrato c)	
		// BY p.id ASC";	
		//echo $sql;
		$sql = "SELECT p.id,p.cedula,p.nombreCompleto,p.genero,p.telefono,p.correo  FROM ".self::$tablename." p 	
		WHERE p.estatus=1  and id = $id ORDER BY p.id ASC";

		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			

			$array[$cnt] = new ClienteData(); 
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->cedula = $r['cedula'];
			$array[$cnt]->nombreCompleto = $r['nombreCompleto'];
			$array[$cnt]->genero = $r['genero'];
			$array[$cnt]->telefono = $r['telefono'];
			$array[$cnt]->correo = $r['correo'];	

			
		$cnt++;
		}
		return $array;
	}


		public static function estadisticas(){
	
		$sql = "SELECT count(id) as numeros FROM cliente WHERE estatus = 1	ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){

			$array[$cnt] = new PersonalData();    
		
			$array[$cnt]->numeros = $r['numeros'];

		$cnt++;
		}
		return $array;
	}

	
}
?>