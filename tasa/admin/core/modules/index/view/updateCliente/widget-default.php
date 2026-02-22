  <!-- BEGIN: Content-->
  <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Clientes</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="index.php?view=cliente">Clientes</a>
                                    </li>
                                    <li class="breadcrumb-item active">Clientes
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div class="dropdown">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
               <!-- Basic Inputs start -->
               <section id="basic-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos del cliente</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <input type="hidden" class="form-control" id="idCliente-cliente"  value="<?php  echo $_GET['id']?>"/>
                                                <label class="form-label" for="basicInput">Apellidos y nombres</label>
                                                <input type="text" class="form-control" id="nombre-cliente" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">                                              
                                                <label class="form-label" for="basicInput">Nacionalidad</label>
                                                <select class="form-select nacionalidad-cliente" id="nacionalidad-cliente" name="nacionalidad-cliente">                                           
                                                    <option value= ""> Seleccione </option>	 
                                                    <option value= "V-"> Venezolano </option>	 
                                                    <option value= "E-"> Extranjero </option>
                                                    <option value= "J-"> Jurídico </option>	 	 
                                                    <option value= "G-"> Gubernamental </option>	 	                                  
                                                </select>
                                            </div>
                                        </div>
                                       
                                        
                                       
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Inputs end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->