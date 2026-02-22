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
                     <h2 class="content-header-title float-start mb-0">Siniestro | Historial</h2>
                     <div class="breadcrumb-wrapper">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="./">Home</a>
                             </li>
                             <li class="breadcrumb-item"><a href="index.php?view=polizas"> Pólizas</a>
                             </li>
                             <li class="breadcrumb-item active"><a href="index.php?view=tipo&id=<?php echo $_GET['idPoliza']; ?>" id="numeroPoliza-media2"></a>
                             </li>
                             <li class="breadcrumb-item active"><a href="index.php?view=siniestros&idPoliza=<?php echo $_GET['idPoliza']; ?>&id=<?php echo $_GET['idPoliza']; ?>" id="numeroSiniestro">Siniestros</a>
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
        <input type="hidden" id="dataSiniestro" class="dataSiniestro" value=''>
         <!-- Basic table -->
         <section id="basic-datatable">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <table class="datatables-basic-siniestro table" id="siniestros">
                             <thead>
                                 <tr>
                                    
                                     <th></th>
                                     <th></th>
                                     <th></th>
                                     <th>Codigo</th>
                                     <th>Titulo</th>                                  
                                     <th>descripcion</th> 
                                     <th>Fecha</th>    
                                     <th>Archivo</th>    
                                     <th>estatus</th>                            
                                     <th></th>
                                 </tr>
                             </thead>
                         </table>
                     </div>
                 </div>
             </div>
           
         </section>
         <!--/ Basic table -->


     <!-- Create New Folder Modal Starts-->
                         <div class="modal fade" id="new-folder-modal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="numeroPoliza-media3"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form class="add-new-record-evento" method="post" action="#" enctype="multipart/form-data">                             
                                            
                                           
                                            <input type="hidden" class="form-control numeroPoliza-siniestro" id="numeroPoliza-siniestro" name="numeroPoliza-siniestro">
                                            <input type="hidden" class="form-control idSiniestro-siniestro" id="idSiniestro-siniestro" name="idSiniestro-siniestro" value ="<?php echo $_GET['id']; ?>">
                                        
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-email">Titulo del evento * </label>
                                            <input type="text" class="form-control  titulo-siniestro" name="titulo-siniestro" placeholder="" id="titulo-siniestro" />
                                        </div> 
                                        <div class="mb-1">
                                                <label class="form-label" for="exampleFormControlTextarea1">Descripción</label>
                                                <textarea class="form-control descripcion-siniestro" id="descripcion-siniestro" name ="descripcion-siniestro" rows="3" placeholder=""></textarea>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label" for="basic-icon-default-fullname">¿Documento? * </label>
                                            <select class="select2 form-select doc-siniestro" id="doc-siniestro" name="doc-siniestro">                                           
                                                <option value="0"> Seleccione </option>	
                                                <option value="1"> SI </option>
                                                <option value="2"> NO </option>	                               
                                               
                                            </select>
                                        </div>
                                        <div class="mb-1 documento-siniestro" style="display:none">
                                            <label class="form-label" for="basic-icon-default-email">Documento *</label>
                                            <input type="file" accept="application/pdf" class="form-control archivo-siniestro" name="archivo-siniestro" id="archivo-siniestro"><br>
                                                    <p>Solo se permiten archivos en formato .PDF <br> que no excedan los 2mb</p>
                                        </div>    
                                        <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Fecha * </label>
                                        <input type="text" id="ano-siniestro" class="form-control flatpickr-basic flatpickr-input active ano-siniestro" placeholder="YYYY-MM-DD" readonly="readonly">
                                    </div> 
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary me-1 data-submit" id="upload2" >Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Create New Folder Modal Ends -->

 

     </div>
 </div>
</div>
<!-- END: Content-->
