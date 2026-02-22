<?php
class ItemData {
	public static $tablename = "item";
	public $responsive_id;
	public $id;
	public $placa;
	public $idModelo;
	public $ano;
	public $color;
	public $serialChasis;
	public $serialMotor;
	public $media;
	public $tipo;
	public $marca;
	public $modelo;

	public $condicion; // 1 activo, 2 inactivo
	public $estatus; // 1 activo, 0 inactivo
	public $idCliente;
	/******************* */
	public $dato1;
	public $dato2;
	public $dato3;
	public $dato4;
	public $dato5;
	public $dato6;

	/**************** */
	// para ordenes de trabajo

	public $idOrden;
	public $idItem;
	public $descripcion;
	public $fechaIngreso;
	public $fechaSalida;
	public $idPersonal;
	public $codigo; // codigo de la orden de trabajo
	public $idUbicacion; // id de la ubicacion del vehiculo
	public $numeros; // numeros de ordenes de trabajo

	
	
	public function __construct(){
		$this->id = 0;
		$this->placa = 0;	
		$this->idModelo = '';	
		$this->ano = '';	
		$this->color = '';	
			$this->tipo = '';	
	$this->media = '';	
		$this->marca = '';	
		$this->modelo = '';

		$this->serialChasis = '';	
		$this->serialMotor = '';	
		$this->condicion = '';			
		$this->estatus = 0;	
		$this->idCliente = 0;

		$this->idOrden = 0;
		$this->idItem = 0;
		$this->descripcion = 0;
		$this->fechaIngreso = 0;
		$this->fechaSalida = 0;
		$this->idPersonal = 0;
		$this->codigo = 0;
		$this->idUbicacion = 0; 
		$this->numeros = 0;


		$this->dato1 = 0;
		$this->dato2 = 0;
		$this->dato3 = 0; 
		$this->dato4 = 0;
		$this->dato5 = 0; 
		$this->dato6 = 0;
	}	


