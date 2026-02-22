  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Redis</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=redis">Redis</a>
                                    </li>
                                    <li class="breadcrumb-item active">Listado
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
               
             
               <input type="hidden" id="data" class="data" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesRedis table">
                                    <thead>
                                        <tr>
                                           
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
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade modalAddRedi" id="modalAddRedi">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddRedi modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo Registro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">REDI</label>
                                        <input type="text" class="form-control txtAddRedi" name="txtAddRedi" placeholder="Nombre de la REDI" id="txtAddRedi" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnAddRedi me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal modal-slide-in fade modalEditRedi" id="modalEditRedi">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditRedi modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title " id="exampleModalLabel">Datos de la REDI</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                 
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">REDI</label>
                                        <input type="hidden" class="form-control txtEditIdRedi" name="txtEditIdRedi" id="txtEditIdRedi" />
                                        <input type="text" class="form-control txtEditRedi" name="txtEditRedi" placeholder="Nombre de la REDI" id="txtEditRedi" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnEditRedi me-1">Editar</button>
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