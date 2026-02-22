<?php

$mes =$_GET['mes'];
$ano =$_GET['ano'];
date_default_timezone_set('America/Caracas');
$fecha = date("d-m-Y");	
$datos = new AseguradoraData(); 
$result = $datos->estadisticasBonos();
$total=0.00;
$totalv=0.00;
$totalg=0.00;
$titulo="";
if($mes==1){
    $titulo="ENERO";
}
if($mes==2){
    $titulo="FEBRERO";
}
if($mes==3){
    $titulo="MARZO";
}
if($mes==4){
    $titulo="ABRIL";
}
if($mes==5){
    $titulo="MAYO";
}
if($mes==6){
    $titulo="JUNIO";
}
if($mes==7){
    $titulo="JULIO";
}
if($mes==8){
    $titulo="AGOSTO";
}
if($mes==9){
    $titulo="SEPTIEMBRE";
}
if($mes==10){
    $titulo="OCTUBRE";
}
if($mes==11){
    $titulo="NOVIEMBRE";
}
if($mes==12){
    $titulo="DICIEMBRE";
}











    
   
?>
 <!-- BEGIN: Content-->
 <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-preview-wrapper" >
                    <div class="row invoice-preview">
                        <!-- Invoice -->
                        <div class="col-xl-12 col-md-12 col-12" id="anexo1p" >
                            <div class="card invoice-preview-card">
                                
                                <!-- Header starts -->
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <p class="card-text mb-25">MARIO PILIERI CARMONA</p>
                                            <p class="card-text mb-25">Corredor de Seguros</p>
                                            <p class="card-text mb-25">Inscrito ante la Superintendencia</p>
                                            <p class="card-text mb-0">de la Actividad Aseguradora Bajo el Nro. 2939</p>
                                        </div>
                                        <div class="mt-md-0 mt-2">
                                            <h4 class="invoice-title">Fecha de emisiòn</h4>
                                            <div class="invoice-date-wrapper">
                                               
                                                <p class="invoice-date-title"><?php echo $fecha; ?></p>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                <!-- Invoice Description starts -->
                                <div class="text-center">
                                                <p class="invoice-date-title">ESTADISTICAS</p>
                                                <p class="invoice-date-title"><b><?php echo $titulo; ?> | <?php echo $ano; ?></b></p>  
                                                                 
                                </div>
                                <div class="table-responsive" style="display: grid;justify-content: center;align-items: center;">
                                    <table class="" style="text-align:center;">
                                        <thead>
                                            <tr>    

                                          
                                   
                                         
                                            <th  >ASEGURADORA</th>                                           
                                            <th  >PRIMA</th>
                                            <th  >PRIMA ACUMULADA</th>   
                                            <th  >COMISION</th>                                                                                 
                                            <th  >COMISION ACUMULADA</th>                                           
                                            <th  >BONO</th>   
                                            <th  >BONO ACUMULADO</th>    
                                            <th  >BONO + COMISION</th> 
                                            </tr>

                                        </thead>
                                        <tbody>
                                      
                                        <?php 
                                            $totalbonocomision=0;
                                            $balanceTotalPrima = 0;
                                            $balanceTotalPrimaAcu = 0;

                                            $balanceTotalBono = 0;
                                            $balanceTotalBonoAcu = 0;

                                            $balanceTotalComision = 0;
                                            $balanceTotalComisionAcu = 0;
                                            foreach ($result as $row) {                                             
                                        ?>
                                            <tr>
                                                <td  >
                                                   
                                                    <p class="card-text text-nowrap">
                                                    <?php echo $row->aseguradora;?>
                                                    </p>
                                                </td>
                                              <?php
                                               $balance=0;
                                               $totalC=0;
                                               $totalB=0;
                                               $totalP=0;
                                               $totalBC=0;
                                                //$ano = 
                                              
                                                for ($i = 1; $i<=$mes; $i++) {
                                                    $balancegeneralP = FuncionesData::balanceEstatisticasPrima4($row->id,$i,$ano,"PagoData");
                                                    $balanceP = $balancegeneralP->cuenta;
                                                    $totalP =$totalP + $balanceP;
                                                    $balancegeneralC = FuncionesData::balanceEstatisticas4($row->id,$i,$ano,"PagoData");
                                                    $balanceC = $balancegeneralC->cuenta;
                                                    $totalC =$totalC + $balanceC;
                                                    $balancegeneralB = FuncionesData::balanceEstatisticasBono4($row->id,$i,$ano,"PagoData");
                                                    $balanceB = $balancegeneralB->cuenta;
                                                    $totalB =$totalB + $balanceB;
                                                
                                                ?>                                                               
                                                <?php
                                                }
                                            $balancegeneralEP = FuncionesData::balanceEstatisticasPrima4($row->id,$mes,$ano,"PagoData");
                                            $balanceEP = $balancegeneralEP->cuenta;
                                            // $totalP =$totalP + $balanceP;
                                            $balancegeneralEC = FuncionesData::balanceEstatisticas4($row->id,$mes,$ano,"PagoData");
                                            $balanceEC = $balancegeneralEC->cuenta;
                                            // $totalE =$totalE + $balanceE;
                                            $balancegeneralEB = FuncionesData::balanceEstatisticasBono4($row->id,$mes,$ano,"PagoData");
                                            $balanceEB = $balancegeneralEB->cuenta;
                                            // $totalB =$totalB + $balanceB;
                                            $totalBC = $balanceEC + $balanceEB;
                                            ?>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($balanceEP, 2, ',', '.');?></span>
                                                </td>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($totalP, 2, ',', '.');?></span>
                                                </td>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($balanceEC, 2, ',', '.');?></span>
                                                </td>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($totalC, 2, ',', '.');?></span>
                                                </td>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($balanceEB, 2, ',', '.');?></span>
                                                </td>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($totalB, 2, ',', '.');?></span>
                                                </td>
                                                <td  >
                                                    <span class="fw-bold"><?php echo number_format($totalBC, 2, ',', '.');?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            $balanceTotalPrima=$balanceTotalPrima+$balanceEP;
                                            $balanceTotalPrimaAcu=$balanceTotalPrimaAcu+$totalP;

                                            $balanceTotalBono=$balanceTotalBono+$balanceEB;
                                            $balanceTotalBonoAcu=$balanceTotalBonoAcu+$totalB;

                                            $balanceTotalComision=$balanceTotalComision+$balanceEC;
                                            $balanceTotalComisionAcu=$balanceTotalComisionAcu+$totalC;
                                        $totalbonocomision = $totalbonocomision + $totalBC;
                                                }
                                

                                                ?>       
                                                <tr>                                       
                                           <th>TOTALES</th>
                                           <th><?php echo number_format($balanceTotalPrima, 2, ',', '.');?></th>
                                           <th><?php echo number_format($balanceTotalPrimaAcu, 2, ',', '.');?></th>
                                           <th><?php echo number_format($balanceTotalComision, 2, ',', '.');?></th>
                                           <th><?php echo number_format($balanceTotalComisionAcu, 2, ',', '.');?></th>
                                           <th><?php echo number_format($balanceTotalBono, 2, ',', '.');?></th>
                                           <th><?php echo number_format($balanceTotalBonoAcu, 2, ',', '.');?></th>
                                           <th><?php echo number_format($totalbonocomision, 2, ',', '.');?></th>
                            </tr>
                                
                                        </tbody>
                                    </table>
                                </div>

                              
                         

                             
                            </div>
                        </div>
                        <!-- /Invoice -->

                        <!-- Invoice Actions -->
                        <div class="col-xl-12 col-md-12 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <button class="btn btn-primary w-100 mb-75" id="anexo1">
                                    Generar pdf
                                    </button>                              
                                </div>
                            </div>
                        </div>
                        <!-- /Invoice Actions -->
                    </div>
                </section>

              
           

            </div>
        </div>
    </div>
    <!-- END: Content-->