<?php
 $tipo = $_POST['tipo']; // 1 para lecciones
 $accion = $_POST['accion']; // 1 para registrar 2 para actualizar 3 para eliminar
 $datos = $_POST['datos']; // 1 pagos 

if($tipo==1){    
 
    if($accion ==3){
        if($datos==1){
                $tasa = $_POST['tasa']; // valor para sacar el id del usuario     
             // echo $tasa;
                $tasa_objeto = new TasaData();            
                $tasa_objeto->update($tasa);
              
               echo "1";
            }      

        }
    
   
   
}
?>