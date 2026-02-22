  <!-- BEGIN: Content-->
  <div class="app-content content "> 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Articulos</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=articulos">Articulo</a>
                                    </li>
                                    <li class="breadcrumb-item active">Listado
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <!--
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
            <div class="content-body">               
                
               <input type="hidden" id="dataArticulos" class="dataArticulos" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesArticulos table">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>                                            
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>                                                                                                                   
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal modal-slide-in fade modalAddArticulo" id="modalAddArticulo">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddArticulo modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Datos Articulo</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                               
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo *</label>                                       
                                        <select class="select2 form-select cmbAddArticulo_idTipo" id="cmbAddArticulo_idTipo" name="cmbAddArticulo_idTipo">
                                        <option value="0">Seleccione</option>                                                                                                                               
                                        </select>
                                    </div>     
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Marca *</label>
                                       
                                        <select class="select2 form-select cmbAddArticulo_idMarca" id="cmbAddArticulo_idMarca" name="cmbAddArticulo_idMarca" disabled="true">
                                                          
                                        <option value="0">Seleccione</option>                                                                                    
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Modelo *</label>                                       
                                        <select class="select2 form-select cmbAddArticulo_idModelo" id="cmbAddArticulo_idModelo" name="cmbAddArticulo_idModelo" disabled="true">
                                        <option value="0">Seleccione</option>              
                                                                                                                                   
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Unidad Medida *</label>
                                        <select class="form-select cmbAddArticuloMedida" id="cmbAddArticuloMedida" name="cmbAddArticuloMedida">                                           
                                            <option value= "0"> Seleccione </option>	 
                                            <option value= "1">UNIDAD</option>	 
                                            <option value= "2">CENTIMETROS</option>
                                            <option value= "3">METROS</option>         
                                            <option value= "4">MILILITROS</option>   
                                            <option value= "5">LITROS</option>   
                                            <option value= "6">GRAMOS</option>         
                                            <option value= "7">KILOS</option>                             
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nombre *</label>
                                        <input class="form-control txtAddArticuloNombre" id="txtAddArticuloNombre"  name="txtAddArticuloNombre" type="text" placeholder="Articulo" />
                                    </div>  

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Descripción *</label>
                                        <textarea data-length="100" class="form-control char-textarea textAreaAddArticuloDescripcion" id="textAreaAddArticuloDescripcion" rows="3" placeholder="Descripción" style="height: 100px"  name="textAreaAddArticuloDescripcion"></textarea>
                                        <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 20 </small>
                                    </div>                                
                                  
                                  
                                                     
                                  
                                    <button type="button" class="btn btn-primary btnAddArticulo me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                   
                               
                            </form>
                        </div>
                    </div>
                                 
                    <div class="modal modal-slide-in fade modalEditArticulo" id="modalEditArticulo">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditArticulo modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Datos Articulo</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                <input class="txtEditArticuloId" id="txtEditArticuloId"  name="txtEditArticuloId" type="hidden" placeholder="Articulo" />
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo *</label>                                       
                                        <select class="select2 form-select cmbEditArticulo_idTipo" id="cmbEditArticulo_idTipo" name="cmbEditArticulo_idTipo">
                                        <option value="0">Seleccione</option>                                                                                                                               
                                        </select>
                                    </div>     
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Marca *</label>
                                       
                                        <select class="select2 form-select cmbEditArticulo_idMarca" id="cmbEditArticulo_idMarca" name="cmbEditArticulo_idMarca" disabled="true">
                                                          
                                        <option value="0">Seleccione</option>                                                                                    
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Modelo *</label>                                       
                                        <select class="select2 form-select cmbEditArticulo_idModelo" id="cmbEditArticulo_idModelo" name="cmbEditArticulo_idModelo" disabled="true">
                                        <option value="0">Seleccione</option>              
                                                                                                                                   
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Unidad Medida *</label>
                                        <select class="form-select cmbEditArticuloMedida" id="cmbEditArticuloMedida" name="cmbEditArticuloMedida">                                           
                                          
                                            <option value= "1">UNIDAD</option>	 
                                            <option value= "2">CENTIMETROS</option>
                                            <option value= "3">METROS</option>         
                                            <option value= "4">MILILITROS</option>   
                                            <option value= "5">LITROS</option>   
                                            <option value= "6">GRAMOS</option>         
                                            <option value= "7">KILOS</option>                             
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nombre *</label>
                                        <input class="form-control txtEditArticuloNombre" id="txtEditArticuloNombre"  name="txtEditArticuloNombre" type="text" placeholder="Articulo" />
                                    </div>  

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Descripción *</label>
                                        <textarea data-length="100" class="form-control char-textarea textAreaEditArticuloDescripcion" id="textAreaEditArticuloDescripcion" rows="3" placeholder="Descripción" style="height: 100px"  name="textAreaEditArticuloDescripcion"></textarea>
                                        <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 100 </small>
                                    </div>                                
                                  
                                  
                                                     
                                  
                                    <button type="button" class="btn btn-primary btnEditArticulo me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                   
                               
                            </form>
                        </div>
                    </div>
                  
                </section>
                <!--/ Basic table -->


         

        

            </div>
        </div>
    </div>
    <!-- END: Content-->