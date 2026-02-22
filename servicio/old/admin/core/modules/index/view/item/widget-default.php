  <!-- BEGIN: Content-->
  <div class="app-content content buscarDataVehiculo" id="buscarDataVehiculo">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Item</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=items">Items</a>
                                    </li>
                                    <li class="breadcrumb-item active">Datos del item
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="user-profile" id="user-profile">
                    <!-- profile header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card profile-header mb-2">
                                <!-- profile cover photo -->
                                <img class="card-img-top" src="../app-assets/images/profile/user-uploads/top.jpg" id="imagen-tipo" alt="User Profile Image" />
                                <!--/ profile cover photo -->

                                <div class="position-relative">
                                    <!-- profile picture -->
                                    <div class="profile-img-container d-flex align-items-center">
                                        <div class="profile-img">
                                            <img src="../app-assets/images/portrait/small/cliente.png" class="rounded img-fluid dataVehiculo_imagen" alt="Card image" />
                                        </div> <input type="hidden" class="idVehiculo" id="idVehiculo" value ="<?php echo $_GET['id']; ?>">
                                        <!-- profile title -->
                                        <div class="profile-title ms-3">
                                            <h2 class="text-white dataVehiculo_placa" id ="dataVehiculo_placa"></h2>
                                            <p class="text-white dataVehiculo_tipo" id="dataVehiculo_tipo"></p>
                                           
                                        </div>
                                    </div>
                                </div>

                                <!-- tabs pill -->
                                <div class="profile-header-nav">
                                    <!-- navbar -->
                                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                       <br>

                                    
                                    </nav>
                                    <!--/ navbar -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ profile header -->

                    <!-- profile info section -->
                    <section id="profile-info">
                        <div class="row">
                            <!-- left profile info section -->
                            <div class="col-lg-4 col-12 order-2 order-lg-1">
                                <!-- about -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Datos del Item</h5>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Código:</h5>
                                            <p class="card-text dataVehiculo_placa2" id="dataVehiculo_placa2"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Tipo:</h5>
                                            <p class="card-text dataVehiculo_tipo2" id="dataVehiculo_tipo2"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Marca:</h5>
                                            <p class="card-text dataVehiculo_marca" id="dataVehiculo_marca"></p>
                                        </div>   
                                        <div class="mt-2">
                                            <h5 class="mb-75">Modelo:</h5>
                                            <p class="card-text dataVehiculo_modelo" id="dataVehiculo_modelo"></p>
                                        </div>                                  
                                        <div class="mt-2">
                                            <h5 class="mb-75">Color:</h5>
                                            <p class="card-text dataVehiculo_color" id="dataVehiculo_color"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Año:</h5>
                                            <p class="card-text dataVehiculo_ano" id="dataVehiculo_ano"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <h5 class="mb-75">Condicion:</h5>
                                            <p class="card-text dataVehiculo_condicion" id="dataVehiculo_condicion"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-primary btnEditarDatosVehiculo" >
                                                    Editar
                                            </button>
                                              <!-- MODAL DE PERSONAL -->
                                                <div class="modal  modal-slide-in modalDatosVehiculo fade" id="modalDatosVehiculo">
                                                    <div class="modal-dialog sidebar-sm">
                                                        <form class="frmEditVehiculo modal-content pt-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                            <div class="modal-header mb-1">
                                                                <h5 class="modal-title" id="exampleModalLabel">Datos del Item</h5>
                                                            </div>
                                                            <div class="modal-body flex-grow-1">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Código *</label>
                                                                    <input class="form-control txtEditVehiculoPlaca"  id="txtEditVehiculoPlaca" name="txtEditVehiculoPlaca" type="text" placeholder="ABCD-1234" />
                                                                </div> 
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Tipo *</label>                                                                
                                                                    <select class="select2 form-select cmbEditVehiculo_idTipo" id="cmbEditVehiculo_idTipo" name="cmbEditVehiculo_idTipo">
                                                                    <option value="0">Seleccione</option>                                                                                  
                                                                    </select>
                                                                </div>     
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Marca *</label>
                                                                
                                                                    <select class="select2 form-select cmbEditVehiculo_idMarca" id="cmbEditVehiculo_idMarca" name="cmbEditVehiculo_idMarca" disabled="true">
                                                                                    
                                                                    <option value="0">Seleccione</option>                                                                                    
                                                                    </select>
                                                                </div>     
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Modelo *</label>                                       
                                                                    <select class="select2 form-select cmbEditVehiculo_idModelo" id="cmbEditVehiculo_idModelo" name="cmbEditVehiculo_idModelo" disabled="true">
                                                                    <option value="0">Seleccione</option>              
                                                                                                                                                            
                                                                    </select>
                                                                </div>     
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Año *</label>
                                                                    <input class="form-control txtEditVehiculoAno"  id="txtEditVehiculoAno" name="txtEditVehiculoAno" type="number" placeholder="2024" />
                                                                </div> 

                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Color *</label>
                                                                    <input class="form-control txtEditVehiculoColor"  id="txtEditVehiculoColor" name="txtEditVehiculoColor" type="text" placeholder="ROJO" />
                                                                </div> 

                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Serial Chasis *</label>
                                                                    <input class="form-control txtEditVehiculoSerialChasis"  id="txtEditVehiculoSerialChasis" name="txtEditVehiculoSerialChasis" type="text" placeholder="ABC1DE2" />
                                                                </div> 

                                                                <div class="mb-1 d-none">
                                                                    <label class="form-label" for="basic-icon-default-email">Serial Motor *</label>
                                                                    <input class="form-control txtEditVehiculoSerialMotor"  id="txtEditVehiculoSerialMotor" name="txtEditVehiculoSerialMotor" type="text" placeholder="ABC1DE2" />
                                                                </div> 

                                                                
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Condicion *</label>
                                                                    <select class="form-select cmbEditVehiculoCondicion" id="cmbEditVehiculoCondicion" name="cmbEditVehiculoCondicion">                                           
                                                                                                             
                                                                        <option value= "1"> OPERATIVO </option>  
                                                                        <option value= "2"> INOPERATIVO </option>	 
                                                                                                        
                                                                    </select>
                                                                </div>      
                                                            
                                                                <button type="button" class="btn btn-primary btnEditVehiculo me-1">Guardar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            
                                                            
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>     

                                    </div>
                                </div>
                     
                               

                              

                            </div>
                            <!--/ left profile info section -->

                            <!-- center profile info section -->
                            <div class="col-lg-8 col-12 order-1 order-lg-2">
                                <!-- post 1 -->
                               
                                <div class="row">                                                     
                                    <!--
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-transaction">
                                            <div class="card-header">
                                            <div>
                                                    <h4 class="card-title">Mantenimientos</h4>
                                                    <p class="card-text font-small-2">Servicios Realizados</p>
                                                </div>
                                            </div>
                                            <div class="card-body" id="">
                                               
                                            <a class="btn btn-danger" href="index.php?view=mantenimientos&id=<?php echo $_GET['id']; ?>" ><i data-feather="eye" class="d-block d-md-none"></i><span class="fw-bold d-none d-md-block">Ver</span></a>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-transaction">
                                            <div class="card-header">
                                            <div>
                                                    <h4 class="card-title">Asignaciones</h4>
                                                    <p class="card-text font-small-2">Traslados Realizados</p>
                                                </div>
                                            </div>
                                            <div class="card-body" id="">
                                               
                                            <a class="btn btn-warning" href="index.php?view=asignaciones&id=<?php echo $_GET['id']; ?>" ><i data-feather="eye" class="d-block d-md-none"></i><span class="fw-bold d-none d-md-block">Ver</span></a>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    -->
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-transaction">
                                            <div class="card-header">
                                            <div>
                                                    <h4 class="card-title">Ordenes de trabajo </h4>
                                                    <p class="card-text font-small-2">En espera, asignadas, ejecutadas.</p>
                                                </div>
                                            </div>
                                            <div class="card-body" id="">                                               
                                            <a class="btn btn-success" href="index.php?view=ordenes&id=<?php echo $_GET['id']; ?>" ><i data-feather="eye" class="d-block d-md-none"></i><span class="fw-bold d-none d-md-block">Ver</span></a> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--/ Transaction Card -->
                                </div>
                         

                               
                              
                             
                            </div>
                            </div>
                                

                                                <div class="modal modal-slide-in fade modalAsignarVehiculo" id="modalAsignarVehiculo">
                                                    <div class="modal-dialog sidebar-sm">
                                                        <form class="frmAsignarVehiculo modal-content pt-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                            <div class="modal-header mb-1">
                                                                <h5 class="modal-title" id="exampleModalLabel">Asignar Vehiculo</h5>
                                                            </div>
                                                            <div class="modal-body flex-grow-1">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Redi *</label>
                                                                    <select class="select2 form-select cmbAddAsignarVehiculo_idRedi" id="cmbAddAsignarVehiculo_idRedi" name="cmbAddAsignarVehiculo_idRedi">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>      
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Zodi *</label>
                                                                    <select class="select2 form-select cmbAddAsignarVehiculo_idZodi" id="cmbAddAsignarVehiculo_idZodi" name="cmbAddAsignarVehiculo_idZodi" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                        </select> 
                                                                </div>      
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Brigada *</label>
                                                                    <select class="select2 form-select cmbAddAsignarVehiculo_idBrigada" id="cmbAddAsignarVehiculo_idBrigada" name="cmbAddAsignarVehiculo_idBrigada" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>  
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Unidad *</label>
                                                                    <select class="select2 form-select cmbAddAsignarVehiculo_idUnidad" id="cmbAddAsignarVehiculo_idUnidad" name="cmbAddAsignarVehiculo_idUnidad" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>   
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Dependencia *</label>
                                                                    <select class="select2 form-select cmbAddAsignarVehiculo_idDependencia" id="cmbAddAsignarVehiculo_idDependencia" name="cmbAddAsignarVehiculo_idDependencia" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>   
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Fecha de Asignación *</label>
                                                                    <input type="text" id="txtcmbAddAsignarVehiculoFechaAsignacion" class="form-control flatpickr-basic flatpickr-input active txtcmbAddAsignarVehiculoFechaAsignacion" name="txtcmbAddAsignarVehiculoFechaAsignacion" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                </div>    
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Dirección</label>
                                                                    <textarea data-length="100" class="form-control char-textarea textAreaAddAsignarVehiculoObservacion" id="textAreaAddAsignarVehiculoObservacion" rows="3" placeholder="Observación" style="height: 100px"  name="textAreaAddAsignarVehiculoObservacion"></textarea>
                                                                    <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 100 </small>
                                                                </div>    
                                                                <button type="button" class="btn btn-primary btnAsignarVehiculo me-1">Guardar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                
                    </section>
                    <!--/ profile info section -->
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->