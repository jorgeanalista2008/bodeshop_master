<?php
$clase =$_GET['c'];
$tabla = $_GET['t'];
if(isset($_GET['a'])){
    $a=$_GET['a'];
    }
if($a==1){
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatos();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);

}
if($a==2){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInner();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}

if($a==222){
//alertas
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerAlerta();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 //alertas
}

if($a==3){
    $id =$_GET['id'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosFiltrados($id);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);

    
}
if($a==4){
    $id =$_GET['id'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosFiltrados2($id);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}
if($a==5){
    $id =$_GET['id'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getDataId($id);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}
if($a==6){
    $id =$_GET['id'];
    $key =$_GET['key'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getDataKeyId($key,$id);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}
if($a==7){
    $tabla = $_GET['tabla'];
    $key = "id";
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->contarDatos($tabla,$key,$clase);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}
if($a==8){
    
    $html = '';
    $tabla = $_GET['tabla'];
    $valor = $_GET['data'];
    $datos = new $clase(); 
    
            $result = $datos->sugerirTipo($tabla,$valor,$clase);
        if(isset($result)){
            $html .= '<div><a class="suggest-element" data="'.utf8_encode($result->tipo).'" id="'.$result->id.'">'.utf8_encode($result->tipo).'</a></div>';
            echo $html;
          
        }else{
            echo $html;
        }
          
}
if($a==9){
    
    $html = '';
    $tabla = $_GET['tabla'];
    $valor = $_GET['data'];
    $datos = new $clase(); 
    
            $result = $datos->sugerirMarca($tabla,$valor,$clase);
        if(isset($result)){
            $html .= '<div><a class="suggest-element-marca" data="'.utf8_encode($result->marca).'" id="'.$result->id.'">'.utf8_encode($result->marca).'</a></div>';
            echo $html;
          
        }else{
            echo $html;
        }
          
}

if($a==10){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerAutos();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}


if($a==11){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerEstructuras();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}

if($a==12){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerOtros();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}
if($a==13){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerPatrimonios();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}

if($a==14){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerPersonales();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}

if($a==15){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosContratos();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}

if($a==16){
    $dato = $_GET['dato'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerAlertas($dato);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}
if($a==17){
    $dato = $_GET['dato'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosCodigo($dato);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}
if($a==18){
    $id =$_GET['id'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerPagos($id);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}
if($a==19){
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosBanca();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);

}

if($a==199){
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosCorreo();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    //var_dump($result);
}
if($a==20){
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->saldoGlobal();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);

}
if($a==21){
    $codigo =$_GET['codigo'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getDataObjeto($codigo);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}


if($a==22){

    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosSinContratos();
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
}

if($a==23){
    $id =$_GET['id'];
    $datos = new $clase(); 
    $result=[];
    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getDataCodigo($id);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}

if($a==24){
    // metodo para listar todas las cuotas para emitir en la tabla de alertas
     $datos = new $clase(); 
    $result=[];
    $status =$_GET['status'];
    $filtro =$_GET['filtro'];
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllcuotas($status,$filtro);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    
}

if($a==25){
    // metodo para listar todas las cuotas para emitir en la tabla de alertas
     $datos = new $clase(); 
    $result=[];
    $status =$_GET['status'];
    $filtro =$_GET['filtro'];    
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getAllDatosInnerAdmin($status,$filtro);
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
 
    
}

if($a==32){
    $hoy = getdate();   
    $anio = $hoy['year'];
    $datos = new $clase(); 
    $result=[];   
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->estadisticasPagos($anio);            
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    //var_dump($result);
} 



/// para los graficos de afuera (tablero)
/*if($a==99){
    $datos = new $clase(); 
    $result=[];
  
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getDataFiltradaVendedoresGrafico_tablero_arreglos();
            
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    //var_dump($result);
} */


if($a==999){
    $datos = new $clase(); 
    $result=[];
  
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->getDataFiltradaVendedoresGrafico_tablero_arreglos();
            
            break;
    }
    
    header("Content-Type: application/json");
    echo json_encode($result);
    //var_dump($result);
} 

?>
