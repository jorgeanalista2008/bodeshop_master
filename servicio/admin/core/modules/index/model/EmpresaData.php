<?php
class EmpresaData {
	
	public static $tablename = "empresa";

		
	//id	direccion	valor	estatus
	public function __construct(){
		$this->responsive_id = '';
		$this->co_emp = '0';
		$this->name = "";
		$this->email = "";	
		
		$this->dir = "";	
		$this->telefonos = "";	
		$this->rif = "";	
		$this->image = "no_image.png";	
		$this->estatus ='0';
		
	
		$this->co_emp_mail ='0';
		$this->text ='0';
		$this->smtp ='0';
		$this->password ='0';
		$this->host ='0';
		$this->port ='0';
	}

	
	public function update(){
		$sql = "UPDATE ".self::$tablename." SET name='$this->name', email='$this->email', dir='$this->dir', telefonos='$this->telefonos',rif='$this->rif'  WHERE co_emp='01';";
		//echo $sql;
		$query = Executor::doit($sql);
	}

	public function updateCorreo(){
		$sql = "UPDATE empresaMail SET text='$this->text', smtp='$this->smtp', password='$this->password', host='$this->host',port='$this->port'  WHERE co_emp='01';";
		//echo $sql;
		$query = Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "SELECT *  FROM ".self::$tablename." e WHERE e.co_emp='$id' and e.estatus =1 ORDER BY e.co_emp ASC";	
		$query = Executor::doit($sql);
		$found = null;
		$data = new EmpresaData();
		while($r = $query[0]->fetch_array()){
				$data->co_emp = $r['co_emp'];
				$data->name = $r['name'];				
				$data->email = $r['email'];	
				$data->dir = $r['dir'];		
				$data->telefonos = $r['telefonos'];	
				$data->rif = $r['rif'];	
				$data->image = $r['image'];		
				$data->estatus = $r['estatus'];					
			$found = $data;
			break;
		}
		return $found;
	}
	
	public static function getAllDatos(){
		$sql = "SELECT *  FROM ".self::$tablename." e WHERE e.co_emp='01' and e.estatus =1 ORDER BY e.co_emp ASC";	
		$query = Executor::doit($sql);
		$e=count($query);
		if($e>=1){
		$array = array();
		$cnt = 0;
		while($r = $query[0]->fetch_array()){

				$array[$cnt] = new EmpresaData();  
				$array[$cnt]->responsive_id = "";  
				$array[$cnt]->co_emp = $r['co_emp'];
				$array[$cnt]->name = $r['name'];				
				$array[$cnt]->email = $r['email'];	
			
				$array[$cnt]->dir = $r['dir'];		
				$array[$cnt]->telefonos = $r['telefonos'];	
				$array[$cnt]->rif = $r['rif'];	
				$array[$cnt]->image = $r['image'];		
				$array[$cnt]->estatus = $r['estatus'];			
			$cnt++;
			}
			//var_dump($array);
			
			return $array;

		}else{

			$array = array();
			return $array;

		}
		
	}

	
	public static function getAllDatosCorreo(){
		$sql = "SELECT ee.text,ee.smtp,ee.password,ee.host,ee.port,e.email FROM empresaMail ee 
		INNER JOIN empresa e ON ee.co_emp = e.co_emp WHERE ee.co_emp='01' ORDER BY ee.co_emp ASC";	
		//echo $sql;
		$query = Executor::doit($sql);
		//print_r($query);
		$e=count($query);
		if($e>=1){

			$array = array();
			$cnt = 0;	
		while($r = $query[0]->fetch_array()){
				$array[$cnt] = new EmpresaData();  
				$array[$cnt]->responsive_id = "";  		
				$array[$cnt]->text = $r['text'];				
				$array[$cnt]->smtp = $r['smtp'];	
				$array[$cnt]->password = $r['password'];		
				$array[$cnt]->host = $r['host'];	
				$array[$cnt]->port = $r['port'];	
				$array[$cnt]->email = $r['email'];
			
			$cnt++;
			}
			//var_dump($array);
			
			return $array;

		}else{

			$array = array();
			return $array;

		}
		
	}

	
}
?>