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
                            <?php 
                                    $datos = new AseguradoraData(); 
                                    $result = $datos->getAllDatosAseguradoras();
                                    $total=0.00;
                                    $totalv=0.00;
                                    $totalg=0.00;
                                        foreach ($result as $row) {
                                            $totalv = $totalv+$row->vida;
                                            $totalg = $totalg+$row->general;
                                            $total = $total+$row->total;
                                        }
                                        $anio=2022;
                            ?> 
                            <?php 
                                            $datos = new AseguradoraData(); 
                                            $result = $datos->getAllDatosAseguradoras();
                                        
                                            foreach ($result as $row) {        
                                            ?>
                            <div class="card invoice-preview-card">
                                <div class="card-body invoice-padding pb-0">
                                    <!-- Header starts -->
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <p class="card-text mb-25">MARIO PILIERI CARMONA</p>
                                            <p class="card-text mb-25">Corredor de Seguros</p>
                                            <p class="card-text mb-25">Inscrito ante la Superintendencia</p>
                                            <p class="card-text mb-0">de la Actividad Aseguradora Bajo el Nro. 2939</p>
                                        </div>
                                        <div class="mt-md-0 mt-2">
                                            <h4 class="invoice-title">Anexo Nro. 16</h4>
                                            <div class="invoice-date-wrapper">
                                              
                                               
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                                        

                                <!-- Invoice Description starts -->
                                <div class="text-center">
                                                <p class="invoice-date-title">ESTADO DEMOSTRATIVO DE LAS COMISIONES</p>
                                                <p class="invoice-date-title">COBRADAS DURANTE EL EJERCICIO</p>
                                                <p class="invoice-date-title">31/12/<?php echo $anio;?></p> 
                                                <p class="invoice-date-title"><?php echo $row->aseguradora;?></p> 

                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="py-1"></th>
                                                <th class="py-1">VIDA</th>
                                                <th class="py-1">RAMOS GENERALES</th>
                                                <th class="py-1">TOTALES</th>
                                            </tr>
                                           
                                        </thead>                                           
                                        <tbody>
                                        <?php 
                                          
                                            $total=0.00;
                                            $totalv=0.00;
                                            $totalg=0.00;
                                            $total=0.00;
                                            $m=1;
                                            for ($i = 1; $i<=12; $i++) {
                                            //año para editar
                                            if($i==1)
                                                $mes='ENERO';
                                            if($i==2)
                                                $mes='FEBRERO';
                                            if($i==3)
                                                $mes='MARZO';   
                                            if($i==4)
                                                $mes='ABRIL'; 
                                            if($i==5)
                                                $mes='MAYO'; 
                                            if($i==6)
                                                $mes='JUNIO';
                                            if($i==7)
                                                $mes='JULIO'; 
                                            if($i==8)
                                                $mes='AGOSTO';  
                                            if($i==9)
                                                $mes='SEPTIEMBRE'; 
                                            if($i==10)
                                                $mes='OCTUBRE'; 
                                            if($i==11)
                                                $mes='NOVIEMBRE'; 
                                            if($i==12)
                                                $mes='DICIEMBRE';  
                                            $anio=2022;
                                                $balancevida = FuncionesData::balanceDetalleVida($row->id,3,12,$anio,"PagoData");
                                                $balanceV = $balancevida->cuenta;
                                               
                                                $balancegeneral = FuncionesData::balanceDetalleGenerales($row->id,1,2,4,5,12,$anio,"PagoData");
                                                $balanceG = $balancegeneral->cuenta;
                                               $total= $balanceV+$balanceG ;

                                            ?>
                                            <tr>
                                                <td class="py-1">                                                   
                                                    <p class="card-text text-nowrap"><?php echo $mes;?></p>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $balanceV;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $balanceG;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $total;?></span>
                                                </td>
                                            </tr>
                                            <?php
                                          $m=$m+1;
                                                }
                                                ?> 
                                          
                                        </tbody>
                                        
                                            <tr>
                                                <th class="py-1">Totales</th>
                                                <th class="py-1"><?php echo $totalv; ?></th>
                                                <th class="py-1"><?php echo $totalg; ?></th>
                                                <th class="py-1"><?php echo $total; ?></th>
                                            </tr>
                                        
                                    </table>

                                </div>
                             
                            </div>
                            <?php
                                            }
                                ?>
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