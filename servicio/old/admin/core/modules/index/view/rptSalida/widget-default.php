<div class="app-content content rptSalida ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="invoice-add-wrapper">
                    <div class="row invoice-add" id="reportePDF">
                        <!-- Invoice Add Left starts -->
                    
                        <div class="col-xl-9 col-md-8 col-12" >
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                
                                                <h3 class="text-primary invoice-logo">Nota de Entrega</h3>
                                            </div>
                                          
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-md-end mb-1">
                                            <span class="title">Salida:</span>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                    <input type="text" class="form-control invoice-edit-input txtAddEntrada_codigoEntrada" placeholder="53634" disabled />
                                                    <input type="hidden" class="idSalida" id="idSalida" value ="<?php echo $_GET['id']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="title">Emisión:</span>
                                                <input type="text" class="form-control   txtAddEntradaFechaEmision" id="txtAddEntradaFechaEmision" name ="txtAddEntradaFechaEmision" disabled />
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->

                                <hr class="invoice-spacing" />

                            

                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
                                    <form class="source-item">
                                        <div data-repeater-list="group-a">
                                            <div class="row">
                                                <div class="col-12 d-flex product-details-border position-relative pe-0">
                                                    <div class="row w-100 ">
                                                        <div class="col-lg-6 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                            <p class="card-text col-title  "><b>Artículo</b> </p>
                                                          
                                                        </div>
                                                        <div class="col-lg-6 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title "><b>Cantidad</b> </p>
                                                        
                                                        </div>                                                     
                                                    
                                                    </div>
                                                   
                                                </div>
                                            </div>  
                                            <div class="tableArticulosEntrada" >
                       
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12 px-0">
                                               
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
                                                <label for="note" class="form-label fw-bold">Obervación:</label>
                                                <textarea class="form-control textAreaAddEntradaObservacion"  name ="textAreaAddEntradaObservacion" id="textAreaAddEntradaObservacion" rows="2" id="note" disabled></textarea>
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
                                                <h4 class="text-info ">Datos de Salida</h4>
                                            </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Redi *</label>
                                        <select class="select2 form-select cmbAddSalida_idRedi" id="cmbAddSalida_idRedi" name="cmbAddSalida_idRedi " disabled="true">
                                                                                                                                                                                              
                                        </select> 
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Zodi *</label>
                                        <select class="select2 form-select cmbAddSalida_idZodi" id="cmbAddSalida_idZodi" name="cmbAddSalida_idZodi" disabled="true">
                                                                                                                                                                                              
                                    </select> 
                                    </div>      
                                   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Brigada *</label>
                                        <select class="select2 form-select cmbAddSalida_idBrigada" id="cmbAddSalida_idBrigada" name="cmbAddSalida_idBrigada" disabled="true">
                                                                                                                                                                                         
                                        </select> 
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Unidad *</label>
                                        <select class="select2 form-select cmbAddSalida_idUnidad" id="cmbAddSalida_idUnidad" name="cmbAddSalida_idUnidad" disabled="true">
                                                                                                                                                                                          
                                        </select> 
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dependencia *</label>
                                        <select class="select2 form-select cmbAddSalida_idDependencia" id="cmbAddSalida_idDependencia" name="cmbAddSalida_idDependencia" disabled="true">
                                                                                                                                                                                           
                                        </select> 
                                    </div> 
                                    <button type="button" class="btn btn-danger w-100 mb-75 btnAddDevolucion">  
                                        <span class="align-middle">Realizar devolución</span>
                                    </button>

                                    <button type="button" class="btn btn-relief-success w-100 mb-75 " id="botonReporte">  
                                        <span class="align-middle">Generar PDF</span>
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