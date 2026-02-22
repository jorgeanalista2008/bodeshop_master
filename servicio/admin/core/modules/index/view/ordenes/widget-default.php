<?php 
$id=0;
if(isset($_GET['id'])){
    $id = ($_GET['id']);
}

?><!-- BEGIN: Content-->
  <div class="app-content content buscarDataOrdenes " id="buscarDataOrdenes">
  <input type="hidden" class="idVehiculo" id="idVehiculo" value ="<?php echo $id; ?>">
 <div class="content-overlay"></div>
 <div class="header-navbar-shadow"></div>
 <div class="content-wrapper container-xxl p-0">
     <div class="content-header row">
         <div class="content-header-left col-md-9 col-12 mb-2">
             <div class="row breadcrumbs-top">
                 <div class="col-12">
                     <h2 class="content-header-title float-start mb-0">Ordenes de Trabajo</h2>
                     <div class="breadcrumb-wrapper">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item"><a href="./">Home</a>
                             </li>
                             <li class="breadcrumb-item"><a href="index.php?view=items"> Items</a>
                             </li>
                             <?php if($id!=0){
                                ?>
                                <li class="breadcrumb-item active"><a href="index.php?view=item&id=<?php echo $id; ?>" >Item</a></li>
                            <?php
                             }
                             ?>
                            
                         </ol>
                     </div>
                 </div>
             </div>
         </div>
         <div class="content-header-right text-md-end col-md-3 col-12 d-md-block">
                    <div class="mb-1 breadcrumb-right">              
                           <a class="btn btn-info waves-effect waves-float waves-light " href="index.php?view=ingreso&id=<?php echo $id; ?>"><i class="me-1" data-feather="plus"></i><span class="align-middle">Registrar orden trabajo</span></a>
                    </div>
         </div>
     </div>
     <div class="content-body">
        
         <div class="row">
             <div class="col-12 data">
                
                
                 
             </div>
         </div>
        <input type="hidden" id="dataVehiculoOrdenes" class="dataVehiculoOrdenes" value=''>
         <!-- Basic table -->
         <section id="basic-datatable">
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <table class="datatablesOrdenes table" id="datatablesOrdenes">
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


                                            
                                             
     </div>
 </div>
</div>
<!-- END: Content-->
