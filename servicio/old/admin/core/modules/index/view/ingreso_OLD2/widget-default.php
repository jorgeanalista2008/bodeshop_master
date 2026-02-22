<?php 
$id=0;
if(isset($_GET['id'])){
    $id = ($_GET['id']);
}

?><div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
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
                                            <div class="logo-wrapper">                                                
                                                <h4 class="text-primary">Orden de entrada del Item</h4>
                                              
                                            </div>
                                            <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                            <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                            <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-md-end mb-1">
                                            <span class="title">N° :</span>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                    <input type="text" class="form-control  txtAddOrden_codigoSalida" id="txtAddOrden_codigoSalida" value =""  name ="txtAddOrden_codigoSalida" readonly="true"/>
                                                   
                                                </div>
                                                <input type="hidden" class="idVehiculo" id="idVehiculo" value ="<?php echo $id; ?>"/>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="title">Emisión:</span>
                                                <input type="text" class="form-control invoice-edit-input date-picker txtAddOrdenFechaEmision" id="txtAddOrdenFechaEmision" name ="txtAddOrdenFechaEmision" />
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->

                                <hr class="invoice-spacing" />

                                <div class="card-body invoice-padding pt-0">
                                    <div class="row row-bill-to invoice-spacing">
                                        <div class="col-xl-6 mb-lg-1 col-bill-to ps-0">
                                            <h6 class="invoice-to-title">Ruta:</h6>
                                            <div class="invoice-customer">
                                            <input class="form-control txtAddOrdenRuta"  id="txtAddOrdenRuta" name="txtAddOrdenRuta" type="text" placeholder="SALIDA - DESTINO"  maxlength="30" />
                                            <p>Se permite un maximo de 30 letras</p>
                                        </div>
                                        </div>
                                        <div class="col-xl-6 mb-lg-1 col-bill-to ps-0">
                                            <h6 class="invoice-to-title">Asunto:</h6>
                                            <div class="invoice-customer">
                                            <input class="form-control txtAddOrdenAsunto"  id="txtAddOrdenAsunto" name="txtAddOrdenAsunto" type="text" placeholder="Asunto"  maxlength="30" />
                                            <p>Se permite un maximo de 30 letras</p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Details starts -->
                                <div class="card-body">                                   
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Aspectos a Chequear:</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="title">B</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="title">R</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="title">M</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Aspectos a Chequear:</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="title">B</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="title">R</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="title">M</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="#" id="radioRespuestas">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Nivel de aceite de motor:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="1" id="1" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="1" id="1" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="1" id="1" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Luces de Emergencia:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="11" id="11" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="11" id="11" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="11" id="11" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Nivel de aceite de caja:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="2" id="2" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="2" id="2" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="2" id="2" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Presión de aire neumáticos :</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="12" id="12" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="12" id="12" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="12" id="12" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Nivel de agua de batería :</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="3" id="3" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="3" id="3" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="3" id="3" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Limpia parabrisas:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="13" id="13" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="13" id="13" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="13" id="13" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Nivel de combustible:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="4" id="4" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="4" id="4" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="4" id="4" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Neumático de repuesto:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="14" id="14" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="14" id="14" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="14" id="14" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Nivel de agua del radiador:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="5" id="5" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="5" id="5" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="5" id="5" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Gato y llave de cruz:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="15" id="15" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="15" id="15" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="15" id="15" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Nivel de liga de frenos:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="6" id="6" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="6" id="6" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="6" id="6" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Triángulo de seguridad:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="16" id="16" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="16" id="16" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="16" id="16" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Indicadores y medidores:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="7" id="7" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="7" id="7" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="7" id="7" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Extintor:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="17" id="17" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="17" id="17" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="17" id="17" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Luces altas y bajas:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="8" id="8" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="8" id="8" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="8" id="8" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Espejo retrovisor:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="18" id="18" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="18" id="18" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="18" id="18" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Direccionales:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="9" id="9" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="9" id="9" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="9" id="9" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Juego de herramientas:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="19" id="19" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="19" id="19" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="19" id="19" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="row">                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Luces de frenos:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="10" id="10" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="10" id="10" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="10" id="10" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                               
                                                <div class="col-6 d-flex align-items-center mb-1">
                                                    <span class="title">Licencia y certificado:</span>
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="20" id="20" value="1" checked />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="20" id="20" value="2"  />
                                                </div>
                                                <div class="col-2">
                                                <input class="form-check-input" type="radio" name="20" id="20" value="3"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                         
                              
                                <hr class="invoice-spacing mt-0" />

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="note" class="form-label fw-bold">Observación:</label>
                                                <textarea class="form-control textAreaAddOrdenObservacion"  name ="textAreaAddOrdenObservacion" id="textAreaAddOrdenObservacion" rows="2" id="note"></textarea>
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
                                    <div class="logo-wrapper">                                                
                                                <h4 class="text-info ">Datos de Entrada</h4>
                                            </div>
                                    <?php 
                                    if($id==0){
                                    ?>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Vehiculo *</label>
                                        <select class="select2 form-select cmbAddOrden_idVehiculo" id="cmbAddOrden_idVehiculo" name="cmbAddOrden_idVehiculo">
                                            <option value="0">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>      
                                    <?php
                                    }
                                    ?>
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Chofer *</label>
                                        <select class="select2 form-select cmbAddOrden_idPersonal" id="cmbAddOrden_idPersonal" name="cmbAddOrden_idPersonal">
                                                            <option value="0">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>      

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">A cargo *</label>
                                        <select class="select2 form-select cmbAddOrden_idPersonalACargo" id="cmbAddOrden_idPersonalACargo" name="cmbAddOrden_idPersonalACargo">
                                                            <option value="0">Seleccione</option>                                                                                                                                        
                                            </select> 
                                    </div>      
                                   
                                
                                 
                                    <button type="button" class="btn btn-success w-100  btnAddOrden">  
                                        <span class="align-middle">Registrar</span>
                                    </button>                                    
                                </div>
                            </div>
                         
                        </div>
                        <!-- Invoice Add Right ends -->
                    </div>

                                        
                </section>

            </div>
        </div>
    </div>