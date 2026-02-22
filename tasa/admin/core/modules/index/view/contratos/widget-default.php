  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Contratos</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=contratos">Contratos</a>
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
                        <p>Contratos</p>
                     
                        
                    </div>
                </div>
               <input type="hidden" id="dataContratos" class="dataContratos" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic-contratos table">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Número póliza</th>
                                            <th>Cliente</th>                                         
                                            <th>Tipo</th>
                                            <th>idPoliza</th>
                                            <th>Aseguradora</th>    
                                            <th>Fecha Inicio </th>     
                                            <th>Fecha Final </th>                                         
                                            <th>Frecuencia</th>   
                                            <th>Cuotas</th>  
                                            <th>Suma asegurada</th>      
                                            <th>Prima</th>  
                                            <th>Prima BS</th>                                                                                                               
                                            <th>Estatus</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-contrato modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo contrato</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                     <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Póliza</label>
                                        <select class="select2 form-select idPoliza" id="select2-basic">
                                               
                                        </select>
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha inicio</label>
                                        <input type="text" id="fechaInicio-contrato" class="form-control flatpickr-basic flatpickr-input active fechaInicio-contrato" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha final</label>
                                        <input type="text" id="fechaFinal-contrato" class="form-control flatpickr-basic flatpickr-input active fechaFinal-contrato" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>                                       
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Frecuencia</label>
                                        <select class="form-select frecuencia-contrato " id="frecuencia-contrato" name="frecuencia-contrato">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Mensual</option>
                                            <option value="2">Trimestral</option>
                                            <option value="3">Cuatrimestral</option>
                                            <option value="4">Semestral</option>
                                            <option value="5">Anual</option>
                                            <option value="6">Financiado</option>
                                        </select>
                                    </div>    

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de cuotas</label>
                                        <input type="number" class="form-control  numero-contrato" name="numero-contrato" placeholder="" id="numero-contrato"  disabled/>
                                    </div>    
                                    <div class="mb-1 porcentaje" id="porcentaje" style="display:none">
                                        <label class="form-label" for="basic-icon-default-email">Porcentaje de financiamiento</label>
                                        <input type="number" class="form-control  porcentaje-contrato" name="numero-contrato" placeholder="" value="0" id="porcentaje-contrato"/>
                                    </div>    
                                    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Monto asegurado $</label>
                                        <input type="number" class="form-control  monto-contrato" name="monto-contrato" placeholder="" id="monto-contrato"/>
                                    </div>   

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Prima anual $</label>
                                        <input type="number" class="form-control  prima-contrato" name="prima-contrato" placeholder="" id="prima-contrato"/>
                                    </div>   

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Prima en cuotas Bs</label>
                                        <input type="number" class="form-control  prima-contrato-bs" name="prima-contrato-bs" placeholder="" id="prima-contrato-bs"/>
                                    </div>   
                                  
                                    <button type="button" class="btn btn-primary data-submit-contratos me-1">Guardar</button>
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