<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="shop-login-form-wrap">
    <?php if ($error) { ?>
        <div class="alert alert-danger shop-alert">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <div class="shop-alert-msg"><i class="fa fa-exclamation-circle"></i> <?= $error; ?></div>
        </div>
    <?php } ?>
    <?php if ($message) { ?>
        <div class="alert alert-success shop-alert">
            <button data-dismiss="alert" class="close" type="button">×</button>
            <div class="shop-alert-msg"><i class="fa fa-check-circle"></i> <?= $message; ?></div>
        </div>
    <?php } ?>

    <!-- Welcome Header -->
    <div class="shop-login-header">
        <div class="shop-login-icon">
            <i class="fa fa-user-circle"></i>
        </div>
        <div class="shop-login-titles">
            <h4 class="shop-login-title"><?= lang('login'); ?></h4>
            <p class="shop-login-subtitle">Ingresa a tu cuenta de Cristalería</p>
        </div>
    </div>

    <?= form_open('login', 'class="validate shop-login-form"'); ?>
    <?php $u = mt_rand(); ?>
    
    <div class="form-group shop-form-group">
        <label for="username<?= $u; ?>" class="shop-form-label">
            <i class="fa fa-envelope-o"></i> <?= lang('identity'); ?>
        </label>
        <div class="shop-input-wrapper">
            <input type="text" name="identity" id="username<?= $u; ?>" class="form-control shop-input" value="" required placeholder="<?= lang('email'); ?>">
        </div>
    </div>

    <div class="form-group shop-form-group">
        <div class="shop-label-row">
            <label for="password<?= $u; ?>" class="shop-form-label">
                <i class="fa fa-lock"></i> <?= lang('password'); ?>
            </label>
            <a href="<?= site_url('forgot_password'); ?>" class="shop-forgot-link"><?= lang('forgot?'); ?></a>
        </div>
        <div class="shop-input-wrapper">
            <input type="password" id="password<?= $u; ?>" name="password" class="form-control shop-input" placeholder="••••••••" value="" required>
        </div>
    </div>

    <?php if ($Settings->captcha) { ?>
        <div class="form-group shop-captcha-wrap">
            <div class="form-group text-center margin-bottom-sm">
                <span class="captcha-image"><?= $image; ?></span>
            </div>
            <div class="input-group">
                <span class="input-group-addon shop-addon">
                    <a href="<?= admin_url('auth/reload_captcha'); ?>" class="reload-captcha text-blue">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
                <?= form_input($captcha); ?>
            </div>
        </div>
    <?php } ?>

    <div class="shop-remember-row">
        <label class="shop-checkbox-label" for="remember_me<?= $u; ?>">
            <input type="checkbox" value="1" name="remember_me" id="remember_me<?= $u; ?>" class="shop-checkbox">
            <span class="shop-checkbox-text"><?= lang('remember_me'); ?></span>
        </label>
    </div>

    <button type="submit" value="login" name="login" class="btn btn-shop-login">
        <i class="fa fa-sign-in"></i> <span><?= lang('login'); ?></span>
    </button>
    <?= form_close(); ?>

    <?php if (!$shop_settings->private) { ?>
        <div class="shop-login-footer">
            <span class="shop-footer-text">¿No tienes cuenta?</span>
            <a href="<?= site_url('login#register'); ?>" class="shop-register-link">
                <?= lang('register'); ?> <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    <?php } ?>

    <?php
    if (!$shop_settings->private) {
        $providers = config_item('providers');
        if (!empty($providers)) {
            $has_social = false;
            foreach ($providers as $provider) {
                if (!empty($provider['enabled'])) {
                    $has_social = true;
                    break;
                }
            }
            if ($has_social) {
                echo '<div class="shop-social-divider"><span>o continuar con</span></div>';
                echo '<div class="shop-social-grid" style="margin-bottom: 6px;">';
                foreach ($providers as $key => $provider) {
                    if (!empty($provider['enabled'])) {
                        $provider_lower = strtolower($key);
                        if ($provider_lower == 'google') {
                            echo '<a href="' . site_url('social_auth/login/' . $key) . '" class="btn btn-oauth-google" role="button" title="Acceder con Google">';
                            echo '<svg class="google-icon" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>';
                            echo '<span>Continuar con Google</span>';
                            echo '</a>';
                        } else {
                            echo '<a href="' . site_url('social_auth/login/' . $key) . '" class="btn btn-shop-social btn-social-' . $provider_lower . '" title="' . lang('login_with') . ' ' . $key . '"><i class="fa fa-' . $provider_lower . '"></i> ' . ucfirst($key) . '</a>';
                        }
                    }
                }
                echo '</div>';
            }
        }
    }
    ?>
</div>
