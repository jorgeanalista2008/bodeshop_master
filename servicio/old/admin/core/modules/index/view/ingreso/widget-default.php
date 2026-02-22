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
                                    <button class="btn btn-primary w-100 mb-75 addIngreso" id="addIngreso">Guardar</button>
                                  
                                   
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