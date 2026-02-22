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
        $idZodi = strtoupper($_POST['idZodi']);
        $brigada = strtoupper($_POST['brigada']); 
        $f = new FuncionesData();
        $t = $f->foundValor("brigada","brigada",$brigada,"BrigadaData");
        $id = $t->cuenta;
        if($id==1){
            echo '2';         
        }else{
            $objeto = new BrigadaData(); 
            $objeto->idZodi =$idZodi;             
            $objeto->brigada =$brigada;          
            $objeto->add();            
            echo '1';         
        }

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
            $objeto = new BrigadaData();         
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
            $objeto = new BrigadaData();         
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
        $clase =$_GET['c'];  // clase
        $tabla = $_GET['t'];  // tabla
        $dato = $_GET['d']; // dato
        $campo = $_GET['cp']; // campo
        
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new BrigadaData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getByCampo($campo,$dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }
  
}
if($accion==3){
    if($datos==1){       
        $brigada = strtoupper($_POST['brigada']);
        $id = $_POST['id'];
        $idZodi = $_POST['idZodi']; 
        $f = new FuncionesData();
        $t = $f->foundValorxValor("brigada","brigada",$brigada,"idZodi",$idZodi,"BrigadaData");
        $token = $t->cuenta;
        if($token==1){ 
            echo '1';         
        }else{           
                $objeto = new BrigadaData();     
                $objeto->id =$id; 
                $objeto->idZodi =$idZodi;                   
                $objeto->brigada =$brigada;          
                $objeto->edit();            
                echo '1';   
        }
        
        
    
    

    }
}
if($accion==4){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $banco_objeto = new BrigadaData();           
            $banco_objeto->id =$id;                
            $banco_objeto->del();
           echo "1";
        }    
}
if($accion ==5){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $banco_objeto = new BrigadaData();           
            $banco_objeto->id =$id;                
            $banco_objeto->act();
           echo "1";
        }    
}
?>