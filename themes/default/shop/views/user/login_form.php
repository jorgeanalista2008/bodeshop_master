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
                echo '<div class="shop-social-grid">';
                foreach ($providers as $key => $provider) {
                    if (!empty($provider['enabled'])) {
                        $icon = ($key == 'google' ? 'google' : ($key == 'facebook' ? 'facebook' : 'share-alt'));
                        echo '<a href="' . site_url('social_auth/login/' . $key) . '" class="btn btn-shop-social btn-social-' . $key . '" title="' . lang('login_with') . ' ' . $key . '"><i class="fa fa-' . $icon . '"></i> ' . ucfirst($key) . '</a>';
                    }
                }
                echo '</div>';
            }
        }
    }
    ?>
</div>
