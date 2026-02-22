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
if($tipo==1){    
   
    if($accion==2){
        if($datos==1){
                if (is_array($_FILES) && count($_FILES) ==1) {        
                    if (($_FILES["file1"]["type"] == "image/webp") || ($_FILES["file1"]["type"] == "image/jpeg") || ($_FILES["file1"]["type"] == "image/jpg") || ($_FILES["file1"]["type"] == "image/png")) {
                    if (move_uploaded_file($_FILES["file1"]["tmp_name"], "../admin/storage/logo/".$_FILES['file1']['name'])) {      
                       
                       
                             $user_objeto = new EmpresaData();
                            //echo "Llegue";
                            $name = $_GET['name'];              
                            $email = $_GET['email'];
                            $telefonos = $_GET['telefonos'];
                            $rif = $_GET['rif'];
                            $direccion = $_GET['direccion'];                 
                        
                            $user_objeto->name =$name;
                            $user_objeto->email =$email;
                        
                            $user_objeto->telefonos =$telefonos;
                            $user_objeto->rif =$rif;
                            $user_objeto->dir =$direccion;
                            $user_objeto->update();

                            $archivo = "../admin/storage/logo/".$_FILES['file1']['name'];
                            
                            rename($archivo, "../admin/storage/logo/logo.webp");                          
                     
                

                        echo "1";
    
                    
                    } else {
                        echo 0;  
                    }
                } else {
                    echo 2;
                }                
                

                } else {
                
                       $user_objeto = new EmpresaData();
                            //echo "Llegue";
                            $name = $_GET['name'];              
                            $email = $_GET['email'];
                            $telefonos = $_GET['telefonos'];
                            $rif = $_GET['rif'];
                            $direccion = $_GET['direccion'];                 
                        
                            $user_objeto->name =$name;
                            $user_objeto->email =$email;
                        
                            $user_objeto->telefonos =$telefonos;
                            $user_objeto->rif =$rif;
                            $user_objeto->dir =$direccion;
                            $user_objeto->update();
                      
                     

                          
                              echo "1";

            }





       


            
          
        }
    }  

    if($accion==3){
        if($datos==1){
           // data:{text:$text,smtp:$smtp,password:$password,host:$host,puerto:$puerto,tipo:tipo,accion:accion,datos:datos},
            $user_objeto = new EmpresaData();
           
            $text = $_POST['text'];              
            $smtp = $_POST['smtp'];
            $password = $_POST['password'];
            $host = $_POST['host'];
            $port = $_POST['port'];
         
            $user_objeto->text =$text;
            $user_objeto->smtp =$smtp;
            $user_objeto->password =$password;
            $user_objeto->host =$host;
            $user_objeto->port =$port;
            $user_objeto->updateCorreo();

            $result = $user_objeto->getAllDatosCorreo();
            header("Content-Type: application/json");
            echo json_encode($result);
          
        }
    }  
   
   
}
?>




