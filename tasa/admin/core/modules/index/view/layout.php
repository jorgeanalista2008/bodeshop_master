<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="SegurOS es un sistema integral para la gestion de procesos administrativos de control de pòlizas, cobranzas, alertas.">
    <meta name="keywords" content="admin, dashboard , responsive, web app">
    <meta name="author" content="DSD-NEO">
    <title>SeguExpress</title>
    <link rel="apple-touch-icon" href="../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../app-assets/images/ico/favicon.ico">
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

        <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/page-profile.css">
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-invoice.css">
        <link rel="stylesheet" type="text/css" href="../app-assets/css/pages/app-invoice-print.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- END: Custom CSS-->

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
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-cliente" title="Cliente"><i class="ficon" data-feather='users'></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-auto" title="Auto"><i class="ficon" data-feather="truck"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-estructura" title="Inmueble"><i class="ficon" data-feather="home"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-otro" title="Otro"><i class="ficon" data-feather="square"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-patrimonio" title="Patrimonial"><i class="ficon" data-feather="slack"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-poliza-personal" title="Personal"><i class="ficon" data-feather="user"></i></a></li>
                   
                </ul>
               
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">

                <!-- <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-configuracion" title="Configuracion"><i class="ficon" data-feather='settings'></i></a></li> -->
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="index.php?view=polizas"  title="Polizas"><i class="ficon" data-feather='shield'></i></a></li><!--  acceso directo -->
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="index.php?view=contratos"  title="Contratos"><i class="ficon" data-feather='align-justify'></i></a></li><!--  acceso directo -->
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="index.php?view=pagos"  title="Pagos"> <i class="ficon" data-feather='dollar-sign'></i></a></li><!--  acceso directo -->
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
              <!--
                <li class="nav-item dropdown dropdown-notification me-25"><a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge rounded-pill bg-danger badge-up">Ver</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 me-auto">Notificaciones</h4>
                                <div class="buscador" id="iguales">
      
        <input  class ="form-control" id="buscador" type="input" value="">
                </div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list" id="alertas1"> 
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="#">Ver todas</a></li>
                    </ul>
                </li>
