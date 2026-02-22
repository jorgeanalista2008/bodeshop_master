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
                
                if (is_array($_FILES) && count($_FILES) > 0) {
                    $f = new FuncionesData();
                    $llave = $f->radomCodigo();

                    $idCliente =strtoupper($_GET['idCliente']);
                    $serialMotor =strtoupper($_GET['serialMotor']);
                    $serialChasis =strtoupper($_GET['serialChasis']);
                    $color =strtoupper($_GET['color']);
                    $ano =$_GET['ano'];
                    $placa =strtoupper($_GET['placa']);
                    $idModelo =$_GET['idModelo'];
                    $condicion =$_GET['condicion'];
                    $nombre=$placa.'-'.$llave;
                  
                    $t = $f->foundValor("item","placa",$placa,"ItemData");
                    $id = $t->cuenta;
                    if($id==1){
                        echo "4";         
                    }else{
                    if (($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg")) {
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], "../admin/storage/archivos/items/".$nombre.$_FILES['file']['name'])) {      
                            $archivo = "../admin/storage/archivos/items/".$nombre.$_FILES['file']['name'];
                            rename($archivo, "../admin/storage/archivos/items/".$nombre.$llave.".jpg");
                            $objeto = new ItemData();
                            /*placa
                            idModelo
                            ano
                            color
                            serialChasis
                            serialMotor*/
                            $objeto->idCliente =  $idCliente;
                            $objeto->placa =  $placa;
                            $objeto->idModelo =  $idModelo;
                            $objeto->ano =  $ano;
                            $objeto->color =  $color;
                            $objeto->serialChasis =  $serialChasis;
                            $objeto->serialMotor =  $serialMotor;
                            $objeto->condicion =  $condicion;

                            
                            $objeto ->add();

                        

                            $objeto_media = new MediaData();
                            $objeto_media->codigo =  $placa;
                            $objeto_media->media =  "../admin/storage/archivos/items/".$nombre.$llave.".jpg";
                            $objeto_media->estatus=1; // imagen de item
                            $objeto_media ->add();

                            echo "1";
        
                        
                        } else {
                            echo 0;  
                        }
                    } else {
                        echo 2;
                    }                
                }

                } else {
                    echo 3;
                }
            }

            if($datos==2){  
                $idObjeto =$_POST['id'];
                $idDependencia =$_POST['idDependencia'];
                $fechaAsignacion = $_POST['fechaAsignacion'];
                $observacion = strtoupper($_POST['observacion']);
                $objeto = new ItemData();
                $objeto->idObjeto =  $idObjeto;
                $objeto->idCustodio =  $idDependencia;
                $objeto->fechaAsignacion =  $fechaAsignacion;
                $objeto->observacion =  $observacion;
                $objeto ->addAsignacion();
              
                echo "1";
            }   

            if($datos==3){      
                


                $idVehiculo =$_POST['id'];
                $idPersonal =$_POST['idPersonal'];
                $fechaMantenimiento = $_POST['fechaMantenimiento'];
                $tiempoEstimado = $_POST['tiempoEstimado'];
                $tipoMantenimiento = $_POST['tipoMantenimiento'];            
                $observacion = strtoupper($_POST['observacion']);
                $fechaProximoMantenimiento = $_POST['fechaProximoMantenimiento'];
                $objeto = new ItemData();
                $objeto->idVehiculo =  $idVehiculo;
                $objeto->idPersonal =  $idPersonal;
                $objeto->fechaMantenimiento =  $fechaMantenimiento;
                $objeto->tiempoEstimado =  $tiempoEstimado;
                $objeto->tipoMantenimiento =  $tipoMantenimiento;
                $objeto->observacion =  $observacion;
                $objeto->fechaProximoMantenimiento =  $fechaProximoMantenimiento;
                $objeto ->addMantenimiento();

                $objeto->idVehiculo =  $idVehiculo;
                $objeto ->editCondicion('2'); //en mantenimiento
              
                echo "1";
            } 
            if($datos==4){  
                header("Content-Type: application/json");
                $f = new FuncionesData();
                $llave = $f->radomCodigo();
                $nombre=$llave;
               // Para Método 3
                $datosCompletos = [
                    'arreglo1' => $_POST['arreglo1'],                   
                    'otrosDatos' => [
                        'idItem' => $_POST['otrosDatos']['idItem'],
                        'note' => $_POST['otrosDatos']['note'],
                        'fechaIngreso' => $_POST['otrosDatos']['fechaIngreso'],
                        'fechaSalida' => $_POST['otrosDatos']['fechaSalida']
                    ]
                ];
               
                $idItem =$_POST['otrosDatos']['idItem'];
                $note = $_POST['otrosDatos']['note'];
                $fechaIngreso = $_POST['otrosDatos']['fechaIngreso'];
                $fechaSalida = $_POST['otrosDatos']['fechaSalida']; 
                $arreglo1 = $_POST['arreglo1']; // arreglo de datos            
             
                        $data = json_decode($arreglo1, true);

                        // Verificar si hubo errores al decodificar
                        if (json_last_error() !== JSON_ERROR_NONE) {
                            die("Error al decodificar el JSON: " . json_last_error_msg());
                        }

                        // Acceder al grupo "group-a"
                        $groupA = $data['group-a'];

                        // Recorrer los elementos del grupo
                        foreach ($groupA as $item) {

                    //ordentrabajodetalles  id	codigoOrden	nombre	serial		
                            $objeto = new ItemData();
                            $objeto->codigoOrden =  $llave;
                            $objeto->nombre =  $item['detallesItem'];
                            $objeto->serial =  $item['serialItem'];
                                                        
                            $objeto->condicion =  1;         
                            $objeto->estatus =  1;   
                            $objeto ->addIngresoDetalles();
                            
                   
                        }

                       


                //id	codigo	idItem	idPersonal	idUbicacion	fechaIngreso	fechaSalida	descripcion	condicion	estatus	
                            $objeto = new ItemData();
                            $objeto->idItem =  $idItem;
                            $objeto->descripcion =  $note;
                            $objeto->fechaIngreso =  $fechaIngreso;
                            $objeto->fechaSalida =  $fechaSalida;                           
                            $objeto->codigo =  $llave ;                                 
                            $objeto->condicion =  1;         
                            $objeto->estatus =  1;   
                            $objeto ->addIngreso();


                         //  ordentrabajodetalles  id	codigoOrden	nombre	serial	estatus	condicion	


                    $directorioDestino = "../admin/storage/ingresos/items/";
                  // Procesar cada imagen
                    foreach($_FILES['imagenesItem']['tmp_name'] as $key => $tmp_name) {

                        
                    $nombreArchivo = $_FILES['imagenesItem']['name'][$key];
                    $tipoArchivo = $_FILES['imagenesItem']['type'][$key];
                    $tamanoArchivo = $_FILES['imagenesItem']['size'][$key];
                    $archivoTemporal = $_FILES['imagenesItem']['tmp_name'][$key];
                    $errorArchivo = $_FILES['imagenesItem']['error'][$key];

                   
                    
                    // Validar el archivo
                    if($errorArchivo === UPLOAD_ERR_OK) {
                        // Generar nombre único
                        $nombreUnico = uniqid() . '_' . basename($nombreArchivo);
                        $rutaCompleta = $directorioDestino . $nombreUnico;
                        //echo $rutaCompleta; echo "<br>"; echo $nombreUnico; echo "<br>";
                        // Mover el archivo al directorio destino
                        if(move_uploaded_file($archivoTemporal, $rutaCompleta)) {
                            $respuesta['imagenesItem'][] = array(
                                'nombre_original' => $nombreArchivo,
                                'nombre_servidor' => $nombreUnico,
                                'ruta' => $rutaCompleta,
                                'tamano' => $tamanoArchivo,
                                'tipo' => $tipoArchivo
                            );
                            $objeto_media = new MediaData();
                            $objeto_media->codigo =  $llave;
                            $objeto_media->media =  $rutaCompleta;
                            $objeto_media->estatus =  2; // imagen de ingreso
                            $objeto_media ->add();

                        } else {
                            $respuesta['errores'][] = "Error al mover el archivo: $nombreArchivo";
                        }
                    } else {
                        $respuesta['errores'][] = "Error en el archivo: $nombreArchivo (Código: $errorArchivo)";
                    }
                  
                }
               
                echo $idItem;
                
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
            $objeto = new ItemData();         
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
            $objeto = new ItemData();         
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
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataById($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

       if($datos==333){     // para orden de trabajo   
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataByIdOrdenTrabajo($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

    
    if($datos==33){       
        $clase =$_GET['c'];  // clase
        $tabla = $_GET['t'];  // tabla
        $dato = $_GET['d']; // dato
        $campo = $_GET['cp']; // campo
        
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
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

    if($datos==4){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataByIdAsignacion($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

    if($datos==5){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataByIdAsignaciones($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }

    if($datos==6){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataByIdOrdenesTrabajo($dato);
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
        $estatus = $_GET['s'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataByIdOrdenes($dato,$estatus);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }

    if($datos==8){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getAllOperativos();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    } 

    if($datos==9){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getUltimaOrden();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }  
    if($datos==10){       
        $clase =$_GET['c'];
        $tabla = $_GET['t'];
        $dato = $_GET['d'];
        if(isset($_GET['a'])){
            $a=$_GET['a'];
            }
        if($a==1){
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->getDataMantenimientos($dato);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);

            }
    }

    if($datos==99){              
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->estadisticas();
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);
        
    }

     if($datos==98){       
        // ordenesTrabajo   
        $d =$_GET['d'];    
            $objeto = new ItemData();         
            $result=[];    
                switch($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $result = $objeto->estadisticasOrdenes($d);
                    break;
                }    
            header("Content-Type: application/json");
            echo json_encode($result);
        

            
    }


          


    
    
  

  
}
if($accion==3){
    if($datos==1){     
        
    
            $f = new FuncionesData();       
            $idVehiculo =$_GET['id'];
          
            $serialChasis =$_GET['serialChasis'];
            $color =$_GET['color'];
            $ano =$_GET['ano'];
            $placa =$_GET['placa'];
            $idModelo =$_GET['idModelo'];
            $condicion =$_GET['condicion']; 

            $t = $f->foundValorxValor("item","placa",$placa,"id",$idVehiculo,"ItemData");
            $token = $t->cuenta;
            if($token==1){       

                $objeto = new ItemData();                
                $objeto->id =  $idVehiculo;
                $objeto->placa =  $placa;
                $objeto->idModelo =  $idModelo;
                $objeto->ano =  $ano;
                $objeto->color =  $color;
                $objeto->serialChasis =  $serialChasis;
              
                $objeto->condicion =  $condicion;                   
                $objeto ->edit(); 

                echo "1";

            }else{

                $t = $f->foundValor("item","placa",$placa,"ItemData");
                $id = $t->cuenta;
                if($id==1){
                    echo "2";         
                }else{

                    $objeto = new ItemData();  
                    $objeto->id =  $idVehiculo;   
                    $objeto->placa =  $placa;
                    $objeto->idModelo =  $idModelo;
                    $objeto->ano =  $ano;
                    $objeto->color =  $color;
                    $objeto->serialChasis =  $serialChasis;
                  
                    $objeto->condicion =  $condicion;                   
                    $objeto ->edit(); 
    
                    echo "1";
    
                     
                }

            }
          
           
       
    }
    if($datos==2){
       

            $id = $_POST['id'];
            $idCliente = $_POST['idCliente']; // va // valor para sacar el id del usuario         
            $objeto = new ItemData();           
            $objeto->id =$id;     
            $objeto->idCliente =$idCliente; 
            $objeto->cambiarClienteItem();         
           echo "1";
        }    



}

if($accion==4){
    if($datos==1){
       
            $idOrden = $_POST['id']; //       
            $codigo = $_POST['codigo']; //       
            $objeto = new ItemData();           
            $objeto->idOrden =$idOrden;                
            $objeto->delOrdenTrabajo();
            $objeto->delOrdenTrabajoDetalles($codigo);
            $objeto_media = new MediaData();      
            $result=[];
               $result =$objeto_media->getDataImagenesCodigo($codigo);

            if(count($result)>0){   
                // Eliminar las imágenes asociadas
                $objeto_media->delByCode($codigo,2);
                foreach ($result as $item) {
                    $ruta = $item->image;

                    if(file_exists($ruta)){
                        unlink($ruta);
                      } 
             }
            }

         
          
           
           echo "1";
        }    
}
if($accion==5){
    if($datos==1){
       
            $id = $_POST['id']; // valor para sacar el id del usuario         
            $objeto = new UnidadData();           
            $objeto->id =$id;                
            $objeto->act();
           echo "1";
        }    
}

if($accion==6){
    if($datos==1){       
            $idObjeto = $_POST['id'];
            $id = $_POST['idAsignacion']; // valor para sacar el id del usuario         
            $objeto = new ItemData();           
            $objeto->idObjeto =$idObjeto;  
            $objeto->id =$id;                
            $objeto->liberar();
           echo "1";
        }    
}
if($accion==7){
    if($datos==1){
       


            $idOrden = $_POST['idOrden']; //     
            $idPersonal = $_POST['idPersonal']; //     
            $idUbicacion = $_POST['idUbicacion']; //    
            $placa = $_POST['placa']; //    

            $objeto = new ItemData();           
            $objeto->idOrden =$idOrden;
            $objeto->idPersonal =$idPersonal;              
            $objeto->idUbicacion =$idUbicacion;                                      
            $objeto->asignarPersonalUbicacion();

            $objeto->placa =  $placa;
            $objeto ->editCondicion('1'); // en mantenimiento
           echo "1";
        }    
}

if($accion==88){
    if($datos==1){
       
            $idOrden = $_POST['idOrden']; //     
            $tipoMantenimineto = $_POST['tipoM']; //     
            $tiempoEmpleado = $_POST['tiempo']; //    
            $procedimiento = $_POST['procedimiento']; //    
            $fechaProximo = $_POST['fechaProximo']; //    
            $fechaMantenimiento = $_POST['fechaMantenimiento']; //    
            
            $recomendacion = $_POST['recomendacion']; //   
            $placa = $_POST['placa']; //    

            $objeto = new ItemData();           
            $objeto->idOrden =$idOrden;
            $objeto->dato1 =$tipoMantenimineto;           
            $objeto->dato2 =$tiempoEmpleado;           
            $objeto->dato3 =$procedimiento;           
            $objeto->dato4 =$fechaProximo;           
            $objeto->dato5 =$recomendacion;  
            $objeto->dato6 =$fechaMantenimiento;  

            $objeto->cerrarOrdenTrabajo();
            $objeto->editCondicionOrden('2','2');

            $objeto->placa =  $placa;
            $objeto ->editCondicion('1'); // en mantenimiento
           echo "1";
        }    
}
if($accion==8){
    if($datos==1){
       
            $idOrden = $_POST['idOrden'];
            $idVehiculo = $_POST['idVehiculo']; // va // valor para sacar el id del usuario         
            $objeto = new ItemData();           
            $objeto->idOrden =$idOrden;     
 
            $objeto->cerrarOrden();

            $objeto->idVehiculo =  $idVehiculo;
            $objeto ->editCondicion('1'); // disponible

           echo "1";
        }    
}

?>