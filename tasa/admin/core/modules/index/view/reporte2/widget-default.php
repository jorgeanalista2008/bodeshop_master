<?php
$desde = $_GET['desde'];
$hasta =$_GET['hasta'];
$sucursal =$_GET['sucursal'];
$aseguradora =$_GET['aseguradora'];
date_default_timezone_set('America/Caracas');
$fecha = date("d-m-Y");	

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
                                            <h4 class="invoice-title">Rango de fechas</h4>
                                            <div class="invoice-date-wrapper">
                                                <p class="invoice-date-title"><?php echo $desde; ?></p>
                                                <p class="invoice-date-title"><?php echo $hasta; ?></p>
                                               
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                                        

                                <!-- Invoice Description starts -->
                                <div class="text-center">
                                                <p class="invoice-date-title">Emisiones</p>
                                                <p class="invoice-date-title">A LA FECHA <?php echo $fecha; ?></p>                                               
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>                                             
                                            <th class="py-1">NUMERO DE POLIZA</th>
                                           
                                            <th class="py-1">CLIENTE</th>
                                            <th class="py-1">DOCUMENTO</th>                                                                         
                                            <th class="py-1">ASEGURADORA</th>                                           
                                            <th class="py-1">SUCURSAL</th>                  
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php 
                                             $datos = new PolizaData(); 
                                             $result = $datos->getPolizasEmitidas($desde,$hasta,$sucursal,$aseguradora);

                                         
                                            foreach ($result as $row) {        
                                            ?>
                                            <tr>
                                                <td class="py-1">
                                                   
                                                    <p class="card-text text-nowrap">
                                                    <?php echo $row->otro1;?>
                                                    </p>
                                                </td>
                                              
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->otro4;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->otro5;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->otro6;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->otro7;?></span>
                                                </td>
                                            </tr>
                                            <?php
                                              
                                                }
                                                ?> 
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