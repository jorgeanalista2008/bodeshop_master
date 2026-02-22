  <!-- BEGIN: Content-->
  <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Contrato</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=contratos">Contratos</a>
                                    </li>
                                    <li class="breadcrumb-item active">Contrato
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
                <div id="user-profile">
                 
                    <input type="hidden" id="idPolizaData" value ="<?php echo $_GET['id']; ?>">
                    <input type="hidden" id="idContratoData" value ="<?php echo $_GET['idc']; ?>">
                    <input type="hidden"   id="codigoContrato2" value ="">
                
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
                                    </div>
                                </div>

                                 <div class="card" id="auto" style="display:none">
                                            <div class="card-body text-center">
                                                <h5 class="mb-75">Datos del vehículo</h5>
                                                <div class="row">
                                                    <div class="col-lg-4 col-4 order-2 order-lg-1">
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
                                                    <div class="col-lg-4 col-4 order-2 order-lg-1">
                                                    <div class="mt-2">
                                                            <h5 class="mb-75">Estado:</h5>
                                                            <p class="card-text" id="estadoVehiculo"></p>
                                                        </div>  
                                                                
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Color:</h5>
                                                            <p class="card-text" id="colorVehiculo"></p>
                                                        </div>
                                                                                        
                                                                    
                                                    </div>
                                                    <div class="col-lg-4 col-4 order-2 order-lg-1">
                                                    <div class="mt-2">
                                                            <h5 class="mb-75">Marca:</h5>
                                                            <p class="card-text" id="marcaVehiculo"></p>
                                                        </div>  
                                                        <div class="mt-2">
                                                            <h5 class="mb-75">Modelo:</h5>
                                                            <p class="card-text" id="modeloVehiculo"></p>
                                                        </div>       
                                                    </div>

                                                </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="estructura" style="display:none">
                                            <div class="card-body text-center">
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
                                                                    
                                                                                
                                                                        
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="otros" style="display:none">
                                            <div class="card-body text-center">
                                                    <h5 class="mb-75">Datos de otros / vida</h5>
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
                                                                    
                                                                                
                                                                        
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="patrimonial" style="display:none">
                                            <div class="card-body text-center">
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
                                                                                
                                                                        
                                                        </div>

                                                    </div>                                        
                                            </div>
                                        </div>
                                        
                                        <div class="card" id="personal" style="display:none">
                                            <div class="card-body text-center">
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
                                       
                                        <div class="card">
                                            <div class="card-body datosContratoPerfil" id="datosContratoPerfil">
                                                    <h5 class="mb-75">Datos del contrato</h5>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-4 order-2 order-lg-1">                                                   
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Codigo:</h5>
                                                                <p class="card-text" id="codigoContrato"></p>
                                                          
                                                            </div>
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Frecuencia de pagos:</h5>
                                                                <p class="card-text" id="frecuenciaContrato"></p>
                                                                <button type="button" style="display:none" class="btn btn-warning pagarParte" data-bs-toggle="modal" data-bs-target="#modal-slide-pago-parte">
                                                                        Pagar Inicial
                                                                </button>
                                                            </div>  
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Suma asegurada:</h5>
                                                                <p class="card-text" id="montoContrato"></p>
                                                            </div>      
                                                            <div class="mt-2">
                                                              <br> <br>
                                                            </div>    
                                                            <div class="mt-2">
                                                           
                                                            </div>                   
                                                        </div>
                                                        <div class="col-lg-4 col-4 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Fecha inicio:</h5>
                                                                <p class="card-text" id="fechaInicioContrato"></p>
                                                            </div>                                                 
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Número de cuotas:</h5>
                                                                <p class="card-text" id="numeroContrato"></p>
                                                            </div> 
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Prima anual $:</h5>
                                                                <p class="card-text" id="primaContrato"></p>
                                                            </div>    
                                                            <div class="mt-2">
                                                              <br> <br>
                                                            </div>    
                                                            <div class="mt-2">
                                                           
                                                            </div>  
                                                            <!--
                                                             <div class="mt-2">
                                                                <h5 class="mb-75">Prima anual BS:</h5>
                                                                <p class="card-text" id="primaContratobs"></p>
                                                            </div>                   
                                                            -->      
                                                        </div>
                                                        <div class="col-lg-4 col-4 order-2 order-lg-1">
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Fecha culminación:</h5>
                                                                <p class="card-text" id="fechaFinalContrato"></p>
                                                            </div>                                                 
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Dias de plazo:</h5>
                                                                <p class="card-text" id="diasContrato"></p>
                                                            </div> 
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Prima en cuotas $:</h5>
                                                                <p class="card-text" id="primacContrato"></p>
                                                            </div>  
                                                            <div class="mt-2">
                                                                <h5 class="mb-75">Prima en cuotas BS:</h5>
                                                                <p class="card-text" id="primaContratobs"></p>
                                                            </div>                   
                                                            <div class="mt-2">
                                                                <button type="button" class="btn btn-warning finalizar" style="display:none">
                                                                        Finalizar
                                                                </button>
                                                                
                                                                <button type="button" style="display:none" class="btn btn-info editar" data-bs-toggle="modal" data-bs-target="#modals-slide-in-contrato-update">
                                                                        Editar
                                                                </button>
                                                                <button type="button" class="btn btn-danger anular" style="display:none">
                                                                        Anular
                                                                </button>
                                                               
                                                            </div>   
                                                            <!-- Modal to add new record -->
                                                            <div class="modal modal-slide-in fade" id="modals-slide-in-contrato-update">
                                                                <div class="modal-dialog sidebar-sm">
                                                                    <form class="update-record-contrato modal-content pt-0">
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                                        <div class="modal-header mb-1">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Editar contrato</h5>
                                                                        </div>
                                                                        <div class="modal-body flex-grow-1">
                                                                            
                                                                            <div class="mb-1">
                                                                                <label class="form-label" for="basic-icon-default-email">Fecha inicio</label>
                                                                                <input type="text" id="fechaInicio-contrato" class="form-control flatpickr-basic flatpickr-input active fechaInicio-contrato" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                                <input type="hidden" class="idPoliza" id="idPoliza" value ="<?php echo $_GET['id']; ?>">
                                                                                <input type="hidden" class="idContrato" id="idContrato" value ="<?php echo $_GET['idc']; ?>">
                                                                                <input type="hidden" class="codigoContrato3" id="codigoContrato3" >
                                                                                <input type="hidden" class="usuario-contrato" id="usuario-contrato" value="<?php  echo $_SESSION['nombreUsuario']?>">
                                                                            </div>      
                                                                            <div class="mb-1">
                                                                                <label class="form-label" for="basic-icon-default-email">Fecha final</label>
                                                                                <input type="text" id="fechaFinal-contrato" class="form-control flatpickr-basic flatpickr-input active fechaFinal-contrato" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                            </div>                                       
                                                                            <div class="mb-1">
                                                                                <label class="form-label" for="basic-icon-default-email">Frecuencia</label>
                                                                                <select class="form-select frecuencia-contrato-2" id="frecuencia-contrato-2" name="frecuencia-contrato-2">
                                                                                   
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
                                                                                <label class="form-label" for="basic-icon-default-email">Prima anual</label>
                                                                                <input type="number" class="form-control  prima-contrato" name="prima-contrato"  id="prima-contrato"/>
                                                                            </div>   

                                                                              <div class="mb-1">
                                                                                <label class="form-label" for="basic-icon-default-email">Prima anual BS</label>
                                                                                <input type="number" class="form-control  prima-contrato-bs" name="prima-contrato-bs"  id="prima-contrato-bs"/>
                                                                            </div>   
                                                                        
                                                                            <button type="button" class="btn btn-primary data-submit-contratos-update me-1">Editar</button>
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12 col-12 order-1 order-lg-2">
                                    <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Relación de pagos | Realizados y pendientes</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text me-25 mb-0">Al dia de hoy</p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row alertas-contrato-detalles" id="alertas-contrato-detalles">
                                       
                                     
                                    </div>
                                </div>
                            </div>
                                    </div>
                                </div>
                                <input type="hidden" id="dataPagos" class="dataPagos" value=''>
                            <div class="row">
                                <section id="basic-datatable">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <table class="datatables-basic-pagos table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th>Código</th>
                                                            <th>idContrato</th>                                         
                                                            <th>Tipo Pago</th>
                                                            <th>Cuota</th>
                                                            <th>N° Recibo</th>
                                                            <th>Fecha</th>    
                                                            <th>Referencia</th>     
                                                            <th>Fecha Operación</th>                                         
                                                            <th>Factura</th>   
                                                            <th>Fecha Factura</th>  
                                                            <th>Prima</th>                                                                                                       
                                                            <th>Comisión</th>
                                                            <th>Bono</th>                  
                                                          
                                                          
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal to add new record -->
                                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                                        <div class="modal-dialog sidebar-sm">
                                            <form class="add-new-record-pagos modal-content pt-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                <div class="modal-header mb-1">
                                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo pago</h5>
                                                </div>
                                                <div class="modal-body flex-grow-1">                                                 
                                                        <input type="hidden" class="form-control  contrato-pago" name="contrato-pago" value="<?php echo $_GET['idc']; ?>" id="contrato-pago"/>
                                                        <input type="hidden" class="form-control  codigocontrato-pago" name="codigocontrato-pago" value="" id="codigocontrato-pago"/>
                                                        <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Tipo pago</label>
                                                        <select class="form-select tipo-pago " id="tipo-pago" name="tipo-pago">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1">Emisión</option>
                                                            <option value="2">Renovación</option>
                                                            <option value="3">Cuota</option>
                                                          
                                                        </select>
                                                    </div>    
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Número de recibo</label>
                                                        <input type="number" class="form-control  numeroRecibo-pago" name="numeroRecibo-pago" placeholder="" id="numeroRecibo-pago" />
                                                    </div>    
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Fecha Recibo</label>
                                                        <input type="text" id="fecha-pago" class="form-control flatpickr-basic flatpickr-input active fecha-pago" placeholder="YYYY-MM-DD" readonly="readonly">
                                                    </div>      
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Número referencia</label>
                                                        <input type="number" class="form-control  referencia-pago" name="referencia-pago" placeholder="" id="referencia-pago" />
                                                    </div>  
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Fecha de la operacion</label>
                                                        <input type="text" id="fechaOperacion-pago" class="form-control flatpickr-basic flatpickr-input active fechaOperacion-pago" placeholder="YYYY-MM-DD" readonly="readonly">
                                                    </div>   
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Número de factura</label>
                                                        <input type="number" class="form-control  factura-pago" name="factura-pago" placeholder="" id="factura-pago" />
                                                    </div>   
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Fecha facturación</label>
                                                        <input type="text" id="fechaFactura-pago" class="form-control flatpickr-basic flatpickr-input active fechaFactura-pago" placeholder="YYYY-MM-DD" readonly="readonly">
                                                    </div>     
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Prima</label>
                                                        <input type="number" class="form-control  prima-pago" name="prima-pago" placeholder="" id="prima-pago" />
                                                    </div> 
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Comisión</label>
                                                        <input type="number" class="form-control  comision-pago" name="comision-pago" placeholder="" id="comision-pago" />
                                                    </div>       
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Bono</label>
                                                        <input type="number" class="form-control  bono-pago" name="bono-pago" placeholder="" id="bono-pago" />
                                                    </div>                                 
                                                   
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Cuota</label>
                                                        <input type="number" class="form-control  cuota-pago" name="cuota-pago" placeholder="" id="cuota-pago"  />
                                                    </div>    
                                                
                                                    <button type="button" class="btn btn-primary data-submit-pagos me-1">Guardar</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                     <!-- Modal to add new pago parte -->
                                     <div class="modal modal-slide-in fade" id="modal-slide-pago-parte">
                                        <div class="modal-dialog sidebar-sm">
                                            <form class="add-new-record-pagos-parte modal-content pt-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                <div class="modal-header mb-1">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pago</h5>
                                                </div>
                                                <div class="modal-body flex-grow-1">                                                 
                                                        <input type="hidden" class="form-control  contrato-pago-parte" name="contrato-pago-parte" value="<?php echo $_GET['idc']; ?>" id="contrato-pago-parte"/>
                                                        <input type="hidden" class="form-control  codigocontrato-pago-parte" name="codigocontrato-pago-parte" value="" id="codigocontrato-pago-parte"/>
                                                        <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Tipo pago</label>
                                                        <select class="form-select tipo-pago-parte " id="tipo-pago-parte" name="tipo-pago-parte">
                                                            <option value="">Seleccionar</option>                                                            
                                                            <option value="4">Parte financiada</option>
                                                          
                                                        </select>
                                                    </div>    
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Número de recibo</label>
                                                        <input type="number" class="form-control  numeroRecibo-pago-parte" name="numeroRecibo-pago-parte" placeholder="" id="numeroRecibo-pago-parte" />
                                                    </div>    
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Fecha Recibo</label>
                                                        <input type="text" id="fecha-pago-parte" class="form-control flatpickr-basic flatpickr-input active fecha-pago-parte" placeholder="YYYY-MM-DD" readonly="readonly">
                                                    </div>      
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Número referencia</label>
                                                        <input type="number" class="form-control  referencia-pago-parte" name="referencia-pago-parte" placeholder="" id="referencia-pago-parte" />
                                                    </div>  
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Fecha de la operacion</label>
                                                        <input type="text" id="fechaOperacion-pago-parte" class="form-control flatpickr-basic flatpickr-input active fechaOperacion-pago-parte" placeholder="YYYY-MM-DD" readonly="readonly">
                                                    </div>   
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Número de factura</label>
                                                        <input type="number" class="form-control  factura-pago-parte" name="factura-pago-parte" placeholder="" id="factura-pago-parte" />
                                                    </div>   
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Fecha facturación</label>
                                                        <input type="text" id="fechaFactura-pago-parte" class="form-control flatpickr-basic flatpickr-input active fechaFactura-pago-parte" placeholder="YYYY-MM-DD" readonly="readonly">
                                                    </div>     
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Prima</label>
                                                        <input type="number" class="form-control  prima-pago-parte" name="prima-pago-parte" placeholder="" id="prima-pago-parte" />
                                                    </div> 
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Comisión</label>
                                                        <input type="number" class="form-control  comision-pago-parte" name="comision-pago-parte" placeholder="" id="comision-pago-parte" />
                                                    </div>       
                                                    <div class="mb-1">
                                                        <label class="form-label" for="basic-icon-default-email">Bono</label>
                                                        <input type="number" class="form-control  bono-pago-parte" name="bono-pago-parte" placeholder="" id="bono-pago-parte" />
                                                    </div>                                 
                                                   
                                                  
                                                
                                                    <button type="button" class="btn btn-primary data-submit-pagos-parte me-1">Guardar</button>
                                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                            </div>
                             
                            </div>
                            </div>

                       
                    </section>
                    
                    <!--/ profile info section -->
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->