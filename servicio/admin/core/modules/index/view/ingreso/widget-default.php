  <?php 
$id=0;
if(isset($_GET['id'])){
    $id = ($_GET['id']);
}

?>
  <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                  <input type="hidden" class="idItem" id="idItem" value ="<?php echo $id; ?>"/>
            </div>
            <div class="content-body">
                <section class="invoice-add-wrapper">
                    <div class="row invoice-add">
                        <!-- Invoice Add Left starts -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                           
                                              
                                                <!-- The image is set in the CSS file -->



                                                
                                            <h3 class="text-primary invoice-logo"><?php echo $_SESSION['tenancy_name']?></h3>
                                           
                                            <p class="card-text mb-25"><?php echo $_SESSION['tenancy_dir']?></p>
                                            <p class="card-text mb-25"><?php echo $_SESSION['tenancy_telefonos']?></p>
                                            <p class="card-text mb-0"><?php echo $_SESSION['tenancy_email']?></p>

                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-md-end mb-1">
                                                <h4 class="invoice-title">N°:</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                       <input type="text" class="form-control  txtAddOrden_codigoSalida" id="txtAddOrden_codigoSalida" value =""  name ="txtAddOrden_codigoSalida" readonly="true"/>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="title">Ingreso:</span>
                                                <input type="text" class="form-control invoice-edit-input date-picker fechaIngreso" />
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="title">Salida :</span>
                                                <input type="text" class="form-control invoice-edit-input due-date-picker fechaSalida" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->

                                <hr class="invoice-spacing" />
                                <?php
                                    if(isset($_GET['id']) && $_GET['id'] == 0){                                       
                                  
                                
                                 ?>
                                 <!-- Address and Contact starts -->
                                <div class="card-body invoice-padding pt-0">
                                    <div class="row row-bill-to invoice-spacing">
                                        <div class="col-xl-12 mb-lg-1 col-bill-to ps-0">
                                            <h6 class="invoice-to-title">Cliente:</h6>
                                            <div class="invoice-customer">
                                                <select class="select2 form-select cmbAddOrden_idCliente cmbClienteEquipo"  id="cmbAddOrden_idCliente" name="cmbAddOrden_idCliente">                                                                                      
                                                        <option value="0">Seleccione</option>     
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 mb-lg-1 col-bill-to ps-0">
                                            <h6 class="invoice-to-title">Equipo:</h6>
                                            <div class="invoice-customer">
                                                <select class="select2 form-select cmbAddIngreso_idEquipo "    id="cmbAddIngreso_idEquipo" name="cmbAddIngreso_idEquipo" disabled="true">
                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- Address and Contact ends -->
                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
                                    <form class="source-item" id="source-item">
                                        <div data-repeater-list="group-a">
                                            <div class="repeater-wrapper" data-repeater-item>
                                                <div class="row">
                                                    <div class="col-12 d-flex product-details-border position-relative pe-0">
                                                        <div class="row w-100 pe-lg-0 pe-1 py-2">
                                                            <div class="col-lg-4 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                                <p class="card-text col-title mb-md-50 mb-0">Item</p>
                                                                <select class="form-select item-details" name="detallesItem">
                                                                    <option value="0">Seleccione</option>
                                                                    <option value="MONITOR">Monitor</option>
                                                                    <option value="TECLADO">Teclado</option>
                                                                    <option value="MOUSE">Mouse</option>
                                                                    <option value="IMPRESORA">Impresora</option>
                                                                    <option value="TARJETA MADRE">Tarjeta madre</option>
                                                                    <option value="DISCO DURO" >Disco duro</option>
                                                                    <option value="MEMORIA RAM">Memoria ram</option>
                                                                    <option value="FUENTE DE PODER">Fuente de poder</option>
                                                                    <option value="PROCESADOR">Procesador</option>
                                                                </select>
                                                               
                                                            </div>
                                                            <div class="col-lg-8 col-12 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Serial</p>
                                                                <input type="text" name="serialItem" class="form-control" value="" placeholder="24" />
                                                               
                                                            </div>
                                                            
                                                         
                                                        </div>
                                                        <div class="d-flex flex-column align-items-center justify-content-between  border-start invoice-product-actions                        py-50
                        px-25
                      ">
                                                    <i data-feather="x" class="cursor-pointer font-medium-3" data-repeater-delete></i>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12 px-0">
                                                <button type="button" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
                                                    <i data-feather="plus" class="me-25"></i>
                                                    <span class="align-middle">Agregar</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Product Details ends -->

                               

                                <hr class="invoice-spacing mt-0" />

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-email">Fotos *</label>
                                                    <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control imagenesItem" multiple   name="imagenesItem[]" id="imagenesItem"><br>
                                                            <p>Solo se permiten archivos en formato .PNG , .JPEG, .JPG <br> que no excedan los 2mb</p>
                                            </div> 
                                        </div>  
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="note" class="form-label fw-bold">Observación:</label>
                                                <textarea class="form-control note" rows="4" id="note"></textarea>
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
                            <div class="card">
                                <div class="card-body">
                                      <?php
                                    if(isset($_GET['id']) && $_GET['id'] == 0){                                       
                                  
                                
                                    ?>
                                        <div class="mb-1">
                                         
                                           <a class="btn btn-success w-100 mb-75 " href="#" data-bs-toggle="modal" data-bs-target="#modalAddCliente" title="Agregar cliente"><i class="ficon" data-feather="user-plus"></i>Registrar cliente</a>
                                                <!-- <a class="btn btn-outline-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalAddVehiculo" title="Agregar equipo"><i class="ficon" data-feather="file-plus"></i></a> -->
                                              
                                        
                                        </div>  
                                        <div class="mb-1">
                                          
                                          
                                              
                                                    <a class="btn btn-info w-100 mb-75 " href="#" data-bs-toggle="modal" data-bs-target="#modalAddVehiculo" title="Agregar equipo"><i class="ficon" data-feather="file-plus"></i> &nbsp;Registrar equipo</a> 
                                           
                                        </div>
                                    <?php } ?>
                                         <div class="mb-1">
                                              <button class="btn btn-primary w-100 mb-75 addIngreso" id="addIngreso"><i class="ficon" data-feather="save"></i>&nbsp;Guardar</button>
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
    <!-- END: Content-->


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
                                    <h5 class="modal-title" id="exampleModalLabel">Datos del Equipo</h5>
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
                                        <input class="form-control txtAddVehiculoPlaca"  id="txtAddVehiculoPlaca" name="txtAddVehiculoPlaca" type="text" placeholder=""  disabled/>
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
                                   
                                    <div class="mb-1 d-none">
                                        <label class="form-label" for="basic-icon-default-email">Año *</label>
                                        <input class="form-control txtAddVehiculoAno"  id="txtAddVehiculoAno" name="txtAddVehiculoAno" type="number" value="<?php echo ANIO?>"/>
                                    </div> 

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Color *</label>
                                        <input class="form-control txtAddVehiculoColor"  id="txtAddVehiculoColor" name="txtAddVehiculoColor" type="text" placeholder="ROJO" />
                                    </div> 

                                    <div class="mb-1 d-none">
                                        <label class="form-label" for="basic-icon-default-email">Serial Chasis *</label>
                                        <input class="form-control txtAddVehiculoSerialChasis"  id="txtAddVehiculoSerialChasis" name="txtAddVehiculoSerialChasis" type="text"  value="<?php echo SERIAL?>" />
                                    </div> 

                                    <div class="mb-1 d-none">
                                        <label class="form-label" for="basic-icon-default-email">Serial Motor *</label>
                                        <input class="form-control txtAddVehiculoSerialMotor"  id="txtAddVehiculoSerialMotor" name="txtAddVehiculoSerialMotor" type="text" placeholder="ABC1DE2" value ="<?php echo SERIAMT?>"/>
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
                                                       
                                        </select>
                                    </div>      

                                  
                                    <button type="button" class="btn btn-primary btnAddVehiculo me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                  
                                            <div class="modal fade text-start modal-primary modalAddTipo" id="modalAddTipo" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                              <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo tipo</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                           <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Tipo</label>
                                                                <input type="text" class="form-control txtAddTipo" name="txtAddTipo" placeholder="Nombre del Tipo" id="txtAddTipo" />
                                                            </div>                                   
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Para *</label>
                                                                <select class="form-select cmbAddTipoCondicion" id="cmbAddTipoCondicion" name="cmbAddTipoCondicion">                                           
                                                                    <option value= "0"> Seleccione </option>	 
                                                                    <option value= "1"> Inventario partes </option>	 
                                                                    <option value= "2"> Equipos </option>
                                                                                                    
                                                                </select>
                                                            </div>     
                                                        </div>
                                                        <div class="modal-footer">
                                                             <button type="button" class="btn btn-primary btnAddTipo me-1">Guardar</button>
                                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade text-start modal-primary modalAddMarca" id="modalAddMarca" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                              <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nueva marca</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Para *</label>
                                                                <select class="form-select cmbAddMarcaCondicion" id="cmbAddMarcaCondicion" name="cmbAddMarcaCondicion">                                           
                                                                    <option value= ""> Seleccione </option>	 
                                                                    <option value= "1"> Inventario </option>	 
                                                                    <option value= "2"> Equipos </option>
                                                                                                    
                                                                </select>
                                                            </div>     
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-fullname">Tipo * </label>
                                                                <select class="select2 form-select cmbAddMarca_idTipo" id="cmbAddMarca_idTipo" name="cmbAddMarca_idTipo" disabled='true'>                                           
                                                                                                                                
                                                                </select>
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Marca</label>
                                                                <input type="text" class="form-control txtAddMarca" name="txtAddMarca" placeholder="Nombre de la Marca" id="txtAddMarca" />
                                                            </div>                                   
                                  
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btnAddMarca me-1">Guardar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade text-start modal-primary modalAddModelo" id="modalAddModelo" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                              <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo modelo</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Para *</label>
                                                                <select class="form-select cmbAddModeloCondicion" id="cmbAddModeloCondicion" name="cmbAddModeloCondicion">                                           
                                                                    <option value= "0"> Seleccione </option>	 
                                                                    <option value= "1"> Inventario </option>	 
                                                                    <option value= "2"> Equipos </option>
                                                                                                    
                                                                </select>
                                                            </div>     
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-fullname">Tipo * </label>
                                                                <select class="select2 form-select cmbAddModelo_idTipo" id="cmbAddModelo_idTipo" name="cmbAddModelo_idTipo" disabled='true'>                                           
                                                                                                                                
                                                                </select>
                                                            </div>
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-fullname">Marca * </label>
                                                                <select class="select2 form-select cmbAddModelo_idMarca" id="cmbAddModelo_idMarca" name="cmbAddModelo_idMarca" disabled='true'>                                           
                                                                                                                                
                                                                </select>
                                                            </div>                             
                                                            <div class="mb-1">
                                                                <label class="form-label" for="basic-icon-default-email">Modelo * </label>
                                                                <input type="text" class="form-control txtAddModelo" name="txtAddModelo" placeholder="Nombre del Modelo" id="txtAddModelo" />
                                                            </div>               
                                  
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btnAddModelo me-1">Guardar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                            