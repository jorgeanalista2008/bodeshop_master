  <!-- BEGIN: Content-->
  <div class="app-content content" id="dashboard">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Recepción de equipos</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=ingreso">Recepción</a>
                                    </li>
                                    <li class="breadcrumb-item active">Listado
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
              <!-- Horizontal Wizard -->
              <section class="horizontal-wizard">

                    <div class="bs-stepper horizontal-wizard-example">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#account-details" role="tab" id="account-details-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">1</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Cliente</span>
                                        <span class="bs-stepper-subtitle">Detalles del cliente</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#personal-info" role="tab" id="personal-info-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">2</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Item</span>
                                        <span class="bs-stepper-subtitle">Detalles del item</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#address-step" role="tab" id="address-step-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">3</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Imagenes</span>
                                        <span class="bs-stepper-subtitle">Fotos del equipo</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i data-feather="chevron-right" class="font-medium-2"></i>
                            </div>
                            <div class="step" data-target="#social-links" role="tab" id="social-links-trigger">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-box">4</span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Mantenimiento</span>
                                        <span class="bs-stepper-subtitle">Descripción de la falla</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <div id="account-details" class="content" role="tabpanel" aria-labelledby="account-details-trigger">
                                <div class="content-header">
                                    <h5 class="mb-0">Cliente</h5>
                                    <small class="text-muted">Detalles del cliente.</small>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="username">Cliente</label>
                                           
                                            <select class="select2 form-select cmbAddIngreso_idCliente" id="cmbAddIngreso_idCliente" name="cmbAddIngreso_idCliente">                                                                                      
                                                <option value="">Seleccione</option>     
                                            </select>
                                           
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="email">Nombre</label>
                                             <input type="text" name="paso1" id="paso1" class="form-control d-none paso1"/>
                                            <input type="text" name="nombre" id="nombre" class="form-control nombre" placeholder="Gulsaya" aria-label="john.doe" disabled />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 form-password-toggle col-md-6">
                                            <label class="form-label" for="password">Telefono</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control telefono" placeholder="+584261234567" disabled />
                                        </div>
                                        <div class="mb-1 form-password-toggle col-md-6">
                                            <label class="form-label" for="confirm-password">Correo</label>
                                            <input type="email" name="correo" id="correo" class="form-control correo" placeholder="correo@guslaya.com"  disabled/>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary btn-prev" disabled>
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                    </button>
                                    <button class="btn btn-primary btn-next" >
                                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="personal-info" class="content" role="tabpanel" aria-labelledby="personal-info-trigger">
                                <div class="content-header">
                                    <h5 class="mb-0">Articulo</h5>
                                    <small>Detalles del articulo.</small>
                                </div>
                                <form>
                                    <div class="row">
                                    <div class="mb-1 col-md-6">
                                            <label class="form-label" for="username">Código</label>
                                            <select class="select2 form-select cmbAddIngreso_idVehiculo" id="cmbAddIngreso_idVehiculo" name="cmbAddIngreso_idVehiculo">                                                                                      
                                                <option value="">Seleccione</option>     
                                            </select>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="last-name">Serial Chapa</label>
                                            <input type="text" name="serialChasis" id="serialChasis" class="form-control serialChasis" placeholder="" disabled />
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="country">Tipo</label>

                                            <input type="text" name="tipo" id="tipo" class="form-control tipo" placeholder="" aria-label="john.doe" disabled />
                                          
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="country">Marca</label>
                                            <input type="text" name="marca" id="marca" class="form-control marca" placeholder="" aria-label="john.doe" disabled />
                                          
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="country">Modelo</label>
                                            <input type="text" name="modelo" id="modelo" class="form-control modelo" placeholder="" aria-label="john.doe" disabled />
                                          
                                        </div>  
                                        
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="country">Año</label>
                                            <input type="text" name="ano" id="ano" class="form-control ano" placeholder="" aria-label="john.doe" disabled />
                                          
                                        </div>   
                                    </div>

                                       <div class="row">
                                            <div class="mb-1 col-md-6">
                                                <label class="form-label" for="country">Color</label>
                                                <input type="text" name="color" id="color" class="form-control color" placeholder="" aria-label="john.doe" disabled />
                                            
                                            </div>  
                                        
                                            <div class="col-12 col-sm-6">
                                                <label class="form-label" for="country">Imagen</label>
                                                <div class="profile-img">
                                                        <img src="" class="rounded img-fluid media" alt="Imagen  del item" id="media">                                                 

                                                </div>                                     
                                            </div>
                                    
                                        </div>  
                                        <br>
                                </form>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                    </button>
                                    <button class="btn btn-primary btn-next  btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="address-step" class="content" role="tabpanel" aria-labelledby="address-step-trigger">
                                <div class="content-header">
                                    <h5 class="mb-0">Fotos</h5>
                                    <small>Fotografias del equipo.</small>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <div class="profile-img">
                                                    <img src="" class="rounded img-fluid image_edit" alt="Card image" id="preview_image_edit">
                                                    <input type="hidden" class="form-control image_edit_p" placeholder="00001" aria-describedby="button-addon2" value="0"  id="image_edit_p" name="image_edit_p"/>

                                            </div>
                                                <label class="form-label" for="basic-icon-default-email">Foto *</label>
                                                <input type="file" accept="image/jpg,image/jpeg,image/webp,image/png" class="form-control imagen_edit" name="imagen_edit" id="imagen_edit" multiple=""><br>
                                                <p>Solo se permite (1) archivos en formato .webp </p>
                                        </div> 
                                        <div class="col-12 col-sm-6 mb-1">
                                            <div class="profile-img">
                                                    <img src="" class="rounded img-fluid image_edit" alt="Card image" id="preview_image_edit">
                                                    <input type="hidden" class="form-control image_edit_p" placeholder="00001" aria-describedby="button-addon2" value="0"  id="image_edit_p" name="image_edit_p"/>

                                            </div>
                                                <label class="form-label" for="basic-icon-default-email">Foto *</label>
                                                <input type="file" accept="image/jpg,image/jpeg,image/webp,image/png" class="form-control imagen_edit" name="imagen_edit" id="imagen_edit" multiple=""><br>
                                                <p>Solo se permite (1) archivos en formato .webp </p>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <div class="profile-img">
                                                    <img src="" class="rounded img-fluid image_edit" alt="Card image" id="preview_image_edit">
                                                    <input type="hidden" class="form-control image_edit_p" placeholder="00001" aria-describedby="button-addon2" value="0"  id="image_edit_p" name="image_edit_p"/>

                                            </div>
                                                <label class="form-label" for="basic-icon-default-email">Foto *</label>
                                                <input type="file" accept="image/jpg,image/jpeg,image/webp,image/png" class="form-control imagen_edit" name="imagen_edit" id="imagen_edit" multiple=""><br>
                                                <p>Solo se permite (1) archivos en formato .webp </p>
                                        </div> 
                                        <div class="col-12 col-sm-6 mb-1">
                                            <div class="profile-img">
                                                    <img src="" class="rounded img-fluid image_edit" alt="Card image" id="preview_image_edit">
                                                    <input type="hidden" class="form-control image_edit_p" placeholder="00001" aria-describedby="button-addon2" value="0"  id="image_edit_p" name="image_edit_p"/>

                                            </div>
                                                <label class="form-label" for="basic-icon-default-email">Foto *</label>
                                                <input type="file" accept="image/jpg,image/jpeg,image/webp,image/png" class="form-control imagen_edit" name="imagen_edit" id="imagen_edit" multiple=""><br>
                                                <p>Solo se permite (1) archivos en formato .webp </p>
                                        </div> 
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                    </button>
                                    <button class="btn btn-primary btn-next">
                                        <span class="align-middle d-sm-inline-block d-none">Siguiente</span>
                                        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="social-links" class="content" role="tabpanel" aria-labelledby="social-links-trigger">
                                <div class="content-header">
                                    <h5 class="mb-0">Matenimiento</h5>
                                    <small>Detalles de la falla.</small>
                                </div>
                                <form>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="twitter">Twitter</label>
                                            <input type="text" id="twitter" name="twitter" class="form-control" placeholder="https://twitter.com/abc" />
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="facebook">Facebook</label>
                                            <input type="text" id="facebook" name="facebook" class="form-control" placeholder="https://facebook.com/abc" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="google">Google+</label>
                                            <input type="text" id="google" name="google" class="form-control" placeholder="https://plus.google.com/abc" />
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="linkedin">Linkedin</label>
                                            <input type="text" id="linkedin" name="linkedin" class="form-control" placeholder="https://linkedin.com/abc" />
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary btn-prev">
                                        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                    </button>
                                    <button class="btn btn-success btn-submit">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /Horizontal Wizard -->
           
            </div>
        </div>
    </div>
    <!-- END: Content-->