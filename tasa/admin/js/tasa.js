
$(function () {  
  'use strict';
 

$('.guardarTasa').on('click', function (e) {
      
      let tasa = $('#tasa').val();
            console.log(tasa);
            actualizarTasa(tasa);
        
     
 
});


});



function actualizarTasa(tasa){
  var tipo = 1;
  var accion = 3;
  var datos =1;
  $.ajax({
    url: 'tasa/admin/index.php?action=tasa', 
    type:'post',
    data:{tipo:tipo,accion:accion,datos:datos,tasa:tasa},
    success:function(response){
     //alert(response);
        if(response == 1){      
        
          alert('Tasa actualizada exitosamente'), 
          $('#tasa').val(''),  
          $('#exampleModal').modal('hide')

        }else{
          alert('Existe un error')
        }
       
    }
});
}
