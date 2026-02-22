  <!-- BEGIN: Content-->
  <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Poliza</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=polizas">Polizas</a>
                                    </li>
                                    <li class="breadcrumb-item active">Poliza
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
                                <img class="card-img-top" src="../app-assets/images/profile/user-uploads/timeline.jpg" id="imagen-tipo" alt="User Profile Image" />
                                <!--/ profile cover photo -->

                                <div class="position-relative">
                                    <!-- profile picture -->
                                    <div class="profile-img-container d-flex align-items-center">
                                        <div class="profile-img">
                                            <img src="../app-assets/images/portrait/small/cliente.png" class="rounded img-fluid" alt="Card image" />
                                        </div> <input type="hidden" id="idPolizaData" value ="<?php echo $_GET['id']; ?>">
                                        <!-- profile title -->
                                        <div class="profile-title ms-3">
                                            <h2 class="text-white" id ="numeroPoliza"></h2>
                                            <p class="text-white" id="tipoData"></p>
                                           
                                        </div>
                                    </div>
                                </div>

                                <!-- tabs pill -->
                                <div class="profile-header-nav">
                                    <!-- navbar -->
                                    <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
                                        <button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <i data-feather="align-justify" class="font-medium-5"></i>
                                        </button>

                                        <!-- collapse  -->
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
                                                <ul class="nav nav-pills mb-0">
                                                    <li class="nav-item">
                                                       
                                                    </li>
                                                    <li class="nav-item">
                                                       
                                                    </li>
                                                    <li class="nav-item">
                                                      
                                                    </li>
                                                    <li class="nav-item">
                                                       
                                                    </li>
                                                </ul>
                                                <!-- edit button -->
                                                <button type="button" class="btn btn-danger eliminarPoliza" id="eliminarPoliza">
                                                    <i data-feather="trash" class="d-block d-md-none"></i>
                                                    <span class="fw-bold d-none d-md-block">Eliminar</span>
                                                </button>
                                            </div>
                                        </div>
                                        <!--/ collapse  -->
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
                                        <h5 class="mb-75">Póliza</h5>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Numero:</h5>
                                            <p class="card-text" id="numeroPoliza2"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Tipo:</h5>
                                            <p class="card-text" id="tipoData2"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Sucursal:</h5>
                                            <p class="card-text" id="sucursal2"></p>
                                        </div>   
                                        <div class="mt-2">
                                            <h5 class="mb-75">Fecha emisión:</h5>
                                            <p class="card-text" id="fechaEmision2"></p>
                                        </div>                                  
                                        <div class="mt-2">
                                            <h5 class="mb-75">Fecha registro:</h5>
                                            <p class="card-text" id="fechaEmision"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Aseguradora:</h5>
                                            <p class="card-text" id="aseguradora"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza">
                                                    Editar
                                            </button>
                                              <!-- MODAL DE PERSONAL -->
                                                <div class="modal modal-slide-in fade" id="modals-slide-in-poliza">
                                                    <div class="modal-dialog sidebar-sm">
                                                        <form class="update-record-poliza modal-content pt-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                            <div class="modal-header mb-1">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar poliza</h5>
                                                            </div>
                                                            <div class="modal-body flex-grow-1">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Número de Póliza * </label>
                                                                    <input type="text" class="form-control  numero-poliza" name="numero-poliza" placeholder="" id="numero-poliza" />
                                                                    <input type="hidden" class="form-control  usuario-poliza" name="usuario-poliza" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-poliza" />
                                                                    <input type="hidden" class="form-control  id-poliza" name="id-poliza"  id="id-poliza" />
                                                                </div> 
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Fecha emisión * </label>
                                                                    <input type="text" id="emision-poliza" class="form-control flatpickr-basic flatpickr-input active emision-poliza" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                </div>    
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                                                    <select class=" select2 form-select idAseguradora-poliza" id="idAseguradora-poliza" name="idAseguradora-poliza">                                           
                                                                                                  
                                                                    </select>
                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                                                    <select class="select2 form-select idSucursal-poliza" id="idSucursal-poliza" name="idSucursal-poliza">                                           
                                                                                                    
                                                                    </select>
                                                                </div>
                                                            
                                                                                
                                                            
                                                                <button type="button" class="btn btn-primary data-submit-poliza me-1">Editar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>     

                                    </div>
                                </div>
                     
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Datos del cliente</h5>
                                      
                                        <div class="mt-2">
                                            <h5 class="mb-75">Cliente:</h5>
                                            <p class="card-text" id="cliente"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Cédula de identidad:</h5>
                                            <p class="card-text" id="cedula"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Teléfono local:</h5>
                                            <p class="card-text" id="telefono"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Teléfono móvil:</h5>
                                            <p class="card-text" id="telefono2"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Email:</h5>
                                            <p class="card-text" id="correo"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-50">Fecha nacimiento:</h5>
                                            <p class="card-text mb-0" id="fechaNacimiento"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-50">Edad:</h5>
                                            <p class="card-text mb-0" id="edad"></p>
                                        </div>
                                        
                                        <div class="mt-2">
                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-cliente-update">
                                                Editar
                                                </button>
                                                <div class="modal modal-slide-in fade" id="modals-slide-in-cliente-update">
                                                    <div class="modal-dialog sidebar-sm">
                                                        <form class="update-record-cliente modal-content pt-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                            <div class="modal-header mb-1">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
                                                            </div>
                                                            <div class="modal-body flex-grow-1">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Apellido y nombre *</label>
                                                                    <input type="text" class="form-control  update-nombre-cliente" name="update-nombre" placeholder="" id="update-nombre-cliente" />
                                                                    <input type="hidden" class="form-control update-id-cliente"  id="update-id-cliente">
                                                                </div> 
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Nacionalidad *</label>
                                                                    <select class="form-select update-nacionalidad-cliente" id="update-nacionalidad-cliente" name="update-nacionalidad-cliente">                                           
                                                                        <option value= "V-"> Venezolano </option>	 
                                                                        <option value= "E-"> Extranjero </option>
                                                                        <option value= "J-"> Jurídico </option>	 	 
                                                                        <option value= "G-"> Gubernamental </option>	 	                                  
                                                                    </select>
                                                                </div>     
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Cédula *</label>
                                                                    <input type="number" class="form-control update-cedula-cliente" placeholder="123456789" id="update-cedula-cliente">
                                                                </div>     
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Fecha Nacimiento</label>
                                                                    <input type="text" id="update-fechaNacimiento-cliente" class="form-control flatpickr-basic flatpickr-input active update-fechaNacimiento-cliente" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                </div>      
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                                                    <div class="input-group input-group-merge">
                                                                            <span class="input-group-text">VE (+58)</span>
                                                                            <input type="text" class="form-control phone-number-mask update-telefono-cliente" placeholder="254 232 55 66"  id="update-telefono-cliente" />
                                                                        </div>
                                                                </div>      
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Teléfono móvil *</label>
                                                                    <div class="input-group input-group-merge">
                                                                            <span class="input-group-text">VE (+58)</span>
                                                                            <input type="text" class="form-control phone-number-mask update-telefono2-cliente" placeholder=" 412 123 55 66" id="update-telefono2-cliente" />
                                                                        </div>
                                                                </div>      
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                                                    <input type="email" class="form-control update-correo-cliente" placeholder="usuario@gmail.com" id="update-correo-cliente">
                                                                </div>    
                                                                                
                                                            
                                                                <button type="button" class="btn btn-primary data-submit-cliente-update me-1">Editar</button>
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
                                    <div class="col-lg-12 col-12 order-1 order-lg-2">
                                            <div class="card" id="auto" style="display:none">
                                            <div class="card-body">
                                                <h5 class="mb-75">Datos del vehículo</h5>
                                                <div class="row">
                                                    <div class="col-lg-4 col-6 order-2 order-lg-1">
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Placa:</h5>
                                                            <p class="card-text" id="placaVehiculo"></p>
                                                        </div>
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Tipo:</h5>
                                                            <p class="card-text" id="tipoVehiculo"></p>
                                                        </div>
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Año:</h5>
                                                            <p class="card-text" id="anoVehiculo"></p>
                                                        </div>   
                                                                        
                                                    </div>
                                                    <div class="col-lg-4 col-6 order-2 order-lg-1">
                                                    <div class="mt-2">
                                                            <h5 class="mb-75">Estado:</h5>
                                                            <p class="card-text" id="estadoVehiculo"></p>
                                                        </div>  
                                                                
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Color:</h5>
                                                            <p class="card-text" id="colorVehiculo"></p>
                                                        </div>
                                                                                        
                                                                    
                                                    </div>
                                                    <div class="col-lg-4 col-6 order-2 order-lg-1">
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Marca:</h5>
                                                            <p class="card-text" id="marcaVehiculo"></p>
                                                        </div>  
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Modelo:</h5>
                                                            <p class="card-text" id="modeloVehiculo"></p>
                                                        </div>    

                                                         <div class="mt-2">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-auto-update">
                                                                    Editar
                                                            </button>
                                                                <!-- MODAL DE auto -->
                                                                <div class="modal modal-slide-in fade" id="modals-slide-in-auto-update">
                                                                    <div class="modal-dialog sidebar-sm">
                                                                        <form class="update-record-poliza-auto modal-content pt-0">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                                            <div class="modal-header mb-1">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Editar Automóvil</h5>
                                                                            </div>
                                                                            <div class="modal-body flex-grow-1">      
                                                                            <div class="mb-1">
                                                                            <label class="form-label" for="basic-icon-default-email">Tipo de Póliza * </label>
                                                                                    <select class="form-select estado-auto-update" id="estado-auto-update" name="estado-auto-update">                                           
                                                                                    
                                                                                    <option value= "0"> Seleccione </option>	 
                                                                                    <option value= "1"> RCV </option>	 
                                                                                    <option value= "2"> COBERTURA AMPLIA </option>	  
                                                                                    <option value= "3"> PERDIDA TOTAL </option>	                                                 
                                                                                    </select>
                                                                                </div>                                                                                 
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Tipo de vehículo</label>
                                                                                    <input type="text" class="form-control  tipo-auto-update" name="tipo-auto-update" placeholder="" id="tipo-auto-update" />
                                                                                    <input type="hidden" class="form-control  id-auto-update" name="id-auto-update" placeholder="" id="id-auto-update" />
                                                                                    <input type="hidden" class="form-control  usuario-auto" name="usuario-auto" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-auto" />
                                                                                </div> 
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Marca</label>
                                                                                    <input type="text" class="form-control  marca-auto-update" name="marca-auto-update" placeholder="" id="marca-auto-update" />
                                                                                </div> 
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Modelo</label>
                                                                                    <input type="text" class="form-control  modelo-auto-update" name="modelo-auto-update" placeholder="" id="modelo-auto-update" />
                                                                                </div> 
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Placa * </label>
                                                                                    <input type="text" class="form-control placa-auto-update" placeholder="asd1234" id="placa-auto-update">
                                                                                </div>    
                                                                            
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Color</label>
                                                                                    <input type="text" class="form-control color-auto-update" placeholder="Naranja" id="color-auto-update">
                                                                                </div> 
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Año</label>
                                                                                    <input type="number" class="form-control ano-auto-update" placeholder="2022" id="ano-auto-update">
                                                                                </div>    
                                                                                
                                                                                                                                                  
                                                                            
                                                                                <button type="button" class="btn btn-primary data-submit-poliza-auto-update me-1">Editar</button>
                                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                         </div>        
                                                      
                                                    </div>

                                                </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="estructura" style="display:none">
                                            <div class="card-body">
                                                    <h5 class="mb-75">Datos del inmueble</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Codigo:</h5>
                                                                <p class="card-text" id="codigoEstructura"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Valor:</h5>
                                                                <p class="card-text" id="valorEstructura"></p>
                                                            </div>
                                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                        <div class="mt-2">
                                                                <h5 class="mb-75">Direccion:</h5>
                                                                <p class="card-text" id="direccionEstructura"></p>
                                                            </div>  
                                                                    
                                                        <div class="mt-2">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-estructura-update">
                                                                    Editar
                                                            </button>
                                                                                                    <!-- MODAL DE estructura -->
                                                            <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-estructura-update">
                                                                <div class="modal-dialog sidebar-sm">
                                                                    <form class="update-record-poliza-estructura modal-content pt-0">
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                                        <div class="modal-header mb-1">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Editar inmueble</h5>
                                                                        </div>
                                                                        <div class="modal-body flex-grow-1">
                                                                        
                                                                            <div class="mb-1">
                                                                                <label class="form-label" for="basic-icon-default-email">Dirección * </label>
                                                                                <input type="text" class="form-control  direccion-estructura-update" name="direccion-estructura-update" placeholder="" id="direccion-estructura-update" />
                                                                                <input type="hidden" class="form-control  id-estructura-update" name="id-estructura-update" placeholder="" id="id-estructura-update" />
                                                                                <input type="hidden" class="form-control  usuario-estructura" name="usuario-estructura" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-estructura" />
                                                                            </div> 
                                                                        
                                                                            <div class="mb-1">
                                                                                <label class="form-label" for="basic-icon-default-email">Valor</label>
                                                                                <input type="number" class="form-control valor-estructura-update" placeholder="" id="valor-estructura-update">
                                                                            </div>    
                                                                                            
                                                                        
                                                                            <button type="button" class="btn btn-primary data-submit-poliza-estructura-update me-1">Editar</button>
                                                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>                       
                                                                 <!-- update inmueble -->       
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="otros" style="display:none">
                                            <div class="card-body">
                                                    <h5 class="mb-75">Datos de otros</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Codigo:</h5>
                                                                <p class="card-text" id="codigoOtro"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">nombre:</h5>
                                                                <p class="card-text" id="nombreOtro"></p>
                                                            </div>
                                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                        <div class="mt-2">
                                                                <h5 class="mb-75">Descripcion:</h5>
                                                                <p class="card-text" id="descripcionOtro"></p>
                                                            </div>  
                                                                    
                                                                                    
                                                            <div class="mt-2">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-otro-update">
                                                                    Editar
                                                            </button>

                                                                  <!-- MODAL DE otro -->
                                                                <div class="modal modal-slide-in fade" id="modals-slide-in-otro-update">
                                                                    <div class="modal-dialog sidebar-sm">
                                                                        <form class="update-poliza-otro modal-content pt-0">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                                            <div class="modal-header mb-1">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Nueva póliza para casos otros</h5>
                                                                            </div>
                                                                            <div class="modal-body flex-grow-1">
                                                                               
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Titulo * </label>
                                                                                    <input type="text" class="form-control  nombre-otro-update" name="nombre-otro-update" placeholder="Título de la póliza" id="nombre-otro-update" />
                                                                                    <input type="hidden" class="form-control  id-otro-update" name="id-otro-update" placeholder="" id="id-otro-update" />
                                                                                    <input type="hidden" class="form-control  usuario-otro" name="usuario-otro" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-otro" />
                                                                                </div> 
                                                                            
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Descripción * </label>
                                                                                    <input type="text" class="form-control descripcion-otro-update" placeholder="De que trata la póliza" id="descripcion-otro-update">
                                                                                </div>    
                                                                                                
                                                                            
                                                                                <button type="button" class="btn btn-primary data-submit-poliza-otro-update me-1">Guardar</button>
                                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>                       
                                                                 <!-- update otras -->                
                                                                        
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="patrimonial" style="display:none">
                                            <div class="card-body">
                                                    <h5 class="mb-75">Datos de la empresa</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Codigo:</h5>
                                                                <p class="card-text" id="codigoPatrimonio"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Nombre:</h5>
                                                                <p class="card-text" id="nombrePatrimonio"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Numero de identificación:</h5>
                                                                <p class="card-text" id="identificacionPatrimonio"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Correo eléctronico:</h5>
                                                                <p class="card-text" id="correoPatrimonio"></p>
                                                            </div>
                                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Ramo:</h5>
                                                                <p class="card-text" id="ramoPatrimonio"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Tipo:</h5>
                                                                <p class="card-text" id="tipoPatrimonio"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Teléfono local:</h5>
                                                                <p class="card-text" id="telefonoPatrimonio"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Teléfono móvil:</h5>
                                                                <p class="card-text" id="telefono2Patrimonio"></p>
                                                            </div>
                                                                                
                                                            <div class="mt-2">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-patrimonio-update">
                                                                    Editar
                                                            </button>

                                                             <!-- MODAL DE patrimonio -->
                                                                    <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-patrimonio-update">
                                                                        <div class="modal-dialog sidebar-sm">
                                                                            <form class="update-record-poliza-patrimonio modal-content pt-0">
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                                                <div class="modal-header mb-1">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar patrimonial</h5>
                                                                                </div>
                                                                                <div class="modal-body flex-grow-1">
                                                                                    
                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Nombre * </label>
                                                                                        <input type="text" class="form-control  nombre-patrimonio-update" name="nombre-patrimonio-update" placeholder="" id="nombre-patrimonio-update" />
                                                                                        <input type="hidden" class="form-control  id-patrimonio-update" name="id-patrimonio-update" placeholder="" id="id-patrimonio-update" />
                                                                                      
                                                                                        <input type="hidden" class="form-control  usuario-patrimonio" name="usuario-patrimonio" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-estructura" />
                                                                                    </div> 
                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Identificacion * </label>
                                                                                        <input type="text" class="form-control  identificacion-patrimonio-update" name="identificacion-patrimonio-update" placeholder="J-123456789" id="identificacion-patrimonio-update" />
                                                                                    </div> 
                                                                                
                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Dirección * </label>
                                                                                        <input type="text" class="form-control  direccion-patrimonio-update" name="direccion-patrimonio-update" placeholder="" id="direccion-patrimonio-update" />
                                                                                    </div> 
                                                                                
                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Tipo * </label>
                                                                                        <select class="form-select tipo-patrimonio-update" id="tipo-patrimonio-update" name="tipo-patrimonio-update">                                           
                                                                                            
                                                                                            <option value= "1"> RCG </option>	 
                                                                                            <option value= "2"> Patronal </option>	 
                                                                                            <option value= "3"> Empresarial </option>	                                         
                                                                                        </select>
                                                                                    </div>    
                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Numero de empleados * </label>
                                                                                        <input type="number" class="form-control  numeroe-patrimonio-update" name="numeroe-patrimonio-update" placeholder="9" id="numeroe-patrimonio-update" />
                                                                                    </div>   
                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Ramo</label>
                                                                                        <input type="text" class="form-control  ramo-patrimonio-update" name="ramo-patrimonio-update" placeholder="" id="ramo-patrimonio-update" />
                                                                                    </div>  

                                                                                    <div class="mb-1">
                                                                                        <label class="form-label" for="basic-icon-default-email">Sueldo general * </label>
                                                                                        <input type="number" class="form-control  sueldo-patrimonio-update" name="sueldo-patrimonio-update" placeholder="" id="sueldo-patrimonio-update" />
                                                                                    </div>  
                                                                                    

                                                                                    <div class="mb-1">
                                                                                            <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                                                                            <div class="input-group input-group-merge">
                                                                                                    <span class="input-group-text">VE (+58)</span>
                                                                                                    <input type="text" class="form-control phone-number-mask telefono-patrimonio-update" placeholder="254 232 55 66"  id="telefono-patrimonio-update" />
                                                                                                </div>
                                                                                        </div>      
                                                                                        <div class="mb-1">
                                                                                            <label class="form-label" for="basic-icon-default-email">Teléfono móvil * </label>
                                                                                            <div class="input-group input-group-merge">
                                                                                                    <span class="input-group-text">VE (+58)</span>
                                                                                                    <input type="text" class="form-control phone-number-mask telefono2-patrimonio-update" placeholder=" 412 123 55 66" id="telefono2-patrimonio-update" />
                                                                                                </div>
                                                                                        </div>      
                                                                                        <div class="mb-1">
                                                                                            <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                                                                            <input type="email" class="form-control correo-patrimonio-update" placeholder="usuario@gmail.com" id="correo-patrimonio-update">
                                                                                        </div>    
                                                                                                    
                                                                                
                                                                                
                                                                                    <button type="button" class="btn btn-primary data-submit-poliza-patrimonio-update me-1">Guardar</button>
                                                                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                            </div>                       
                                                                 <!-- update otras -->       
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="personal" style="display:none">
                                            <div class="card-body">
                                                    <h5 class="mb-75">Datos del Asegurado</h5>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">                                                   
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Nombre:</h5>
                                                                <p class="card-text" id="nombrePersonal"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Cédula:</h5>
                                                                <p class="card-text" id="cedulaPersonal"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Fecha nacimiento:</h5>
                                                                <p class="card-text" id="fechaNacimientoPersonal"></p>
                                                            </div>
                                                        
                                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-6 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Correo eléctronico:</h5>
                                                                <p class="card-text" id="correoPersonal"></p>
                                                            </div>                                                   
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Teléfono local:</h5>
                                                                <p class="card-text" id="telefonoPersonal"></p>
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Teléfono móvil:</h5>
                                                                <p class="card-text" id="telefono2Personal"></p>
                                                            </div>
                                                                                
                                                            <div class="mt-2">
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in-personal-update">
                                                                    Editar
                                                            </button>
                                                             <!-- MODAL DE PERSONAL -->
                                                                <div class="modal modal-slide-in fade" id="modals-slide-in-personal-update">
                                                                    <div class="modal-dialog sidebar-sm">
                                                                        <form class="update-record-poliza-personal modal-content pt-0">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                                            <div class="modal-header mb-1">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Editar datos personales</h5>
                                                                            </div>
                                                                            <div class="modal-body flex-grow-1">                                                                               
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Apellido y nombre * </label>
                                                                                    <input type="text" class="form-control  nombre-vida-update" name="nombre-vida-update" placeholder="" id="nombre-vida-update" />
                                                                                    <input type="hidden" class="form-control  id-vida-update" name="nombre-vida-update" placeholder="" id="id-vida-update" />
                                                                                    <input type="hidden" class="form-control  usuario-vida-update" name="nombre-vida-update" value="<?php  echo $_SESSION['nombreUsuario']?>" placeholder="" id="nombre-vida-update" />
                                                                                </div> 

                                                                                  <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Nacionalidad *</label>
                                                                                    <select class="form-select nacionalidad-vida-update" id="nacionalidad-vida-update" name="nacionalidad-vida-update">                                           
                                                                                        <option value= "V-"> Venezolano </option>	 
                                                                                        <option value= "E-"> Extranjero </option>
                                                                                        <option value= "J-"> Jurídico </option>	 	 
                                                                                        <option value= "G-"> Gubernamental </option>	 	                                  
                                                                                    </select>
                                                                                </div>     
                                                                 
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Cédula * </label>
                                                                                    <input type="text" class="form-control cedula-vida-update" placeholder="V-123456789" id="cedula-vida-update">
                                                                                </div>     
                                                                            
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Fecha Nacimiento</label>
                                                                                    <input type="text" id="fechaNacimiento-vida-update" class="form-control flatpickr-basic flatpickr-input active fechaNacimiento-vida-update" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                                </div>      
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                                                                    <div class="input-group input-group-merge">
                                                                                            <span class="input-group-text">VE (+58)</span>
                                                                                            <input type="text" class="form-control phone-number-mask telefono-vida-update" placeholder="254 232 55 66"  id="telefono-vida-update" />
                                                                                        </div>
                                                                                </div>      
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Teléfono móvil * </label>
                                                                                    <div class="input-group input-group-merge">
                                                                                            <span class="input-group-text">VE (+58)</span>
                                                                                            <input type="text" class="form-control phone-number-mask telefono2-vida-update" placeholder=" 412 123 55 66" id="telefono2-vida-update" />
                                                                                        </div>
                                                                                </div>      
                                                                                <div class="mb-1">
                                                                                    <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                                                                    <input type="email" class="form-control correo-vida-update" placeholder="usuario@gmail.com" id="correo-vida-update">
                                                                                </div>    
                                                                                                
                                                                            
                                                                                <button type="button" class="btn btn-primary data-submit-poliza-personal-update me-1">Editar</button>
                                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>                       
                                                                 <!-- update otras -->       
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                                            <!-- Browser States Card -->
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-browser-states">
                                            <div class="card-header">
                                                <div>
                                                    <h4 class="card-title">Contratos registrados</h4>
                                                    <p class="card-text font-small-2">historico</p>
                                                </div>
                                               
                                            </div>
                                            <div class="card-body contratos" id="contratos">
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-transaction">
                                            <div class="card-header">
                                                <h4 class="card-title">Pagos realizados</h4>
                                                
                                            </div>
                                            <div class="card-body" id="pagosRealizados">
                                               
                                            
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-transaction">
                                            <div class="card-header">
                                            <div>
                                                    <h4 class="card-title">Archivos</h4>
                                                    <p class="card-text font-small-2">Documentos consignados</p>
                                                </div>
                                            </div>
                                            <div class="card-body" id="">
                                               
                                            <a class="btn btn-success" href="index.php?view=media&id=<?php echo $_GET['id']; ?>" ><i data-feather="eye" class="d-block d-md-none"></i><span class="fw-bold d-none d-md-block">Ver</span></a>
                                              
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <!--/ Transaction Card -->
                                </div>
                                <div class="row">
                                                            <!-- Browser States Card -->
                                
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="card card-transaction">
                                            <div class="card-header">
                                            <div>
                                                    <h4 class="card-title">Siniestros</h4>
                                                    <p class="card-text font-small-2">Histórico de eventos</p>
                                                </div>
                                            </div>
                                            <div class="card-body" id="">
                                               
                                            <a class="btn btn-info" href="index.php?view=siniestros&idPoliza=<?php echo $_GET['id']; ?>&id=<?php echo $_GET['id']; ?>" ><i data-feather="eye" class="d-block d-md-none"></i><span class="fw-bold d-none d-md-block">Ver</span></a>
                                            </div>
                                        </div>
                                    </div>
   
                                    
                                    <!--/ Transaction Card -->
                                </div>

                               
                              
                             
                            </div>
                            </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                      <!--   <button type="button" class="btn btn-sm btn-primary block-element border-0 mb-1">Ver más</button> -->
                                    </div>
                                </div>
                                <!--/ reload button -->

                                  <!-- Modal to add new record -->
                                <div class="modal modal-slide-in fade" id="modals-slide-in">
                                    <div class="modal-dialog sidebar-sm">
                                        <form class="add-new-record-contrato modal-content pt-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                            <div class="modal-header mb-1">
                                                <h5 class="modal-title" id="exampleModalLabel">Nuevo contrato</h5>
                                            </div>
                                            <div class="modal-body flex-grow-1">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Póliza</label>
                                                    <select class="select2 form-select idPoliza" id="select2-basic">
                                                        
                                                    </select>
                                                </div>   
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Fecha inicio</label>
                                                    <input type="text" id="fechaInicio-contrato" class="form-control flatpickr-basic flatpickr-input active fechaInicio-contrato" placeholder="YYYY-MM-DD" readonly="readonly">
                                                </div>      
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Fecha final</label>
                                                    <input type="text" id="fechaFinal-contrato" class="form-control flatpickr-basic flatpickr-input active fechaFinal-contrato" placeholder="YYYY-MM-DD" readonly="readonly">
                                                </div>                                       
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Frecuencia</label>
                                                    <select class="form-select frecuencia-contrato " id="frecuencia-contrato" name="frecuencia-contrato">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Mensual</option>
                                                        <option value="2">Trimestral</option>
                                                        <option value="3">Cuatrimestral</option>
                                                        <option value="4">Semestral</option>
                                                        <option value="5">Anual</option>
                                                        <option value="6">Financiado</option>
                                                    </select>
                                                </div>    

                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Número de cuotas</label>
                                                    <input type="number" class="form-control  numero-contrato" name="numero-contrato" placeholder="" id="numero-contrato"  disabled/>
                                                </div>    
                                                <div class="mb-1 porcentaje" id="porcentaje" style="display:none">
                                                    <label class="form-label" for="basic-icon-default-email">Porcentaje de financiamiento</label>
                                                    <input type="number" class="form-control  porcentaje-contrato" name="numero-contrato" placeholder="" value="0" id="porcentaje-contrato"/>
                                                </div>    
                                                
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Monto asegurado $</label>
                                                    <input type="number" class="form-control  monto-contrato" name="monto-contrato" placeholder="" id="monto-contrato"/>
                                                </div>   
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Prima anual $</label>
                                                    <input type="number" class="form-control  prima-contrato" name="prima-contrato" placeholder="" id="prima-contrato"/>
                                                </div>  
                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Prima en cuotas BS</label>
                                                    <input type="number" class="form-control  prima-contrato-bs" name="prima-contrato-bs" placeholder="" id="prima-contrato-bs"/>
                                                </div>    
                                            
                                                <button type="button" class="btn btn-primary data-submit-contratos-fuera me-1">Guardar</button>
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