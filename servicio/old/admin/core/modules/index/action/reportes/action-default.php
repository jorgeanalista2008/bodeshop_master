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
  if($accion==1){
    if($datos==1){     

        $id=$_GET["id"]; 
      //  echo $id;
        $datos = new VehiculoData(); 
        $result = $datos->getDataByIdOrden($id,'1');    
       // print_r($result);
        
        $pdf = new PDF($orientation='P',$unit='mm');
        $pdf->AddPage();

        $hoy = getdate();
        
            $dia = $hoy['mday'];
			$mes = $hoy['mon'];
			$anio = $hoy['year'];
            $fecha =  $dia .'/'.$mes.'/'.$anio;
        $textypos = 5;
        $pdf->setY(12);
        $pdf->setX(10);
        // Agregamos los datos de la empresa 
        $pdf->SetFont('Arial','',10);  
        $pdf->setY(10);$pdf->setX(75);
        $pdf->Cell(5,$textypos,utf8_decode("REPÚBLICA BOLIVARIANA DE VENEZUELA"));  
        $pdf->setY(15);$pdf->setX(65);
        $pdf->Cell(5,$textypos,utf8_decode('MINISTERIO DEL PODER POPULAR PARA LA DEFENSA'));
        $pdf->setY(20);$pdf->setX(75);
        $pdf->Cell(5,$textypos,utf8_decode('COMANDO ESTRATÉGICO OPERACIONAL'));
        $pdf->setY(25);$pdf->setX(68);
        $pdf->Cell(5,$textypos,utf8_decode('COMANDO DE DEFENSA AEROESPACIAL INTEGRAL'));       
        $pdf->setY(30);$pdf->setX(45);
        $pdf->Cell(5,$textypos,utf8_decode('CENTRO DE SERVICIOS LOGÍSTICOS DE DEFENSA AEROESPACIAL INTEGRAL'));
        $pdf->setY(35);$pdf->setX(80);
        $pdf->Cell(5,$textypos,utf8_decode('DIRECCIÓN DE APOYO LOGÍSTICO'));
        $pdf->setY(40);$pdf->setX(70);
        $pdf->Cell(5,$textypos,utf8_decode('SERVICIO DE TRANSPORTE DEL CESERLODAI'));

        $pdf->setY(45);$pdf->setX(80);
        $pdf->Cell(5,$textypos,utf8_decode('ORDEN DE SALIDA DE VEHÍCULO'));
        $pdf->Image('../app-assets/images/logo/logo_recibo_2.jpg' , 175 ,8, 25 , 25,'JPG');
 
        $pdf->setY(50);$pdf->setX(86);
        $pdf->SetFont('Arial','B',12);  
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(5,$textypos,utf8_decode('TRANSP-').$id.'-'.$result[0]->fechaSalida);
        $pdf->SetTextColor(0, 0, 0);
       
        $pdf->SetFont('Arial','',10);  
        $pdf->setY(100);$pdf->setX(70);
        $pdf->Cell(5,$textypos,utf8_decode('GUIA DE VERIFICACIÓN DEL VEHÍCULO'));
        $pdf->Ln();
    
       
        $pdf->setY(60);
        $pdf->Cell(195,5,utf8_decode('QUIEN SUSCRIBE HACE CONSTAR QUE EL: ' .$result[0]->g1.' '.$result[0]->nombreCompletoChofer.' PORTADOR DE LA CI Nª: '.$result[0]->c1),0,1,'FJ',0);
        $pdf->setY(65);
        $pdf->Cell(195,5,utf8_decode('ESTÁ AUTORIZADO PARA CONDUCIR EL VEHÍCULO: '.$result[0]->tipo.'  MARCA: ' .$result[0]->marca),0,1,'FJ',0);
        $pdf->setY(70);
        $pdf->Cell(195,5,utf8_decode('PLACA O SERIAL: '.$result[0]->placa.' COLOR: '.$result[0]->color.' SISTEMA DE ARRASTRE TIPO: ______________ '),0,1,'FJ',0);
        $pdf->setY(75);
        $pdf->Cell(195,5,utf8_decode('SERIAL: _______________ COLOR: ________________ A CARGO DE: '.$result[0]->g2.' ' .$result[0]->nombreCompletoACargo),0,1,'FJ',0);
        $pdf->setY(80);
        $pdf->Cell(195,5,utf8_decode('PORTADOR DE LA CI Nª:'.$result[0]->c2.' CON LA FINALIDAD DE EJECUTAR COMISIÓN DE SERVICIO'),0,1,'FJ',0);
       // $pdf->MultiCell(5,$textypos,);
        $pdf->setY(85);
        $pdf->Cell(5,$textypos,utf8_decode('EN ASUNTO DE: '.$result[0]->asunto.' EN LA RUTA ESTABLECIDA DE CONFORMIDAD AL'));
        $pdf->setY(90);
        $pdf->Cell(5,$textypos,utf8_decode('ITINERARIO DE :'.$result[0]->ruta.'.'));
        /*
        
        $pdf->setY(65);$pdf->setX(10);
		$pdf->Line(10, 65, 200,65);
        
		$pdf->setY(65);$pdf->setX(10);
		$pdf->Cell(190,20,"",1,0,"C");
*/
        $pdf->setY(105);$pdf->setX(5);
        $header = array("N.", "ASPECTOS A CHEQUEAR","B","R","M","N.","ASPECTOS A CHEQUEAR","B","R","M");
        $w = array(5, 65, 10, 10, 10,5,65,10,10,10);         
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
        $pdf->Ln();


            $r1=$result [0]->r1; $r11=$result [0]->r11;
            $r2=$result [0]->r2;  $r12=$result [0]->r12;
            $r3=$result [0]->r3;  $r13=$result [0]->r13;
            $r4=$result [0]->r4;  $r14=$result [0]->r14;
            $r5=$result [0]->r5;  $r15=$result [0]->r15;
            $r6=$result [0]->r6;  $r16=$result [0]->r16;
            $r7=$result [0]->r7;  $r17=$result [0]->r17;
            $r8=$result [0]->r8;  $r18=$result [0]->r18;
            $r9=$result [0]->r9;  $r19=$result [0]->r19;
            $r10=$result [0]->r10;  $r20=$result [0]->r20;
            /* 'r2' =>$result [0]->r2,  'r3' =>$result [0]->r3, 'r4' =>$result [0]->r4,  'r5' =>$result [0]->r5,
            'r6' =>$result [0]->r6, 'r7' =>$result [0]->r7,  'r8' =>$result [0]->r8, 'r9' =>$result [0]->r9,  'r10' =>$result [0]->r10,
            'r11' =>$result [0]->r11, 'r12' =>$result [0]->r12,  'r13' =>$result [0]->r13, 'r14' =>$result [0]->r14,  'r15' =>$result [0]->r15,
            'r16' =>$result [0]->r16, 'r17' =>$result [0]->r17,  'r18' =>$result [0]->r18, 'r19' =>$result [0]->r19,  'r20' =>$result [0]->r20*/

     
/////////////////////////////////////////////////////////////////    1  /////////////////////////////////////////////
        $pdf->setY(112);
        $pdf->setX(5);$pdf->Cell(5,5,"1",1,0,"C"); 
        $pdf->setX(10);$pdf->Cell(65,5,"Nivel de aceite de motor:",1,0,"C");
        if($r1==1){
            $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r1==2){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r1==3){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
        }
        $pdf->setX(105);$pdf->Cell(5,5,"11",1,0,"C"); 
        $pdf->setX(110);$pdf->Cell(65,5,"Luces de Emergencia:",1,0,"C");
        if($r11==1){
            $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r11==2){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r11==3){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
        }

        ////////////////////////////////////////////         2           ///////////////////////////////////////////


        $pdf->setY(117);
        $pdf->setX(5);$pdf->Cell(5,5,"2",1,0,"C"); 
        $pdf->setX(10);$pdf->Cell(65,5,"Nivel de aceite de caja:",1,0,"C");
        if($r2==1){
            $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r2==2){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r2==3){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
        }
        $pdf->setX(105);$pdf->Cell(5,5,"12",1,0,"C"); 
        $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Presión de aire neumáticos:'),1,0,"C");
        if($r12==1){
            $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r12==2){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r12==3){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
        }
        //////////////////////////////////////////               3                    ////////////////////////////////////////////////

        $pdf->setY(122);
        $pdf->setX(5);$pdf->Cell(5,5,"3",1,0,"C"); 
        $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Nivel de agua de batería:'),1,0,"C");
        if($r3==1){
            $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r3==2){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r3==3){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
        }
        $pdf->setX(105);$pdf->Cell(5,5,"13",1,0,"C"); 
        $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Limpia parabrisas:'),1,0,"C");
        if($r13==1){
            $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r13==2){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r13==3){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
        }
        
        /////////////////////////////////////////////            4                ////////////////////////////////////
    //    Nivel de combustible:
        //Neumático de repuesto:
        $pdf->setY(127);
        $pdf->setX(5);$pdf->Cell(5,5,"4",1,0,"C"); 
        $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Nivel de combustible:'),1,0,"C");
        if($r4==1){
            $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r4==2){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r4==3){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
        }
        $pdf->setX(105);$pdf->Cell(5,5,"14",1,0,"C"); 
        $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Neumático de repuesto:'),1,0,"C");
        if($r14==1){
            $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r14==2){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r14==3){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
        }
        
        ///////////////////////////////////                      5                 ////////////////////////////////////////////////
        

               // Nivel de agua del radiador:
                //Gato y llave de cruz:
        
        $pdf->setY(132);
        $pdf->setX(5);$pdf->Cell(5,5,"5",1,0,"C"); 
        $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Nivel de agua del radiador:'),1,0,"C");
        if($r5==1){
            $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r5==2){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r5==3){
            $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
        }
        $pdf->setX(105);$pdf->Cell(5,5,"15",1,0,"C"); 
        $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Gato y llave de cruz:'),1,0,"C");
        if($r15==1){
            $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        } 
        if($r15==2){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
        }
        if($r15==3){
            $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
        }
             ///////////////////////////////////                      6                 ////////////////////////////////////////////////
    
        
                $pdf->setY(137);
                $pdf->setX(5);$pdf->Cell(5,5,"6",1,0,"C"); 
                $pdf->setX(10);$pdf->Cell(65,5,utf8_decode(' Nivel de liga de frenos:'),1,0,"C");
                if($r6==1){
                    $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                } 
                if($r6==2){
                    $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                }
                if($r6==3){
                    $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
                }
                $pdf->setX(105);$pdf->Cell(5,5,"16",1,0,"C"); 
                $pdf->setX(110);$pdf->Cell(65,5,utf8_decode(' Triángulo de seguridad:'),1,0,"C");
                if($r16==1){
                    $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                } 
                if($r16==2){
                    $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                }
                if($r16==3){
                    $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
                }
        
                ///////////////////////////////////                      7                ////////////////////////////////////////////////
    
        


                $pdf->setY(142);
                $pdf->setX(5);$pdf->Cell(5,5,"7",1,0,"C"); 
                $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Indicadores y medidores:'),1,0,"C");
                if($r7==1){
                    $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                } 
                if($r7==2){
                    $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                }
                if($r7==3){
                    $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
                }
                $pdf->setX(105);$pdf->Cell(5,5,"17",1,0,"C"); 
                $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Extintor:'),1,0,"C");
                if($r17==1){
                    $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                } 
                if($r17==2){
                    $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                }
                if($r17==3){
                    $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
                }
        
                 ///////////////////////////////////                      8                ////////////////////////////////////////////////
    
        

             
          

                 $pdf->setY(147);
                 $pdf->setX(5);$pdf->Cell(5,5,"8",1,0,"C"); 
                 $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Luces altas y bajas:'),1,0,"C");
                 if($r8==1){
                     $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                 } 
                 if($r8==2){
                     $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                 }
                 if($r8==3){
                     $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
                 }
                 $pdf->setX(105);$pdf->Cell(5,5,"18",1,0,"C"); 
                 $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Espejo retrovisor:'),1,0,"C");
                 if($r18==1){
                     $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                 } 
                 if($r18==2){
                     $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                 }
                 if($r18==3){
                     $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
                 }
          
          //////////////////////////////////                      9               ////////////////////////////////////////////////
    
        
                 $pdf->setY(152);
                 $pdf->setX(5);$pdf->Cell(5,5,"9",1,0,"C"); 
                 $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Direccionales:'),1,0,"C");
                 if($r9==1){
                     $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                 } 
                 if($r9==2){
                     $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                 }
                 if($r9==3){
                     $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
                 }
                 $pdf->setX(105);$pdf->Cell(5,5,"18",1,0,"C"); 
                 $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Juego de herramientas:'),1,0,"C");
                 if($r19==1){
                     $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                 } 
                 if($r19==2){
                     $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                 }
                 if($r19==3){
                     $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
                 }
         

                   //////////////////////////////////                      10              ////////////////////////////////////////////////

        
                   $pdf->setY(157);
                   $pdf->setX(5);$pdf->Cell(5,5,"10",1,0,"C"); 
                   $pdf->setX(10);$pdf->Cell(65,5,utf8_decode('Luces de frenos::'),1,0,"C");
                   if($r10==1){
                       $pdf->setX(75);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                   } 
                   if($r10==2){
                       $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5," ",1,0,"C");
                   }
                   if($r10==3){
                       $pdf->setX(75);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(85);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(95);$pdf->Cell(10,5,"M",1,0,"C");
                   }
                   $pdf->setX(105);$pdf->Cell(5,5,"20",1,0,"C"); 
                   $pdf->setX(110);$pdf->Cell(65,5,utf8_decode('Licencia y certificado:'),1,0,"C");
                   if($r20==1){
                       $pdf->setX(175);$pdf->Cell(10,5,"B",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                   } 
                   if($r20==2){
                       $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5,"R",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5," ",1,0,"C");
                   }
                   if($r20==3){
                       $pdf->setX(175);$pdf->Cell(10,5," ",1,0,"C");   $pdf->setX(185);$pdf->Cell(10,5," ",1,0,"C");  $pdf->setX(195);$pdf->Cell(10,5,"M",1,0,"C");
                   }
        
                    
                   $pdf->setY(167); 
                   $pdf->Cell(195,5,utf8_decode('NOTA: EL JEFE DE LA COMISIÓN Y EL CONDUCTOR DEL VEHÍCULO DEBERÁN FIRMAR AL DORSO DE LA PRESENTE'),0,1,'FJ',0); 
                   $pdf->setY(172); 
                   $pdf->Cell(195,5,utf8_decode('AUTORIZACIÓN COMO CONSTANCIA DE ESTAR EN CONOCIMIENTO DE LAS DISPOSICIONES Y NORMATIVAS '),0,1,'FJ',0);
                   $pdf->setY(177); 
                   $pdf->Cell(5,$textypos,utf8_decode('VIGENTES DURANTE LA COMISIÓN.'));

                   $pdf->setY(182); 
                   $pdf->Cell(5,$textypos,utf8_decode('OBSERVACIONES:______________________________________________________________________________________'));  
                   $pdf->setY(187); 
                   $pdf->Cell(5,$textypos,utf8_decode('___________________________________________________________________________________________________'));
                   $pdf->setY(192); 
                   $pdf->Cell(5,$textypos,utf8_decode('___________________________________________________________________________________________________.'));      
                   
                   $pdf->setY(205);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('___________________________'));  
                   $pdf->setX(80);
                   $pdf->Cell(5,$textypos,utf8_decode('___________________________'));  

                   $pdf->setX(145);
                   $pdf->Cell(5,$textypos,utf8_decode('_____________________________'));

                   $pdf->setY(210); 
                   $pdf->setX(15);

                   $pdf->Cell(5,$textypos,utf8_decode('JEFE DE LA COMISIÓN'));  


                   $pdf->setX(95);
                   $pdf->Cell(5,$textypos,utf8_decode('CONDUCTOR'));  

                   $pdf->setX(147);
                   $pdf->Cell(5,$textypos,utf8_decode('JEFE DE LOS SERVICIOS DEL '));

                   $pdf->setY(215); 
                   $pdf->setX(162);
                   $pdf->Cell(5,$textypos,utf8_decode('CESERLODAI'));  


                   $pdf->setY(245); 
                   $pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('_____________________________________')); 
                   $pdf->setX(130);
                   $pdf->Cell(5,$textypos,utf8_decode('_____________________________________'));  

                   $pdf->setY(255); 
                   $pdf->setX(15);
                   $pdf->Cell(5,$textypos,utf8_decode('JEFE DEL SERVICIO DE TRANSPORTE')); 
                   $pdf->setX(135);
                   $pdf->Cell(5,$textypos,utf8_decode('DIRECTOR DE APOYO LOGÍSTICO DEL'));  

                   $pdf->setY(260); 
                   $pdf->setX(35);
                   $pdf->Cell(5,$textypos,utf8_decode('CESERLODAI'));
                   $pdf->setX(155);
                   $pdf->Cell(5,$textypos,utf8_decode('CESERLODAI'));  

                   $pdf->AddPage();

                   $pdf->SetFont('Arial','',10);  
                   $pdf->setY(15);$pdf->setX(60);$pdf->SetFont('Arial','B',10);  
                   $pdf->Cell(5,$textypos,utf8_decode("ASPECTOS ACONSIDERAR POR EL JEFE DE LA COMISIÓN"));  
                   $pdf->SetFont('Arial','',10);
                   $pdf->setY(20);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('1. Será responsable por el buen desarrollo y desenvolvimiento de la comisión.'));
                   $pdf->setY(25);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('2. El único autorizado para condicir el vehìculo es conductor designado mediante la presente orden de salida.'));
                   $pdf->setY(30);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('3. El desplazamiento de vehículos militares antes de las 06:00 hrs y después de las 18:00 hrs está terminantemente prohibido'));       
                   $pdf->setY(35);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('salvo aquellos caso caso autotizados previamente por el comandante de la unidad.'));
                   $pdf->setY(40);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('4. No estará autorizado para transportar personas ajenas a la misma, sin conocimiento del comandante de la unidad.'));
                   $pdf->setY(45);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('5. No podrá desviarse de la ruta estipulada, salvo aquellos casos autorizados previamente por el comandante de la unidad.'));

                   $pdf->setY(50);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('6. Deberá coordinar algún medio de comunicación que le permita mantener contacto con el comandante de la unidad.'));
                   $pdf->setY(55);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('7. Velará por la seguridad física del vehículo durante la comisión.'));
                   $pdf->setY(60);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('8. Será responsable de controlar y supervisar que el conductor del vehículo cumpla con todas las disposiciones vigentes dentro'));
                   $pdf->setY(65);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('de la ley de tránsito terrestre.'));
                   $pdf->setY(70);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('9. Deberá vigilar y estar atento, a fin de evitar alguna imprudencia del conductor que pudiera ocasionar algún accidente y/o retar '));
                   $pdf->setY(75);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('-do en la comisión.'));

                   $pdf->setY(80);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('10. Deberá estar atento y pendiente del funcionamiento del vehículo considerando aspectos de inspección antes, durante y des'));
                   $pdf->setY(85);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('-pués de la marcha.'));

                   $pdf->setY(90);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('11. Velará, coordinará y es responsable en todo respectivo a viáticos de la comisión (hospedaje, alimentación, combustible).'));

                   $pdf->setY(95);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('12. Una ve cumplida la comisión deberá entregar el vehículo y la orden de salída en la oficina del servicio de transporte del '));
                   $pdf->setY(100);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('CESERLODAI para el chequeo y archivo del documento respectivamente.'));
                   

                   $pdf->setY(120);$pdf->setX(20);
                   $pdf->Cell(5,$textypos,utf8_decode($result[0]->g2.' ' .$result[0]->nombreCompletoACargo));
                   $pdf->setY(125);$pdf->setX(20);
                   $pdf->Cell(5,$textypos,utf8_decode('JEFE DE LA COMISIÓN'));
                    

                   $pdf->setY(135);$pdf->setX(60);  $pdf->SetFont('Arial','B',10);  
                   $pdf->Cell(5,$textypos,utf8_decode("ASPECTOS ACONSIDERAR POR EL CONDUCTOR DEL VEHÍCULO"));  
                   $pdf->SetFont('Arial','',10);
                   $pdf->setY(140);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('1. Mantendrá el vehículo limpio y en buen estado durante la comisión. '));

                   $pdf->setY(145);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('2. Inspeccionará el vehículo antes, durante y después de cumplir con la comisión asignada, según la guía de verificación corres'));
                   $pdf->setY(150);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('-pondiente.'));

                   
                   $pdf->setY(155);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('3. Informará sobre las novedades de operatividad o desperfectos que pueda presentar el vehículo durante la comisión.'));
                  
                  
                   $pdf->setY(160);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('4. Por ningún motivo se desviará de la ruta e itinerario establecido para realizar la comisión.'));

                   $pdf->setY(165);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('5. No montará personas extrañas en el vehículo durante la comisión.'));
                 
                   
                   $pdf->setY(170);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('6. Mantendrá la velocidad de marcha del vehículo en los límites establecidos.'));

                   $pdf->setY(175);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('7. Cumplirá estrictamente con las leyes de transito terrestes.'));

                   $pdf->setY(180);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('8. Verificará que su licencia de conducir y certificado médico estén actualizados.'));

                   $pdf->setY(185);$pdf->setX(5);
                   $pdf->Cell(5,$textypos,utf8_decode('9. En caso de percibir un desperfecto en el vehículo o situación que ponga en peligro la vida o seguridad física de los pasajeros'));
                   $pdf->setY(190);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('o del vehículo, deberá informar al jefe de ka comisión quien a su vez informará al jefe del servicio de transporte del '));
                   $pdf->setY(195);$pdf->setX(10);
                   $pdf->Cell(5,$textypos,utf8_decode('CESERLODAI.'));


                   $pdf->setY(215);$pdf->setX(20);
                   $pdf->Cell(5,$textypos,utf8_decode($result[0]->g1.' ' .$result[0]->nombreCompletoChofer));
                   $pdf->setY(220);$pdf->setX(20);
                   $pdf->Cell(5,$textypos,utf8_decode('CONDUCTOR DEL VEHÍCULO'));
                  
                   $pdf->Output("I","orden_salida-".$id.".pdf",true);
      
    }}     

?>
