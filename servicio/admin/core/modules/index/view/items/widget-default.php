  <!-- BEGIN: Content-->
  <div class="app-content content "> 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Equipos</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=items">Equipos</a>
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
                
               <input type="hidden" id="dataVehiculos" class="dataVehiculos" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesVehiculos table">
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
                                                                                                                                                             
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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
                                        <input class="form-control txtAddVehiculoPlaca"  id="txtAddVehiculoPlaca" name="txtAddVehiculoPlaca" type="text" placeholder="ABCD-1234" disabled />
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
                                        <input class="form-control txtAddVehiculoAno"  id="txtAddVehiculoAno" name="txtAddVehiculoAno" type="number"  <?php echo ANIO?>/>
                                    </div> 

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Color *</label>
                                        <input class="form-control txtAddVehiculoColor"  id="txtAddVehiculoColor" name="txtAddVehiculoColor" type="text" placeholder="ROJO" />
                                    </div> 

                                    <div class="mb-1 d-none">
                                        <label class="form-label" for="basic-icon-default-email">Serial Chasis *</label>
                                        <input class="form-control txtAddVehiculoSerialChasis"  id="txtAddVehiculoSerialChasis" name="txtAddVehiculoSerialChasis" type="text" <?php echo SERIAL?>/>
                                    </div> 

                                    <div class="mb-1 d-none">
                                        <label class="form-label" for="basic-icon-default-email">Serial Motor *</label>
                                        <input class="form-control txtAddVehiculoSerialMotor"  id="txtAddVehiculoSerialMotor" name="txtAddVehiculoSerialMotor" type="text" placeholder="ABC1DE2" value ="000000001"/>
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
                  
                </section>
                <!--/ Basic table -->


         

        

            </div>
        </div>
    </div>
    <!-- END: Content-->