<?php
 $tipo = $_POST['tipo']; // 1 para lecciones
 $accion = $_POST['accion']; // 1 para registrar 2 para actualizar 3 para eliminar
 $datos = $_POST['datos']; // 1 lecciones
if($tipo==1){    
    if($accion ==1){
        if($datos==1){
           
            $nombreUsuario = $_POST['nombreUsuario']; // valor para sacar el id del usuario
            $f = new FuncionesData();
            $t = $f->foundValor("user","nombreUsuario",$nombreUsuario,"UserData");
            $id = $t->cuenta;
            if($id==1){
                $result = array(['id'=>'0'],['id'=>'1']);
             
                header("Content-Type: application/json");
                echo json_encode($result);

            }else{
                //nombre nombreUsuario confirmContrasena userLevel
                $user_objeto = new UserData();
                $nombre = $_POST['nombre'];           
                $nombreUsuario = $_POST['nombreUsuario'];              
                $userLevel = $_POST['userLevel'];
               
                $password = sha1(md5($_POST['confirmContrasena']));

                $user_objeto->nombre =$nombre;
                $user_objeto->nombreUsuario =$nombreUsuario;
                $user_objeto->password =$password;
                $user_objeto->userLevel =$userLevel;
                $user_objeto->idReferido =1;
                $user_objeto->add();

                $result = $user_objeto->getDataObjeto($nombreUsuario);
                header("Content-Type: application/json");
                echo json_encode($result);

               // echo "1";
            }            
        }
    }
    if($accion ==2){
        if($datos==1){
           
                      
                $user_objeto = new UserData();
                $id = $_POST['id'];        
                $nombre = $_POST['nombre'];           
                $nombreUsuario = $_POST['nombreUsuario'];              
               if($_POST['confirmContrasena']==0){
                $password=0;
               }else{
                $password = sha1(md5($_POST['confirmContrasena']));
               }
               
                
                $user_objeto->id =$id;
                $user_objeto->nombre =$nombre;
                $user_objeto->nombreUsuario =$nombreUsuario;
                $user_objeto->password =$password;              
                $user_objeto->edit();

                echo "1";
            }          
        
    }
    if($accion ==3){
        if($datos==1){
           
                $id = $_POST['id']; // valor para sacar el id del usuario         
                $user_objeto = new UserData();
               
                $user_objeto->id =$id;                
                $user_objeto->delF();
               echo "1";
            }        
    }
    if($accion ==4){
        if($datos==1){
           
                $email = $_POST['email']; // valor para sacar el id del usuario  
               //echo 0;
               // echo $email;   
                $user_objeto = new UserData();     
                $data = $user_objeto->forgotPassword($email);
                $response = count($data);             
                if($response>=1){
                    $emailForgot=$data[0]->nombreUsuario;
                    $nombre=$data[0]->nombre;    
                    $password=$data[0]->password;  
                    $nuevaclave= sha1(md5($password));
                    echo $password; echo "<br>";
                    //echo $nuevaclave;
                    $result = $user_objeto->recoverPassword($email,$nuevaclave);                
                    /*        
                    $asunto = "Tus credenciales de acceso - " . date('d/m/Y');


                    $mensaje = '
                    <!DOCTYPE html>
                    <html lang="es">
                    <head>
                        <meta charset="UTF-8">
                        <title>Credenciales de Acceso</title>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                                color: #333;
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                            }
                            .header {
                                background-color: #0066cc;
                                color: white;
                                padding: 20px;
                                text-align: center;
                                border-radius: 5px 5px 0 0;
                            }
                            .content {
                                padding: 20px;
                                background-color: #f9f9f9;
                                border: 1px solid #ddd;
                                border-top: none;
                            }
                            .credentials {
                                background-color: #fff;
                                border: 1px solid #ddd;
                                padding: 15px;
                                margin: 15px 0;
                                border-radius: 4px;
                            }
                            .footer {
                                margin-top: 20px;
                                font-size: 12px;
                                color: #777;
                                text-align: center;
                            }
                            .button {
                                display: inline-block;
                                padding: 10px 20px;
                                background-color: #0066cc;
                                color: white;
                                text-decoration: none;
                                border-radius: 4px;
                                margin-top: 15px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h2>Credenciales de Acceso</h2>
                        </div>
                        <div class="content">
                            <p>Hola '.htmlspecialchars($nombre).',</p>
                            <p>A continuación encontrarás tus credenciales para acceder a nuestro sistema:</p>
                            
                            <div class="credentials">
                                <p><strong>Usuario:</strong> '.htmlspecialchars($emailForgot).'</p>
                                <p><strong>Contraseña:</strong> '.htmlspecialchars($password).'</p>
                            </div>
                            
                            <p>Por seguridad, te recomendamos cambiar tu contraseña después de iniciar la sesión.</p>                       
                            
                            <p>Si no solicitaste estas credenciales, por favor ignora este mensaje o contacta con nuestro soporte.</p>
                        </div>
                        <div class="footer">
                            <p>© '.date('Y').' guslaya.com. Todos los derechos reservados.</p>
                            <p>Este es un mensaje automático, por favor no respondas directamente a este correo.</p>
                        </div>
                    </body>
                    </html>
                    ';

                    
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                    $headers .= "From: Soporte <soporte@guslaya.com>\r\n";
                    $headers .= "Reply-To: no-responder@guslaya.com\r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion();
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "soporte@guslaya.com";
                    $to = $emailForgot;
                    $subject = $asunto;
                    $message = $mensaje;          
                    if(mail($to,$subject,$message, $headers)) {
                    echo "1";        
                    } else {
                    echo "99";        
                    }         */ 
                    
                 echo "1"; // Enviar correo exitosamente
                }else{
                echo "0"; // No se encontró el usuario
                }   
            }
    }
   
    }
//https://drive.google.com/file/d/1qFVV9EQki5CpzGxH3mTq36_7LW9prgIl/view?usp=sharinghttps://drive.google.com/file/d/1qFVV9EQki5CpzGxH3mTq36_7LW9prgIl/view?usp=sharing
//hcHojq23
//b23c45bfa259cdde56b9de4661d91f827b186c67
?>