$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      var $email = $("#txtEmail").val().trim();  
      var tipo = 1;
      var accion = 4;
      var datos = 1;


      if( $email!= "" ){
          $.ajax({
              url: 'admin/index.php?action=user',
             type: 'POST',
            data: {email: $email, tipo: tipo, accion: accion, datos: datos },

            beforeSend: function() {
              let timerInterval
                      Swal.fire({
                        title: 'Procesando',
                        html: 'Enviando datos de acceso a su cuenta. Por favor, revise su bandeja de entrada..',
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                   
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        
                      })
         },
              success:function(response){
               //alert(response);
              // console.log(response);
                 if (response == '3') {
                  Swal.fire({
                    icon: 'success',
                    title: 'Bien...',
                    text: 'Se ha enviado un correo electrónico con las instrucciones para restablecer su contraseña.',

                  })
             

                    }
                 
                  if(response == 0){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El correo que ha proporcionado, no corresponde a ningún usuario registrado.',

                  })
                  }

                 
              },
              error: function (response) {
               
                alert('Ocurrio'+response);
            }
          });
      }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error, existe un error en los datos suministrador, verifique e intenten nuevamn.',

                  })
                  

      }

    }
  });
  $('#frmForgotPass').validate({
        rules: {
        'txtEmail': {
          required: true,
          email: true
        }
      },
        messages: {
          'txtEmail': {
        required: "Error, Debe escribir el correo electrónico",
        email: "Error, Debe escribir un correo electrónico válido"
      }
},
   
  });
});
