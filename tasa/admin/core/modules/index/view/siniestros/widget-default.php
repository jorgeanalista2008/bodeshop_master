     <!-- BEGIN: Content-->
  <div class="app-content content ">
  <input type="hidden" id="idPolizaData" value ="<?php echo $_GET['id']; ?>">
  
 <div class="content-overlay"></div>
 <div class="header-navbar-shadow"></div>
 <div class="content-wrapper container-xxl p-0">
     <div class="content-header row">
         <div class="content-header-left col-md-9 col-12 mb-2">
             <div class="row breadcrumbs-top">
                 <div class="col-12">
                     <h2 class="content-header-title float-start mb-0">Siniestros</h2>
                     <div class="breadcrumb-wrapper">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="./">Home</a>
                             </li>
                             <li class="breadcrumb-item"><a href="index.php?view=polizas"> Pólizas</a>
                             </li>
                             <li class="breadcrumb-item active"><a href="index.php?view=tipo&id=<?php echo $_GET['idPoliza']; ?>" id="numeroPoliza-media2"></a>
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
                
                
                 
             </div>
         </div>
        <input type="hidden" id="dataSiniestro2" class="dataSiniestro2" value=''>
         <!-- Basic table -->
         <section id="basic-datatable">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <table class="datatables-basic-siniestro2 table" id="siniestros2">
                             <thead>
                                 <tr>
                                    
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th>Codigo</th>
                                     <th>IdPoliza</th>
                                     <th>Número</th>  
                                     <th>Titulo</th>                                  
                                     <th>Fecha de Apertura</th> 
                                     <th>Fecha de Cierre</th>

                                     <th>Estado</th>                            
                                     <th></th>
                                 </tr>
                             </thead>
                         </table>
                     </div>
                 </div>
             </div>
           
         </section>
         <!--/ Basic table -->


          <div class="modal modal-slide-in fade" id="modals-slide-in-siniestro">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record-siniestro modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo registro de Siniestro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Numero de tiket *</label>
                                        <input type="text" class="form-control  numero-siniestro" name="numero" placeholder="" id="numero-siniestro" />
                                        <input type="hidden" class="idPoliza-siniestro" id="idPoliza-siniestro" value ="<?php echo $_GET['id']; ?>">
                                    </div>      
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Título *</label>
                                        <input type="text" class="form-control titulo-siniestro"  id="titulo-siniestro">
                                    </div>    
                                                                                    
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha Apertura *</label>
                                        <input type="text" id="fechaInicio-siniestro" class="form-control flatpickr-basic flatpickr-input active fechaInicio-siniestro" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>  

                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha Cierre </label>
                                        <input type="text" id="fechaFinal-siniestro" class="form-control flatpickr-basic flatpickr-input active fechaFinal-siniestro" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div>       
                                        
                                     
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Monto *</label>
                                        <input type="number" class="form-control monto-siniestro"  id="monto-siniestro">
                                    </div>    
                                                     
                                  
                                    <button type="button" class="btn btn-primary data-submit-siniestro me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

 

     </div>
 </div>
</div>
<!-- END: Content-->
