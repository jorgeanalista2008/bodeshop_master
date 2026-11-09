<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents shop-auth-page padding-y-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                
                <div class="shop-auth-box shop-forgot-box">
                    <div class="shop-forgot-header">
                        <div class="shop-forgot-icon-wrap">
                            <i class="fa fa-key"></i>
                        </div>
                        <h3 class="shop-forgot-title"><?= lang('forgot_password'); ?></h3>
                        <p class="shop-forgot-subtitle">
                            Ingresa tu correo electrónico registrado y te enviaremos las instrucciones para restablecer tu contraseña.
                        </p>
                    </div>

                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger shop-alert">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <div class="shop-alert-msg"><i class="fa fa-exclamation-circle"></i> <?= $error; ?></div>
                        </div>
                    <?php } ?>
                    <?php if (!empty($message)) { ?>
                        <div class="alert alert-success shop-alert">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <div class="shop-alert-msg"><i class="fa fa-check-circle"></i> <?= $message; ?></div>
                        </div>
                    <?php } ?>

                    <?= form_open('forgot_password', 'class="validate shop-login-form"'); ?>

                    <div class="form-group shop-form-group">
                        <label for="forgot_email" class="shop-form-label">
                            <i class="fa fa-envelope-o"></i> <?= lang('email_address'); ?>
                        </label>
                        <div class="shop-input-wrapper">
                            <input type="email" name="email" id="forgot_email" class="form-control shop-input" required="required" placeholder="ejemplo@correo.com" autofocus>
                        </div>
                        <span class="help-block text-muted" style="font-size: 12px; margin-top: 6px; display: block;">
                            Te enviaremos un enlace de recuperación seguro para que puedas crear una nueva contraseña.
                        </span>
                    </div>

                    <div class="margin-top-lg">
                        <button type="submit" name="forgot_password" class="btn btn-shop-login">
                            <i class="fa fa-paper-plane"></i> <span>Enviar Enlace de Recuperación</span>
                        </button>
                    </div>

                    <?= form_close(); ?>

                    <div class="shop-forgot-footer">
                        <a href="<?= site_url('login'); ?>" class="shop-back-to-login">
                            <i class="fa fa-arrow-left"></i> Volver a Iniciar Sesión
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
