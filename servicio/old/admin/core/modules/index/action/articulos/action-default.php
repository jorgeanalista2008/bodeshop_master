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
      

        $idModelo = strtoupper($_POST['idModelo']);
        $nombre = strtoupper($_POST['nombre']);
        $descripcion = strtoupper($_POST['descripcion']);
        $unidadMedida = strtoupper($_POST['medida']);

        $f = new FuncionesData();
        $t = $f->foundValor("articulo","nombre",$nombre,"ArticuloData");
        $id = $t->cuenta;
       // echo $id;
        
        if($id>=1){
            echo "2";         
        }else{

            $objeto = new ArticuloData(); 
            $objeto->idModelo =$idModelo;             
            $objeto->nombre =$nombre;     
            $objeto->descripcion =$descripcion;    
            $objeto->unidadMedida =$unidadMedida;   
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
            $objeto = new ArticuloData();         
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
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllTable();
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
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAll($dato);
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
            $objeto = new ArticuloData();         
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
    
    if($datos==5){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllTableEntradas();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 
    if($datos==6){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllTableSalidas();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

    if($datos==7){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllDataEntrada($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }
    if($datos==8){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllDataSalida($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }

    if($datos==9){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataId($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }

        
    if($datos==10){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ArticuloData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getUltimaOrdenSalida();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

  
}
if($accion==3){
    if($datos==1){       

        if($datos==1){       
      
            $id = strtoupper($_POST['id']);
            $idModelo = strtoupper($_POST['idModelo']);
            $nombre = strtoupper($_POST['nombre']);
            $descripcion = strtoupper($_POST['descripcion']);
            $unidadMedida = strtoupper($_POST['medida']);
            $f = new FuncionesData();
            $t = $f->foundValorxValor("articulo","nombre",$nombre,"id",$id,"ArticuloData");
            $token = $t->cuenta;
            if($token==1){ 
                echo '1';         
            }else{           
                $objeto = new ArticuloData(); 
                $objeto->id =$id;       
                $objeto->idModelo =$idModelo;             
                $objeto->nombre =$nombre;     
                $objeto->descripcion =$descripcion;    
                $objeto->unidadMedida =$unidadMedida;   
                $objeto->edit();            
    
                echo '1';         
            
            }
        }

       
        
        
    
    

    }
}
if($accion==4){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $banco_objeto = new ArticuloData();           
            $banco_objeto->id =$id;                
            $banco_objeto->del();
           echo "1";
        }    
}
if($accion ==5){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $banco_objeto = new ArticuloData();           
            $banco_objeto->id =$id;                
            $banco_objeto->act();
           echo "1";
        }    
}
if($accion ==6){
    if($datos==1){

        $cantidad =  $_REQUEST['cantidad'];     
        $idArticulo = $_REQUEST['idArticulo'];
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];

            $itemData = array(
                'co_art' =>   $idArticulo,
                'art_des' =>  $nombre,
                'prec_vta1' =>$precio,
                'qty' => $cantidad,
                'iva' => '0',
                'uni' => '0',
                'tiva' => '0',
            );
           // print_r($itemData);
            $carrito_objeto = new CarritoData();
            $insertItem = $carrito_objeto->insert($itemData);

            echo "1";      

    }
 
}
if($accion ==7){
    if($datos==1){
    $datos = new CarritoData(); 
    $result=[];
    $array = array();
    $cnt =0;
    switch($_SERVER["REQUEST_METHOD"]) {
        case "GET":
            $result = $datos->contents();
            break;
    }
   //var_dump($result);
    foreach($result as $item){

        $array[$cnt] = new ArticuloData();    
        $array[$cnt]->idArticulo = $item["co_art"];
        $array[$cnt]->nombre =  $item['art_des'];
        $array[$cnt]->rowid = $item["rowid"];
        $array[$cnt]->cantidad = $item['qty'];
        $array[$cnt]->precio = $item['prec_vta1'];
    $cnt++;
    }
  
    header("Content-Type: application/json");
    echo json_encode($array);
   // var_dump($array);
}   
}
if($accion ==8){
    if($datos==1){
        $carrito_objeto = new CarritoData();
        $deleteItem = $carrito_objeto->remove($_REQUEST['id']);
       // echo "3";
    }
 

}

if($accion ==9){
    if($datos==1){
        $carrito_objeto = new CarritoData();
        $carrito_objeto->destroy();  
        echo "1";
    }
 

}

if($accion ==10){
    if($datos==1){
        $idArticulo =  $_REQUEST['idArticulo'];
        $cantidad =  $_REQUEST['cantidad'];     
        $precio =  $_REQUEST['precio'];     
        $rowId =  $_REQUEST['rowId'];
        $itemData = array(
            'rowid' => $rowId,
            'qty' => $cantidad,
            'prec_vta1' =>$precio
        );
        $carrito_objeto = new CarritoData();
        $updateItem = $carrito_objeto->update($itemData);
        echo "1";
        //echo $updateItem?'ok':'err';die;
       
    }
  
}

if($accion ==11){
    if($datos==1){
        $idArticulo =  $_REQUEST['idArticulo'];
        $cantidad =  $_REQUEST['cantidad'];
        $precio =  $_REQUEST['precio'];
        $almacen=0;
        $articulo_objeto = new ArticuloData();
        $result = $articulo_objeto->getDataId($idArticulo);
        $cantidadActual = $result[0]->cantidad;
        if($cantidad<=$cantidadActual){
        $rowId =  $_REQUEST['rowId'];
        $itemData = array(
            'rowid' => $rowId,
            'qty' => $cantidad,
            'prec_vta1' =>$precio
        );
        $carrito_objeto = new CarritoData();
        $updateItem = $carrito_objeto->update($itemData);
        echo "1";
        //echo $updateItem?'ok':'err';die;
        }else{
        echo $cantidadActual;

        }
    }
  
}

/////////////////////////// para entradas *****************************
if($accion ==12){
    if($datos==1){       
        
        $fechaEmision = strtoupper($_POST['fechaEmision']);
        $fechaRecepcion = strtoupper($_POST['fechaRecepcion']);
        $observacion = strtoupper($_POST['observacion']);
        $codigoEntrada = strtoupper($_POST['codigoEntrada']);
            $objeto = new ArticuloData(); 
            $objeto->fechaEmision =$fechaEmision;             
            $objeto->fechaRecepcion =$fechaRecepcion;     
            $objeto->observacion =$observacion;    
            $objeto->codigoEntrada =$codigoEntrada;   
        $objeto->addEntrada(); 
            
            
            $carrito_objeto = new CarritoData();
            $data = $carrito_objeto->contents_total();
            $dataEntrada=$objeto->ultimaEntrada();
            $idEntrada = $dataEntrada->idEntrada;	

            foreach($data as $carrito){           
            

                $idArticulo = $carrito['co_art'];
                $cantidad = $carrito['qty'];
                $precio = $carrito['prec_vta1'];

                $dataCantidad = $objeto->getDataId($idArticulo);
                $cantidadActual = $dataCantidad[0]->cantidad;
                $totalCantidad= $cantidadActual+ $cantidad;

                $objeto->editCantidadArticulo($totalCantidad,$idArticulo);

                $objeto->idArticulo =  $idArticulo;
                $objeto->cantidad =  $cantidad;
                $objeto->precio =  $precio;
                $objeto->idEntrada =  $idEntrada;
                $objeto->addEntradaDetalle();
            //  echo $idArticulo; echo "<br>"; echo $cantidad;  echo "<br>"; echo $precio;


            }   
            $carrito_objeto->destroy();

            echo '1';         
        

    }
}
///////////////////////////////// para salidas/////////////////////////////

if($accion ==13){
    if($datos==1){

        $cantidad =  $_REQUEST['cantidad'];     
        $idArticulo = $_REQUEST['idArticulo'];
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];

        $articulo_objeto = new ArticuloData();
        $result = $articulo_objeto->getDataId($idArticulo);
        $cantidadActual = $result[0]->cantidad;
        if($cantidad<=$cantidadActual){
            $itemData = array(
                'co_art' =>   $idArticulo,
                'art_des' =>  $nombre,
                'prec_vta1' =>$precio,
                'qty' => $cantidad,
                'iva' => '0',
                'uni' => '0',
                'tiva' => '0',
            );
           // print_r($itemData);
            $carrito_objeto = new CarritoData();
            $insertItem = $carrito_objeto->insert($itemData);

            echo "1";  
        }else{
            echo "2";
        }    

    }
 
}
if($accion ==14){
    if($datos==1){       
   
        $fechaEmision = strtoupper($_POST['fechaEmision']);
        $idDependencia = strtoupper($_POST['idDependencia']);
        $observacion = strtoupper($_POST['observacion']);
        $codigoSalida = strtoupper($_POST['codigoSalida']);

            $objeto = new ArticuloData(); 
            $objeto->fechaEmision =$fechaEmision;             
            $objeto->idDependencia =$idDependencia;     
            $objeto->observacion =$observacion;    
            $objeto->codigoSalida =$codigoSalida;   
            $objeto->addSalida(); 
            
            
            $carrito_objeto = new CarritoData();
            $data = $carrito_objeto->contents_total();
            $dataSalida=$objeto->ultimaSalida();
            $idSalida = $dataSalida->idSalida;	

            foreach($data as $carrito){           
            

                $idArticulo = $carrito['co_art'];
                $cantidad = $carrito['qty'];
         

                $dataCantidad = $objeto->getDataId($idArticulo);
                $cantidadActual = $dataCantidad[0]->cantidad;
                $totalCantidad= $cantidadActual-$cantidad;

                $objeto->editCantidadArticulo($totalCantidad,$idArticulo);

                $objeto->idArticulo =  $idArticulo;
                $objeto->cantidad =  $cantidad;             
                $objeto->idSalida =  $idSalida;
                $objeto->addSalidaDetalle();
            //  echo $idArticulo; echo "<br>"; echo $cantidad;  echo "<br>"; echo $precio;


            }   
            $carrito_objeto->destroy();

            echo '1';         
        

    }
}
/////////////////////////////////////////////////////// para  las devocluciones

if($accion ==15){
    if($datos==1){       
        $idSalida = strtoupper($_POST['idSalida']);
       

            $objeto = new ArticuloData(); 
           $objeto->idSalida =$idSalida;   
           $objeto->editSalida();       

            $objeto_salida = New FuncionesData();
			$data = $objeto_salida->getAllDataSalidaDetalles($idSalida);      
          //print_r($arrayArticulosDetalles);

            foreach($data as $arrayArticulosDetalles){  
                $idArticulo = $arrayArticulosDetalles->id;
                $cantidad = $arrayArticulosDetalles->cantidad;
         

                $dataCantidad = $objeto->getDataId($idArticulo);
                $cantidadActual = $dataCantidad[0]->cantidad;
                $totalCantidad= $cantidadActual+$cantidad;

                $objeto->editCantidadArticulo($totalCantidad,$idArticulo);



            }   
           

            echo '1';         
        

    }
}

?>