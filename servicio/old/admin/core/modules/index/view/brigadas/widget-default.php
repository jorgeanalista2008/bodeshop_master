  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Brigadas</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=zodis">Zodis</a>
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
               
             
               <input type="hidden" id="dataBrigadas" class="dataBrigadas" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesBrigadas table">
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
                    <div class="modal modal-slide-in fade modalAddBrigada" id="modalAddBrigada">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddBrigada modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo Registro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbAddBrigada_idRedi" id="cmbAddBrigada_idRedi" name="cmbAddBrigada_idRedi"> 
                                            <option value="0">Seleccione</option>                                          
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Zodi * </label>
                                        <select class="select2 form-select cmbAddBrigada_idZodi" id="cmbAddBrigada_idZodi" name="cmbAddBrigada_idZodi" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Brigada</label>
                                        <input type="text" class="form-control txtAddBrigada" name="txtAddBrigada" placeholder="Nombre de la Brigada" id="txtAddBrigada" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnAddBrigada me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal modal-slide-in fade modalEditBrigada" id="modalEditBrigada">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditBrigada modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title " id="exampleModalLabel">Datos de la Zodi</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbEditBrigada_idRedi" id="cmbEditBrigada_idRedi" name="cmbEditBrigada_idRedi">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Zodi * </label>
                                        <select class="select2 form-select cmbEditBrigada_idZodi" id="cmbEditBrigada_idZodi" name="cmbEditBrigada_idZodi " disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Brigada</label>
                                        <input type="hidden" class="form-control txtEditIdBrigada" name="txtEditIdBrigada" id="txtEditIdBrigada" />
                                        <input type="text" class="form-control txtEditBrigada" name="txtEditBrigada" placeholder="Nombre de la Brigada" id="txtEditBrigada" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnEditBrigada me-1">Editar</button>
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