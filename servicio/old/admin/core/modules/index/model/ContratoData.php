<?php
class ContratoData {
	public static $tablename = "contrato";
	
	public function __construct(){
		$this->id = 0;
		$this->idPersonal = 0;	
		$this->idCategoria = '';	
		$this->idGrado = '';	
		$this->idCargo = '';	
		$this->idDependencia = '';	
		$this->gradoLicencia = '';	
		$this->certificado = '';	
		$this->estatus = 0;	


	}	
	public function add(){
		
//id	idPersonal	idCategoria 	idGrado	idCargo	idDependencia	gradoLicencia	certificado	estatus	 (tabla contrato)

		$sql = "insert into ".self::$tablename." (id,idPersonal,idCategoria,idGrado,idCargo,idDependencia,gradoLicencia,certificado,estatus) ";
		$sql .= "value (NULL,$this->idPersonal,$this->idCategoria,$this->idGrado,$this->idCargo,$this->idDependencia,$this->gradoLicencia,$this->certificado,1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}
	public function edit(){
		
		$sql = "update ".self::$tablename." set idCategoria=$this->idCategoria,idGrado=$this->idGrado,
		idCargo=$this->idCargo,idDependencia=$this->idDependencia,gradoLicencia=$this->gradoLicencia,
		certificado=$this->certificado  where idPersonal=$this->idPersonal";
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
		$sql = "SELECT *  FROM ".self::$tablename." p  ORDER BY p.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new PersonalData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			
		$cnt++;
		}
		return $array;
	}

	public static function getDataContrato($idPersonal){
		$sql = "SELECT *  FROM ".self::$tablename." c WHERE idPersonal='$idPersonal'  ORDER BY c.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ContratoData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			
		$cnt++;
		}
		return $array;
	}





	

	public static function getByIdInner($id){

		
		$sql = "SELECT c.id,c.idPersonal,c.idCategoria,c.idGrado,g.grado,g.idComponente,cp.componente,c.idCargo,cg.cargo,c.idDependencia,u.unidad,u.idBrigada,b.brigada,b.idZodi,z.zodi,z.idRedi,r.redi,c.gradoLicencia,c.certificado,c.estatus  FROM ".self::$tablename." c 
		INNER JOIN grado g ON c.idGrado = g.id
		INNER JOIN componente cp ON g.idComponente = cp.id
		INNER JOIN cargo cg ON c.idCargo = cg.id
		INNER JOIN unidad u ON c.idDependencia = u.id 
		INNER JOIN brigada b ON u.idBrigada = b.id 
		INNER JOIN zodi z ON b.idZodi = z.id 
		INNER JOIN redi r ON z.idRedi = r.id WHERE c.idPersonal='$id'";
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			
			$array[$cnt] = new ContratoData();    
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->idPersonal = $r['idPersonal'];
			
			$array[$cnt]->idCategoria = $r['idCategoria'];

			
			switch ($r['idCategoria']) {
				case 1:
					$categoria="EFECTIVOS (OFICIALES DE COMANDO)";
					break;
				case 2:
					$categoria="EFECTIVOS (OFICIALES TÉCNICOS)";
					break;
				case 3:
					$categoria="EFECTIVOS (OFICIALES DE TROPA)";
					break;
				case 4:
					$categoria="ASIMILADOS (ASIMILIADO TÉCNICO)";
					break;
				case 5:
					$categoria="ASIMILADOS (ASIMILADO)";
					break;
				case 6:
					$categoria="TROPA PROFESIONAL";
					break;
				case 7:
					$categoria="TROPA ALISTADA";
					break;
				case 8:
					$categoria="ASPIRANTE";
					break;
				case 99:
					$categoria="CIVIL";
					break;
			}
			$array[$cnt]->categoria =$categoria;

			$array[$cnt]->idGrado = $r['idGrado'];
			$array[$cnt]->grado = $r['grado'];
			$array[$cnt]->idComponente = $r['idComponente'];
			$array[$cnt]->componente = $r['componente'];

			$array[$cnt]->idCargo = $r['idCargo'];
			$array[$cnt]->cargo = $r['cargo'];

			$array[$cnt]->idDependencia = $r['idDependencia'];
			$array[$cnt]->unidad = $r['unidad'];

			$array[$cnt]->idBrigada = $r['idBrigada'];
			$array[$cnt]->brigada = $r['brigada'];

			$array[$cnt]->idZodi= $r['idZodi'];
			$array[$cnt]->zodi = $r['zodi'];

			$array[$cnt]->idRedi= $r['idRedi'];
			$array[$cnt]->redi = $r['redi'];


			$array[$cnt]->gradoLicencia = $r['gradoLicencia'];	
	
			$array[$cnt]->certificado = $r['certificado'];
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

	
}
?>