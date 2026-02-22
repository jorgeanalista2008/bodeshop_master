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
                                            <h4 class="invoice-title">Estadisticas por aseguradoras</h4>
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
                                                <p class="invoice-date-title">01/01/2022 - 31/12/2022</p>                                               
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th class="py-1">ASEGURADORA</th>
                                                <th class="py-1">ENE</th>
                                                <th class="py-1">FEB</th>
                                                <th class="py-1">MAR</th>
                                                <th class="py-1">ABR</th>
                                                <th class="py-1">MAY</th>
                                                <th class="py-1">JUN</th>
                                                <th class="py-1">JUL</th>
                                                <th class="py-1">AGO</th>
                                                <th class="py-1">SEP</th>
                                                <th class="py-1">OCT</th>
                                                <th class="py-1">NOV</th>
                                                <th class="py-1">DIC</th>
                                                <th class="py-1">TOTALES</th>
                                            </tr>
                                           
                                        </thead>
                                            
                                        <tbody>
                                            <?php 
                                            $datos = new AseguradoraData(); 
                                            $result = $datos->getAllDatosAseguradoras();
                                            $total=0.00;
                                            $totalv=0.00;
                                            $totalg=0.00;
                                            foreach ($result as $row) {        
                                            ?>
                                            <tr>
                                                <td >
                                                   
                                                    <p >
                                                    <?php echo $row->aseguradora;?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <span ><?php echo $row->vida;?></span>
                                                </td>
                                                <td>
                                                    <span ><?php echo $row->general;?></span>
                                                </td>
                                                <td>
                                                    <span><?php echo $row->total;?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            $totalv = $totalv+$row->vida;
                                            $totalg = $totalg+$row->general;
                                            $total = $total+$row->total;
                                                }
                                                ?> 
                                        </tbody>
                                        
                                           
                                    </table>

                                </div>
                                <!--
                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-4 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Totales</p>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                   
                                                    <p class="invoice-total-amount"><?php echo $totalv; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                 
                                                    <p class="invoice-total-amount"><?php echo $totalg; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                 
                                                    <p class="invoice-total-amount"><?php echo $totalg; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                   
                                                    <p class="invoice-total-amount"><?php echo $total; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               -->

                             
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