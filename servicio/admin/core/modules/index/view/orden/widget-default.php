<?php 
$id=0;
if(isset($_GET['id'])){
    $id = ($_GET['id']);
}

?><div class="app-content content buscarDataOrden " id="buscarDataOrden">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-add-wrapper">
                    <div class="row invoice-add">
                        <!-- Invoice Add Left starts -->
                        <div class="col-xl-9 col-md-8 col-12" id="devDetallesOrden">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                           <div>
                                           
                                            <input type="hidden" class="idOrden" id="idOrden" value ="<?php echo $id; ?>"/>
                                             <input type="hidden" class="codigoOrden" id="codigoOrden" value =""/>
                                            <!-- The image is set in the CSS file -->                                                
                                            <h3 class="text-primary invoice-logo"><?php echo $_SESSION['tenancy_name']?></h3>                                           
                                            <p class="card-text mb-25"><?php echo $_SESSION['tenancy_dir']?></p>
                                            <p class="card-text mb-25"><?php echo $_SESSION['tenancy_telefonos']?></p>
                                            <p class="card-text mb-0"><?php echo $_SESSION['tenancy_email']?></p>
                                        </div>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-md-end mb-1">
                                                <h4 class="invoice-title">N°:</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                       <input type="text" class="form-control  " id="" value ="<?php echo $id; ?>"  name ="" readonly="true"/>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="title">Código :</span>
                                                <p class="card-text mb-25" id="lblCodigoOrden"></p>
                                              
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="title">Ingreso:</span>
                                                <p class="card-text mb-25" id="lblFechaIngreso"></p>
                                            
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="title">Salida :</span>
                                                <p class="card-text mb-25" id="lblFechaSalida"></p>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                              
                                <!-- Header ends --> 
                                     
                                        <div class="card faq-search">
                                            <div class="card-body text-center">
                                                <!-- main title -->
                                                <h2 class="text-primary">Orden de trabajo</h2>

                                                <!-- subtitle -->
                                            
                                            </div>
                                        </div>
                               
                               
     <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row invoice-spacing">
                                        <div class="col-xl-6 p-0">
                                            <h6 class="mb-2">Cliente:</h6>
                                            <h6 class="mb-25" id="lblNameCliente"></h6>
                                            <p class="card-text mb-25" id="lblCedulaCliente"></p>
                                            <p class="card-text mb-25" id="lblTelefonoCliente"></p>
                                            <p class="card-text mb-25" id="lblCorreoCliente"></p>
                                          
                                        </div>
                                      <div class="col-xl-6 p-0">
                                            <h6 class="mb-2">Equipo:</h6>
                                            <h6 class="mb-25" id="lblCodigoItem"></h6>
                                            <p class="card-text mb-25" id="lblTipoItem"></p>
                                            <p class="card-text mb-25" id="lblMarcaItem"></p>
                                            <p class="card-text mb-25" id="lblModeloItem"></p>
                                        </div>
                                      
                                    </div>
                                </div>
                                <!-- Address and Contact ends -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="py-1">Item</th>
                                                <th class="py-1">Serial</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody id="detallesOrden">
                                           
                                        </tbody>
                                    </table>
                                </div>

                         
                              
                                <hr class="invoice-spacing mt-0" />

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="note" class="form-label fw-bold">Obervación:</label>
                                                <p class="card-text mb-25" id="lblDescripcionOrden"></p>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    
                                    <!-- Invoice Note ends -->
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Add Left ends -->

                        <!-- Invoice Add Right starts -->
                        <div class="col-xl-3 col-md-4 col-12">
                            <div class="card bg-success text-white"  id="estatusOrden" hidden>
                                <div class="card-body">
                                    <h4 class="card-title text-white">Orden cerrada</h4>
                                    <p class="card-text">Esta orden ya ha sido cerrada por el personal autorizado, solo podrá enviarse por correo al cliente correspondiente.</p>
                                </div>
                            </div>    
                            <div class="card">
                                    <div class="card-body">      
                                    
                                        <div hidden id="noexiste">
                                            <div class="logo-wrapper">                                                
                                                        <h4 class="text-info ">Asignar personal y ubicación</h4>
                                            </div>
                                            <div class="mb-1" >
                                                <label class="form-label" for="basic-icon-default-email">Personal a cargo *</label>                                       
                                                <select  class="select2 form-select cmbAddOrden_idPersonal"  id="cmbAddOrden_idPersonal" name="cmbAddOrden_idPersonal">
                                                    <option value="0">Seleccione</option>                                                                                                                                        
                                                </select> 
                                            </div>      

                                            <div class="mb-1">
                                                <label class="form-label" for="basic-icon-default-email">Ubicación designada *</label>
                                            
                                                <select  class="select2 form-select cmbAddOrden_idUbicacion"  id="cmbAddOrden_idUbicacion" name="cmbAddOrden_idUbicacion">
                                                <option value="0">Seleccione</option>                                                                                                                                        
                                                    </select> 
                                            </div>  
                                            <div class="mb-1"  >
                                                <button type="button" class="btn btn-info w-100 btnAsignarPersonalUbicacion">  
                                                    <span class="align-middle">Asignar personal y ubicacion</span>
                                                </button>
                                            </div>   
                                        </div>
                                    
                                        <div hidden id="existe">
                                        <div class="logo-wrapper">                                                
                                                    <h4 class="text-info ">Personal asignado y ubicado</h4>
                                                    
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Personal a cargo *</label>

                                            <p class="card-text mb-25"  id="lblPersonalOrden"></p>
                                        
                                        </div>      

                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Ubicación designada *</label>
                                            <p class="card-text mb-25"  id="lblUbicacionOrden"></p>
                                        
                                        </div>      
                                        <div class="mb-1"  >
                                            <button type="button" class="btn btn-info w-100 btnEnviarCorreoCliente">  
                                                <span class="align-middle">Enviar por correo</span>
                                            </button>
                                        </div>  


                                        <div class="mb-1"  id="cerrarOrden" >
                                            <button type="button" class="btn btn-success w-100  btnCerrarOrden" >  
                                                <span class="align-middle">Cerrar orden</span>
                                            </button>
                                        </div>  
                                        </div>
                                           <div class="mb-1"  >
                                            <a type="button" href="index.php?action=reportes&tipo=1&accion=1&datos=1&d=<?php echo $id; ?>"  target="_blank" class="btn btn-success w-100 btnGenerarPDFOrden" >  
                                                <span class="align-middle">Generar PDF</span>
                                            </a>
                                        </div>  
                                        
                                        <div class="mb-1"  >
                                            <button type="button"  class="btn btn-warning w-100 btnEliminarOrden " id="btnEliminarOrden">  
                                                <span class="align-middle">Eliminar</span>
                                            </button> 
                                        </div>      
                                        <div class="mb-1"  >
                                            <a type="button" href="index.php?view=dashboard" class="btn btn-danger w-100 ">  
                                                <span class="align-middle">Salir</span>
                                            </a> 
                                        </div>      
                                       
                                                                        
                                    </div>
                                </div>
                            
                            
                        
                            </div>
                       
                        <!-- Invoice Add Right ends -->
                    </div>

                                        
                </section>

            </div>
        </div>
    </div>



        <!-- Edit User Modal -->
                <div class="modal fade" id="modalCerrarOrden" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-5 px-sm-5 pt-50">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Cerrar orden de trabajo</h1>
                                    <p>Debe dar ciertos datos para cerrar la orden y ejecutar el mantenimiento.</p>
                                </div>
                                <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserStatus">Tipo de mantenimiento *</label>
                                        <select id="cmbTipoMantenimiento" name="cmbTipoMantenimiento" class="form-select cmbTipoMantenimiento" aria-label="Default select example">
                                            <option value="0" selected >Seleccionar</option>
                                            <option value="1">Correctivo</option>
                                            <option value="2">Preventivo</option>
                                            <option value="3">Adaptativo</option>
                                        </select>
                                    </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserName">Fecha próximo mantenimiento</label>
                                        <input type="text" id="txtFechaMantenimiento" name="txtFechaMantenimiento" class="form-control invoice-edit-input date-picker txtFechaMantenimiento" />

                                    </div>      
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalEditUserFirstName">Tiempo de mantenimiento</label>
                                        <input type="text" id="txtTempoMantenimiento" name="txtTempoMantenimiento" class="form-control txtTempoMantenimiento"  data-msg="Escriba el tiempo estimado que le tomo el mantenimiento" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="modalEditUserLastName">Descripcion del procedimiento  *</label>
                                        <textarea class="form-control txtDescripcionProcedimiento" id="txtDescripcionProcedimiento" name="txtDescripcionProcedimiento" rows="4" ></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="modalEditUserName">Fecha próximo mantenimiento</label>
                                        <input type="text" id="txtFechaProximo" name="txtFechaProximo" class="form-control invoice-edit-input date-picker txtFechaProximo" />

                                    </div>                              
                                   
                                 
                                    <div class="col-12">
                                        <label class="form-label" for="modalEditUserPhone">Recomendaciones *</label>
                                          <textarea class="form-control txtRecomendacion" id="txtRecomendacion" name="txtRecomendacion" rows="4" ></textarea>
                                    </div>
                                 
                                  
                                    <div class="col-12 text-center mt-2 pt-50">
                                        <button type="button" class="btn btn-primary me-1 btnCerrarOrdenTrabajo">Guardar</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            Salir
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Edit User Modal -->