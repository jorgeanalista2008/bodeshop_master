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
                                            <h4 class="invoice-title">Anexo Nro. 21</h4>
                                            <div class="invoice-date-wrapper">
                                              
                                               
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                                        

                                <!-- Invoice Description starts -->
                                <div class="text-center">
                                                <p class="invoice-date-title">ESTADO DEMOSTRATIVO DE LA PRIMAS</p>
                                                <p class="invoice-date-title">COBRADAS DURANTE EL EJERCICIO</p>
                                                <p class="invoice-date-title">31/12/2022</p>                                               
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
                                        <tr>
                                                <th class="py-1">NRO DE CUENTA</th>
                                                <th class="py-1">6-61-01</th>
                                                <th class="py-1">6-61-02</th>
                                                <th class="py-1"></th>
                                            </tr>
                                        <tbody>
                                            <?php 
                                            $datos = new AseguradoraData(); 
                                            $result = $datos->getAllDatosAseguradoras2();
                                            $total=0.00;
                                            $totalv=0.00;
                                            $totalg=0.00;
                                            foreach ($result as $row) {        
                                            ?>
                                            <tr>
                                                <td class="py-1">
                                                   
                                                    <p class="card-text text-nowrap">
                                                    <?php echo $row->aseguradora;?>
                                                    </p>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->vida;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->general;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->total;?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            $totalv = $totalv+$row->vida;
                                            $totalg = $totalg+$row->general;
                                            $total = $total+$row->total;
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
                                  <!--                  
                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
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
                                                   
                                                    <p class="invoice-total-amount"><?php echo $total; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                            -->
                                <!-- Invoice Description ends -->

                         

                             
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