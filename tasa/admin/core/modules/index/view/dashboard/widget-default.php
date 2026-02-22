  <!-- BEGIN: Content-->
  <div class="app-content content" id="dashboard">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row match-height">
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h5>Comisiones 🎉 Cobradas!</h5>
                                    <p class="card-text font-small-3">Saldo global</p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        <a id="saldoGlobal" href="#"></a>
                                    </h3>
                                    <a href="index.php?view=pagos"  class="btn btn-primary">Ver pagos</a>
                                    <img src="../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->
                        <!-- Goal Overview Card -->
                      
                        <!--/ Goal Overview Card -->
                        <!-- Statistics Card -->
                        <div class="col-xl-8 col-md-6 col-12" id="data0">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Pólizas registradas</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 me-25 mb-0" id="hoy"></p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                 
                                                       <a href="index.php?view=autos"><i data-feather="truck" class="avatar-icon"></i></a> 
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0" id="data1"></h4>
                                                    <p class="card-text font-small-3 mb-0">autos</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                    <a href="index.php?view=estructuras"><i data-feather="home" class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0" id="data2"></h4>
                                                    <p class="card-text font-small-3 mb-0">Inmuebles</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                    <a href="index.php?view=otros"><i data-feather="square" class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0" id="data3"></h4>
                                                    <p class="card-text font-small-3 mb-0">Varias / vida</p>
                                                </div>
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                    <a href="index.php?view=patrimonios"><i data-feather="slack" class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0" id="data4"></h4>
                                                    <p class="card-text font-small-3 mb-0">Patrimoniales</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                    <a href="index.php?view=personales"><i data-feather="user" class="avatar-icon"></i></a>
                                                    </div>
                                                </div>
                                                <div class="my-auto" >
                                                    <h4 class="fw-bolder mb-0" id="data5" ></h4>
                                                    <p class="card-text font-small-3 mb-0">Personales</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Estadisticas Cuotas</h4>
                                    <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
                                </div>
                                <div class="card-body p-0">
                                    <div id="goal-overview-chart"></div>
                                    <div class="row border-top text-center mx-0">
                                        <div class="col-6 border-end py-1">
                                            <p class="card-text text-muted mb-0">Total Cuotas</p>
                                            <h3 class="fw-bolder mb-0 totalCuotas" id="totalCuotas"></h3>
                                        </div>

                                        <div class="col-6 py-1">
                                            <p class="card-text text-muted mb-0">Cuotas cobradas</p>
                                            <h3 class="fw-bolder mb-0 cuotasCobradas" id="cuotasCobradas"></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>
                 

                    <input type="hidden" id="dataPolizasContratos" class="dataPolizasContratos" value=''>
                    <input type="hidden" id="dataPolizasSinContratos" class="dataPolizasSinContratos" value=''>
                    <div class="row match-height">
                    <div class="col-12 data">
                        <p>Pólizas | sin contratos registrados</p>
                     
                        
                    </div>
                        <div class="col-12">
                                <div class="card">
                                    <table class="datatables-basic-polizas-sincontratos table">
                                        <thead>
                                            <tr>
                                            
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Número</th>
                                                <th>Cliente</th>
                                            
                                                <th>Tipo</th>
                                                <th>Aseguradora</th>                                           
                                                <th>Sucursal</th>                                                                                                                     
                                                <th>Estatus</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                        </div>
                    </div>
              
                    <div class="row match-height">
                    <div class="col-12 data">
                        <p>Pólizas | Contratos sin pago </p>
                     
                        
                    </div>
                        <div class="col-12">
                                <div class="card">
                                    <table class="datatables-basic-polizas-contratos table">
                                        <thead>
                                            <tr>
                                            
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Número</th>
                                                <th>Cliente</th>
                                            
                                                <th>Tipo</th>
                                                <th>Aseguradora</th>                                           
                                                <th>Sucursal</th>                                                                                                                     
                                                <th>Estatus</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                        </div>
                    </div>
                 
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->