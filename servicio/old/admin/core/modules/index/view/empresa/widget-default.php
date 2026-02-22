 <!-- BEGIN: Content-->
 <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Empresa</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Detalles de la empresa </a>
                                    </li>
                                    <li class="breadcrumb-item active"> Datos
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-2">
                           
                           
                         

                        <!-- profile -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Detalles de la empresa</h4>
                            </div>
                            <div class="card-body ">
                              
                                <!-- form -->
                                <form class="update-record-empresa mt-2 pt-50">
                                    <div class="row dataEmpresa">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountFirstName">Nombre</label>                                          
                                            <input type="text" class="form-control name" id="name" name="name" placeholder="" value="" data-msg="" />
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountLastName">Correo electrónico empresa</label>
                                            <input type="email" class="form-control email" id="email" name="email" placeholder="" value="" data-msg="" />
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountLastName">Telefonos</label>
                                            <input type="text" class="form-control telefonos" id="telefonos" name="telefonos" placeholder="" value="" data-msg="" />
                                        </div>
                                       

                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountEmail">Rif</label>
                                            <input type="text" class="form-control rif" id="rif" name="rif" placeholder="" value="" />
                                        </div>
                                         
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountOrganization">Direccion</label>
                                            <textarea class="form-control direccion" id="direccion" name="direccion" rows="3" placeholder=""></textarea>
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
                                        
                                        <div class="col-12">
                                            <button type="button" class="btn btn-relief-primary mt-1 me-1 btnEditarEmpresa"> <i data-feather='save'></i> Guardar Cambios</button>
                                           
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                        </div>

                   
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->