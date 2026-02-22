  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Dependencias</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=unidades">Unidades</a>
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
               
             
               <input type="hidden" id="dataDependencias" class="dataDependencias" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatablesDependencias table">
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
                    <div class="modal modal-slide-in fade modalAddDependencia" id="modalAddDependencia">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmAddDependencia modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title modalTitulo" id="exampleModalLabel">Nuevo Registro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbAddDependencia_idRedi" id="cmbAddDependencia_idRedi" name="cmbAddDependencia_idRedi"> 
                                            <option value="0">Seleccione</option>                                          
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Zodi * </label>
                                        <select class="select2 form-select cmbAddDependencia_idZodi" id="cmbAddDependencia_idZodi" name="cmbAddDependencia_idZodi" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Brigada * </label>
                                        <select class="select2 form-select cmbAddDependencia_idBrigada" id="cmbAddDependencia_idBrigada" name="cmbAddDependencia_idBrigada" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Unidad * </label>
                                        <select class="select2 form-select cmbAddDependencia_idUnidad" id="cmbAddDependencia_idUnidad" name="cmbAddDependencia_idUnidad" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Dependencia</label>
                                        <input type="text" class="form-control txtAddDependencia" name="txtAddDependencia" placeholder="Nombre de la Dependencia" id="txtAddDependencia" />
                                    </div>      

                                  
                                    <button type="button" class="btn btn-primary btnAddDependencia me-1">Guardar</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal modal-slide-in fade modalEditDependencia" id="modalEditDependencia">
                        <div class="modal-dialog sidebar-sm">
                            <form class="frmEditDependencia modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title " id="exampleModalLabel">Datos de la Zodi</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Redi * </label>
                                        <select class="select2 form-select cmbEditDependencia_idRedi" id="cmbEditDependencia_idRedi" name="cmbEditDependencia_idRedi">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Zodi * </label>
                                        <select class="select2 form-select cmbEditDependencia_idZodi" id="cmbEditDependencia_idZodi" name="cmbEditDependencia_idZodi " disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Brigada * </label>
                                        <select class="select2 form-select cmbEditDependencia_idBrigada" id="cmbEditDependencia_idBrigada" name="cmbEditDependencia_idBrigada" disabled="true">                                           
                                                                                                         
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Brigada</label>
                                        <input type="hidden" class="form-control txtEditIdDependencia" name="txtEditIdDependencia" id="txtEditIdDependencia" />
                                        <input type="text" class="form-control txtEditDependencia" name="txtEditDependencia" placeholder="Nombre de la Brigada" id="txtEditDependencia" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary btnEditDependencia me-1">Editar</button>
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