	public function addIngreso(){
	//id	codigo	idItem	idPersonal	idUbicacion	fechaIngreso	fechaSalida	descripcion	condicion	estatus	
		
		$sql = "insert into ordentrabajo (id,codigo,idItem,idPersonal,idUbicacion,fechaIngreso,fechaSalida,descripcion,condicion,estatus) ";
		$sql .= "value (NULL,\"$this->codigo\",$this->idItem,$this->idPersonal,$this->idUbicacion,
		\"$this->fechaIngreso\",\"$this->fechaSalida\",\"$this->descripcion\",1,1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}

		public function addIngresoDetalles(){
		//ordentrabajodetalles  id	codigoOrden	nombre	serial	estatus	condicion	
		
		$sql = "insert into ordentrabajodetalles (id,codigoOrden,nombre,serial,estatus,condicion) ";
		$sql .= "value (NULL,\"$this->codigoOrden\",\"$this->nombre\",\"$this->serial\",1,1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}

	public function add(){
		

		$sql = "insert into ".self::$tablename." (id,placa,idModelo,ano,color,serialChasis,serialMotor,condicion,estatus,idcliente) ";
		$sql .= "value (NULL,\"$this->placa\",$this->idModelo,\"$this->ano\",\"$this->color\",\"$this->serialChasis\",\"$this->serialMotor\",$this->condicion,1,$this->idCliente)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}

	public function edit(){
		
		$sql = "update ".self::$tablename." set placa=\"$this->placa\",idModelo=$this->idModelo,ano=\"$this->ano\",
		color=\"$this->color\",serialChasis=\"$this->serialChasis\",serialMotor=\"$this->serialMotor\",condicion=$this->condicion where id=$this->id";
		//echo $sql;
		Executor::doit($sql);
	}


	public function addAsignacion(){
	
		
		
		$sql = "insert into asignacion (id,idObjeto,tipoCustodio,idCustodio,fechaAsignacion,fechaDevolucion,observacion,estatus) ";
		$sql .= "value (NULL,\"$this->idObjeto\",2,\"$this->idCustodio\",\"$this->fechaAsignacion\",' ',\"$this->observacion\",1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}


	public function cerrarOrdenTrabajo(){		
		$sql = "insert into mantenimiento (id,idOrden,fechaMantenimiento,tiempoEmpleado,tipoMantenimiento,procedimiento,fechaProximoMantenimiento,recomendacion,estatus) ";
		$sql .= "value (NULL,$this->idOrden,\"$this->dato6\",\"$this->dato2\",$this->dato1,\"$this->dato3\",\"$this->dato4\",\"$this->dato5\",1)";
		//echo $sql;
		Executor::doit($sql);		
		//echo "guarde";
	}
	public function editCondicionOrden($condicion,$estatus){
		$sql = "update ordentrabajo set condicion=$condicion, estatus=$estatus where id=$this->idOrden";
		Executor::doit($sql);
	}


	public function editCondicion($condicion){
		$sql = "update ".self::$tablename." set  condicion=$condicion where placa='$this->placa'";
		Executor::doit($sql);
	}

		public function asignarPersonalUbicacion(){
		$sql = "update ordentrabajo set condicion=3, idPersonal=$this->idPersonal,idUbicacion=$this->idUbicacion  where id=$this->idOrden";
		Executor::doit($sql);
	}

		
	public function delOrdenTrabajo(){
		$sql = "DELETE FROM  ordentrabajo where id='$this->idOrden'";
		Executor::doit($sql);
	}

	public function delOrdenTrabajoDetalles($codigo){
		$sql = "DELETE FROM  ordentrabajodetalles where codigoOrden='$codigo'";
		Executor::doit($sql);
	}
	
	public function delOrdenTrabajoMedia($codigo){
		$sql = "DELETE FROM  media where codigo='$codigo'";
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


	public function cambiarClienteItem(){
		$sql = "update ".self::$tablename." set idCliente=$this->idCliente where id=$this->id";
		Executor::doit($sql);
	}


	public function cerrarOrden(){
		$sql = "update ordenes set fechaEntrada=DATE(NOW()), estatus=2 where id=$this->idOrden";
		Executor::doit($sql);
	}

	public function liberar(){
		
		$sql = "update asignacion set fechaDevolucion=DATE(NOW()), estatus=2 where idObjeto=$this->idObjeto and id=$this->id ";
		//echo $sql;
		Executor::doit($sql);
	}

	public function cerrarMantenimiento(){
		$sql = "update mantenimiento set estatus=2 where id=$this->idMantenimiento";
		Executor::doit($sql);
	}

	
	public static function getAll(){
		/*$sql = "SELECT *  FROM ".self::$tablename." p WHERE p.id NOT IN (SELECT c.idPersonal from contrato c)	
		ORDER BY p.id ASC";	*/
		$sql = "SELECT *  FROM ".self::$tablename." v ORDER BY v.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ItemData();    
			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->placa = $r['placa'];
			$array[$cnt]->placa = $r['placa'];
			
		$cnt++;
		}
		return $array;
	}

	public static function getAllTable(){
		$sql = "SELECT v.id,v.placa,m.modelo,mr.marca,v.condicion,v.estatus,cl.cedula,cl.nombreCompleto,v.idCliente,t.tipo FROM ".self::$tablename." v
		INNER JOIN modelo m ON v.idModelo = m.id
		INNER JOIN cliente cl ON v.idCliente = cl.id
		INNER JOIN marca mr ON m.idMarca = mr.id	
		INNER JOIN tipo t ON mr.idTipo = t.id	
		ORDER BY v.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 
		

			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->placa = $r['placa'];
			$array[$cnt]->modelo = $r['modelo'];
			$array[$cnt]->marca =$r['marca'];
			$array[$cnt]->tipo =$r['tipo'];
			$array[$cnt]->estatus = $r['estatus'];

			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->cliente = $r['cedula'].'-'.$r['nombreCompleto'];
			$array[$cnt]->idCliente = $r['idCliente'];
		
			
		$cnt++;
		}
		return $array;
	}


	public static function getDataById($id){
		$sql = "SELECT v.id,v.placa,v.idModelo,m.idMarca,mr.idTipo,m.modelo,mr.marca,v.condicion,v.estatus,md.media,v.ano,v.color,t.tipo,v.serialMotor,v.serialChasis FROM ".self::$tablename." v
		INNER JOIN modelo m ON v.idModelo = m.id
		INNER JOIN marca mr ON m.idMarca = mr.id
		INNER JOIN tipo t ON mr.idTipo = t.id
		INNER JOIN media md ON v.placa = md.codigo
		WHERE v.id = $id
		ORDER BY v.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 

			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->placa = $r['placa'];

			$array[$cnt]->tipo = $r['tipo'];
		
			
			$array[$cnt]->idModelo = $r['idModelo'];
			$array[$cnt]->tipo = $r['tipo'];

			$array[$cnt]->modelo = $r['modelo'];
		
			$array[$cnt]->marca =$r['marca'];

			$array[$cnt]->serialChasis =$r['serialChasis'];

			$array[$cnt]->serialMotor =$r['serialMotor'];
			
			$array[$cnt]->estatus = $r['estatus'];
			$array[$cnt]->media = $r['media'];
			$array[$cnt]->ano = $r['ano'];
			$array[$cnt]->color = $r['color'];
		
			$array[$cnt]->condicion = $r['condicion'];

	

		$cnt++;
		}
		return $array;
	}

	public static function getDataByIdAsignaciones($id){
		$sql = "select a.id as idAsignacion,dependencia,unidad,brigada,zodi,redi,fechaAsignacion,fechaDevolucion,v.placa,a.estatus from asignacion a 
		INNER JOIN dependencia d ON a.idCustodio = d.id	
		INNER JOIN unidad u ON d.idUnidad = u.id	
		INNER JOIN brigada b ON u.idBrigada= b.id	
		INNER JOIN zodi z ON b.idZodi= z.id	
		INNER JOIN redi r ON z.idRedi= r.id	
		INNER JOIN vehiculo v ON a.idObjeto = v.id
		where  a.idObjeto=$id";		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 

		
			$array[$cnt]->responsive_id = "";	
			
			$array[$cnt]->placa =$r['placa'];
			$array[$cnt]->redi =$r['redi'];
			$array[$cnt]->zodi = $r['zodi'];
			$array[$cnt]->brigada =$r['brigada'];
			$array[$cnt]->unidad =$r['unidad'];
			$array[$cnt]->dependencia =$r['dependencia'];
			$array[$cnt]->fechaAsignacion =$r['fechaAsignacion'];
			$array[$cnt]->fechaDevolucion =$r['fechaDevolucion'];
			$array[$cnt]->idAsignacion =$r['idAsignacion'];
			$array[$cnt]->estatus =$r['estatus'];
		$cnt++;
		}
		return $array;
	}

	public static function getDataByIdOrdenesTrabajo($filtro){
		if($filtro==0){
		$sql="SELECT
		ot.codigo,
		ot.fechaIngreso,
		ot.fechaSalida,
		ot.condicion,
		ot.idItem,
		p.nombreCompleto as personal,
		p.cedula as cedulaPersonal,
		u.ubicacion,
		i.placa,
		c.cedula,
		c.nombreCompleto, 
		ot.descripcion,
		ot.estatus,  
			ot.id
		FROM
			ordentrabajo ot

		INNER JOIN item i ON
			ot.idItem = i.id
		LEFT  JOIN personal p ON 
			ot.idPersonal = p.id
		LEFT  JOIN ubicacion u ON
			ot.idUbicacion = u.id
		INNER JOIN cliente c ON
			i.idCliente = c.id
		WHERE ot.condicion = 1 AND ot.estatus = 1";
		
				}else{
			$sql="SELECT
			ot.codigo,
			ot.fechaIngreso,
			ot.fechaSalida,
			ot.condicion,
			ot.idItem,
			p.nombreCompleto as personal,
			p.cedula as cedulaPersonal,
			u.ubicacion,
			i.placa,
			c.cedula,
			c.nombreCompleto, 
			ot.descripcion,
			ot.estatus,  
			ot.id
		FROM
			ordentrabajo ot

		INNER JOIN item i ON
			ot.idItem = i.id
		LEFT  JOIN personal p ON 
			ot.idPersonal = p.id
		LEFT  JOIN ubicacion u ON
			ot.idUbicacion = u.id
		INNER JOIN cliente c ON
			i.idCliente = c.id
		WHERE
			ot.condicion =  $filtro";

				}
			


		

		//id	codigo	idItem	idPersonal	idUbicacion	fechaIngreso	fechaSalida	descripcion	condicion	estatus	
		/**/


		//echo $sql;
		$query = Executor::doit($sql);	
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 
			
			$personal=$r['personal'];
			$ubicacion =$r['ubicacion'];
			if($personal == null){
				$personal = "0";
			}
			if($ubicacion == null){
				$ubicacion = "0";
			}


			$array[$cnt]->responsive_id = "";	
			$array[$cnt]->id =$r['id'];
			$array[$cnt]->codigo =$r['codigo'];
			$array[$cnt]->fechaIngreso =$r['fechaIngreso'];
			$array[$cnt]->placa = $r['placa'];
			$array[$cnt]->cedula =$r['cedula'];
			$array[$cnt]->nombreCompleto =$r['nombreCompleto'];
			$array[$cnt]->ubicacion =$ubicacion;
			$array[$cnt]->personal =$personal;	
			$array[$cnt]->estatus =$r['estatus'];
			
		$cnt++;
		}
		return $array;
	}

	

