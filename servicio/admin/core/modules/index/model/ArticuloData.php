<?php
class ArticuloData {
	public static $tablename = "articulo";
	public $responsive_id = "";
	
	public $id;	
	public $idModelo;
	public $nombre;	
	public $descripcion;
	public $unidadMedida;	
	public $cantidad;		
	public $condicion;	
	public $estatus;
	public $idEntrada;
	public $idSalida;
	public $idArticulo;
	public $fechaEmision;
	public $fechaRecepcion;
	public $codigoEntrada;
	public $codigoSalida;
	public $observacion;
	public $precio;
	public $idDependencia;

	//para devolucion
	public $idDevolucion;
	public $idArticuloDevolucion;
	public $cantidadDevolucion;

	//para devolucion
	public $idSalidaDetalle;

	//para devolucion
	public $idEntradaDetalle;

	//para devolucion
	public $idArticuloDetalle;

	//para devolucion
	public $estatusDevolucion;

	//Constructor
	//id,idModelo,nombre,descripcion,unidadMedida,cantidad,condicion,estatus
	//id: 0, idModelo: "", nombre: "", descripcion: "", unidadMedida: "", cantidad: 0, condicion: "", estatus: 0
	//idEntrada,idSalida,idArticulo,fechaEmision,fechaRecepcion,codigoEntrada,codigoSalida,observacion,precio,idDependencia
	
	public function __construct(){
		$this->id = 0;
		$this->idModelo = '';	
		$this->nombre = 0;	
		$this->descripcion = '';
		$this->unidadMedida = '';	
	
		$this->cantidad = '';		
	
		$this->condicion = '';	
		$this->estatus = 0;	
		/*	
		idModelo
		nombre
		descripcion
		unidadMedida
		cantidad
		condicion
	
		estatus*/
		

	}	
	public function add(){


		$sql = "insert into ".self::$tablename." (id,idModelo,nombre,descripcion,unidadMedida,cantidad,condicion,estatus) ";
		$sql .= "value (NULL,$this->idModelo,\"$this->nombre\",\"$this->descripcion\",$this->unidadMedida,0,1,1)";
		//echo $sql;
		Executor::doit($sql);
		
		//echo "guarde";
	}

	public function addEntrada(){
		//id	fechaEmision	fechaRecepcion	montoTotal	codigoEntrada	observacion	estatus	

		$sql = "insert into entrada (id,fechaEmision,fechaRecepcion,montoTotal,codigoEntrada,observacion,estatus) ";
		$sql .= "value (NULL,\"$this->fechaEmision\",\"$this->fechaRecepcion\",0.00,\"$this->codigoEntrada\",\"$this->observacion\",1)";
		//echo $sql;
		Executor::doit($sql);

		
		//echo "guarde";
	}

	public function addSalida(){
	//	id	idDependencia	fechaSalida	codigoSalida	observacion	estatus	

		$sql = "insert into salida (id,idDependencia,fechaEmision,codigoSalida,observacion,estatus) ";
		$sql .= "value (NULL,$this->idDependencia,\"$this->fechaEmision\",\"$this->codigoSalida\",\"$this->observacion\",1)";
		//echo $sql;
		Executor::doit($sql);

		
		//echo "guarde";
	}

	public function editSalida(){
		$sql = "update salida set estatus=2 where id=$this->idSalida";
		Executor::doit($sql);
	}

	public function addEntradaDetalle(){
	//	id	idEntrada	idArticulo	cantidad	precio	estatus	

		$sql = "insert into entradaDetalle (id,idEntrada,idArticulo,cantidad,precio,estatus) ";
		$sql .= "value (NULL,$this->idEntrada,$this->idArticulo,$this->cantidad,$this->precio,1)";
		//echo $sql;
		Executor::doit($sql);

		
		//echo "guarde";
	}

	public function addSalidaDetalle(){
		//		id	idSalida	idArticulo	cantidad	estatus	
	
			$sql = "insert into salidaDetalle (id,idSalida,idArticulo,cantidad,estatus) ";
			$sql .= "value (NULL,$this->idSalida,$this->idArticulo,$this->cantidad,1)";
			//echo $sql;
			Executor::doit($sql);
	
			
			//echo "guarde";
		}

	public function editCantidadArticulo($totalCantidad,$id){
		
		$sql = "update ".self::$tablename." set cantidad=$totalCantidad where id=$id";
		//echo $sql;
		Executor::doit($sql);
	}

