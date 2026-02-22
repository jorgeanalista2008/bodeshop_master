<?php
class PersonalData {
	public static $tablename = "personal";
	
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
		 //id	cedula	nombreCompleto genero	telefono	correo	idParroquia	direccion	estatus	(tabla personal)
//id	idPersonal	idCategoria 	idGrado	idCargo	idUnidad	gradoLicencia	certificado	estatus	 (tabla contrato)

		$sql = "insert into ".self::$tablename." (id,cedula,nombreCompleto,genero,telefono,correo,idParroquia,idCargo,direccion,estatus) ";
		$sql .= "value (NULL,\"$this->cedula\",\"$this->nombreCompleto\",$this->genero,\"$this->telefono\",\"$this->correo\",$this->idParroquia,$this->idCargo,\"$this->direccion\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set nombreCompleto=\"$this->nombreCompleto\",genero=$this->genero,fechaNacimiento=\"$this->fechaNacimiento\",
		telefono=\"$this->telefono\",correo=\"$this->correo\",idParroquia=$this->idParroquia,direccion=\"$this->direccion\"  where id=$this->id";
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
		//$sql = "SELECT p.id,p.cedula,p.nombreCompleto  FROM ".self::$tablename." p WHERE p.id NOT IN (SELECT c.idPersonal from contrato c)	
		// BY p.id ASC";	
		//echo $sql;
		$sql = "SELECT p.id,p.cedula,p.nombreCompleto,p.genero,p.telefono,p.correo,cg.cargo  FROM ".self::$tablename." p 
		INNER JOIN cargo cg ON p.idCargo = cg.id
		WHERE p.estatus=1 ORDER BY p.id ASC";

		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PersonalData(); 
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->cedula = $r['cedula'];
			$array[$cnt]->nombreCompleto = $r['nombreCompleto'];
			$array[$cnt]->genero = $r['genero'];
			$array[$cnt]->telefono = $r['telefono'];
			$array[$cnt]->correo = $r['correo'];
			$array[$cnt]->cargo = $r['cargo'];			
		$cnt++;
		}
		return $array;
	}

	public static function getAllPersonalCargos(){
		$sql = "SELECT p.id,p.cedula,p.nombreCompleto,cg.cargo  FROM ".self::$tablename." p 
		
		INNER JOIN cargo cg ON p.idCargo = cg.id	
		ORDER BY p.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PersonalData();    
			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->cedula = $r['cedula'];
			$array[$cnt]->nombreCompleto = $r['cargo'].' - '.$r['nombreCompleto'];
		
		$cnt++;
		}
		return $array;
	}


	public static function getById($id){
		$sql = "SELECT 
		p.id,p.cedula,p.nombreCompleto,p.genero,p.fechaNacimiento,p.telefono,p.correo,e.estado,m.municipio,
		pr.parroquia,p.direccion,p.estatus,cg.cargo
	 	FROM ".self::$tablename." p
		INNER JOIN cargo cg ON p.idCargo = cg.id
		INNER JOIN parroquias pr ON p.idParroquia = pr.id_parroquia
		INNER JOIN municipios m ON pr.id_municipio = m.id_municipio
		INNER JOIN estados e ON m.id_estado = e.id_estado		
		WHERE p.id='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){			
			$array[$cnt] = new PersonalData();  
	
			
			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->cedula = $r['cedula'];
			$array[$cnt]->nombreCompleto = $r['nombreCompleto'];	
			$array[$cnt]->genero = $r['genero'];	
			$array[$cnt]->fechaNacimiento = $r['fechaNacimiento'];	
			$array[$cnt]->telefono = $r['telefono'];	
			$array[$cnt]->correo = $r['correo'];	
			$array[$cnt]->estado = $r['estado'];	
			$array[$cnt]->municipio = $r['municipio'];	
			$array[$cnt]->parroquia = $r['parroquia'];	
			$array[$cnt]->direccion = $r['direccion'];	
			$array[$cnt]->cargo = $r['cargo'];
			$array[$cnt]->estatus = $r['estatus'];		
		$cnt++;
		}
		return $array;
	}

	public static function getByIdInner($id){
		$sql = "SELECT u.id,u.unidad,u.idBrigada,b.brigada,b.idZodi,z.zodi,z.idRedi,r.redi,u.estatus  FROM ".self::$tablename." u 
		INNER JOIN brigada b ON u.idBrigada = b.id 
		INNER JOIN zodi z ON b.idZodi = z.id 
		INNER JOIN redi r ON z.idRedi = r.id WHERE u.id='$id'";
		//echo $sql;
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
		$sql = "SELECT b.id,b.idZodi,b.brigada,z.zodi,z.estatus  FROM ".self::$tablename." b INNER JOIN zodi z ON b.idZodi = z.id  WHERE $campo='$valor'  ORDER BY b.id ASC";
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
		
			$array[$cnt] = new BrigadaData();  
			$array[$cnt]->responsive_id = "";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idRedi = $r['idRedi'];
			$array[$cnt]->redi = $r['redi'];	
			$array[$cnt]->zodi = $r['zodi'];	
			$array[$cnt]->estatus = $r['estatus'];	
				
		$cnt++;
		}
		return $array;
	}

	public static function estadisticas(){
	
		$sql = "SELECT count(id) as numeros FROM personal WHERE estatus = 1	ORDER BY id ASC";	
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