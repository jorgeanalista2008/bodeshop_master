<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents shop-auth-page padding-y-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <div class="shop-auth-box shop-forgot-box">
                    <div class="shop-forgot-header">
                        <div class="shop-forgot-icon-wrap">
                            <i class="fa fa-lock"></i>
                        </div>
                        <h3 class="shop-forgot-title"><?= lang('reset_password'); ?></h3>
                        <p class="shop-forgot-subtitle">
                            <?= sprintf(lang('reset_password_email'), '<strong>' . htmlspecialchars($identity_label) . '</strong>'); ?>
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

                    <?= form_open('reset_password/' . $code, 'class="validate shop-login-form"'); ?>

                    <div class="form-group shop-form-group">
                        <label class="shop-form-label" for="new">
                            <i class="fa fa-key"></i> <?= lang('new_password'); ?>
                        </label>
                        <div class="shop-input-wrapper">
                            <?= form_input($new_password); ?>
                        </div>
                        <span class="help-block text-muted" style="font-size: 12px; margin-top: 6px; display: block;">
                            <?= lang('pasword_hint') ?>
                        </span>
                    </div>

                    <div class="form-group shop-form-group">
                        <label class="shop-form-label" for="new_confirm">
                            <i class="fa fa-lock"></i> <?= lang('confirm_password'); ?>
                        </label>
                        <div class="shop-input-wrapper">
                            <?= form_input($new_password_confirm); ?>
                        </div>
                    </div>

                    <?= form_input($user_id); ?>

                    <div class="margin-top-lg">
                        <button type="submit" name="reset_password" class="btn btn-shop-login">
                            <i class="fa fa-check"></i> <span><?= lang('reset_password'); ?></span>
                        </button>
                    </div>

                    <?= form_close(); ?>

                    <div class="shop-forgot-footer">
                        <a href="<?= site_url('login'); ?>" class="shop-back-to-login">
                            <i class="fa fa-arrow-left"></i> <?= lang('back_to_login') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
