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
        //id	idPersonal	idCategoria 	idGrado	idCargo	idDependencia	gradoLicencia	certificado	estatus	 (tabla contrato)


        $idPersonal = strtoupper($_POST['idPersonal']);      
        $idCategoria = strtoupper($_POST['idCategoria']);
        $idGrado = strtoupper($_POST['idGrado']);
        $idCargo = strtoupper($_POST['idCargo']);
        $idDependencia = strtoupper($_POST['idDependencia']);
        $gradoLicencia = strtoupper($_POST['gradoLicencia']);
        $certificado = strtoupper($_POST['certificado']);
     
            $objeto = new ContratoData(); 
            $objeto->idPersonal =$idPersonal;             
            $objeto->idCategoria =$idCategoria;     
            $objeto->idGrado =$idGrado;     
            $objeto->idCargo =$idCargo;      
            $objeto->idDependencia =$idDependencia;      
            $objeto->gradoLicencia =$gradoLicencia;      
            $objeto->certificado =$certificado;    
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
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new UnidadData();         
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
    if($datos==3){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ContratoData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getByIdInner($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }

  
}

if($accion==3){
    if($datos==1){     
        
        //id	cedula	nombreCompleto	telefono	correo	idParroquia	direccion	estatus	(tabla personal)
        //id	idPersonal	idCategoria 	idGrado	idCargo	idDependencia	gradoLicencia	certificado	estatus	 (tabla contrato)


        $idPersonal = strtoupper($_POST['idPersonal']);      
        $idCategoria = strtoupper($_POST['idCategoria']);
        $idGrado = strtoupper($_POST['idGrado']);
        $idCargo = strtoupper($_POST['idCargo']);
        $idDependencia = strtoupper($_POST['idDependencia']);
        $gradoLicencia = strtoupper($_POST['idDependencia']);
        $certificado = strtoupper($_POST['certificado']);
     
            $objeto = new ContratoData(); 
            $objeto->idPersonal =$idPersonal;             
            $objeto->idCategoria =$idCategoria;     
            $objeto->idGrado =$idGrado;     
            $objeto->idCargo =$idCargo;      
            $objeto->idDependencia =$idDependencia;      
            $objeto->gradoLicencia =$gradoLicencia;      
            $objeto->certificado =$certificado;    
            $objeto->edit();            

            echo '1';         
        

    }
}

?>