$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      var email = $("#login-email").val().trim();
      var password = $("#login-password").val().trim();

      if( email != "" && password != "" ){
          $.ajax({
              url: 'admin/index.php?action=login', 
              type:'post',
              data:{email:email,password:password},
              success:function(response){
               //alert(response);
              // console.log(response);
                  if(response == 1){
                    let timerInterval
                      Swal.fire({
                        title: 'Acceso concedido',
                        html: 'Bienvenida(o) Administrador.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                   
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                          //console.log('I was closed by the timer'),
                          window.location = "admin/"
                        }
                      })
                     
                  }
                 
                  if(response == 2){
                    let timerInterval
                      Swal.fire({
                        title: 'Acceso concedido',
                        html: 'Bienvenida(o) Encargado.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                         
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                         // console.log('I was closed by the timer'),
                          window.location = "encargado/"
                        }
                      })                     
                  }     
                  if(response == 3){
                    let timerInterval
                      Swal.fire({
                        title: 'Acceso concedido',
                        html: 'Bienvenida(o) Mecanico.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                         
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                         // console.log('I was closed by the timer'),
                          window.location = "mecanico/"
                        }
                      })                     
                  }    
                  if(response == 4){
                    let timerInterval
                      Swal.fire({
                        title: 'Acceso concedido',
                        html: 'Bienvenida(o) Chofer.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                         
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                         // console.log('I was closed by the timer'),
                          window.location = "chofer/"
                        }
                      })                     
                  }   
                  
                  if(response == 5){
                    let timerInterval
                      Swal.fire({
                        title: 'Acceso concedido',
                        html: 'Bienvenida(o) Secretaria.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                          Swal.showLoading();
                         
                        },
                        willClose: () => {
                          clearInterval(timerInterval)
                        }
                      }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                         // console.log('I was closed by the timer'),
                          window.location = "secretaria/"
                        }
                      })                     
                  }  
                           
                 
                  if(response == 0){
                    Swal.fire({
                      title: 'Error!',
                      text: ' Datos de usuario inválidos!',
                      icon: 'error',
                      customClass: {
                        confirmButton: 'btn btn-primary'
                      },
                      buttonsStyling: false
                    })
                  }

                 
              },
              error: function (response) {
               console.log(response);
                alert('Phpd io un error'+response);
            }
          });
      }
    }
  });
  $('#loginform').validate({
    rules: {
      'login-email': {
        required: true
      },
      'login-password': {
        required: true,
        minlength: 5
      }
    },
    messages: {
      'login-email': {
        required: "Error, Debe escribir el usuario asignado por el administrador",
       
      },
      'login-password': {
        required: "Error, Debe escribir la contraseña asignada por el administrador",
        minlength: "Tu contraseña debe ser de al menos de 6 caracteres"
      }
},
   
  });

  
});