-->
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"><?php  if(isset($_SESSION['nombre'])){
  echo $_SESSION['nombre'];
}else{
  Action::execute("salir",array());
}?></span><span class="user-status"><?php  echo $_SESSION['nombreUsuario']?></span></div><span class="avatar"><img class="round" src="../app-assets/images/portrait/small/admin.png" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                      
                            <a class="dropdown-item" href="index.php?view=tour">
                                <i class="me-50" data-feather="help-circle"></i> Tour
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
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="./"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">SeguExpress</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item active"><a class="d-flex align-items-center" href="./"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Tablero</span></a>    
                </li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Menú</span><i data-feather="more-horizontal"></i>
                </li>
               
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span class="menu-title text-truncate" data-i18n="User">Pólizas</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="index.php?view=polizas"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Listado general</span></a>
                        </li>
                       
                       
                        <li><a class="d-flex align-items-center" href="index.php?view=contratos"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="View">Contratos</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="index.php?view=pagos"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Pagos</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="index.php?view=alertasPagos"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Edit">Alertas</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">Clientes</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="index.php?view=cliente"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Listado</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="index.php?view=archivos"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Achivos</span></a>
                        </li>
                        <li><a class="d-flex align-items-center" href="index.php?view=siniestro"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Siniestros</span></a>
                        </li>
                        
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">Reportes</span><i data-feather="more-horizontal"></i>
                </li>
              
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="printer"></i><span class="menu-title text-truncate" data-i18n="Card">Anexos</span><span class="badge badge-light-success rounded-pill ms-auto me-1">Ver</span></a>
                <ul class="menu-content">

                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='circle'></i><span class="menu-title text-truncate" data-i18n="Card">Anexo 1</span></a>
                            <ul class="menu-content">                
                                <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-anexo1" title="Reportes anexo 1"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='circle'></i><span class="menu-title text-truncate" data-i18n="Card">Anexo 2</span></a>
                            <ul class="menu-content">                
                                <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-anexo1" title="Reportes anexo 1"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                                </li>
                            </ul>
                        </li>
                      <!-- 
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo1"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 1</span></a>
                        </li>
                       
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo2"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 2</span></a>
                        </li>  
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo3"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 3</span></a>
                        </li>     
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo4"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 4</span></a>
                        </li>  
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo5"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 5</span></a>
                        </li> 
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo6"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 6</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo7"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 7</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo8"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 8</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo9"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 9</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo10"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 10</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo11"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 11</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo12"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 12</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo13"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 13</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo14"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 14</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo15"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 15</span></a>
                        </li>   
                     
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo16"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 16</span></a>
                        </li>  
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo16Detalles"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 16 Detallles</span></a>
                        </li>    
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo17"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 17</span></a>
                        </li>   
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo18"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 18</span></a>
                        </li> 
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo19"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 19</span></a>
                        </li> 
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo20"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 20</span></a>
                        </li> 
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo21"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 21</span></a>
                        </li> 
                        <li><a class="d-flex align-items-center" href="index.php?view=anexo21Detalles"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Basic">Anexo 21 Detallles</span></a>
                        </li>   
                        -->                                   
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='bar-chart-2'></i><span class="menu-title text-truncate" data-i18n="Card">Balances</span><span class="badge badge-light-success rounded-pill ms-auto me-1">Ver</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Por ramos</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=1" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Automoviles</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=2" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Inmuebles</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=3" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Varias</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=4" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Patrimoniales</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=5" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Personales</span></a>
                                </li>
                            </ul>
                        </li>
                     
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Pagos</span></a>
                            <ul class="menu-content">
                                <!--
                                <li><a class="d-flex align-items-center"  href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-4"><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                                </li>
                               -->
                                <!--
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=9" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Primas</span></a>
                                </li>
                                -->
                                <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-4"><span class="menu-item text-truncate" data-i18n="Third Level">Primas</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-5"><span class="menu-item text-truncate" data-i18n="Third Level">Comisiones</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-6"><span class="menu-item text-truncate" data-i18n="Third Level">Bonos</span></a>
                                </li>
                                <!--
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=7" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Comisiones</span></a>
                                </li>
                                <li><a class="d-flex align-items-center" href="index.php?action=reportes&a=8" target="_blank"><span class="menu-item text-truncate" data-i18n="Third Level">Bonos</span></a>
                                </li>
                                -->

                               
                            </ul>
                        </li>

                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Global</span></a>
                            <ul class="menu-content">
                                <li><a class="d-flex align-items-center"  href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-3"><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                                </li>
                               
                               
                               

                               
                            </ul>
                        </li>
                        
                        <li><a class="d-flex align-items-center" href="#"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Second Level">Global x Mes</span></a>
                            <ul class="menu-content">
                                
                                <li><a class="d-flex align-items-center"  href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-8"><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                                </li>
                               
                              
                            </ul>
                        </li>
                      
                    </ul>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='refresh-cw'></i><span class="menu-title text-truncate" data-i18n="Card">Por renovaciones</span></a>
                    <ul class="menu-content">                
                        <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-2" title="Reportes renovaciones"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='alert-triangle'></i><span class="menu-title text-truncate" data-i18n="Card">Pòlizas anuladas</span></a>
                    <ul class="menu-content">                
                        <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-7" title="Reportes polizas anuladas"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                        </li>
                    </ul>
                </li>
              
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='dollar-sign'></i><span class="menu-title text-truncate" data-i18n="Card">Cuotas</span><span class="badge badge-light-success rounded-pill ms-auto me-1">Ver</span></a>
                    <ul class="menu-content">                    
                        <li><a class="d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#modals-slide-in-generar-1" title="Reportes cuotas"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Third Level">Generar</span></a>
                        </li>
                    </ul>
                </li>
              
                
                <li class=" navigation-header"><span data-i18n="User Interface">Configuracion</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=users"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Card">Usuarios</span></a>    
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=banco"><i data-feather='home'></i><span class="menu-title text-truncate" data-i18n="Card">Bancos</span></a>    
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="index.php?view=aseguradora"><i data-feather='key'></i><span class="menu-title text-truncate" data-i18n="Card">Aseguradoras</span></a>    
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
        <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022<a class="ms-25" href="#" target="_blank">Serviconstrucciones KSK C.A</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
            <!-- MODAL DE CLIENTE -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-cliente">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-cliente modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo registro de cliente</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nacionalidad *</label>
                                        <select class="form-select nacionalidad-cliente" id="nacionalidad-cliente" name="nacionalidad-cliente">                                           
                                            <option value= ""> Seleccione </option>	 
                                            <option value= "V-"> Venezolano </option>	 
                                            <option value= "E-"> Extranjero </option>
                                            <option value= "J-"> Jurídico </option>	 	 
                                            <option value= "G-"> Gubernamental </option>	 	                                  
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de documento *</label>
                                        <div class="input-group">
                                                <input type="number" class="form-control cedula-cliente" placeholder="123456789" id="cedula-cliente" aria-describedby="button-addon2">
                                                <button class="btn btn-outline-primary waves-effect buscar-cliente"  type="button" id="buscar-cliente"><i data-feather='search'></i></button>
                                            </div>
                                       <!-- <input type="number" class="form-control cedula-cliente" placeholder="123456789" id="cedula-cliente"> -->
                                    </div>     
                                    <div class="datos" id="datos" style="display:none" >
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Apellidos y nombres *</label>
                                        <input type="text" class="form-control  nombre-cliente" name="nombre" placeholder="" id="nombre-cliente" />
                                    </div> 
                                   
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha Nacimiento</label>
                                        <input type="text" id="fechaNacimiento-cliente" class="form-control flatpickr-basic flatpickr-input active fechaNacimiento-cliente" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input type="text" class="form-control phone-number-mask telefono-cliente" placeholder="254 232 55 66"  id="telefono-cliente" />
                                            </div>
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono móvil *</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input type="text" class="form-control phone-number-mask telefono2-cliente" placeholder=" 412 123 55 66" id="telefono2-cliente" />
                                            </div>
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                        <input type="email" class="form-control correo-cliente" placeholder="usuario@gmail.com" id="correo-cliente">
                                    </div>    
                                                     
                                  
                                    <button type="button" class="btn btn-primary data-submit-cliente me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                   
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- MODAL DE PERSONAL -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-personal">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-poliza-personal modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva póliza de vida</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de Póliza * </label>
                                        <input type="text" class="form-control  numero-vida" name="numero-vida" placeholder="" id="numero-vida" />
                                        <input type="hidden" class="form-control  usuario-vida" name="usuario-vida" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-vida" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Cliente * </label>
                                        <select class="select2 form-select idClientes-vida" id="idClientes-vida" name="idClientes-vida">                                           
                                        <option value="0"> Seleccione </option>	                                      
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha emisión * </label>
                                        <input type="text" id="emision-vida" class="form-control flatpickr-basic flatpickr-input active emision-vida" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class=" select2 form-select idAseguradora-vida" id="idAseguradora-vida" name="idAseguradora-vida">                                           
                                        <option value=""> Seleccione </option>	                                    
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select idSucursal-vida" id="idSucursal-vida" name="idSucursal-vida">                                           
                                        <option value=""> Seleccione </option>	                                    
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nombre y apellido * </label>
                                        <input type="text" class="form-control  nombre-vida" name="nombre-vida" placeholder="" id="nombre-vida" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de documento *</label>
                                        <input type="text" class="form-control cedula-vida" placeholder="V-123456789" id="cedula-vida">
                                    </div>     
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha Nacimiento</label>
                                        <input type="text" id="fechaNacimiento-vida" class="form-control flatpickr-basic flatpickr-input active fechaNacimiento-vida" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input type="text" class="form-control phone-number-mask telefono-vida" placeholder="254 232 55 66"  id="telefono-vida" />
                                            </div>
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono móvil * </label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input type="text" class="form-control phone-number-mask telefono2-vida" placeholder=" 412 123 55 66" id="telefono2-vida" />
                                            </div>
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                        <input type="email" class="form-control correo-vida" placeholder="usuario@gmail.com" id="correo-vida">
                                    </div>    
                                                     
                                  
                                    <button type="button" class="btn btn-primary data-submit-poliza-personal me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                      <!-- MODAL DE auto -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-auto">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-poliza-auto modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva póliza para automóviles</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de Póliza * </label>
                                        <input type="text" class="form-control  numero-auto" name="numero-auto" placeholder="" id="numero-auto" />
                                        <input type="hidden" class="form-control  usuario-auto" name="usuario-auto" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-auto" />
                                    </div> 

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo de Póliza * </label>
                                        <select class="form-select estado-auto" id="estado-auto" name="estado-auto">                                           
                                            <option value= "0"> Seleccione </option>	 
                                            <option value= "1"> RCV </option>	 
                                            <option value= "2"> COBERTURA AMPLIA </option>	  
                                            <option value= "3"> PERDIDA TOTAL </option>	                                  
                                        </select>
                                    </div>    
                                    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Cliente * </label>
                                        <select class="select2 form-select idClientes-auto" id="idClientes-auto" name="idClientes-auto">                                           
                                        <option> Seleccione </option>	                                    
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha emisión * </label>
                                        <input type="text" id="emision-auto" class="form-control flatpickr-basic flatpickr-input active emision-auto" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select idAseguradora-auto" id="idAseguradora-auto" name="idAseguradora-auto">                                           
                                        <option value=""> Seleccione </option>	                                    
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select idSucursal-auto" id="idSucursal-auto" name="idSucursal-auto">                                           
                                        <option value=""> Seleccione </option>	                                     
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo de vehículo</label>
                                        <input type="text" class="form-control  tipo-auto" name="tipo-auto" placeholder="" id="tipo-auto" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Marca</label>
                                        <input type="text" class="form-control  marca-auto" name="marca-auto" placeholder="" id="marca-auto" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Modelo</label>
                                        <input type="text" class="form-control  modelo-auto" name="modelo-auto" placeholder="" id="modelo-auto" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Placa * </label>
                                        <input type="text" class="form-control placa-auto" placeholder="asd1234" id="placa-auto">
                                    </div>     
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Color</label>
                                        <input type="text" class="form-control color-auto" placeholder="Naranja" id="color-auto">
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Año</label>
                                        <input type="number" class="form-control ano-auto" placeholder="2022" id="ano-auto">
                                    </div>    
                                    
                                    

                                   
                                  
                                    <button type="button" class="btn btn-primary data-submit-poliza-auto me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                        <!-- MODAL DE estructura -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-estructura">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-poliza-estructura modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva póliza para inmueble</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de Póliza * </label>
                                        <input type="text" class="form-control  numero-estructura" name="numero-estructura" placeholder="" id="numero-estructura" />
                                        <input type="hidden" class="form-control  usuario-estructura" name="usuario-estructura" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-estructura" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Cliente * </label>
                                        <select class="select2 form-select idClientes-estructura" id="idClientes-estructura" name="idClientes-estructura">                                           
                                        <option> Seleccione </option>	                                    
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha emisión * </label>
                                        <input type="text" id="emision-estructura" class="form-control flatpickr-basic flatpickr-input active emision-estructura" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select idAseguradora-estructura" id="idAseguradora-estructura" name="idAseguradora-estructura">                                           
                                        <option value=""> Seleccione </option>	                                  
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select idSucursal-estructura" id="idSucursal-estructura" name="idSucursal-estructura">                                           
                                        <option value=""> Seleccione </option>	                               
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dirección * </label>
                                        <input type="text" class="form-control  direccion-estructura" name="direccion-estructura" placeholder="" id="direccion-estructura" />
                                    </div> 
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Valor</label>
                                        <input type="number" class="form-control valor-estructura" placeholder="" id="valor-estructura">
                                    </div>    
                                                     
                                  
                                    <button type="button" class="btn btn-primary data-submit-poliza-estructura me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                         <!-- MODAL DE otro -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-otro">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-poliza-otro modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva póliza para casos otros</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de Póliza * </label>
                                        <input type="text" class="form-control  numero-otro" name="numero-otro" placeholder="" id="numero-otro" />
                                        <input type="hidden" class="form-control  usuario-otro" name="usuario-otro" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-otro" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Cliente * </label>
                                        <select class="select2 form-select idClientes-otro" id="idClientes-otro" name="idClientes-otro">                                           
                                        <option> Seleccione </option>	                                      
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha emisión * </label>
                                        <input type="text" id="emision-otro" class="form-control flatpickr-basic flatpickr-input active emision-otro" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select idAseguradora-otro" id="idAseguradora-otro" name="idAseguradora-otro">                                           
                                        <option value=""> Seleccione </option>	                                   
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select idSucursal-otro" id="idSucursal-otro" name="idSucursal-otro">                                           
                                        <option value=""> Seleccione </option>	                                   
                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo * </label>
                                        <select class="form-select nombre-otro" id="nombre-otro" name="nombre-otro">                                           
                                            <option value= ""> Seleccione </option>	 
                                            <option value= "POLIZA DE VIDA"> POLIZA DE VIDA </option>	 
                                            <option value= "POLIZA ACCIDENTES PERSONALES"> POLIZA ACCIDENTES PERSONALES </option>	 
                                            <option value= "POLIZA PATOLOGIA (CANCER)"> POLIZA PATOLOGIA (CANCER) </option>	
                                            <option value= "POLIZA REPONSABILIDAD CIVIL GENERAL"> POLIZA REPONSABILIDAD CIVIL GENERAL </option>	  
                                            <option value= "POLIZA REPONSABILIDAD EMPRESARIAL"> POLIZA REPONSABILIDAD EMPRESARIAL </option>	      
                                            <option value= "POLIZA REPONSABILIDAD PATRONAL "> POLIZA REPONSABILIDAD PATRONAL </option>	      
                                            <option value= "POLIZA DE HOGAR"> POLIZA DE HOGAR </option>	                                               
                                            <option value= "POLIZA FUNERARIA"> POLIZA FUNERARIA </option>	      
                                            <option value= "POLIZA INCENDIO"> POLIZA INCENDIO </option>	      
                                            <option value= "POLIZA FIANZA"> POLIZA FIANZA </option>	      
                                            <option value= "POLIZA ASISTENCIA DE VIAJES"> POLIZA ASISTENCIA DE VIAJES </option>	      
                                            <option value= "POLIZA OTRO"> POLIZA OTRO </option>	      

                                        </select>
                                    </div>    
                                    
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Descripción * </label>
                                        <input type="text" class="form-control descripcion-otro" placeholder="De que trata la póliza" id="descripcion-otro">
                                    </div>    
                                                     
                                  
                                    <button type="button" class="btn btn-primary data-submit-poliza-otro me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- MODAL DE patrimonio -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-poliza-patrimonio">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-poliza-patrimonio modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva póliza patrimonial</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de Póliza * </label>
                                        <input type="text" class="form-control  numero-patrimonio" name="numero-patrimonio" placeholder="" id="numero-patrimonio" />
                                        <input type="hidden" class="form-control  usuario-patrimonio" name="usuario-patrimonio" value="<?php  echo $_SESSION['nombreUsuario']?>" id="usuario-patrimonio" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Cliente * </label>
                                        <select class="select2 form-select idClientes-patrimonio" id="idClientes-patrimonio" name="idClientes-patrimonio">                                           
                                        <option value=""> Seleccione </option>	                                 
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha emisión * </label>
                                        <input type="text" id="emision-patrimonio" class="form-control flatpickr-basic flatpickr-input active emision-patrimonio" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select idAseguradora-patrimonio" id="idAseguradora-patrimonio" name="idAseguradora-patrimonio">                                           
                                        <option value=""> Seleccione </option>	                              
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select idSucursal-patrimonio" id="idSucursal-patrimonio" name="idSucursal-patrimonio">                                           
                                        <option value=""> Seleccione </option>	                              
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nombre * </label>
                                        <input type="text" class="form-control  nombre-patrimonio" name="nombre-patrimonio" placeholder="" id="nombre-patrimonio" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Identificacion * </label>
                                        <input type="text" class="form-control  identificacion-patrimonio" name="identificacion-patrimonio" placeholder="J-123456789" id="identificacion-patrimonio" />
                                    </div> 
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dirección * </label>
                                        <input type="text" class="form-control  direccion-patrimonio" name="direccion-patrimonio" placeholder="" id="direccion-patrimonio" />
                                    </div> 
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo * </label>
                                        <select class="form-select tipo-patrimonio" id="tipo-patrimonio" name="tipo-patrimonio">                                           
                                            <option value= ""> Seleccione </option>	 
                                            <option value= "1"> RCG </option>	 
                                            <option value= "2"> Patronal </option>	 
                                            <option value= "3"> Empresarial </option>	                                         
                                        </select>
                                    </div>    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Numero de empleados * </label>
                                        <input type="number" class="form-control  numeroe-patrimonio" name="numeroe-patrimonio" placeholder="9" id="numeroe-patrimonio" />
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Ramo</label>
                                        <input type="text" class="form-control  ramo-patrimonio" name="ramo-patrimonio" placeholder="" id="ramo-patrimonio" />
                                    </div>  

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Sueldo general * </label>
                                        <input type="number" class="form-control  sueldo-patrimonio" name="sueldo-patrimonio" placeholder="" id="sueldo-patrimonio" />
                                    </div>  
                                    

                                    <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                            <div class="input-group input-group-merge">
                                                    <span class="input-group-text">VE (+58)</span>
                                                    <input type="text" class="form-control phone-number-mask telefono-patrimonio" placeholder="254 232 55 66"  id="telefono-patrimonio" />
                                                </div>
                                        </div>      
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Teléfono móvil * </label>
                                            <div class="input-group input-group-merge">
                                                    <span class="input-group-text">VE (+58)</span>
                                                    <input type="text" class="form-control phone-number-mask telefono2-patrimonio" placeholder=" 412 123 55 66" id="telefono2-patrimonio" />
                                                </div>
                                        </div>      
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                            <input type="email" class="form-control correo-patrimonio" placeholder="usuario@gmail.com" id="correo-patrimonio">
                                        </div>    
                                                     
                                  
                                  
                                    <button type="button" class="btn btn-primary data-submit-poliza-patrimonio me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal -->
                                            <div class="modal fade" id="new-folder-modal-datacliente" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" >
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Pólizas asociadas</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="polizasAsociadas">
                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                   <!-- Modal -->


                    <!-- MODAL DE reporte1 -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-1">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-1 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">  Cuotas | Criterios de búsqueda</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo * </label>
                                        <select class="form-select generar-1-tipo" id="generar-1-tipo" name="generar-1-tipo">                                           
                                            <option value= ""> Seleccione </option>	 
                                            <option value= "0"> Pendientes por cobrar </option>	 
                                            <option value= "1"> Cobradas </option>
                                         
                                                                                
                                        </select>
                                    </div>    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select generar-1-aseguradora" id="generar-1-aseguradora" name="generar-1-aseguradora">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="999999999"> Todas </option>	                               
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select generar-1-sucursal" id="generar-1-sucursal" name="generar-1-sucursal">                                           
                                        <option value=""> Seleccione </option>
                                        <option value="999999999"> Todas </option>	   	                              
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha desde * </label>
                                        <input type="text" id="generar-1-desde" class="form-control flatpickr-basic flatpickr-input active generar-1-desde" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha hasta * </label>
                                        <input type="text" id="generar-1-hasta" class="form-control flatpickr-basic flatpickr-input active generar-1-hasta" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                   <button type="button" class="btn btn-primary data-submit-generar-1 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                       <!-- MODAL DE reporte2 -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-2">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-2 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Por renovaciones | Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select generar-2-aseguradora" id="generar-2-aseguradora" name="generar-2-aseguradora">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="999999999"> Todas </option>	                               
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select generar-2-sucursal" id="generar-2-sucursal" name="generar-2-sucursal">                                           
                                        <option value=""> Seleccione </option>
                                        <option value="999999999"> Todas </option>	   	                              
                                        </select>
                                    </div>
                                
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha de emsion (Desde) * </label>
                                        <input type="text" id="generar-2-desde" class="form-control flatpickr-basic flatpickr-input active generar-2-desde" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha de emsion (Hasta) * </label>
                                        <input type="text" id="generar-2-hasta" class="form-control flatpickr-basic flatpickr-input active generar-2-hasta" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                   <button type="button" class="btn btn-primary data-submit-generar-2 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                        <!-- MODAL DE reporte3 balances-global -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-3">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-3 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Balances | Global | Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select generar-3-aseguradora" id="generar-3-aseguradora" name="generar-3-aseguradora">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="999999999"> Todas </option>	                               
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select generar-3-sucursal" id="generar-3-sucursal" name="generar-3-sucursal">                                           
                                        <option value=""> Seleccione </option>
                                        <option value="999999999"> Todas </option>	   	                              
                                        </select>
                                    </div>
                                
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha (Desde) * </label>
                                        <input type="text" id="generar-3-desde" class="form-control flatpickr-basic flatpickr-input active generar-3-desde" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha (Hasta) * </label>
                                        <input type="text" id="generar-3-hasta" class="form-control flatpickr-basic flatpickr-input active generar-3-hasta" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                   <button type="button" class="btn btn-primary data-submit-generar-3 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                        <!-- MODAL DE reporte3 balances-pagos -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-4">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-4 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel"> Pagos | Primas | Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Año * </label>
                                        <select class="select2 form-select generar-4-anio" id="generar-4-anio" name="generar-4-anio">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="2022"> 2022 </option>
                                        <option value="2023"> 2023 </option>	                               
                                        <option value="2024"> 2024 </option>
                                        <option value="2025"> 2025 </option>
                                        <option value="2026"> 2026 </option>
                                        <option value="2027"> 2027 </option>
                                        <option value="2028"> 2028 </option>
                                        <option value="2029"> 2029 </option>
                                        <option value="2030"> 2030 </option>
                                        </select>
                                    </div>
                                    
                                   <button type="button" class="btn btn-primary data-submit-generar-4 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                           <!-- MODAL DE reporte3 balances-pagos -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-5">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-5 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel"> Pagos | Comisiones | Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Año * </label>
                                        <select class="select2 form-select generar-5-anio" id="generar-5-anio" name="generar-5-anio">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="2022"> 2022 </option>
                                        <option value="2023"> 2023 </option>	                               
                                        <option value="2024"> 2024 </option>
                                        <option value="2025"> 2025 </option>
                                        <option value="2026"> 2026 </option>
                                        <option value="2027"> 2027 </option>
                                        <option value="2028"> 2028 </option>
                                        <option value="2029"> 2029 </option>
                                        <option value="2030"> 2030 </option>
                                        </select>
                                    </div>
                                    
                                   <button type="button" class="btn btn-primary data-submit-generar-5 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                            <!-- MODAL DE reporte3 balances-pagos -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-6">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-6 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel"> Pagos | Bonos | Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Año * </label>
                                        <select class="select2 form-select generar-6-anio" id="generar-6-anio" name="generar-6-anio">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="2022"> 2022 </option>
                                        <option value="2023"> 2023 </option>	                               
                                        <option value="2024"> 2024 </option>
                                        <option value="2025"> 2025 </option>
                                        <option value="2026"> 2026 </option>
                                        <option value="2027"> 2027 </option>
                                        <option value="2028"> 2028 </option>
                                        <option value="2029"> 2029 </option>
                                        <option value="2030"> 2030 </option>
                                        </select>
                                    </div>
                                    
                                   <button type="button" class="btn btn-primary data-submit-generar-6 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

         <!-- MODAL DE reporte3 balances-global -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-8">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-8 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Balances | Global X Mes| Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Mes * </label>
                                        <select class="select2 form-select generar-8-mes" id="generar-8-mes" name="generar-8-mes">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="1"> ENERO </option>
                                        <option value="2"> FEBRERO </option>	                               
                                        <option value="3"> MARZO </option>
                                        <option value="4"> ABRIL </option>
                                        <option value="5"> MAYO </option>
                                        <option value="6"> JUNIO </option>
                                        <option value="7"> JULIO </option>
                                        <option value="8"> AGOSTO </option>
                                        <option value="9"> SEPTIEMBRE </option>
                                        <option value="10"> OCTUBRE </option>
                                        <option value="11"> NOVIEMBRE </option>
                                        <option value="12"> DICIEMBRE </option>
                                        </select>
                                    </div>

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Año * </label>
                                        <select class="select2 form-select generar-8-anio" id="generar-8-anio" name="generar-8-anio">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="2022"> 2022 </option>
                                        <option value="2023"> 2023 </option>	                               
                                        <option value="2024"> 2024 </option>
                                        <option value="2025"> 2025 </option>
                                        <option value="2026"> 2026 </option>
                                        <option value="2027"> 2027 </option>
                                        <option value="2028"> 2028 </option>
                                        <option value="2029"> 2029 </option>
                                        <option value="2030"> 2030 </option>
                                        </select>
                                    </div>
                                   <button type="button" class="btn btn-primary data-submit-generar-8 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                       <!-- MODAL DE reporte 7 polizas anuladas -->
                       <div class="modal modal-slide-in fade" id="modals-slide-in-generar-7">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-2 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Polizas anuladas | Criterios de búsqueda </h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Aseguradora * </label>
                                        <select class="select2 form-select generar-2-aseguradora" id="generar-2-aseguradora" name="generar-2-aseguradora">                                           
                                        <option value=""> Seleccione </option>	
                                        <option value="999999999"> Todas </option>	                               
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Sucursal * </label>
                                        <select class="select2 form-select generar-2-sucursal" id="generar-2-sucursal" name="generar-2-sucursal">                                           
                                        <option value=""> Seleccione </option>
                                        <option value="999999999"> Todas </option>	   	                              
                                        </select>
                                    </div>
                                
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha de emsion (Desde) * </label>
                                        <input type="text" id="generar-2-desde" class="form-control flatpickr-basic flatpickr-input active generar-2-desde" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha de emsion (Hasta) * </label>
                                        <input type="text" id="generar-2-hasta" class="form-control flatpickr-basic flatpickr-input active generar-2-hasta" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  
                                   <button type="button" class="btn btn-primary data-submit-generar-7 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

        <!-- GENERAR ANEXOS SEGUND ANIO FISCAL -->

                    <div class="modal modal-slide-in fade" id="modals-slide-in-generar-anexo1">
                        <div class="modal-dialog sidebar-sm">
                            <form class="reporte-generar-a1 modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                <h5 class="modal-title" id="exampleModalLabel"> Criterios de busqueda Anexo 1 </h5>
                                </div>
                                <div class="modal-body flex-grow-1">

                                <div class="mb-1">
                                    <label class="form-label" for="basic-icon-default-date">Período Fiscal</label>
                                    <input type="text" id="fp-range" class="form-control flatpickr-range generar-a1-anio" placeholder="Seleccione Rango" />
                                </div>
                                               
                                    
                                   <button type="button" class="btn btn-primary data-submit-generar-a1 me-1">Generar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
           <!-- GENERAR ANEXOS SEGUND ANIO FISCAL -->
                     
     </div>


                       
                    
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
    <script src="js/ajax.js"></script>
    <script src="js/html.js"></script>
    <!-- TODOS LOS DATABLES -->
        <!-- BEGIN: Page Vendor JS-->
    <script src="../app-assets/vendors/js/extensions/tether.min.js"></script>
    <script src="../app-assets/vendors/js/extensions/shepherd.min.js"></script>
    <!-- END: Page Vendor JS-->
        <!-- BEGIN: Page JS-->
    <!-- BEGIN: Page JS-->
    <script src="../app-assets/js/scripts/extensions/ext-component-tour.js"></script>
    <!-- END: Page JS-->
    <!-- END: Page JS-->
     <!-- BEGIN: Page JS-->
     <script src="../app-assets/js/scripts/pages/app-file-manager.js"></script>
    <!-- END: Page JS-->
    <script src="js/table-datatables-bancos.js"></script>
   <!-- <script src="js/table-datatables-users.js"></script>
    <script src="js/table-datatables-aseguradoras.js"></script>
     HASTA AQUI -->

<script>
    document.addEventListener("DOMContentLoaded", () => {
    // Escuchamos el click del botón
    const $boton = document.querySelector("#anexo1");
    $boton.addEventListener("click", () => {
        const $elementoParaConvertir = document.getElementById('anexo1p'); // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: 0.5,
                filename: 'documento.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a3",
                    orientation: 'landscape' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
    });
});
</script>

 
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