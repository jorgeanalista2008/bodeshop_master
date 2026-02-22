  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Zodis</h2>
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
               
             
               <input type="hidden" id="dataZodis" class="dataZodis" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesZodis table">
                                    <thead>
                                        <tr>
                                           
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
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade modalAddZodi" id="modalAddZodi">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddZodi modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo Registro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbAddZodi" id="cmbAddZodi" name="cmbAddZodi">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Zodi</label>
                                        <input type="text" class="form-control txtAddZodi" name="txtAddZodi" placeholder="Nombre de la Zodi" id="txtAddZodi" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnAddZodi me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal modal-slide-in fade modalEditZodi" id="modalEditZodi">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditZodi modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title " id="exampleModalLabel">Datos de la Zodi</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbEditZodi" id="cmbEditZodi" name="cmbEditZodi">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Zodi</label>
                                        <input type="hidden" class="form-control txtEditIdZodi" name="txtEditIdZodi" id="txtEditIdZodi" />
                                        <input type="text" class="form-control txtEditZodi" name="txtEditZodi" placeholder="Nombre de la Zodi" id="txtEditZodi" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnEditZodi me-1">Editar</button>
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