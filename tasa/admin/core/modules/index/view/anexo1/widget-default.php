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
                                            <h4 class="invoice-title">Anexo Nro. 1</h4>
                                            <div class="invoice-date-wrapper">
                                                <p class="invoice-date-title">Cuenta Nro.- 1-11-03</p>
                                               
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <!-- Header ends -->
                                </div>

                                                        

                                <!-- Invoice Description starts -->
                                <div class="text-center">
                                                <p class="invoice-date-title">BANCOS</p>
                                                <p class="invoice-date-title">AL 31/12/2022</p>                                               
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="py-1">ENTIDAD BANCARIA</th>
                                                <th class="py-1">TIPO CUENTA</th>
                                                <th class="py-1">NRO. CTA</th>
                                                <th class="py-1">SALDO BS.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $fecha=$_GET["fecha"]; 
                                            $fechaI = substr($fecha, 0,10);  // devuelve false
                                            $fechaF = substr($fecha, 14,10);  // devuelve false
                                            $datos = new BancoData(); 
                                            $result = $datos->getAllDatosBancaFiscal($fechaI,$fechaF);
                                            $total=0.00;
                                            foreach ($result as $row) {        
                                            ?>
                                            <tr>
                                                <td class="py-1">
                                                   
                                                    <p class="card-text text-nowrap">
                                                    <?php echo $row->banco;?>
                                                    </p>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->tipo;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo $row->numero;?></span>
                                                </td>
                                                <td class="py-1">
                                                    <span class="fw-bold"><?php echo number_format($row->balance, 2, ',', '.');?></span>
                                                </td>
                                            </tr>
                                            <?php
                                            $total = $total+$row->balance;
                                                }
                                                ?> 
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-body invoice-padding pb-0">
                                    <div class="row invoice-sales-total-wrapper">
                                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                          
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                            <div class="invoice-total-wrapper">
                                                <hr class="my-50" />
                                                <div class="invoice-total-item">
                                                    <p class="invoice-total-title">Total:</p>
                                                    <p class="invoice-total-amount"><?php echo number_format($total, 2, ',', '.');?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Description ends -->

                         

                             
                            </div>
                        </div>
                        <!-- /Invoice -->

                        <!-- Invoice Actions -->
                        <div class="col-xl-12 col-md-12 col-12 invoice-actions mt-md-0 mt-2">
                            <div class="card">
                                <div class="card-body">
                                    <a href="index.php?action=anexo1&fecha=<?php echo $fecha;?> " target="_blank" class="btn btn-primary w-100 mb-75">
                                    Generar pdf
                                            </a>                              
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