<div class="app-content content ">
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
                                                
                                                <h3 class="text-primary invoice-logo">Nota de Recepción</h3>
                                            </div>
                                          
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-md-end mb-1">
                                                <h4 class="invoice-title">Entrada</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <i data-feather="hash"></i>
                                                    </div>
                                                    <input type="text" class="form-control invoice-edit-input txtAddEntrada_codigoEntrada" placeholder="53634"  />
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="title">Emisión:</span>
                                                <input type="text" class="form-control invoice-edit-input date-picker txtAddEntradaFechaEmision" id="txtAddEntradaFechaEmision" name ="txtAddEntradaFechaEmision" />
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="title">Recepción:</span>
                                                <input type="text" class="form-control invoice-edit-input due-date-picker txtAddEntradaFechaRecepcion"  id="txtAddEntradaFechaRecepcion" name="txtAddEntradaFechaRecepcion"  />
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
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title "><b>Cantidad</b> </p>
                                                        
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title "><b>Precio C/U</b> </p>
                                                        
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title "><b>&nbsp;</b> </p>
                                                        
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>  
                                            <div class="tableAddArticulosEntrada" >
                       
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
                                                <textarea class="form-control textAreaAddEntradaObservacion"  name ="textAreaAddEntradaObservacion" id="textAreaAddEntradaObservacion" rows="2" id="note"></textarea>
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
                                <button type="button" class="btn btn-info btn-sm  w-100 mb-75 btnAddEntrada_articulo" data-bs-toggle="modal" data-bs-target="#modalArticulo" >
                                                  
                                                    <span class="align-middle">Agregar articulo</span>
                                                </button>
                                                <button type="button" class="btn btn-danger w-100 mb-75 anularAddEntrada">  
                                                    <span class="align-middle">Anular</span></button>
                                    <button type="button" class="btn btn-success w-100  btnAddEntrada">  
                                                    <span class="align-middle">Registrar</span></button>
                                    
                                </div>
                            </div>
                         
                        </div>
                        <!-- Invoice Add Right ends -->
                    </div>

                                            <div class="modal fade text-start modal-primary modalArticulo" id="modalArticulo" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel160">Detalles Artículo</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Articulo *</label>
                                                                    <select class="select2 form-select cmbAddEntrada_idArticulo" id="cmbAddEntrada_idArticulo" name="cmbAddEntrada_idArticulo">                                           
                                                                        <option value= "0"> Seleccione </option>	                                          
                                                                                            
                                                                    </select>
                                                                    </div>      
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basic-icon-default-email">Cantidad *</label>
                                                                        <input class="form-control txtAddEntradaCantidad"  id="txtAddEntradaCantidad" name="txtAddEntradaCantidad" type="number" placeholder="1" />
                                                                    </div> 
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="basic-icon-default-email">Precio C/U *</label>
                                                                        <input class="form-control txtAddEntradaPrecio"  id="txtAddEntradaPrecio" name="txtAddEntradaPrecio" type="number" placeholder="1" />
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary btnAddEntrada_addArticulo">Agregar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                </section>

            </div>
        </div>
    </div>