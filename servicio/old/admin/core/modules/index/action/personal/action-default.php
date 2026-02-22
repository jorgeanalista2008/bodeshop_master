<?php
if((isset($_GET['tipo']))  || (isset($_GET['accion'])) || (isset($_GET['datos']))){ 
    $tipo = $_GET['tipo'];
    $accion = $_GET['accion'];
    $datos = $_GET['datos'];
  }else{  
    $tipo = $_POST['tipo'];
    $accion = $_POST['accion'];
    $datos = $_POST['datos']; 
  }
// 1 para registrar 2 para buscar ( datos1 para global / datos2 para especifico ) 3 para actualizar 4 para eliminar

if($accion==1){
    if($datos==1){     
        
        //id	cedula	nombreCompleto	telefono	correo	idParroquia	direccion	estatus	(tabla personal)
        //id	idPersonal	idCategoria 	idGrado	idCargo	idUnidad	gradoLicencia	certificado	estatus	 (tabla contrato)
        //cmbAddPersona_idCargo

        $cedula = strtoupper($_POST['cedula']);
        $nombreCompleto = strtoupper($_POST['nombreCompleto']);
        $genero = strtoupper($_POST['genero']);
       
        $telefono = strtoupper($_POST['telefono']);
        $correo = strtoupper($_POST['correo']);
        $idParroquia = strtoupper($_POST['idParroquia']);
        $idCargo = strtoupper($_POST['idCargo']);
        $direccion = strtoupper($_POST['direccion']);
     
            $objeto = new PersonalData(); 
            $objeto->cedula =$cedula;             
            $objeto->nombreCompleto =$nombreCompleto;  
            $objeto->genero =$genero;        
           
            $objeto->telefono =$telefono;      
            $objeto->correo =$correo;      
            $objeto->idParroquia =$idParroquia;      
            $objeto->direccion =$direccion;   
            $objeto->idCargo =$idCargo;      
            $objeto->add();            

            echo '1';         
        

    }
}
if($accion==2){
    if($datos==1){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new PersonalData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAll();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }   

    if($datos==2){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new PersonalData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAll();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 
 
    if($datos==3){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new PersonalData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getById($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

    if($datos==4){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new PersonalData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllPersonalCargos();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }   

    
    if($datos==99){              
            $objeto = new PersonalData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->estadisticas();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);
        
    }

  
}
if($accion==3){
    if($datos==1){       
        $idPersonal = strtoupper($_POST['idPersonal']);
        $nombreCompleto = strtoupper($_POST['nombreCompleto']);
        $genero = strtoupper($_POST['genero']);
        $fechaNacimiento = strtoupper($_POST['fechaNacimiento']);
        $telefono = strtoupper($_POST['telefono']);
        $correo = strtoupper($_POST['correo']);
        $idParroquia = strtoupper($_POST['idParroquia']);
        $direccion = strtoupper($_POST['direccion']);
     
            $objeto = new PersonalData(); 
            $objeto->id =$idPersonal;             
            $objeto->nombreCompleto =$nombreCompleto;     
            $objeto->genero =$genero;     
            $objeto->fechaNacimiento =$fechaNacimiento;     
            $objeto->telefono =$telefono;      
            $objeto->correo =$correo;      
            $objeto->idParroquia =$idParroquia;      
            $objeto->direccion =$direccion;    
            $objeto->edit();            

            echo '1';         
        

    }
}
if($accion==4){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $banco_objeto = new UnidadData();           
            $banco_objeto->id =$id;                
            $banco_objeto->del();
           echo "1";
        }    
}
if($accion ==5){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $banco_objeto = new UnidadData();           
            $banco_objeto->id =$id;                
            $banco_objeto->act();
           echo "1";
        }    
}
if($accion ==6){
    if($datos==1){
      
        //nombre cedula fechaNacimiento  telefono telefono2 correo

        $cedula = $_POST['documento']; // valor para sacar el id del usuario
        $f = new FuncionesData();
        $t = $f->foundValor("personal","cedula",$cedula,"PersonalData");
        $id = $t->cuenta;
        if($id==1){         
          
            $p = new ContratoData();
            //echo $idCedula;
            $result= $p->getDataContrato($cedula);
            if(!empty($result)){
                header("Content-Type: application/json");
                echo json_encode($result);

            }else{
                $result = array(['id'=>'no'],['id'=>'no']);
     
                header("Content-Type: application/json");
                echo json_encode($result);
            }
           
        }else{
           // $result = array();
           // header("Content-Type: application/json");
           // echo json_encode($result);
          
        }
    }
}
?>