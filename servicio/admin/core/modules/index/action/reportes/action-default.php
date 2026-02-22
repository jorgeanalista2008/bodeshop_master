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

        $id=$_GET["d"]; 
    
        $datos = new ItemData(); 
        $result = $datos->getDataByIdOrdenTrabajo($id);  
      
     function SmartCell($pdf, $x, $y, $text, $maxWidth = 0, $height = 5, $border = 0, $align = 'L') {
   	 $pdf->SetXY($x, $y);
    
    // Si no hay máximo width o el texto cabe
    if ($maxWidth == 0 || $pdf->GetStringWidth($text) < $maxWidth) {
        $width = $pdf->GetStringWidth($text) + 2;
        $pdf->Cell($width, $height, $text, $border, 0, $align);
    } else {
        // Si no cabe, usamos MultiCell
        $pdf->MultiCell($maxWidth, $height, $text, $border, $align);
    }
}

        $pdf = new PDF($orientation='P',$unit='mm');
        $pdf->AddPage();

        $hoy = getdate();
        
           
			$pdf = new PDF($orientation='L',$unit='mm');
			$pdf->AddPage();			
			$textypos = 5;
		
			$pdf->SetFont('Arial','B',10);    
			$pdf->setY(10);
			$pdf->setX(40);	
			$pdf->Cell(50,30,$_SESSION['tenancy_name'],0,0,"C");
			
			$pdf->SetFont('Arial','B',15);    
			$pdf->setX(10);	
			$pdf->Cell(279,30,utf8_decode("RECEPCIÓN DE EQUIPO"),1,0,"C");			
			//$pdf->Image('../admin/storage/logo/logo.png', 15 ,12, 25 , 25,'PNG');
			$pdf->SetFont('Arial','B',12);    
			$pdf->setY(22);
			$pdf->setX(235);
			$pdf->Cell(5,$textypos,utf8_decode("N° orden:").$id);
			$pdf->Ln();
			$pdf->SetFont('Arial','B',10);    
			$pdf->setY(42);
			$pdf->setX(10);
			$pdf->Cell(5,$textypos,"FECHA DE INGRESO:".$result[0]->fechaIngreso);
		
			$pdf->setX(217);
			$pdf->Cell(5,$textypos,"FECHA ESTIMADA DE SALIDA:".$result[0]->fechaSalida);
			$pdf->setY(47);
			$pdf->setX(10);
			$pdf->Line(10, 48, 288,48);
			$pdf->setY(49);
			$pdf->setX(10);
			$pdf->Cell(279,27,"",1,0,"C");
			$pdf->setX(10);
			$pdf->setY(50);
            
			$pdf->SetFont('Arial','',10);    
			$pdf->Cell(5,$textypos,"CLIENTE: ".$result[0]->dato1."-".$result[0]->dato2);
			$pdf->setY(55);

			$pdf->Cell(5,$textypos,"TELEFONO: ".$result[0]->dato3);
			$pdf->setY(60);
			$pdf->Cell(5,$textypos,"CORREO: ".$result[0]->dato4);
			
					
			$pdf->setY(50);$pdf->setX(180);
			$pdf->Cell(5,$textypos,utf8_decode("TIPO: ").$result[0]->tipo);
			$pdf->setY(55);$pdf->setX(180);
			$pdf->Cell(5,$textypos,utf8_decode("MARCA: ").$result[0]->marca);
			$pdf->setY(60);$pdf->setX(180);
			$pdf->Cell(5,$textypos,utf8_decode("MODELO: ").$result[0]->modelo);			
		
			$pdf->setY(65);$pdf->setX(10);
			$pdf->Cell(5,$textypos,utf8_decode("UBICACIÓN: ").$result[0]->dato6);			
			$pdf->setY(70);$pdf->setX(10);
			$pdf->Cell(5,$textypos,utf8_decode("TÉNICO ENCARGADO: ").$result[0]->dato5);
			$pdf->setY(78);$pdf->setX(113);
			$pdf->SetFont('Arial','B',12);    
			$pdf->Cell(5,$textypos,"COMPONENTES O ACCESORIOS");
			$pdf->SetFont('Arial','',10);    
			$pdf->Ln();			
			$pdf->setY(85);
			$pdf->setX(10);
			$header = array(utf8_decode("N°"),utf8_decode("DESCRIPCION"),"SERIAL");
	
				$pdf->SetFillColor(230, 230, 230);
					$pdf->SetTextColor(0);
					$pdf->SetDrawColor(100, 100, 100);
					$pdf->SetLineWidth(0.3);
					$pdf->SetFont('Arial', 'B', 10);
			// Column widths
			$w = array(10,165,104);
			// Header
			for($i=0;$i<count($header);$i++)
				$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
			$pdf->Ln();

					$pdf->SetFillColor(245, 245, 245);
					$pdf->SetTextColor(0);
					$pdf->SetFont('Arial', '', 9);


			$n=1;
	 		$result2=$datos->getOrdenTrabajoDetalles($result[0]->codigo);  
			foreach($result2 as $dato)

			{   

			
				$nombre = $dato->nombre;
				$serial = $dato->serial;                                           
			   		
  				$pdf->Cell($w[0],6,$n,1,0,'C');
				$pdf->Cell($w[1],6,$nombre,1,0,'C');
				$pdf->Cell($w[2],6, utf8_decode($serial),1,0,'C');
			
			
				$pdf->Ln();
				//$total+= $precio*$cantidad;
				$n++;

  		  }
		  //// Apartir de aqui esta la tabla con los subtotales y totales
		  $yposdinamic =  60 + (count($result2)*10);		
		
		  $pdf->setY($yposdinamic);
		  //$pdf->setX(235);
		  $pdf->Ln();
		  //$pdf->Line(10, $yposdinamic+10, 200, $yposdinamic+10);
		// $pdf->Line(10, $yposdinamic+20, 288, $yposdinamic+20);
		 $pdf->Ln();
		 $pdf->setY($yposdinamic+20);


		 //$pdf->Cell(135,25,utf8_decode("PROBLEMA REPORTADO: " ).$result[0]->descripcion,1,0,"L");

		 SmartCell($pdf,10, $yposdinamic+30,"PROBLEMA REPORTADO: ".utf8_decode($result[0]->descripcion), 279, 5, 1);
		// SmartCell($pdf,10, $yposdinamic+35,utf8_decode("DIAGNÓSTICO RÁPIDO: ").utf8_decode($result[0]->descripcion), 279, 5, 1);
		 $pdf->SetFont('Arial','B',10);    
		
		
		
			
			$pdf->setY($yposdinamic+60);

			$pdf->setX(30);
			$pdf->Cell(70,25,utf8_decode("__________________________ "),0,0,"C");

			$pdf->setX(180);
			$pdf->Cell(70,25,utf8_decode("__________________________ "),0,0,"C");
			$pdf->setY($yposdinamic+64);
			$pdf->setX(30);
			$pdf->Cell(70,25,utf8_decode("Firma cliente "),0,0,"C");	
			$pdf->setX(182);
			$pdf->Cell(70,25,utf8_decode("Personal receptor "),0,0,"C");

		
			

				// Posición a 1.5 cm del final
					$pdf->SetY(-30);
					// Arial italic 8
					$pdf->SetFont('Arial', 'I', 8);
					// Fecha y hora de generación
					$pdf->Cell(0, 5, 'Generado el '.date('d/m/Y H:i'), 0, 0, 'L');
					// Número de página
					$pdf->Cell(0, 5, 'Pagina '.$pdf->PageNo(), 0, 0, 'R');
					$pdf->Output("I","ordendeingreso".$id.".pdf",true);
			

		

    
      
    }
}     

?>
