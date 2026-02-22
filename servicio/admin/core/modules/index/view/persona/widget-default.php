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

                           
                            </div>
                                

                                          
                                                
                    </section>
                    <!--/ profile info section -->
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->