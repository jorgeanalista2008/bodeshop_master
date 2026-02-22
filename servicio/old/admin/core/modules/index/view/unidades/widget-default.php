  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Unidades</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=brigadas">Zodis</a>
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
               
             
               <input type="hidden" id="dataUnidades" class="dataUnidades" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesUnidades table">
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
                    <div class="modal modal-slide-in fade modalAddUnidad" id="modalAddUnidad">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddUnidad modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo Registro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbAddUnidad_idRedi" id="cmbAddUnidad_idRedi" name="cmbAddUnidad_idRedi"> 
                                            <option value="0">Seleccione</option>                                          
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Zodi * </label>
                                        <select class="select2 form-select cmbAddUnidad_idZodi" id="cmbAddUnidad_idZodi" name="cmbAddUnidad_idZodi" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Brigada * </label>
                                        <select class="select2 form-select cmbAddUnidad_idBrigada" id="cmbAddUnidad_idBrigada" name="cmbAddUnidad_idBrigada" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Unidad</label>
                                        <input type="text" class="form-control txtAddUnidad" name="txtAddUnidad" placeholder="Nombre de la Unidad" id="txtAddUnidad" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnAddUnidad me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal modal-slide-in fade modalEditUnidad" id="modalEditUnidad">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditUnidad modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title " id="exampleModalLabel">Datos de la Zodi</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbEditUnidad_idRedi" id="cmbEditUnidad_idRedi" name="cmbEditUnidad_idRedi">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Zodi * </label>
                                        <select class="select2 form-select cmbEditUnidad_idZodi" id="cmbEditUnidad_idZodi" name="cmbEditUnidad_idZodi " disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Brigada * </label>
                                        <select class="select2 form-select cmbEditUnidad_idBrigada" id="cmbEditUnidad_idBrigada" name="cmbEditUnidad_idBrigada" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Brigada</label>
                                        <input type="hidden" class="form-control txtEditIdUnidad" name="txtEditIdUnidad" id="txtEditIdUnidad" />
                                        <input type="text" class="form-control txtEditUnidad" name="txtEditUnidad" placeholder="Nombre de la Brigada" id="txtEditUnidad" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnEditUnidad me-1">Editar</button>
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