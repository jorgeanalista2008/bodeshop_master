<?php
class FuncionesData {
	public static $tablename = "users";
	
	public function __construct(){
		$this->id = '0';
		$this->cuenta = "";
	}

	public static function foundId($tabla,$key,$valor,$clase){
	
		$sql = "SELECT c.id as cuenta FROM ".$tabla." c WHERE c.".$key."='".$valor."'";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new $clase());
	}

	public static function foundAsignacion($id){
		$sql = "select a.id as idAsignacion,dependencia,unidad,brigada,zodi,redi,fechaAsignacion from asignacion a 
		INNER JOIN dependencia d ON a.idCustodio = d.id	
		INNER JOIN unidad u ON d.idUnidad = u.id	
		INNER JOIN brigada b ON u.idBrigada= b.id	
		INNER JOIN zodi z ON b.idZodi= z.id	
		INNER JOIN redi r ON z.idRedi= r.id	
		INNER JOIN vehiculo v ON a.idObjeto = v.id
		where  a.idObjeto=$id and a.estatus = 1  order by a.id desc limit 1;";		
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new VehiculoData());
	}

	public static function foundAsignaciones($id){
		$sql = "select a.id as idAsignacion,dependencia,unidad,brigada,zodi,redi,fechaAsignacion,fechaDevolucion from asignacion a 
		INNER JOIN dependencia d ON a.idCustodio = d.id	
		INNER JOIN unidad u ON d.idUnidad = u.id	
		INNER JOIN brigada b ON u.idBrigada= b.id	
		INNER JOIN zodi z ON b.idZodi= z.id	
		INNER JOIN redi r ON z.idRedi= r.id	
		INNER JOIN vehiculo v ON a.idObjeto = v.id
		where  a.idObjeto=$id";		
		echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new VehiculoData());
	}

	public static function getAllDataEntradaDetalles($id){
		$sql = "SELECT a.id,a.nombre,ed.cantidad,ed.precio FROM entrada e 
		INNER JOIN entradadetalle ed ON e.id = ed.idEntrada
		INNER JOIN articulo a ON ed.idArticulo = a.id
		WHERE e.id = '$id' ORDER BY e.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();  			
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];
			$array[$cnt]->cantidad = $r['cantidad'];
			$array[$cnt]->precio = $r['precio'];
		
		
		$cnt++;
		}
		return $array;
	}

	public static function getAllDataSalidaDetalles($id){
		$sql = "SELECT a.id,a.nombre,sd.cantidad FROM salida s
		INNER JOIN salidaDetalle sd ON s.id = sd.idSalida
		INNER JOIN articulo a ON sd.idArticulo = a.id
		WHERE s.id = '$id' ORDER BY s.id ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){
			$array[$cnt] = new ArticuloData();  			
			$array[$cnt]->id = $r['id'];
			$array[$cnt]->nombre = $r['nombre'];
			$array[$cnt]->cantidad = $r['cantidad'];		
		
		$cnt++;
		}
		return $array;
	}

	

	public static function foundValor($tabla,$key,$valor,$clase){
	
		$sql = "SELECT COUNT(c.".$key.") cuenta FROM ".$tabla." c WHERE c.".$key."='".$valor."'";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new $clase());
	}

	public static function foundValorxValor($tabla,$key,$valor,$key2,$valor2,$clase){
	
		$sql = "SELECT COUNT(c.".$key.") cuenta FROM ".$tabla." c WHERE c.".$key."='".$valor."' AND c.".$key2."=".$valor2."";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new $clase());
	}
	public static function foundValorxValorxValor($tabla,$key,$valor,$key2,$valor2,$key3,$valor3,$clase){
	
		$sql = "SELECT COUNT(c.".$key.") cuenta FROM ".$tabla." c WHERE c.".$key."='".$valor."' AND c.".$key2."=".$valor2." AND c.".$key3."=".$valor3."";
		//echo $sql;	
		$query = Executor::doit($sql);
		return Model::one($query[0],new $clase());
	}
		
	public  function radomCodigo(){
		$alphabet = "0123456789ABCDEFGHIJKLMNOPQSTUWXYZabcdefghijqlmnopqrstuvwxyz";
		$pass = array(); //recuerde que debe declarar $pass como un array
		$alphaLength = strlen($alphabet) - 1; //poner la longitud -1 en caché
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //convertir el array en una cadena
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

	

	

	
}
?>