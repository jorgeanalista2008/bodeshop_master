  <!-- BEGIN: Content-->
  <div class="app-content content ">
 
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Bancos</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=banco">Bancos</a>
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
               
                <div class="row">
                    <div class="col-12 data">
                        <p>Bancos</p>
                     
                        
                    </div>
                </div>
               <input type="hidden" id="dataBancos" class="dataBancos" value=''>
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Banco</th>
                                            <th>Código</th>
                                            <th>Tipo cuenta</th>
                                            <th>N° de cuenta</th>
                                           
                                            <th>Estatus</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo registro</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Banco</label>
                                        <select class="form-select banco" id="banco" name="banco">                                           
                                            <option value="10001">Banco Central de Venezuela</option>
                                            <option value="20102">Banco de Venezuela S.A.C.A</option>
                                            <option value="30104">Venezolano de Crédito S.A.</option>
                                            <option value="40105">Banco Mercantil, C.A S.A.C.A.</option>
                                            <option value="50108">Banco Provincial, S.A.</option>
                                            <option value="60114">Bancaribe C.A.</option>
                                            <option value="70115">Banco Exterior C.A.</option>
                                            <option value="80116">Banco Occidental de Descuento, C.A.</option>
                                            <option value="90128">Banco Caroní C.A.</option>
                                            <option value="100134">Banesco S.A.C.A.</option>
                                            <option value="110137">Banco Sofitasa C.A.</option>
                                            <option value="120138">Banco Plaza C.A.</option>
                                            <option value="130146">Banco de la Gente Emprendedora C.A.Bangente</option>
                                            <option value="140149">Banco del Pueblo Soberano, C.A.</option>
                                            <option value="150151">BFC Banco Fondo Común C.A.</option>
                                            <option value="160156">100% Banco, C.A.</option>
                                            <option value="170157">DelSur, C.A.</option>
                                            <option value="180163">Banco del Tesoro, C.A.</option>
                                            <option value="190166">Banco Agrícola de Venezuela, C.A</option>
                                            <option value="200168">Bancrecer, S.A.</option>
                                            <option value="210169">Mi Banco C.A.</option>
                                            <option value="220171">Banco Activo, C.A.</option>
                                            <option value="230172">Bancamiga, C.A.</option>
                                            <option value="240173">Banco Internacional de Desarrollo, C.A.</option>
                                            <option value="250174">Banplus, C.A.</option>
                                            <option value="260175">Banco Bicentenario C.A.</option>
                                            <option value="270177">Banco de la Fuerza Armada Nacional Bolivariana</option>
                                            <option value="280190">Citibank N.A.</option>
                                            <option value="290191">Banco Nacional de Crédito, C.A.</option>
                                            <option value="30601">Instituto Municipal de Crédito Popular</option>                                            
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Tipo cuenta</label>
                                        <select class="form-select tipo" id="tipoc" name="tipoc">                                           
                                            <option value="1">Ahorro</option>
                                            <option value="2">Corriente</option>
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Número de cuenta</label>
                                        <input type="text" class="form-control credit-card-mask numero" name="numero" placeholder="0000 0000 0000 0000" id="credit-card" />
                                    </div>                                   
                                  
                                    <button type="button" class="btn btn-primary data-submit me-1">Guardar</button>
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