	public function edit(){
		//id,idModelo,nombre,descripcion,unidadMedida,cantidad,condicion,estatus
		$sql = "update ".self::$tablename." set idModelo=$this->idModelo,nombre=\"$this->nombre\",descripcion=\"$this->descripcion\",unidadMedida=$this->unidadMedida where id=$this->id";
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
		$sql = "SELECT a.id,a.nombre ,a.cantidad,a.condicion,a.unidadMedida,m.modelo,mr.marca,t.tipo,a.estatus,mr.idTipo,m.idMarca,a.idModelo FROM ".self::$tablename." a 
		INNER JOIN modelo m ON a.idModelo = m.id
		INNER JOIN marca mr ON m.idMarca = mr.id
		INNER JOIN tipo t ON mr.idTipo = t.id	
		ORDER BY a.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();    
			
			switch ($r['unidadMedida']) {
				case 1:
					$unidad="UNIDAD";
				
					break;
				case 2:
					$unidad="CENTIMETROS";
				
					break;
				case 3:
					$unidad="METROS";
					
					break;
				case 4:
					$unidad="MILILITROS";
					
					break;
				case 5:
					$unidad="LITROS";
				
					break;
				case 6:
					$unidad="GRAMOS";					
					break;
				case 7:
					$unidad="KILOS";					
				break;
			
			}
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];
			$array[$cnt]->cantidad = $r['cantidad'];
			$array[$cnt]->unidadMedida = $unidad;

			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->idModelo = $r['idModelo'];
			$array[$cnt]->modelo = $r['modelo'];
			$array[$cnt]->idMarca = $r['idMarca'];
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->idTipo = $r['idTipo'];
			$array[$cnt]->tipo = $r['tipo'];
			$array[$cnt]->estatus = $r['estatus'];
		$cnt++;
		}
		return $array;
	}

	public static function getAllTableEntradas(){
		$sql = "SELECT id,codigoEntrada,fechaEmision,fechaRecepcion,estatus FROM entrada e ORDER BY e.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();    

			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->codigoEntrada = $r['codigoEntrada'];
			$array[$cnt]->fechaEmision = $r['fechaEmision'];
			$array[$cnt]->fechaRecepcion = $r['fechaRecepcion'];
			$array[$cnt]->estatus = $r['estatus'];
		
		$cnt++;
		}
		return $array;
	}

	public static function getAllDataEntrada($id){
		$sql = "SELECT e.id,e.codigoEntrada,e.fechaEmision,e.fechaRecepcion,e.estatus,e.observacion FROM entrada e WHERE e.id = '$id' ORDER BY e.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();  
			$objeto_entrada = New FuncionesData();
			$arrayArticulosDetalles = $objeto_entrada->getAllDataEntradaDetalles($id);
			//print_r($arrayArticulosDetalles);
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->codigoEntrada = $r['codigoEntrada'];
			$array[$cnt]->fechaEmision = $r['fechaEmision'];
			$array[$cnt]->fechaRecepcion = $r['fechaRecepcion'];
			$array[$cnt]->observacion = $r['observacion'];
			$array[$cnt]->estatus = $r['estatus'];
			$array[$cnt]->objeto =  $arrayArticulosDetalles;
		$cnt++;
		}
		return $array;
	}

	public static function getAllDataSalida($id){
		$sql = "SELECT s.id,s.observacion,s.codigoSalida,s.estatus,s.fechaEmision,s.idDependencia,r.redi,z.zodi,b.brigada,u.unidad,d.dependencia FROM salida s 
		INNER JOIN dependencia d ON s.idDependencia = d.id	
		INNER JOIN unidad u ON d.idUnidad = u.id	
		INNER JOIN brigada b ON u.idBrigada= b.id	
		INNER JOIN zodi z ON b.idZodi= z.id	
		INNER JOIN redi r ON z.idRedi= r.id	
		WHERE s.id = '$id' ORDER BY s.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();  
			$objeto_salida = New FuncionesData();
			$arrayArticulosDetalles = $objeto_salida->getAllDataSalidaDetalles($id);
			//print_r($arrayArticulosDetalles);
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->codigoSalida = $r['codigoSalida'];
			$array[$cnt]->fechaEmision = $r['fechaEmision'];

			$array[$cnt]->redi = $r['redi'];
			$array[$cnt]->zodi = $r['zodi'];
			$array[$cnt]->brigada = $r['brigada'];
			$array[$cnt]->unidad = $r['unidad'];
			$array[$cnt]->dependencia = $r['dependencia'];
		
			
			$array[$cnt]->observacion = $r['observacion'];
			$array[$cnt]->estatus = $r['estatus'];
			$array[$cnt]->objeto =  $arrayArticulosDetalles;
		$cnt++;
		}
		return $array;
	}

	


	public static function getAllTableSalidas(){
		$sql = "SELECT s.id,s.codigoSalida,s.fechaEmision,s.estatus,r.redi,z.zodi,b.brigada,u.unidad,d.dependencia FROM salida s
		INNER JOIN dependencia d ON s.idDependencia = d.id	
		INNER JOIN unidad u ON d.idUnidad = u.id	
		INNER JOIN brigada b ON u.idBrigada= b.id	
		INNER JOIN zodi z ON b.idZodi= z.id	
		INNER JOIN redi r ON z.idRedi= r.id			
		ORDER BY s.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();    

			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->codigoSalida = $r['codigoSalida'];
			$array[$cnt]->fechaEmision = $r['fechaEmision'];
			$array[$cnt]->redi = $r['redi'];
			$array[$cnt]->zodi = $r['zodi'];
			$array[$cnt]->brigada = $r['brigada'];
			$array[$cnt]->unidad = $r['unidad'];
			$array[$cnt]->dependencia = $r['dependencia'];
			$array[$cnt]->estatus = $r['estatus'];
		
		$cnt++;
		}
		return $array;
	}


	public static function getDataId($idArticulo){
		/*$sql = "SELECT *  FROM ".self::$tablename." p WHERE p.id NOT IN (SELECT c.idPersonal from contrato c)	
		ORDER BY p.id ASC";	*/
		$sql = "SELECT a.id,a.nombre,a.descripcion,a.cantidad,a.condicion,a.unidadMedida,m.modelo,mr.marca,t.tipo,a.estatus,mr.idTipo,m.idMarca,a.idModelo FROM ".self::$tablename." a 
		INNER JOIN modelo m ON a.idModelo = m.id
		INNER JOIN marca mr ON m.idMarca = mr.id
		INNER JOIN tipo t ON mr.idTipo = t.id	
		WHERE a.id = $idArticulo
		ORDER BY a.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();    
			
			switch ($r['unidadMedida']) {
				case 1:
					$unidad="UNIDAD";
				
					break;
				case 2:
					$unidad="CENTIMETROS";
				
					break;
				case 3:
					$unidad="METROS";
					
					break;
				case 4:
					$unidad="MILILITROS";
					
					break;
				case 5:
					$unidad="LITROS";
				
					break;
				case 6:
					$unidad="GRAMOS";					
					break;
				case 7:
					$unidad="KILOS";					
				break;
			
			}
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];
			$array[$cnt]->cantidad = $r['cantidad'];
			$array[$cnt]->unidadMedida = $unidad;
			$array[$cnt]->idUnidadMedida = $r['unidadMedida'];
			$array[$cnt]->condicion = $r['condicion'];
			$array[$cnt]->idModelo = $r['idModelo'];
			$array[$cnt]->modelo = $r['modelo'];
			$array[$cnt]->idMarca = $r['idMarca'];
			$array[$cnt]->marca = $r['marca'];
			$array[$cnt]->idTipo = $r['idTipo'];
			$array[$cnt]->tipo = $r['tipo'];
			$array[$cnt]->descripcion = $r['descripcion'];
			$array[$cnt]->estatus = $r['estatus'];
		$cnt++;
		}
		return $array;
	}
	

	public static function ultimaEntrada(){
		$sql = "select max(id) as idEntrada from entrada";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new ArticuloData());
	}

	public static function ultimaSalida(){
		$sql = "select max(id) as idSalida from salida";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new ArticuloData());
	}

	public static function ultimaDevolucion(){
		$sql = "select max(id) as idDevolucion from devolucion";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new ArticuloData());
	}

	public static function getUltimaOrdenSalida(){
		
		// SOLO VEHICULOS Q NO ESTEN EN MANTENIMIENTO Y ESTEN DISPONIBLES
		$sql = "SELECT count(id)+1 as ultimaOrdenSalida from salida";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();    
			
			$array[$cnt]->responsive_id = "";
			$array[$cnt]->ultimaOrdenSalida = $r['ultimaOrdenSalida'];
			
			
		$cnt++;
		}
		return $array;
	}


	
}
?>