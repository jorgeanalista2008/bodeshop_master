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
                                    <h5>Felicidades 🎉 <?php echo $_SESSION['tenancy_name'] ?>!</h5>
                                    <p class="card-text font-small-3 ordenesCompletadas">Ordenes completadas </p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        <a href="#"><h2 class="fw-bolder mt-1 cantidadOrdenesCompletadas"></h2></a>
                                    </h3>
                                    <a type="button" href="index.php?view=ordenesTrabajo&filtro=2" class="btn btn-primary">Ver ordenes</a>
                                    <img src="../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                                </div>
                            </div>
                        </div>
                        <!--/ Medal Card -->

                        <!-- Statistics Card -->
                        <div class="col-xl-8 col-md-6 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Funcionalidades</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text font-small-2 me-25 mb-0"> Agregar equipos clientes inventario</p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                      <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalAddVehiculo" title="Agregar equipo"><i data-feather="layers" class="avatar-icon"></i></a> 
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0 cantidadItemsRegistrados">0</h4>
                                                    <p class="card-text font-small-3 mb-0 itemsRegistrados" > <a class="d-flex align-items-center" href="index.php?view=items">Equipos</a></p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                       <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalAddCliente" title="Agregar cliente"><i data-feather="user" class="avatar-icon"></i></a> 
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0 cantidadClientesRegistrados">0</h4>
                                                    <p class="card-text font-small-3 mb-0 clientesRegistrados"><a class="d-flex align-items-center" href="index.php?view=clientes">Clientes</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0 cantidadPersonalRegistrados">0</h4>
                                                    <p class="card-text font-small-3 mb-0 personalRegistrados"><a class="d-flex align-items-center" href="index.php?view=personal">Personal</a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="clock" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0 cantidadOrdenesEnEspera">0</h4>
                                                    <p class="card-text font-small-3 mb-0 ordenesEnEspera"><a class="d-flex align-items-center" href="index.php?view=ordenesTrabajo&filtro=1">Ordenes</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>
                    <div class="row match-height">
                      
                       

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                   <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="package" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder mt-1 cantidadOrdenesEnProceso"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=ordenesTrabajo&filtro=3">Ordenes en proceso </a></p>
                                   
                                </div>
                                <div id="order-chart-ordenesEnProceso" class="ordenesEnProceso"></div>
                            </div>
                        </div>
               
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="package" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder mt-1 cantidadOrdenesADestiempo"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=ordenesTrabajo&filtro=4">Ordenes a destiempo </a></p>
                                   
                                </div>
                                <div id="order-chart-ordenesADestiempo" class="ordenesADestiempo"></div>
                            </div>
                        </div>
                        
                    </div>
                 

                      <!-- List DataTable -->
                    <div class="row">
                                 
                    <input type="hidden" id="dataDasboardOrdenes" class="dataDasboardOrdenes" value=''>
                        <div class="col-12">
                            <div class="card invoice-list-wrapper">
                                <div class="card-datatable table-responsive">
                                    <table class="datatableDasboardOrdenes table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>#</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th class="cell-fit">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ List DataTable -->
              
                  
                 
                </section>
                <section id="dashboard-ecommerce">
                   
                   <div class="row match-height">
                           <input type="hidden" id="dataMeses" class="dataMeses" value=''>
                         

                         
                                   <div class="col-lg-12 col-md-12 col-12">
                                       <div class="card">
                                           <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                               <div class="header-center">
                                                   <h4 class="card-title">Ordenes de trabajo</h4>
                                               
                                               </div>
                                           
                                               <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                           
                                               
                                               </div>
                                           </div>
                                           <div class="card-body">
                                           <div class="chartdiv_dashboard chartdiv_dashboard_1" id="graficoXA"></div>
                                       
                                           </div>
                                       </div>
                                       </div>
                                   </div>
                     
                              
                          
                   </div>
               </section>
           
            </div>
        </div>
    </div>
    <!-- END: Content-->