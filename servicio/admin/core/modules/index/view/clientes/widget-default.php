  <!-- BEGIN: Content-->
  <div class="app-content content "> 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Clientes</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=clientes">CLiente</a>
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
                
               <input type="hidden" id="dataClientes" class="dataClientes" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesClientes table">
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
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
                </section>
                <!--/ Basic table -->


         

        

            </div>
        </div>
    </div>
    <!-- END: Content-->