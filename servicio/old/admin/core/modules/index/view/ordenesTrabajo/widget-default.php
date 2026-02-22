     <!-- BEGIN: Content-->
  <div class="app-content content buscarDataOrdenesTrabajos" id="buscarDataOrdenesTrabajos">
  <input type="hidden" class="filtro" id="filtro" value ="<?php echo $_GET['filtro'];  ?>">
 <div class="content-overlay"></div>
 <div class="header-navbar-shadow"></div>
 <div class="content-wrapper container-xxl p-0">
     <div class="content-header row">
         <div class="content-header-left col-md-9 col-12 mb-2">
             <div class="row breadcrumbs-top">
                 <div class="col-12">
                     <h2 class="content-header-title float-start mb-0">Ordenes de Trabajo </h2>
                     <div class="breadcrumb-wrapper">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="./">Home</a>
                             </li>
                             <li class="breadcrumb-item"><a href="index.php?view=items"> Items</a>
                             </li>                            
                         </ol>
                     </div>
                 </div>
             </div>
         </div>
         <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            
         </div>
     </div>
     <div class="content-body">
        
         <div class="row">
             <div class="col-12 data">
                
                
                 
             </div>
         </div>
        <input type="hidden" id="dataOrdenesTrabajo" class="dataOrdenesTrabajo" value=''>
         <!-- Basic table -->
         <section id="basic-datatable">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <table class="datatablesOrdenesTrabajo table" id="datatablesOrdenesTrabajo">
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
                                    <th></th>  
                                 </tr>
                             </thead>
                         </table>
                     </div>
                 </div>
             </div>
           
         </section>
         <!--/ Basic table -->


                                                <div class="modal modal-slide-in fade modalAddVehiculoMantenimiento" id="modalAddVehiculoMantenimiento">
                                                    <div class="modal-dialog sidebar-sm">
                                                        <form class="frmAsignarVehiculoMantenimiento modal-content pt-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                                            <div class="modal-header mb-1">
                                                                <h5 class="modal-title" id="exampleModalLabel">Realizar mantenimiento</h5>
                                                            </div>
                                                            <div class="modal-body flex-grow-1">
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Personal *</label>
                                                                    <select class="select2 form-select cmbAddAsignarVehiculo_idPersonal" id="cmbAddAsignarVehiculo_idPersonal" name="cmbAddAsignarVehiculo_idPersonal">
                                                                                        <option value="0">Seleccione</option>                                                                                                                                        
                                                                    </select> 
                                                                </div>      
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Tipo de Mantenimiento *</label>
                                                                    <select class="form-select cmbAddAsignarVehiculoTipoMantenimiento" id="cmbAddAsignarVehiculoTipoMantenimiento" name="cmbAddAsignarVehiculoTipoMantenimiento">                                           
                                                                        <option value= "0"> Seleccione </option>	 
                                                                        <option value= "1"> Mantenimiento Correctivo </option>	 
                                                                        <option value= "2"> Mantenimiento Preventivo </option>
                                                                                                      
                                                                    </select>
                                                                </div>     
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Fecha de Mantenimiento *</label>
                                                                    <input type="text" id="txtcmbAddAsignarVehiculoFechaMantenimiento" class="form-control flatpickr-basic flatpickr-input active txtcmbAddAsignarVehiculoFechaMantenimiento" name="txtcmbAddAsignarVehiculoFechaMantenimiento" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                </div>   
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Tiempo estimado *</label>
                                                                    <input class="form-control txtcmbAddAsignarVehiculoTiempoEstimado"  id="txtcmbAddAsignarVehiculoTiempoEstimado" name="txtcmbAddAsignarVehiculoTiempoEstimado" type="text" placeholder="1 mes" />
                                                                </div> 
                                    
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Observación *</label>
                                                                    <textarea data-length="250" class="form-control char-textarea textAreaAddAsignarVehiculoObservacion" id="textAreaAddAsignarVehiculoObservacion" rows="3" placeholder="Observación" style="height: 100px"  name="textAreaAddAsignarVehiculoObservacion"></textarea>
                                                                    <small class="textarea-counter-value float-end"><span class="char-count">0</span> / 250 </small>
                                                                </div>    
                                                                <div class="mb-1">
                                                                    <label class="form-label" for="basic-icon-default-email">Fecha Proxima de Mantenimiento *</label>
                                                                    <input type="text" id="txtcmbAddAsignarVehiculoFechaProximoMantenimiento" class="form-control flatpickr-basic flatpickr-input active txtcmbAddAsignarVehiculoFechaProximoMantenimiento" name="txtcmbAddAsignarVehiculoFechaProximoMantenimiento" placeholder="YYYY-MM-DD" readonly="readonly">
                                                                </div>   
                                                                <button type="button" class="btn btn-primary btnAsignarVehiculoMantenimiento me-1">Guardar</button>
                                                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
 
                                             
     </div>
 </div>
</div>
<!-- END: Content-->
