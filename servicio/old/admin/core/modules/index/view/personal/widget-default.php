  <!-- BEGIN: Content-->
  <div class="app-content content "> 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Personal</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=personal">Personal</a>
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
                
               <input type="hidden" id="dataPersonal" class="dataPersonal" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesPersonal table">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>  <th></th>
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
                  
                    <div class="modal fade modalBuscarPersonal" id="modalBuscarPersonal" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" >
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Contrato Asociado</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="datosAsociados">
                                                           
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                    </div>                     
                   
                    <div class="modal modal-slide-in fade modalEditarPersonalContrato" id="modalEditarPersonalContrato">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditPersonalContrato modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Interés Organizacional</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Tipo  *</label>
                                        <input class="form-control txtEditarPersonalId" id="txtEditarPersonalId" name="txtEditarPersonalId" type="hidden"  />
                                        <select class="select2 form-select cmbEditPersonaTipo" id="cmbEditPersonaTipo" name="cmbEditPersonaTipo">
                                                            
                                                            <option value="1">CIVIL</option>   
                                                            <option value="2">MILITAR</option>                                                                                    
                                        </select>
                                    </div>     
                                    <div class="frmMilitarEdit" style="display:none">
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Categoria *</label>
                                            <select class="select2 form-select cmbEditPersonaCategoria" id="cmbEditPersonaCategoria" name="cmbEditPersonaCategoria">
                                                         
                                                            <option value="1">EFECTIVOS (OFICIALES DE COMANDO)</option>   
                                                            <option value="2">EFECTIVOS (OFICIALES TÉCNICOS)</option>  
                                                            <option value="3">EFECTIVOS (OFICIALES DE TROPA)</option>    
                                                            <option value="4">ASIMILADOS (ASIMILIADO TÉCNICO)</option>
                                                            <option value="5">ASIMILADOS (ASIMILADO)</option>        
                                                            <option value="6">TROPA PROFESIONAL</option>                                                                                                    
                                                            <option value="7">TROPA ALISTADA</option>    
                                                            <option value="8">ASPIRANTE</option>         
                                            </select>
                                                        
                                        </div> 
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Componente *</label>
                                            <select class="select2 form-select cmbEditPersona_idComponente" id="cmbEditPersona_idComponente" name="cmbEditPersona_idComponente">
                                                                                                                                                                                    
                                            </select>
                                                        
                                        </div> 
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Grado *</label>
                                            <select class="select2 form-select cmbEditPersona_idGrado" id="cmbEditPersona_idGrado" name="cmbEditPersona_idGrado" disabled="true">
                                                            <option value="0">Seleccione</option>                                                                                                                                  
                                            </select>
                                                        
                                        </div> 
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Cargo *</label>
                                        <select class="select2 form-select cmbEditPersona_idCargo" id="cmbEditPersona_idCargo" name="cmbEditPersona_idCargo">
                                                            <option value="">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div> 
                                   
                                  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Redi *</label>
                                        <select class="select2 form-select cmbEditPersona_idRedi" id="cmbEditPersona_idRedi" name="cmbEditPersona_idRedi">
                                                            <option value="">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Zodi *</label>
                                        <select class="select2 form-select cmbEditPersona_idZodi" id="cmbEditPersona_idZodi" name="cmbEditPersona_idZodi" disabled="true">
                                                            <option value="">Seleccione</option>                                                                                                                                        
                                            </select> 
                                    </div>      
                                   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Brigada *</label>
                                        <select class="select2 form-select cmbEditPersona_idBrigada" id="cmbEditPersona_idBrigada" name="cmbEditPersona_idBrigada" disabled="true">
                                                            <option value="">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>  
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Unidad *</label>
                                        <select class="select2 form-select cmbEditPersona_idUnidad" id="cmbEditPersona_idUnidad" name="cmbEditPersona_idUnidad" disabled="true">
                                                            <option value="">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dependencia *</label>
                                        <select class="select2 form-select cmbEditPersona_idDependencia" id="cmbEditPersona_idDependencia" name="cmbEditPersona_idDependencia" disabled="true">
                                                            <option value="">Seleccione</option>                                                                                                                                        
                                        </select> 
                                    </div>   
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Licencia de Conducir *</label>
                                        <select class="select2 form-select cmbEditPersonaLicencia" id="cmbEditPersonaLicencia" name="cmbEditPersonaLicencia">
                                                         
                                                            <option value="1">1</option>   
                                                            <option value="2">2</option>     
                                                            <option value="3">3</option>   
                                                            <option value="4">4</option>                                                                                       
                                                            <option value="5">5</option>                                                                                       
                                                            <option value="99">NO POSEE</option>   
                                                        </select>
                                    </div>     
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Certificado Médico</label>
                                        <select class="select2 form-select cmbEditPersonaCertificado" id="cmbEditPersonaCertificado" name="cmbEditPersonaCertificado">
                                                           
                                                            <option value="1">SI</option>   
                                                            <option value="99">NO</option>     
                                                        
                                        </select>
                                    </div>    
                                                     
                                                              
                                  
                                    <button type="button" class="btn btn-info btnEditPersonalContrato me-1">Editar</button>
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