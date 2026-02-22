<?php
class UserData {
	public static $tablename = "user";
	public $responsive_id;
	public $id;
	public $nombre;
	public $nombreUsuario;
	public $password;
	public $userLevel;
	public $idReferido;
	public $confirmacion;
	public $created;
	public $image;
	public $estatus;

	public $dato1;


	public function __construct(){
		$this->responsive_id = '';
		$this->id = '0';
		$this->nombre = "";
		$this->nombreUsuario = "";	
		$this->password = "";
		$this->userLevel ="";
		$this->idReferido ="0";
		$this->confirmacion ="1";
		$this->created = "NOW()";
		$this->image ="no_image.jpg";
		$this->estatus ='0';
		$this->dato1 = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (nombre,nombreUsuario,password,userLevel,idReferido,confirmacion,created,estatus) ";
		$sql .= "value (\"$this->nombre\",\"$this->nombreUsuario\",\"$this->password\",\"$this->userLevel\",$this->idReferido,
		$this->confirmacion,$this->created,'1')";
		//echo $sql;
		Executor::doit($sql);
	}

	public function del(){
		$sql = "update ".self::$tablename." set estatus=0 where id='$this->id'";
		Executor::doit($sql);
	}
	
	public function delF(){
		$sql = "DELETE FROM  ".self::$tablename." where id='$this->id'";
		Executor::doit($sql);
	}
	
	public  function radomPassword(){
		$alphabet = "0123456789ABCDEFGHIJKLMNOPQSTUWXYZabcdefghijqlmnopqrstuvwxyz";
		$pass = array(); //recuerde que debe declarar $pass como un array
		$alphaLength = strlen($alphabet) - 1; //poner la longitud -1 en caché
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //convertir el array en una cadena
	}				
	
	public static function login($email,$password){
		$sql = "select count(id) as dato1,id,nombre,nombreUsuario,userLevel,image,estatus,confirmacion from ".self::$tablename." where nombreUsuario='$email' and password ='$password' and estatus = 1";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}
	public static function foundId($email){
		$sql = "select count(id) as cuenta from ".self::$tablename." where nombreUsuario='$email'";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function foundMail($email){
		$sql = "select id from ".self::$tablename." where nombreUsuario='$email'";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	// partiendo de que ya tenemos creado un objecto StatusData previamente utilizamos el contexto
	public  function loginTime(){
		$fecha = new DateTime();
		$date =$fecha->format('d/m/Y H:i:s');
		$sql = "update ".self::$tablename." set ultimoLogin=\"$date\" where nombreUsuario='$this->nombreUsuario'";
		//echo $sql;	
		return $query=Executor::doit($sql);
		
	}


	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",telefono=\"$this->telefono\",direccion=\"$this->direccion\"  where nombreUsuario='$this->nombreUsuario'";
		Executor::doit($sql);
	}
	
	public  function updatePassword(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where nombreUsuario='$this->nombreUsuario'";
		//echo $sql;
		Executor::doit($sql);
	}

	public  function recoverPassword($nombreUsuario,$password){
		$sql = "update ".self::$tablename." set password=\"$password\" where nombreUsuario='$nombreUsuario'";
		//echo $sql;
		Executor::doit($sql);
	}


	public function edit(){
		if($this->password==0){
			$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",nombreUsuario=\"$this->nombreUsuario\" where id='$this->id'";
		}else{
			$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",nombreUsuario=\"$this->nombreUsuario\",password=\"$this->password\" where id='$this->id'";
		}
	
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		$found = null;
		$data = new UserData();
		while($r = $query[0]->fetch_array()){
			$data->id = $r['id'];
			$data->nombre = $r['nombre'];
			$data->nombreUsuario = $r['nombreUsuario'];
			$data->userLevel = $r['userLevel'];
			$data->estatus = $r['estatus'];
			$found = $data;
			break;
		}
		return $found;
	}

	public static function getAllDatos(){
		$sql = "SELECT *  FROM ".self::$tablename."  WHERE userLevel>1 ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			
			$array[$cnt] = new UserData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];	
			$array[$cnt]->nombreUsuario = $r['nombreUsuario'];	
			$array[$cnt]->userLevel = $r['userLevel'];		
			$array[$cnt]->ultimoLogin = $r['ultimoLogin'];	
			$array[$cnt]->created = $r['created'];	
			$array[$cnt]->image = $r['image'];		
			$array[$cnt]->password = $r['password'];	
			$array[$cnt]->idReferido = 1;	
			$array[$cnt]->confirmacion = $r['confirmacion'];		
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}

	public static function getDataObjeto($email){
		$sql = "SELECT *  FROM ".self::$tablename."  WHERE nombreUsuario='$email'  ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new UserData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];	
			$array[$cnt]->nombreUsuario = $r['nombreUsuario'];	
			$array[$cnt]->userLevel = $r['userLevel'];		
			$array[$cnt]->ultimoLogin = $r['ultimoLogin'];	
			$array[$cnt]->created = $r['created'];	
			$array[$cnt]->image = $r['image'];		
			$array[$cnt]->password = $r['password'];	
			$array[$cnt]->idReferido = $r['idReferido'];		//data de la tabla sucursal
			$array[$cnt]->confirmacion = $r['confirmacion'];		
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}

	public static function forgotPassword($email){
		$sql = "SELECT *  FROM ".self::$tablename."  WHERE nombreUsuario='$email' AND confirmacion= 1 and idReferido =1   ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$objetoFuncion = new FuncionesData();
			$nuevaClave = $objetoFuncion->radomPassword();	
			
			$array[$cnt] = new UserData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];	
			$array[$cnt]->nombreUsuario = $r['nombreUsuario'];	
			$array[$cnt]->userLevel = $r['userLevel'];		
			$array[$cnt]->ultimoLogin = $r['ultimoLogin'];	
			$array[$cnt]->created = $r['created'];	
			$array[$cnt]->image = $r['image'];		
			$array[$cnt]->password = $nuevaClave ;
			$array[$cnt]->idReferido = $r['idReferido'];		//data de la tabla sucursal
			$array[$cnt]->confirmacion = $r['confirmacion'];		
			$array[$cnt]->estatus = $r['estatus'];			
		$cnt++;
		}
		return $array;
	}

	
}
?>