	public static function getDataByIdOrdenes($id,$estatus){
		


		// si el id viene con 0, debemos buscar todas las ordenes en de todos los vehiculos , que esten activas... 
		if(($id==0) and ($estatus ==0) ){
				$sql = "select o.id,o.idItem,o.codigo,o.estatus,o.idPersonal,o.fechaSalida,o.fechaIngreso,o.idUbicacion,o.condicion
		from ordentrabajo o	
		INNER JOIN item i ON o.idItem  = i.id";
		}
		if(($id!=0) and ($estatus!=0) ){
		$sql = "select o.id,o.idItem,o.codigo,o.estatus,o.idPersonal,o.fechaSalida,o.fechaIngreso,o.idUbicacion,o.condicion
		from ordentrabajo o	
		INNER JOIN item i ON o.idItem  = i.id	
		where  o.idItem=$id and o.estatus=$estatus";
		}
		if(($id!=0) and ($estatus==0) ){
		$sql = "select o.id,o.idItem,o.codigo,o.estatus,o.idPersonal,o.fechaSalida,o.fechaIngreso,o.idUbicacion,o.condicion
		from ordentrabajo o	
		INNER JOIN item i ON o.idItem  = i.id		
		where  o.idItem=$id";
			}		

		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 	
			
			$array[$cnt]->responsive_id = "";	
			$array[$cnt]->idOrden =$r['id'];
			$array[$cnt]->idItem =$r['idItem'];
			$array[$cnt]->codigo =$r['codigo'];
			$array[$cnt]->idPersonal =$r['idPersonal'];
		
			$array[$cnt]->idUbicacion =$r['idUbicacion'];
			$array[$cnt]->fechaSalida =$r['fechaSalida'];
			$array[$cnt]->fechaIngreso =$r['fechaIngreso'];
			$array[$cnt]->condicion =$r['condicion'];
			
			$array[$cnt]->estatus =$r['estatus'];

			

		$cnt++;
		}
		return $array;
	}

	
	public static function getDataByIdOrden($id){
		// si el id viene con 0, debemos buscar todas las ordenes en de todos los vehiculos , que esten activas... 
		

		$sql = "select o.id,o.idVehiculo,v.placa,o.estatus,g1.grado as g1,p1.nombreCompleto as n1,p1.cedula as c1,g2.grado as g2,p2.nombreCompleto as n2,p2.cedula as c2,
		o.asunto,o.fechaSalida,o.fechaEntrada,o.ruta,
		o.1,o.2,o.3,o.4,o.5,o.6,o.7,o.8,o.9,o.10,o.11,o.12,o.13,o.14,o.15,o.16,o.17,o.18,o.19,o.20,t.tipo,mr.marca,m.modelo,
		v.color
		from ordenes o
		INNER JOIN personal p1 ON o.idPersonal = p1.id
		INNER JOIN contrato c1 ON p1.id = c1.idPersonal
		INNER JOIN grado g1 ON c1.idGrado = g1.id
		

		INNER JOIN personal p2 ON o.idPersonalAcargo = p2.id

		INNER JOIN contrato c2 ON p2.id = c2.idPersonal
		INNER JOIN grado g2 ON c2.idGrado = g2.id

		INNER JOIN vehiculo v ON o.idVehiculo = v.id
		INNER JOIN modelo m ON v.idModelo = m.id
		INNER JOIN marca mr ON m.idMarca = mr.id
		INNER JOIN tipo t ON mr.idTipo = t.id
		where  o.id=$id";
		
		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 	
			
	
			$array[$cnt]->idOrden =$r['id'];
			$array[$cnt]->placa =$r['placa'];
			$array[$cnt]->idVehiculo =$r['idVehiculo'];
			$array[$cnt]->nombreCompletoChofer =$r['n1'];
			$array[$cnt]->c1 =$r['c1'];
			$array[$cnt]->g1 =$r['g1'];
			$array[$cnt]->nombreCompletoACargo = $r['n2'];
			$array[$cnt]->c2 =$r['c2'];
			$array[$cnt]->g2 =$r['g2'];
			$array[$cnt]->asunto =$r['asunto'];
			$array[$cnt]->fechaSalida =$r['fechaSalida'];
			$array[$cnt]->fechaEntrada =$r['fechaEntrada'];
			$array[$cnt]->ruta =$r['ruta'];		
			$array[$cnt]->tipo =$r['tipo'];		$array[$cnt]->marca =$r['marca'];	$array[$cnt]->modelo =$r['modelo'];			
			$array[$cnt]->color =$r['color'];			
			$array[$cnt]->r1 =$r['1'];		$array[$cnt]->r2 =$r['2'];		$array[$cnt]->r3 =$r['3'];		$array[$cnt]->r4 =$r['4'];
			$array[$cnt]->r5 =$r['5'];		$array[$cnt]->r6 =$r['6'];		$array[$cnt]->r7 =$r['7'];		$array[$cnt]->r8 =$r['8'];
			$array[$cnt]->r9 =$r['9'];		$array[$cnt]->r10 =$r['10'];	$array[$cnt]->r11 =$r['11'];	$array[$cnt]->r12 =$r['12'];
			$array[$cnt]->r13 =$r['13'];	$array[$cnt]->r14 =$r['14'];	$array[$cnt]->r15 =$r['15'];	$array[$cnt]->r16 =$r['16'];
			$array[$cnt]->r17 =$r['17'];	$array[$cnt]->r18 =$r['18'];	$array[$cnt]->r19 =$r['19'];	$array[$cnt]->r20 =$r['20'];

		$cnt++;
		}
		return $array;
	}


		
	public static function getAllOperativos(){
		
		// SOLO VEHICULOS Q NO ESTEN EN MANTENIMIENTO Y ESTEN DISPONIBLES
		$sql = "SELECT v.id,v.placa,m.modelo,mr.marca  FROM ".self::$tablename." v  
		INNER JOIN modelo m ON v.idModelo = m.id
		INNER JOIN marca mr ON m.idMarca = mr.id		
		WHERE v.id NOT IN ( select m.idVehiculo from mantenimiento m where m.estatus = 1) and v.estatus =1 and v.condicion =1 ORDER BY v.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ItemData();    
			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->placa = $r['placa'];
			$array[$cnt]->modelo = $r['modelo'];
			$array[$cnt]->marca = $r['marca'];
			
		$cnt++;
		}
		return $array;
	}

	public static function getUltimaOrden(){
		
		// SOLO VEHICULOS Q NO ESTEN EN MANTENIMIENTO Y ESTEN DISPONIBLES
		$sql = "SELECT count(id)+1 as ultimaOrden from ordentrabajo";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ItemData();    
			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->ultimaOrden = $r['ultimaOrden'];
			
			
		$cnt++;
		}
		return $array;
	}

	
	public static function estadisticas(){
	
		$sql = "SELECT count(id) as numeros FROM item WHERE estatus = 1	ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){

			$array[$cnt] = new ItemData();    
		
			$array[$cnt]->numeros = $r['numeros'];

		$cnt++;
		}
		return $array;
	}

	public static function estadisticasOrdenes($filtro){
	
		$sql = "SELECT count(id)  numeros  FROM ordentrabajo WHERE condicion = $filtro	ORDER BY id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){

			$array[$cnt] = new ItemData();    
		
			$array[$cnt]->numeros = $r['numeros'];

		$cnt++;
		}
		return $array;
	}

	public static function getDataMantenimientos($filtro){
		$sql = "select m.id,v.id as idVehiculo,v.placa,p.nombreCompleto,m.fechaMantenimiento,m.tiempoEstimado,m.tipoMantenimiento,m.observacion,m.fechaProximoMantenimiento,m.estatus from mantenimiento m
		INNER JOIN personal p ON m.idPersonal = p.id
		INNER JOIN vehiculo v ON m.idVehiculo = v.id
		where  m.estatus=1";		
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$sql=
			$array[$cnt] = new ItemData(); 

		
			$array[$cnt]->responsive_id = "";	
			$array[$cnt]->id =$r['id'];
			$array[$cnt]->placa =$r['placa'];
			$array[$cnt]->nombreCompleto =$r['nombreCompleto'];
			$array[$cnt]->fechaMantenimiento = $r['fechaMantenimiento'];

			$array[$cnt]->tiempoEstimado =$r['tiempoEstimado'];
			$array[$cnt]->tipoMantenimiento =$r['tipoMantenimiento'];
			$array[$cnt]->observacion =$r['observacion'];
	
			$array[$cnt]->fechaProximoMantenimiento =$r['fechaProximoMantenimiento'];
			$array[$cnt]->estatus =$r['estatus'];
			$array[$cnt]->idVehiculo =$r['idVehiculo'];
		$cnt++;
		}
		return $array;
	}

	
	public static function getById($id){
		$sql = "SELECT t.id,t.placa,t.serialChasis,t.serialMotor,t.condicion,t.estatus,ma.marca,m.modelo  FROM ".self::$tablename." t
		INNER JOIN modelo m ON  t.idModelo = m.id
		INNER JOIN marca ma ON m.idMarca = ma.id
		INNER JOIN tipo tp ON ma.idTipo = tp.id
		  WHERE t.idCliente=$id and tp.condicion =2 ORDER BY t.id ASC";	
		 //echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			$array[$cnt] = new ItemData();    
			$array[$cnt]->responsive_id = "0";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->codigo = $r['placa'];	
			$array[$cnt]->serial = $r['serialChasis'];	
			$array[$cnt]->descripcion = $r['serialMotor'];	
			$array[$cnt]->condicion = $r['condicion'];		
			$array[$cnt]->marca = $r['marca'];		
			$array[$cnt]->modelo = $r['modelo'];					
			$array[$cnt]->estatus = $r['estatus'];	

		$cnt++;
		}
		return $array;
	}


	public static function getByCampo($campo,$valor){
		
	
		
		$sql = "SELECT t.id,t.placa,t.serialChasis,t.serialMotor,t.condicion,t.estatus,ma.marca,m.modelo,tp.tipo  FROM ".self::$tablename." t
		INNER JOIN modelo m ON  t.idModelo = m.id
		INNER JOIN marca ma ON m.idMarca = ma.id
		INNER JOIN tipo tp ON ma.idTipo = tp.id
		  WHERE $campo=$valor and tp.condicion =2 ORDER BY t.id ASC";	
		 //echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			$array[$cnt] = new ItemData();    
			$array[$cnt]->responsive_id = "0";  
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->codigo = $r['placa'];	
			$array[$cnt]->serial = $r['serialChasis'];	
			$array[$cnt]->descripcion = $r['serialMotor'];	
			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->tipo = $r['tipo'];			
			$array[$cnt]->marca = $r['marca'];		
			$array[$cnt]->modelo = $r['modelo'];					
			$array[$cnt]->estatus = $r['estatus'];	

		$cnt++;
		}
		return $array;
	}


	
	public static function getDataByIdOrdenTrabajo($id){
		$sql = "SELECT t.id as idItem ,t.placa,t.serialChasis,t.serialMotor,t.condicion,t.estatus,ma.marca,m.modelo,tp.tipo,
		ot.id as idOrden,ot.codigo,ot.idPersonal,ot.idUbicacion,ot.fechaIngreso,ot.fechaSalida,ot.descripcion,ot.condicion,ot.estatus,
		cl.cedula,cl.nombreCompleto,cl.telefono,cl.correo 
		 FROM ".self::$tablename." t
		INNER JOIN modelo m ON  t.idModelo = m.id
		INNER JOIN marca ma ON m.idMarca = ma.id
		INNER JOIN tipo tp ON ma.idTipo = tp.id
		INNER JOIN ordentrabajo ot ON t.id = ot.idItem
		INNER JOIN cliente cl ON t.idCliente = cl.id
		WHERE  tp.condicion =2  and ot.id = $id ORDER BY t.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			$array[$cnt] = new ItemData(); 
			 $personal = $r['idPersonal'];			
			 $ubicacion= $r['idUbicacion'];
			 if(($personal==0) || ($ubicacion==0)){

				$datoPersonal ="No asignado";
				$datoUbicacion="No asignada";

			 }else{
				
				$objeto_Personal = new PersonalData();
				$personal = $objeto_Personal->getById($r['idPersonal']);
				$objeto_Ubicacion = new UbicacionData();
				$ubicacion = $objeto_Ubicacion->getById($r['idUbicacion']);
				$datoPersonal=$personal[0]->cedula.'-'.$personal[0]->nombreCompleto.'-'.$personal[0]->cargo;
				$datoUbicacion=$ubicacion[0]->ubicacion.'-'.$ubicacion[0]->descripcion;

			 }
			// PARA ITEM
			$array[$cnt]->responsive_id = "0";  
			$array[$cnt]->idItem = $r['idItem'];	
			$array[$cnt]->placa = $r['placa'];				
			$array[$cnt]->marca = $r['marca'];		
			$array[$cnt]->modelo = $r['modelo'];					
			$array[$cnt]->estatus = $r['estatus'];	
			$array[$cnt]->tipo = $r['tipo'];		


			// PARA CLIENTE
			$array[$cnt]->dato1 = $r['cedula'];	
			$array[$cnt]->dato2 = $r['nombreCompleto'];		
			$array[$cnt]->dato3 = $r['telefono'];		
			$array[$cnt]->dato4 = $r['correo'];					


			// PARA LA ORDEN
			$array[$cnt]->idOrden = $r['idOrden'];
			$array[$cnt]->codigo = $r['codigo'];
			$array[$cnt]->dato5 =  $datoPersonal;	 
			$array[$cnt]->dato6 =$datoUbicacion;		
			$array[$cnt]->idPersonal =	$r['idPersonal'];				
			$array[$cnt]->idUbicacion =  $r['idUbicacion'];		
			$array[$cnt]->fechaIngreso = $r['fechaIngreso'];					
			$array[$cnt]->fechaSalida = $r['fechaSalida'];	
			$array[$cnt]->descripcion = $r['descripcion'];	
			$array[$cnt]->condicion = $r['condicion'];	

  			$array[$cnt]->detalles = self::getOrdenTrabajoDetalles($r['codigo']);

		
		

		$cnt++;
		}
		return $array;
	}

		
	public static function getOrdenTrabajoDetalles($codigo){
		$sql = "SELECT nombre,serial,estatus  FROM ordentrabajodetalles ot	 WHERE codigoOrden='$codigo' and estatus=1 ORDER BY id ASC";	
		 //echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			$array[$cnt] = new ItemData();    		
			$array[$cnt]->nombre = $r['nombre'];
			$array[$cnt]->serial = $r['serial'];					
			$array[$cnt]->estatus = $r['estatus'];	

		$cnt++;
		}
		return $array;
	}


	public static function getDataByIdUbicacion($id){
		$sql = "SELECT t.id as idItem ,t.placa,t.serialChasis,t.serialMotor,t.condicion,t.estatus,ma.marca,m.modelo,tp.tipo,
		ot.id as idOrden,ot.codigo,ot.idPersonal,ot.idUbicacion,ot.fechaIngreso,ot.fechaSalida,ot.descripcion,ot.condicion,ot.estatus,
		cl.cedula,cl.nombreCompleto,cl.telefono,cl.correo,md.media 
		 FROM ".self::$tablename." t
		INNER JOIN modelo m ON  t.idModelo = m.id
		INNER JOIN marca ma ON m.idMarca = ma.id
		INNER JOIN tipo tp ON ma.idTipo = tp.id
		INNER JOIN ordentrabajo ot ON t.id = ot.idItem
		INNER JOIN cliente cl ON t.idCliente = cl.id
		INNER JOIN media md ON t.placa = md.codigo
		WHERE  tp.condicion =2 and ot.condicion = 3  and ot.idUbicacion = $id ORDER BY t.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){		
			$array[$cnt] = new ItemData();		


			 $personal = $r['idPersonal'];			
			 $ubicacion= $r['idUbicacion'];
			 if(($personal==0) || ($ubicacion==0)){

				$datoPersonal ="No asignado";
				$datoUbicacion="No asignada";

			 }else{
				
				$objeto_Personal = new PersonalData();
				$personal = $objeto_Personal->getById($r['idPersonal']);
				$objeto_Ubicacion = new UbicacionData();
				$ubicacion = $objeto_Ubicacion->getById($r['idUbicacion']);
				$datoPersonal=$personal[0]->cedula.'-'.$personal[0]->nombreCompleto.'-'.$personal[0]->cargo;
				$datoUbicacion=$ubicacion[0]->ubicacion.'-'.$ubicacion[0]->descripcion;
				

			 }
			// PARA ITEM
			$array[$cnt]->responsive_id = "0";  
			$array[$cnt]->idItem = $r['idItem'];	
			$array[$cnt]->placa = $r['placa'];				
			$array[$cnt]->marca = $r['marca'];		
			$array[$cnt]->modelo = $r['modelo'];					
			$array[$cnt]->estatus = $r['estatus'];	
			$array[$cnt]->tipo = $r['tipo'];
			$array[$cnt]->media = $r['media'];			


			// PARA CLIENTE
			$array[$cnt]->dato1 = $r['cedula'];	
			$array[$cnt]->dato2 = $r['nombreCompleto'];		
			$array[$cnt]->dato3 = $r['telefono'];		
			$array[$cnt]->dato4 = $r['correo'];					


			// PARA LA ORDEN
			$array[$cnt]->idOrden = $r['idOrden'];
			$array[$cnt]->codigo = $r['codigo'];
			$array[$cnt]->dato5 =  $datoPersonal;	 
			$array[$cnt]->dato6 =$datoUbicacion;		
			$array[$cnt]->idPersonal =	$r['idPersonal'];				
			$array[$cnt]->idUbicacion =  $r['idUbicacion'];		
			$array[$cnt]->fechaIngreso = $r['fechaIngreso'];					
			$array[$cnt]->fechaSalida = $r['fechaSalida'];	
			$array[$cnt]->descripcion = $r['descripcion'];	
			$array[$cnt]->condicion = $r['condicion'];	
  		
		
		

		$cnt++;
		}
		return $array;
	}
	public  function getDataFiltradaVendedoresGrafico_tablero_arreglos(){	

		$arreglo = $this->getDataFiltradaVendedoresGrafico_tablero();
		$arreglo2 =$this->getDataFiltradaVendedoresGrafico_tablero_2();

		$array = array_merge($arreglo, $arreglo2);
	
		//var_dump($array);

		return $array;

	

	}
		public static function getDataFiltradaVendedoresGrafico_tablero(){	

			$hoy = getdate();			
			$anio = $hoy['year'];

			
					$sql = "SELECT 
					COALESCE(SUM(MONTH(p.fechaSalida) = 1), 0) as ene,
					COALESCE(SUM(MONTH(p.fechaSalida) = 2), 0) as feb,
					COALESCE(SUM(MONTH(p.fechaSalida) = 3), 0) as mar,
					COALESCE(SUM(MONTH(p.fechaSalida) = 4), 0) as abr,
					COALESCE(SUM(MONTH(p.fechaSalida) = 5), 0) as may,
					COALESCE(SUM(MONTH(p.fechaSalida) = 6), 0) as jun,
					COALESCE(SUM(MONTH(p.fechaSalida) = 7), 0) as jul,
					COALESCE(SUM(MONTH(p.fechaSalida) = 8), 0) as ago,
					COALESCE(SUM(MONTH(p.fechaSalida) = 9), 0) as sep,
					COALESCE(SUM(MONTH(p.fechaSalida) = 10), 0) as oct,
					COALESCE(SUM(MONTH(p.fechaSalida) = 11), 0) as nov,
					COALESCE(SUM(MONTH(p.fechaSalida) = 12), 0) as dic
				FROM ordentrabajo p 
				WHERE YEAR(p.fechaSalida) = '$anio'  and p.condicion = 2";

			//echo $sql;
			$query = Executor::doit($sql);
			//print_r($query);
			//$data = json_decode($query);
			$e=count($query);
			if($e>=1){
			//echo "Si tengo algo";
			$array = array();
			$cnt = 0;	
			while($r = $query[0]->fetch_array()){
				$ene = $r['ene'];
				$feb = $r['feb'];
				$mar = $r['mar'];
				$abr = $r['abr'];
				$may = $r['may'];
				$jun = $r['jun'];
				$jul = $r['jul'];
				$ago = $r['ago'];
				$sep = $r['sep'];
				$oct = $r['oct'];
				$nov = $r['nov'];
				$dic = $r['dic'];

				$array=array($anio,$ene,$feb,$mar,$abr,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic);
			}

			
					return $array;

					}else{
					$ene = 0;
					$feb = 0;
					$mar = 0;
					$abr = 0;
					$may = 0;
					$jun = 0;
					$jul = 0;
					$ago = 0;
					$sep = 0;
					$oct = 0;
					$nov = 0;
					$dic = 0;

					$array=array($anio,$ene,$feb,$mar,$abr,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic);
					return $array;

					

			}
		}

	public static function getDataFiltradaVendedoresGrafico_tablero_2(){	

				$hoy = getdate();			
				$anio = $hoy['year'];
				$anio = $anio-1;

					$sql = "SELECT 
				COALESCE(SUM(MONTH(p.fechaSalida) = 1), 0) as ene,
				COALESCE(SUM(MONTH(p.fechaSalida) = 2), 0) as feb,
				COALESCE(SUM(MONTH(p.fechaSalida) = 3), 0) as mar,
				COALESCE(SUM(MONTH(p.fechaSalida) = 4), 0) as abr,
				COALESCE(SUM(MONTH(p.fechaSalida) = 5), 0) as may,
				COALESCE(SUM(MONTH(p.fechaSalida) = 6), 0) as jun,
				COALESCE(SUM(MONTH(p.fechaSalida) = 7), 0) as jul,
				COALESCE(SUM(MONTH(p.fechaSalida) = 8), 0) as ago,
				COALESCE(SUM(MONTH(p.fechaSalida) = 9), 0) as sep,
				COALESCE(SUM(MONTH(p.fechaSalida) = 10), 0) as oct,
				COALESCE(SUM(MONTH(p.fechaSalida) = 11), 0) as nov,
				COALESCE(SUM(MONTH(p.fechaSalida) = 12), 0) as dic
			FROM ordentrabajo p 
			WHERE YEAR(p.fechaSalida) = '$anio' and p.condicion = 2";

				$query = Executor::doit($sql);
				//print_r($query);
				//$data = json_decode($query);
				$e=count($query);
				if($e>=1){
				//echo "Si tengo algo";
				$array = array();
				$cnt = 0;	
				while($r = $query[0]->fetch_array()){	

				$ene = $r['ene'];
				$feb = $r['feb'];
				$mar = $r['mar'];
				$abr = $r['abr'];
				$may = $r['may'];
				$jun = $r['jun'];
				$jul = $r['jul'];
				$ago = $r['ago'];
				$sep = $r['sep'];
				$oct = $r['oct'];
				$nov = $r['nov'];
				$dic = $r['dic'];

				$array=array($anio,$ene,$feb,$mar,$abr,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic);


				}


				//var_dump($array);
				//$array =array($anio,$r['ene'],$r['feb'],$r['mar'],$r['abr'],$r['may'],$r['jun'],$r['jul'],$r['ago'],$r['sep'],$r['oct'],$r['nov'],$r['dic']):

				return $array;

				}else{
				//echo "No tengo nada";
				$ene = 0;
				$feb = 0;
				$mar = 0;
				$abr = 0;
				$may = 0;
				$jun = 0;
				$jul = 0;
				$ago = 0;
				$sep = 0;
				$oct = 0;
				$nov = 0;
				$dic = 0;

				$array=array($anio,$ene,$feb,$mar,$abr,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic);
				return $array;

				}

	}

}
?>