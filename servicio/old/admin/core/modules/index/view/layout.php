<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title><?php echo APP_NAME ?></title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/jstree.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/charts/apexcharts.css">
 

    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/extensions/shepherd.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/themes/semi-dark-layout.css">
 <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-tour.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-file-manager.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Page CSS-->

    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-wizard.css">
        <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/page-profile.css">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-invoice.css">
        <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-invoice-print.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->
    <!-- END: Custom CSS-->
   

    
    
    
  <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-wizard.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/plugins/forms/form-validation.css">
  <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/modal-create-app.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav bookmark-icons">
             

              <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"  id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex " style="align-items: flex-start !important;"><span class="user-name fw-bolder"><?php  if(isset($_SESSION['tenancy_name'])){
                echo $_SESSION['tenancy_name'];
                }else{
                Action::execute("salir",array());
                }?></span><span class="user-status"><?php  echo $_SESSION['tenancy_rif']?></span></div><span class="avatar"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">                     
                            <a class="dropdown-item" href="index.php?view=empresa">
                                <i class="me-50" data-feather="settings"></i> Configuracion
                            </a>
                            
                    </div>
                </li>
               
                </ul>
               
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item "><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalAddVehiculo" title="Agregar item"><i class="ficon" data-feather="slack"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalAddCliente" title="Agregar cliente"><i class="ficon" data-feather="user"></i></a></li>
            
            <li class="nav-item "><a class="nav-link" href="index.php?view=articulos"  title="Inventario de partes"><i class="ficon" data-feather='layers'></i></a></li>
              
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex "><span class="user-name fw-bolder"><?php  if(isset($_SESSION['nombre'])){
                echo $_SESSION['nombre'];
                }else{
                Action::execute("salir",array());
                }?></span><span class="user-status"><?php  echo $_SESSION['nombreUsuario']?></span></div><span class="avatar"><img class="round" src="../app-assets/images/portrait/small/admin.png" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">                     
                            <a class="dropdown-item" href="index.php?view=user">
                                <i class="me-50" data-feather="settings"></i> Configuracion
                            </a>
                            <a class="dropdown-item"  href="javascript:void(0)"  id ="salir">
                                <i class="me-50" data-feather="power"></i> Salir
                            </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    
    
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
       
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item active"><a class="d-flex align-items-center" href="./"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Tablero</span></a>    
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Menú</span><i data-feather="more-horizontal"></i>
                </li>
               
            
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='box'></i><span class="menu-title text-truncate" data-i18n="User">Inventario</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="index.php?view=articulos"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Listado general</span></a>
                        </li>                       
                        <li><a class="d-flex align-items-center" href="index.php?view=entradas"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Entradas</span></a>
                        </li> 
                        <li><a class="d-flex align-items-center" href="index.php?view=salidas"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Salidas</span></a>
                        </li>  
                         
                      
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='cpu'></i><span class="menu-title text-truncate" data-i18n="User">Items</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="index.php?view=items"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Listado general</span></a>
                        </li>                       
                         <li><a class="d-flex align-items-center" href="index.php?view=ordenesTrabajo&filtro=0"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Ordenes de trabajo</span></a>
                        </li>          
                       
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level"></span>asdsad</a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="index.php?view=orden"><span class="menu-item text-truncate" data-i18n="Third Level">Orden Salida</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="index.php?view=ordenes"><span class="menu-item text-truncate" data-i18n="Third Level">Listado general</span></a>
                                </li>
                            </ul>
                        </li>
                   
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">Reportes</span><i data-feather="more-horizontal"></i>
                </li>
               
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='printer'></i><span class="menu-title text-truncate" data-i18n="User">Articulos</span></a>
                    <ul class="menu-content">                     
                    <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Ordenes</span></a>
                            <ul class="menu-content">                                
                                <li><a class="d-flex align-items-center" href="index.php?view=ordenes"><span class="menu-item text-truncate" data-i18n="Third Level">Listado general</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">Configuracion</span><i data-feather="more-horizontal"></i>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate" data-i18n="User">Generales</span></a>
                    <ul class="menu-content">

 
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=cargos"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Cargos</span></a>    
                        </li>
                      
                        <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=tipos"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Tipo</span></a>    
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=marcas"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Marcas</span></a>    
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=modelos"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Modelos</span></a>    
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=ubicaciones"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Ubicaciones</span></a>    
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='database'></i><span class="menu-title text-truncate" data-i18n="User">Datos</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item"><a class="d-flex align-items-center "  href="index.php?view=empresa"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Empresa</span></a>    
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center "  href="index.php?view=email"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Correo</span></a>    
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center btnRespaldarBase" id="btnRespaldarBase" href="#"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Base de datos</span></a>    
                        </li>
                      
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="User">Personas</span></a>
                    <ul class="menu-content">

                    <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=users"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Usuarios</span></a>    
                    </li>   

                    <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=clientes"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Clientes</span></a>    
                    </li>   
                    
                    <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=personal"><i data-feather='arrow-right'></i><span class="menu-title text-truncate" data-i18n="Card">Personal</span></a>    
                    </li>   

                    </ul>
                </li>
                     
               
              
              
                
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

          <?php 
  // puedo cargar otras funciones iniciales
  // dentro de la funcion donde cargo la vista actual
  // como por ejemplo cargar el corte actual
            if(isset($_SESSION["logged_in"])){
            View::load("dashboard");
            }else{
            Action::execute("salir",array());
            }
        ?>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

     <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2025<a class="ms-25" href="" target="_blank">JMSolutions</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


                    <div class="modal modal-slide-in fade modalAddPersonal" id="modalAddPersonal">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-cliente modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Datos Personales</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nacionalidad *</label>
                                        <select class="form-select cmbPersonaNacionalidad" id="cmbPersonaNacionalidad" name="cmbPersonaNacionalidad">                                           
                                            <option value= "0"> Seleccione </option>	 
                                            <option value= "V-"> Venezolano </option>                                         
                                            <option value= "G-"> Gubernamental </option>	 	                                  
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de documento *</label>
                                        <div class="input-group">
                                                <input class="form-control txtAddPersonaCedula" id="txtAddPersonaCedula" name="txtAddPersonaCedula" type="number"  maxlength="8"  minlength="6"  placeholder="123456789" required  />
                                              
                                                <button class="btn btn-outline-primary waves-effect btnBuscarPersonal"  type="button" id="buscar-cliente"><i data-feather='search'></i></button>
                                            </div>
                                       <!-- <input type="number" class="form-control cedula-cliente" placeholder="123456789" id="cedula-cliente"> -->
                                    </div>     
                                    <div class="datos" id="datos" style="display:none" >
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Apellidos y nombres *</label>
                                        <input class="form-control txtAddPersonaNombreCompleto"  id="txtAddPersonaNombreCompleto" name="txtAddPersonaNombreCompleto" type="text" placeholder="Apellidos y Nombres" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Género *</label>
                                        <select class="form-select cmbPersonaGenero" id="cmbPersonaGenero" name="cmbPersonaGenero">                                           
                                            <option value= "0"> Seleccione </option>	 
                                            <option value= "1"> Femenino </option>	 
                                            <option value= "2"> Masculino </option>
                                          	                                  
                                        </select>
                                    </div>     
                                  
                                     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input class="form-control phone-number-mask pm  txtAddPersonaTelefono" id="txtAddPersonaTelefono" name="txtAddPersonaTelefono" type="text" placeholder="426123456789"  maxlength='13'/>
                                            </div>
                                    </div>      
                                   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                        <input class="form-control txtAddPersonaCorreo" id="txtAddPersonaCorreo"  name="txtAddPersonaCorreo" type="email" placeholder="correo@correo.com" />
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Estado</label>
                                        <select class="select2 form-select cmbAddPersona_idEstado" id="cmbAddPersona_idEstado" name="cmbAddPersona_idEstado">                                                                                      
                                                        <option value="">Seleccione</option>     
                                                        </select>
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Municipio</label>
                                        <select class="select2 form-select cmbAddPersona_idMunicipio" id="cmbAddPersona_idMunicipio" name="cmbAddPersona_idMunicipio" disabled="true">                                                                                      
                                                        <option value="">Seleccione</option>     
                                        </select>
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Parroquia</label>
                                        <select class="select2 form-select cmbAddPersona_idParroquia" id="cmbAddPersona_idParroquia" name="cmbAddPersona_idParroquia" disabled="true">                                                                                      
                                                        <option value="0">Seleccione</option>         
                                        </select>
                                    </div>    

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dirección</label>
                                        <textarea data-length="100" class="form-control char-textarea textAreaAddPersonaDireccion" id="textAreaAddPersonaDireccion" rows="3" placeholder="Dirección de habitación" style="height: 100px"  name="textAreaAddPersonaDireccion"></textarea>
                                        <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 20 </small>
                                    </div>    
                                                     
                                    <div class="mb-1 ">
                                        <label class="form-label" for="basic-icon-default-email">Cargo *</label>
                                        <select class="select2 form-select cmbAddPersona_idCargo" id="cmbAddPersona_idCargo" name="cmbAddPersona_idCargo">
                                                            <option value="0">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>          
                                  
                                    <button type="button" class="btn btn-primary btnAddPersonal me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
             
                    <div class="modal modal-slide-in fade modalAddCliente" id="modalAddCliente">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-cliente modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Datos Personales</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nacionalidad *</label>
                                        <select class="form-select cmbClienteNacionalidad" id="cmbClienteNacionalidad" name="cmbClienteNacionalidad">                                           
                                            <option value= "0"> Seleccione </option>	 
                                            <option value= "V-"> Venezolano </option>                                         
                                            <option value= "G-"> Gubernamental </option>	 	                                  
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de documento *</label>
                                        <input class="form-control txtAddClienteCedula" id="txtAddClienteCedula" name="txtAddClienteCedula" type="number" maxlength="8"  minlength="6" placeholder="123456789" required />
                                    </div>     
                                    <div class="datosCliente" id="datosCliente" >
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Apellidos y nombres *</label>
                                        <input class="form-control txtAddClienteNombreCompleto"  id="txtAddClienteNombreCompleto" name="txtAddClienteNombreCompleto" type="text" placeholder="Apellidos y Nombres" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Género *</label>
                                        <select class="form-select cmbClienteGenero" id="cmbClienteGenero" name="cmbClienteGenero">                                           
                                            <option value= "0"> Seleccione </option>	 
                                            <option value= "1"> Femenino </option>	 
                                            <option value= "2"> Masculino </option>
                                          	                                  
                                        </select>
                                    </div>     
     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input class="form-control phone-number-mask pm2 txtAddClienteTelefono" id="txtAddClienteTelefono" name="txtAddClienteTelefono" type="text" placeholder="426123456789" maxlength='13' />
                                            </div>
                                    </div>      
                                   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                        <input class="form-control txtAddClienteCorreo" id="txtAddClienteCorreo"  name="txtAddClienteCorreo" type="email" placeholder="correo@correo.com" />
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Estado</label>
                                        <select class="select2 form-select cmbAddCliente_idEstado" id="cmbAddCliente_idEstado" name="cmbAddCliente_idEstado">                                                                                      
                                                        <option value="0">Seleccione</option>     
                                                        </select>
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Municipio</label>
                                        <select class="select2 form-select cmbAddCliente_idMunicipio" id="cmbAddCliente_idMunicipio" name="cmbAddCliente_idMunicipio" disabled="true">                                                                                      
                                                        <option value="0">Seleccione</option>     
                                        </select>
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Parroquia</label>
                                        <select class="select2 form-select cmbAddCliente_idParroquia" id="cmbAddCliente_idParroquia" name="cmbAddCliente_idParroquia" disabled="true">                                                                                      
                                                        <option value="0">Seleccione</option>         
                                        </select>
                                    </div>    

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dirección</label>
                                        <textarea data-length="100" class="form-control char-textarea textAreaAddClienteDireccion" id="textAreaAddClienteDireccion" rows="3" placeholder="Dirección de habitación" style="height: 100px"  name="textAreaAddClienteDireccion"></textarea>
                                        <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 20 </small>
                                    </div>    
                                                     
                                   
                                  
                                    <button type="button" class="btn btn-primary btnAddCliente me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal modal-slide-in fade modalAddVehiculo" id="modalAddVehiculo">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddVehiculo modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Datos del Item</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Cliente *</label>
                                        <select class="select2 form-select cmbAddVehiculo_idCliente" id="cmbAddVehiculo_idCliente" name="cmbAddVehiculo_idCliente">                                                                                      
                                                <option value="0">Seleccione</option>     
                                            </select>
                                    </div> 
                               
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Codigo *</label>
                                        <input class="form-control txtAddVehiculoPlaca"  id="txtAddVehiculoPlaca" name="txtAddVehiculoPlaca" type="text" placeholder="ABCD-1234" />
                                    </div> 
                                     <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo  *</label>
                                       
                                        <select class="select2 form-select cmbAddVehiculo_idTipo" id="cmbAddVehiculo_idTipo" name="cmbAddVehiculo_idTipo">
                                                            <option value="0">Seleccione</option>     
                                                           
                                                                                                                                   
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Marca  *</label>
                                       
                                        <select class="select2 form-select cmbAddVehiculo_idMarca" id="cmbAddVehiculo_idMarca" name="cmbAddVehiculo_idMarca" disabled="true">
                                                          
                                        <option value="0">Seleccione</option>                                                                                    
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Modelo  *</label>                                       
                                        <select class="select2 form-select cmbAddVehiculo_idModelo" id="cmbAddVehiculo_idModelo" name="cmbAddVehiculo_idModelo" disabled="true">
                                        <option value="0">Seleccione</option>              
                                                                                                                                   
                                        </select>
                                    </div>     
                                   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Año *</label>
                                        <input class="form-control txtAddVehiculoAno"  id="txtAddVehiculoAno" name="txtAddVehiculoAno" type="number" placeholder="2024" />
                                    </div> 

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Color *</label>
                                        <input class="form-control txtAddVehiculoColor"  id="txtAddVehiculoColor" name="txtAddVehiculoColor" type="text" placeholder="ROJO" />
                                    </div> 

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Serial Chasis *</label>
                                        <input class="form-control txtAddVehiculoSerialChasis"  id="txtAddVehiculoSerialChasis" name="txtAddVehiculoSerialChasis" type="text" placeholder="ABC1DE2" />
                                    </div> 

                                    <div class="mb-1 d-none">
                                        <label class="form-label" for="basic-icon-default-email">Serial Motor *</label>
                                        <input class="form-control txtAddVehiculoSerialMotor"  id="txtAddVehiculoSerialMotor" name="txtAddVehiculoSerialMotor" type="text" placeholder="ABC1DE2" value ="000000001"/>
                                    </div> 

                                    <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Foto *</label>
                                            <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control fileAddVehiculoArchivo" name="fileAddVehiculoArchivo" id="fileAddVehiculoArchivo"><br>
                                                    <p>Solo se permiten archivos en formato .PNG , .JPEG, .JPG <br> que no excedan los 2mb</p>
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Condicion *</label>
                                        <select class="form-select cmbAddVehiculoCondicion" id="cmbAddVehiculoCondicion" name="cmbAddVehiculoCondicion">                                           
                                            <option value= ""> Seleccione </option>	                                          
                                            <option value= "1"> OPERATIVO </option>  
                                            <option value= "2"> INOPERATIVO </option>	 
                                            <option value= "3"> EN REPARACION </option>	  
                                            <option value= "4"> PROCESO DESCARTE </option>     
                                            <option value= "5"> DESCARTADO </option>                               
                                        </select>
                                    </div>      

                                  
                                    <button type="button" class="btn btn-primary btnAddVehiculo me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  
                                   
                                </div>
                            </form>
                        </div>
                    </div>

                
                    

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
           
                  

           <!-- GENERAR ANEXOS SEGUND ANIO FISCAL -->
                     



                       
                    
    <!-- BEGIN: Vendor JS-->
    <script src="../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->
 <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/responsive.bootstrap4.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../app-assets/js/core/app-menu.js"></script>
    <script src="../app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->
    <script src="../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <!-- BEGIN: Page JS-->
    <!--<script src="../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script> -->
    <script src="../app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="../app-assets/vendors/js/forms/cleave/addons/cleave-phone.ve.js"></script>

    <script src="../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="../app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page JS-->
        <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/forms/form-select2.js"></script>
    <!-- END: Page JS-->
    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <script src="../app-assets/js/scripts/forms/form-input-mask.js"></script>
    <!-- END: Page JS-->

    <script src="js/html.js"></script>
    <!-- TODOS LOS DATABLES -->
        <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/extensions/tether.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/shepherd.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="../app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="../app-assets/js/scripts/extensions/ext-component-tour.js"></script>
   <!-- <script src="../app-assets/js/scripts/pages/modal-create-app.js"></script>-->
   <script src="../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page JS-->

    <script src="../app-assets/vendors/js/forms/cleave/cleave.min.js"></script>
    <script src="../app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
    <!-- END: Page JS-->
     <!-- BEGIN: Page JS-->
     <script src="../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
     <script src="../app-assets/js/scripts/pages/app-file-manager.js"></script>
    <!-- END: Page JS-->

    <!-- END: Page JS-->
    <script src="../app-assets/js/scripts/pages/app-invoice.js"></script>
    <script src="js/cookies.js"></script>
    <script src="js/ajax.js"></script>




 <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
  
    </script>
</body>
<!-- END: Body-->

</html>