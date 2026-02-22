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
                                    <li class="breadcrumb-item"><a href="index.php?view=cliente">Clientes</a>
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
               
                <div class="row">
                    <div class="col-12 data">
                        <p>Clientes</p>
                     
                        
                    </div>
                </div>
               <input type="hidden" id="dataCliente" class="dataCliente" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic-cliente table">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Apellidos y nombres</th>
                                            <th>Documento</th>
                                            <th>Fecha de nacimiento</th>                                            
                                            <th>Teléfono local</th>
                                            <th>Teléfono móvil</th>
                                            <th>Correo eléctronico</th> 
                                            <th>Póliza</th>                                                                                                                      
                                            <th>Estatus</th>                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <! -- id	apellidos	nombres	cedula	fechaNacimiento	telefono	telefono2	correo	estatus -->
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo registro de cliente</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nombre y apellido</label>
                                        <input type="text" class="form-control  nombre" name="nombre" placeholder="" id="nombre" />
                                    </div> 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Nacionalidad</label>
                                        <select class="form-select nacionalidad" id="nacionalidad" name="nacionalidad">                                           
                                            <option value= ""> Seleccione </option>	 
                                            <option value= "V-"> Venezolano </option>	 
                                            <option value= "E-"> Extranjero </option>
                                            <option value= "J-"> Jurídico </option>	 	 
                                            <option value= "G-"> Gubernamental </option>	 	                                  
                                        </select>
                                    </div>     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Documento</label>
                                        <input type="number" class="form-control  cedula" placeholder="123456789" id="cedula">
                                    </div>     
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha Nacimiento</label>
                                        <input type="text" id="fechaNacimiento" class="form-control flatpickr-basic flatpickr-input active fechaNacimiento" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono local</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input type="text" class="form-control phone-number-mask telefono" placeholder="254 232 55 66"  id="telefono" />
                                            </div>
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Teléfono móvil</label>
                                        <div class="input-group input-group-merge">
                                                <span class="input-group-text">VE (+58)</span>
                                                <input type="text" class="form-control phone-number-mask telefono2" placeholder=" 412 123 55 66" id="telefono2" />
                                            </div>
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Correo eléctronico</label>
                                        <input type="email" class="form-control correo" placeholder="usuario@gmail.com" id="correo">
                                    </div>    
                                                     
                                  
                                    <button type="button" class="btn btn-primary data-submit me-1">Guardar</button>
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