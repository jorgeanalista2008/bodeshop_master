  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Alertas</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=polizas">Pólizas</a>
                                    </li>
                                    <li class="breadcrumb-item active">Alerta de pagos
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
                        <p>Pagos pendientes</p>
                     
                        
                    </div>
                </div>
               <input type="hidden" id="dataAlertas" class="dataAlertas" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic-alertas table">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Número</th>
                                            <th>Cliente</th>
                                            <th>Aseguradora</th>                                      
                                            <th>Fecha de Pago</th>      
                                            <th>Estatus</th>              
                                           <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                                <div class="modal modal-slide-in fade" id="modals-slide-in-filtrar">
                                    <div class="modal-dialog sidebar-sm">
                                        <form class="add-new-record modal-content pt-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                            <div class="modal-header mb-1">
                                                <h5 class="modal-title" id="exampleModalLabel">Criterios de búsqueda</h5>
                                            </div>
                                            <div class="modal-body flex-grow-1">                                          
                                        

                                                <div class="mb-1">
                                                    <label class="form-label" for="basic-icon-default-date">Estatus</label>
                                                    <div class="position-relative" data-select2-id="45">
                                                        <select class="select2 form-select status" id="status"  aria-hidden="true">
                                                            <option value="NO">Seleccionar</option>
                                                            <option value="0">Sin atender</option>
                                                            <option value="1">Atentida</option>                                                           
                                                                                               
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                              
                                                <div class="mb-4">
                                                    <label class="form-label" for="basic-icon-default-date">Fecha</label>
                                                    <input type="text" id="fp-range" class="form-control flatpickr-range rango" placeholder="Seleccione Rango" />
                                                </div>
                                               
                                               
                                              
                                                <button type="button" class="btn btn-info data-submit cargarAlertas me-1"> <i data-feather='search'></i> Consultar</button>
                                                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">  Cancelar</button>
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