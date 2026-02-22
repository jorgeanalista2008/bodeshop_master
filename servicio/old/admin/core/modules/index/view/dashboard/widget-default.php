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
                      
                      
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="cpu" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder mt-1 cantidadItemsRegistrados"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=items">Items</a></p>
                                </div>
                                <div id="gained-chart" class="itemsRegistrados"></div>
                            </div>
                        </div>
                    

                     
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                     <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder mt-1 cantidadPersonalRegistrados"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=personal">Personal</a></p>
                                   
                                </div>
                                <div id="order-chart-clientes" class="personalRegistrados"></div>
                            </div>
                        </div>
                  

                    
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                     <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="users" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder mt-1 cantidadClientesRegistrados"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=clientes">Clientes</a></p>
                                   
                                </div>
                                <div id="order-chart" class="clientesRegistrados"></div>
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
                                    <h2 class="fw-bolder mt-1 cantidadOrdenesCompletadas"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=ordenesTrabajo&filtro=2">Ordenes completadas</a></p>
                                   
                                </div>
                                <div id="order-chart-comision" class="ordenesCompletadas"></div>
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
                                    <h2 class="fw-bolder mt-1 cantidadOrdenesEnEspera"></h2>
                                    <p class="card-text"><a class="d-flex align-items-center" href="index.php?view=ordenesTrabajo&filtro=1">Ordenes en espera </a></p>
                                   
                                </div>
                                <div id="order-chart-mantenimientos" class="ordenesEnEspera"></div>
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
                 

                   
              
                  
                 
                </section>

           
            </div>
        </div>
    </div>
    <!-- END: Content-->