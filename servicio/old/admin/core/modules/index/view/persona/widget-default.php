  <!-- BEGIN: Content-->
  <div class="app-content content buscarDataPersona" id="buscarDataPersona">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Persona</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=personal">Personal Registrado</a>
                                    </li>
                                    <li class="breadcrumb-item active">Datos de la Persona
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
                                            <img src="../app-assets/images/portrait/small/cliente.png" class="rounded img-fluid dataPersona_foto" alt="Card image" />
                                        </div> <input type="hidden" class="idPersona" id="idPersona" value ="<?php echo $_GET['id']; ?>">
                                        <!-- profile title -->
                                        <div class="profile-title ms-3">
                                            <h2 class="text-white dataPersona_nombreCompleto" id ="dataPersona_nombreCompleto"></h2>
                                            <p class="text-white dataPersona_rango" id="dataPersona_rango"></p>
                                           
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
                            <div class="col-lg-6 col-12 order-2 order-lg-1">
                                <!-- about -->
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Datos Personales</h5>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Cédula:</h5>
                                            <p class="card-text dataPersona_cedula" id="dataPersona_cedula"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Apellidos y Nombres:</h5>
                                            <p class="card-text dataPersona_nombreCompleto" id="dataPersona_nombreCompleto"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Fecha Nacimiento:</h5>
                                            <p class="card-text dataPersona_fechaNacimiento" id="dataPersona_fechaNacimiento"></p>
                                        </div>   
                                        <div class="mt-2">
                                            <h5 class="mb-75">Teléfono:</h5>
                                            <p class="card-text dataPersona_telefono" id="dataPersona_telefono"></p>
                                        </div>                                  
                                        <div class="mt-2">
                                            <h5 class="mb-75">Correo Electrónico:</h5>
                                            <p class="card-text dataPersona_correo" id="dataPersona_correo"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Estado:</h5>
                                            <p class="card-text dataPersona_estado" id="dataPersona_estado"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <h5 class="mb-75">Municipio:</h5>
                                            <p class="card-text dataPersona_municipio" id="dataPersona_municipio"></p>
                                        </div>   
                                        <div class="mt-2">
                                            <h5 class="mb-75">Parroquia:</h5>
                                            <p class="card-text dataPersona_parroquia" id="dataPersona_parroquia"></p>
                                        </div>   
                                        <div class="mt-2">
                                            <h5 class="mb-75">Dirección:</h5>
                                            <p class="card-text dataPersona_direccion" id="dataPersona_direccion"></p>
                                        </div> 
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-primary btnEditarDatosPersona" data-bs-toggle="modal" data-bs-target="#modalEditPersonal"  >
                                                Editar
                                            </button>
                                              <!-- MODAL DE PERSONAL -->
                                              <div class="modal modal-slide-in fade modalEditPersonal" id="modalEditPersonal">
                                                <div class="modal-dialog sidebar-sm">
                                                    <form class="frmEditPersonal modal-content pt-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                        <div class="modal-header mb-1">
                                                            <h5 class="modal-title" id="exampleModalLabel">Datos Personales</h5>
                                                        </div>
                                                        <div class="modal-body flex-grow-1">
                                                            
                                                            <div class="datos" id="datos" style="display:" >
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Apellidos y nombres *</label>
                                                                <input class="form-control txtEditPersonaNombreCompleto"  id="txtEditPersonaNombreCompleto" name="txtEditPersonaNombreCompleto" type="text" placeholder="Apellidos y Nombres" />
                                                            </div> 
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Género *</label>
                                                                <select class="form-select cmbEditPersonaGenero" id="cmbEditPersonaGenero" name="cmbEditPersonaGenero">                                           
                                                                    <option value= "0"> Seleccione </option>	 
                                                                    <option value= "1"> Femenino </option>	 
                                                                    <option value= "2"> Masculino </option>
                                                                                                    
                                                                </select>
                                                            </div>     
                                                        
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Fecha Nacimiento</label>
                                                                <input type="text" id="txtEditPersonaFechaNacimiento" class="form-control flatpickr-basic flatpickr-input active txtEditPersonaFechaNacimiento" name="txtEditPersonaFechaNacimiento" placeholder="YYYY-MM-DD" readonly="readonly">
                                                            </div>      
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                                                <div class="input-group input-group-merge">
                                                                        <span class="input-group-text">VE (+58)</span>
                                                                        <input class="form-control phone-number-mask  txtEditPersonaTelefono" id="txtEditPersonaTelefono" name="txtEditPersonaTelefono" type="text" placeholder="0426123456789" />
                                                                    </div>
                                                            </div>      
                                                        
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                                                <input class="form-control txtEditPersonaCorreo" id="txtEditPersonaCorreo"  name="txtEditPersonaCorreo" type="email" placeholder="correo@correo.com" />
                                                            </div>  
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Estado</label>
                                                                <select class="select2 form-select cmbEditPersona_idEstado" id="cmbEditPersona_idEstado" name="cmbEditPersona_idEstado">                                                                                      
                                                                                <option value="0">Seleccione</option>     
                                                                                </select>
                                                            </div>   
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Municipio</label>
                                                                <select class="select2 form-select cmbEditPersona_idMunicipio" id="cmbEditPersona_idMunicipio" name="cmbEditPersona_idMunicipio" disabled="true">                                                                                      
                                                                                <option value="0">Seleccione</option>     
                                                                </select>
                                                            </div>   
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Parroquia</label>
                                                                <select class="select2 form-select cmbEditPersona_idParroquia" id="cmbEditPersona_idParroquia" name="cmbEditPersona_idParroquia" disabled="true">                                                                                      
                                                                                <option value="0">Seleccione</option>         
                                                                </select>
                                                            </div>    

                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Dirección</label>
                                                                <textarea data-length="100" class="form-control char-textarea textAreaEditPersonaDireccion" id="textAreaEditPersonaDireccion" rows="3" placeholder="Dirección de habitación" style="height: 100px"  name="textAreaEditPersonaDireccion"></textarea>
                                                                <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 20 </small>
                                                            </div>    
                                                                            
                                                                            
                                                        
                                                            <button type="button" class="btn btn-primary btnEditPersonal me-1">Editar</button>
                                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        
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
                            <div class="col-lg-6 col-12 order-1 order-lg-2">
                                <!-- post 1 -->
                               
                                <div class="row">                                                     
                                
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Datos Organizacionales</h5>
                                        <div class="mt-2">

                                            <h5 class="mb-75">Redi:</h5>
                                            <p class="card-text dataPersona_redi" id="dataPersona_redi"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Zodi:</h5>
                                            <p class="card-text dataPersona_zodi" id="dataPersona_zodi"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Brigada:</h5>
                                            <p class="card-text dataPersona_brigada" id="dataPersona_brigada"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Unidad:</h5>
                                            <p class="card-text dataPersona_unidad" id="dataPersona_unidad"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Dependencia:</h5>
                                            <p class="card-text dataPersona_dependencia" id="dataPersona_dependencia"></p>
                                        </div>

                                        <div class="mt-2">
                                            <h5 class="mb-75">Tipo:</h5>
                                            <p class="card-text dataPersona_tipo" id="dataPersona_tipo"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Categoría:</h5>
                                            <p class="card-text dataPersona_categoria" id="dataPersona_categoria"></p>
                                        </div>   
                                        <div class="mt-2">
                                            <h5 class="mb-75">Componente:</h5>
                                            <p class="card-text dataPersona_componente" id="dataPersona_componente"></p>
                                        </div>                                  
                                        <div class="mt-2">
                                            <h5 class="mb-75">Grado:</h5>
                                            <p class="card-text dataPersona_grado" id="dataPersona_grado"></p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Cargo:</h5>
                                            <p class="card-text dataPersona_cargo" id="dataPersona_cargo"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <h5 class="mb-75">Licencia:</h5>
                                            <p class="card-text dataPersona_licencia" id="dataPersona_licencia"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <h5 class="mb-75">Licencia:</h5>
                                            <p class="card-text dataPersona_certificado" id="dataPersona_certificado"></p>
                                        </div>     
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalEditPersonalContrato">
                                                    Editar
                                            </button>
                                              <!-- MODAL DE PERSONAL -->
                                                <div class="modal modal-slide-in fade modalEditPersonalContrato" id="modalEditPersonalContrato">
                                                    <div class="modal-dialog sidebar-sm">
                                                        <form class="frmEditPersonalContrato modal-content pt-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                            <div class="modal-header mb-1">
                                                                <h5 class="modal-title" id="exampleModalLabel">Interés Organizacional</h5>
                                                            </div>
                                                            <div class="modal-body flex-grow-1">
                                                               
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Tipo  *</label>
                                                                
                                                                    <select class="select2 form-select cmbEditPersonaTipo" id="cmbEditPersonaTipo" name="cmbEditPersonaTipo">
                                                                                        <option value="">Seleccione</option> 
                                                                                        <!-- 99 para personal civil -->    
                                                                                        <option value="1">Civil</option>   
                                                                                        <option value="2">Militar</option>                                                                                    
                                                                    </select>
                                                                </div>     
                                                                <div class="frmMilitar" style="display:none">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basic-icon-default-email">Categoria *</label>
                                                                        <select class="select2 form-select cmbEditPersonaCategoria" id="cmbEditPersonaCategoria" name="cmbEditPersonaCategoria">
                                                                                        <!-- 99 para personal civil -->
                                                                                        <option value="0">Seleccione</option>     
                                                                                        <option value="1">EFECTIVOS (OFICIALES DE COMANDO)</option>   
                                                                                        <option value="2">EFECTIVOS (OFICIALES TÉCNICOS)</option>  
                                                                                        <option value="3">EFECTIVOS (OFICIALES DE TROPA)</option>    
                                                                                        <option value="4">ASIMILADOS (ASIMILIADO TÉCNICO)</option>
                                                                                        <option value="5">ASIMILADOS (ASIMILADO)</option>        
                                                                                        <option value="6">TROPA PROFESIONAL</option>                                                                                                    
                                                                                        <option value="7">TROPA ALISTADA</option>    
                                                                                        <option value="8">ASPIRANTE</option>         
                                                                        </select>
                                                                                    
                                                                    </div> 
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basic-icon-default-email">Componente *</label>
                                                                        <select class="select2 form-select cmbEditPersona_idComponente" id="cmbEditPersona_idComponente" name="cmbEditPersona_idComponente">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                  
                                                                        </select>
                                                                                    
                                                                    </div> 
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basic-icon-default-email">Grado *</label>
                                                                        <select class="select2 form-select cmbEditPersona_idGrado" id="cmbEditPersona_idGrado" name="cmbEditPersona_idGrado" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                  
                                                                        </select>
                                                                                    
                                                                    </div> 
                                                                </div>
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Cargo *</label>
                                                                    <select class="select2 form-select cmbEditPersona_idCargo" id="cmbEditPersona_idCargo" name="cmbEditPersona_idCargo">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div> 
                                                            
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Redi *</label>
                                                                    <select class="select2 form-select cmbEditPersona_idRedi" id="cmbEditPersona_idRedi" name="cmbEditPersona_idRedi">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>      
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Zodi *</label>
                                                                    <select class="select2 form-select cmbEditPersona_idZodi" id="cmbEditPersona_idZodi" name="cmbEditPersona_idZodi" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                        </select> 
                                                                </div>      
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Brigada *</label>
                                                                    <select class="select2 form-select cmbEditPersona_idBrigada" id="cmbEditPersona_idBrigada" name="cmbEditPersona_idBrigada" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>  
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Unidad *</label>
                                                                    <select class="select2 form-select cmbEditPersona_idUnidad" id="cmbEditPersona_idUnidad" name="cmbEditPersona_idUnidad" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>   
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Dependencia *</label>
                                                                    <select class="select2 form-select cmbEditPersona_idDependencia" id="cmbEditPersona_idDependencia" name="cmbEditPersona_idDependencia" disabled="true">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>   
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Licencia de Conducir *</label>
                                                                    <select class="select2 form-select cmbEditPersonaLicencia" id="cmbEditPersonaLicencia" name="cmbEditPersonaLicencia">
                                                                                        <option value="">Seleccione</option>     
                                                                                        <option value="1">1Era</option>   
                                                                                        <option value="2">2Da</option>     
                                                                                        <option value="3">3Era</option>   
                                                                                        <option value="4">4Ta</option>                                                                                       
                                                                                        <option value="5">5Ta</option>                                                                                       
                                                                                        <option value="99">NO POSEE</option>   
                                                                                    </select>
                                                                </div>     
                                                            
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Certificado Médico</label>
                                                                    <select class="select2 form-select cmbEditPersonaCertificado" id="cmbEditPersonaCertificado" name="cmbEditPersonaCertificado">
                                                                                        <option value="">Seleccione</option>     
                                                                                        <option value="1">SI</option>   
                                                                                        <option value="99">NO</option>     
                                                                                    
                                                                    </select>
                                                                </div>    
                                                                                
                                                                                        
                                                            
                                                                <button type="button" class="btn btn-primary btnEditPersonalContrato me-1">Guardar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            
                                                            
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                 <!-- MODAL DE PERSONAL -->
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