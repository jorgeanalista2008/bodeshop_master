/*=========================================================================================
  File Name: auth-forgot-password.js
  Description: Auth forgot password js file.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  'use strict';

  var pageForgotPasswordForm = $('.frmForgotPass');

  // jQuery Validation
  // --------------------------------------------------------------------
  if (pageForgotPasswordForm.length) {
    pageForgotPasswordForm.validate({
      /*
      * ? To enable validation onkeyup
      onkeyup: function (element) {
        $(element).valid();
      },*/
      /*
      * ? To enable validation on focusout
      onfocusout: function (element) {
        $(element).valid();
      }, */
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
  }
});
