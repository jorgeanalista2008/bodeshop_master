<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents shop-auth-page padding-y-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-8 col-md-8 col-lg-8">
                        <div class="shop-auth-box">
                            <ul class="nav nav-tabs shop-auth-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#login" aria-controls="login" role="tab" data-toggle="tab">
                                        <i class="fa fa-sign-in"></i> <?= lang('login'); ?>
                                    </a>
                                </li>
                                <?php if (!$shop_settings->private) { ?>
                                    <li role="presentation">
                                        <a href="#register" aria-controls="register" role="tab" data-toggle="tab">
                                            <i class="fa fa-user-plus"></i> <?= lang('register'); ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>

                            <div class="tab-content shop-auth-tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="login">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="shop-standalone-form">
                                                <?php include 'login_form.php'; ?>
                                            </div>
                                        </div>
                                        <?php if (!$shop_settings->private) { ?>
                                            <div class="col-sm-5">
                                                <div class="shop-auth-info-card">
                                                    <div class="shop-auth-info-badge">
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <h4 class="shop-auth-info-title"><?= lang('register_new_account'); ?></h4>
                                                    <p class="shop-auth-info-desc">
                                                        <?= lang('register_account_info'); ?>
                                                    </p>
                                                    <ul class="shop-auth-benefits list-unstyled">
                                                        <li><i class="fa fa-check-circle"></i> Compras rápidas y seguras</li>
                                                        <li><i class="fa fa-check-circle"></i> Seguimiento en tiempo real</li>
                                                        <li><i class="fa fa-check-circle"></i> Historial de pedidos y cotizaciones</li>
                                                        <li><i class="fa fa-check-circle"></i> Precios exclusivos para clientes</li>
                                                    </ul>
                                                    <a href="register" class="btn btn-shop-outline show-tab">
                                                        <i class="fa fa-user-plus"></i> <?= lang('register'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php if (!$shop_settings->private) { ?>
                                    <div role="tabpanel" class="tab-pane fade" id="register">
                                        <div class="shop-register-header margin-bottom-md">
                                            <h4 class="shop-login-title"><i class="fa fa-user-plus text-primary"></i> <?= lang('register_new_account'); ?></h4>
                                            <p class="text-muted">Completa los campos a continuación para crear tu cuenta en segundos</p>
                                        </div>

                                        <!-- Quick Google Register -->
                                        <div class="shop-google-fast-register margin-bottom-lg" style="background: var(--bg-page); border: 1px dashed var(--border-color); border-radius: 12px; padding: 16px; text-align: center;">
                                            <p style="font-size: 13px; font-weight: 600; margin-bottom: 10px; color: var(--text-main);">
                                                <i class="fa fa-bolt text-warning"></i> ¿Prefieres registrarte sin contraseñas?
                                            </p>
                                            <a href="<?= site_url('social_auth/login/Google'); ?>" class="btn btn-oauth-google" style="max-width: 280px; margin: 0 auto;">
                                                <svg class="google-icon" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
                                                <span>Registrarse con Google</span>
                                            </a>
                                            <div class="shop-social-divider" style="margin: 14px 0 0 0;"><span>o completa el formulario tradicional</span></div>
                                        </div>

                                        <?php $attrib = ['class' => 'validate shop-register-form', 'role' => 'form'];
                                        echo form_open('register', $attrib); ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="first_name"><?= lang('first_name'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_input('first_name', '', 'class="form-control shop-input" id="first_name" required="required" pattern=".{3,10}" placeholder="Juan"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="last_name"><?= lang('last_name'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_input('last_name', '', 'class="form-control shop-input" id="last_name" required="required" placeholder="Pérez"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="company"><?= lang('company'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_input('company', set_value('company'), 'class="form-control shop-input tip" id="company" placeholder="Nombre de empresa (opcional)"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="phone"><?= lang('phone'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_input('phone', '', 'class="form-control shop-input" id="phone" placeholder="+58 412 0000000"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="email"><?= lang('email'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <input type="email" id="email" name="email" class="form-control shop-input" required="required" placeholder="juan@ejemplo.com"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="username"><?= lang('username'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_input('username', set_value('username'), 'class="form-control shop-input tip" id="username" required="required" placeholder="juanperez"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="passwordr"><?= lang('password'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_password('password', '', 'class="form-control shop-input tip" id="passwordr" required="required" pattern="(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="••••••••"'); ?>
                                                        <span class="help-block shop-help-block"><?= lang('pasword_hint'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group shop-form-group">
                                                    <label class="shop-form-label" for="password_confirm"><?= lang('confirm_password'); ?></label>
                                                    <div class="shop-input-wrapper">
                                                        <?= form_password('password_confirm', '', 'class="form-control shop-input" id="password_confirm" required="required" pattern="(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="••••••••" data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="' . lang('pw_not_same') . '"'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="margin-top-md">
                                            <?= form_submit('register', lang('register'), 'class="btn btn-shop-login" style="max-width: 260px;"'); ?>
                                        </div>
                                        <?= form_close(); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div id="sticky-con" class="shop-side-featured-wrap">
                        <?php if ($side_featured) { ?>
                            <div class="shop-featured-heading">
                                <span><i class="fa fa-bolt text-warning"></i> <?= lang('featured'); ?></span>
                                <div class="pull-right">
                                    <div class="controls pull-right hidden-xs">
                                        <a class="left fa fa-chevron-left btn btn-xs btn-default" href="#carousel-example" data-slide="prev"></a>
                                        <a class="right fa fa-chevron-right btn btn-xs btn-default" href="#carousel-example" data-slide="next"></a>
                                    </div>
                                </div>
                            </div>

                            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $r = 0;
                                    foreach ($side_featured as $fp) {
                                    ?>
                                        <div class="item <?= empty($r) ? 'active' : ''; ?>">
                                            <div class="shop-featured-mini-card">
                                                <div class="product">
                                                    <?php if ($fp->promotion) { ?>
                                                        <span class="badge badge-right theme"><?= lang('promo'); ?></span>
                                                    <?php } ?>
                                                    <div class="shop-mini-img-wrap text-center">
                                                        <img src="<?= base_url('assets/uploads/' . $fp->image); ?>" alt="<?= $fp->name; ?>" class="img-responsive" style="max-height: 140px; margin: 0 auto;">
                                                    </div>
                                                    <div class="shop-mini-info margin-top-sm">
                                                        <h5 class="product_name font-bold margin-bottom-xs">
                                                            <a href="<?= site_url('product/' . $fp->slug); ?>"><?= $fp->name; ?></a>
                                                        </h5>
                                                        <p class="text-muted small margin-bottom-xs"><?= $fp->category_name; ?></p>
                                                        <?php if (!$shop_settings->hide_price) { ?>
                                                            <div class="product_price font-bold text-primary margin-bottom-sm">
                                                                <?php
                                                                if ($fp->promotion) {
                                                                    echo '<del class="text-muted small" style="font-size: 11px;">' . $this->sma->convertMoney(isset($fp->special_price) && !empty(isset($fp->special_price)) ? $fp->special_price : $fp->price) . '</del> ';
                                                                    echo $this->sma->convertMoney($fp->promo_price);
                                                                } else {
                                                                    echo $this->sma->convertMoney(isset($fp->special_price) && !empty(isset($fp->special_price)) ? $fp->special_price : $fp->price);
                                                                }
                                                                ?>
                                                            </div>
                                                            <button class="btn btn-sm btn-shop-login add-to-cart" data-id="<?= $fp->id; ?>" style="font-size: 12px; padding: 6px 12px;">
                                                                <i class="fa fa-shopping-cart"></i> <?= lang('add_to_cart'); ?>
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        $r++;
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
