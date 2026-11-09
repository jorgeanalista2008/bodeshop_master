<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?= $title ?> — Panel Administrativo</title>
    <script type="text/javascript">if (parent.frames.length !== 0) { top.location = '<?=admin_url()?>'; }</script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= $assets ?>styles/theme.css" rel="stylesheet"/>
    <link href="<?= $assets ?>styles/style.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
    
    <style>
        :root {
            --adm-primary: #1e40af;
            --adm-primary-hover: #1d4ed8;
            --adm-accent: #3b82f6;
            --adm-dark: #0f172a;
            --adm-card-bg: #ffffff;
            --adm-border: #e2e8f0;
            --adm-text: #1e293b;
            --adm-muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body.admin-login-body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
            background: linear-gradient(135deg, #090d16 0%, #0f172a 50%, #1e1b4b 100%) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            color: var(--adm-text);
        }

        /* Decorative Background Elements */
        .admin-login-glow-1 {
            position: fixed;
            top: -15%;
            left: -10%;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(30, 58, 138, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }

        .admin-login-glow-2 {
            position: fixed;
            bottom: -15%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, rgba(30, 27, 75, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }

        .admin-login-container {
            width: 100%;
            max-width: 460px;
            padding: 24px 18px;
            position: relative;
            z-index: 10;
            margin: auto;
        }

        .admin-login-card {
            background: var(--adm-card-bg);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            transition: all 0.3s ease;
        }

        /* Top Brand Header */
        .admin-brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .admin-logo-img {
            max-height: 54px;
            max-width: 220px;
            object-fit: contain;
            margin-bottom: 16px;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.06));
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: var(--adm-primary);
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 5px 12px;
            border-radius: 20px;
            margin-bottom: 12px;
            border: 1px solid #dbeafe;
        }

        .admin-login-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 6px;
            letter-spacing: -0.02em;
        }

        .admin-login-subtitle {
            font-size: 13.5px;
            color: var(--adm-muted);
            margin: 0;
            line-height: 1.5;
        }

        /* Form Controls */
        .admin-form-group {
            margin-bottom: 20px;
        }

        .admin-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .admin-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin: 0;
        }

        .admin-forgot-link {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--adm-accent);
            text-decoration: none !important;
            transition: color 0.15s ease;
            cursor: pointer;
        }

        .admin-forgot-link:hover {
            color: var(--adm-primary);
            text-decoration: underline !important;
        }

        .admin-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .admin-input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-control.admin-input {
            width: 100% !important;
            height: 48px !important;
            padding: 10px 14px 10px 42px !important;
            border: 1.5px solid var(--adm-border) !important;
            border-radius: 12px !important;
            font-size: 14px !important;
            color: #0f172a !important;
            background: #f8fafc !important;
            box-shadow: none !important;
            transition: all 0.2s ease !important;
            font-family: inherit !important;
        }

        .form-control.admin-input:focus {
            background: #ffffff !important;
            border-color: var(--adm-primary) !important;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
        }

        .form-control.admin-input:focus + .admin-input-icon,
        .admin-input-wrap:focus-within .admin-input-icon {
            color: var(--adm-primary) !important;
        }

        /* Password Toggle */
        .btn-toggle-pw {
            position: absolute;
            right: 12px;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 15px;
            padding: 6px 8px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .btn-toggle-pw:hover {
            color: #334155;
        }

        /* Captcha Wrapper */
        .admin-captcha-wrap {
            background: #f8fafc;
            border: 1px solid var(--adm-border);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .captcha-image {
            display: inline-block;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .reload-captcha {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #eff6ff;
            color: var(--adm-primary);
            text-decoration: none !important;
            transition: all 0.2s ease;
            margin-left: 8px;
        }

        .reload-captcha:hover {
            background: var(--adm-primary);
            color: #ffffff;
            transform: rotate(90deg);
        }

        /* Remember Me & Options */
        .admin-options-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .admin-checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            color: #475569;
            user-select: none;
            margin: 0;
            font-weight: 500;
        }

        .admin-checkbox-label input[type="checkbox"] {
            width: 17px;
            height: 17px;
            border-radius: 4px;
            accent-color: var(--adm-primary);
            cursor: pointer;
        }

        /* Submit Button */
        .btn-admin-submit {
            width: 100% !important;
            height: 48px !important;
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%) !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 12px !important;
            font-size: 14.5px !important;
            font-weight: 700 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35) !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            text-decoration: none !important;
        }

        .btn-admin-submit:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%) !important;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45) !important;
            transform: translateY(-1px) !important;
            color: #ffffff !important;
        }

        .btn-admin-submit:active {
            transform: translateY(0) !important;
        }

        /* Back to Store Footer */
        .admin-footer-links {
            text-align: center;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #f1f5f9;
        }

        .admin-back-store {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none !important;
            transition: color 0.15s ease;
        }

        .admin-back-store:hover {
            color: var(--adm-primary);
            transform: translateX(-2px);
        }

        .admin-security-note {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        /* Custom Alert Messages */
        .admin-alert {
            border-radius: 12px !important;
            padding: 12px 16px !important;
            font-size: 13px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            margin-bottom: 20px !important;
            border: none !important;
        }

        .admin-alert-danger {
            background: #fef2f2 !important;
            color: #b91c1c !important;
            border-left: 4px solid #ef4444 !important;
        }

        .admin-alert-success {
            background: #ecfdf5 !important;
            color: #047857 !important;
            border-left: 4px solid #10b981 !important;
        }

        .admin-alert-warning {
            background: #fffbeb !important;
            color: #b45309 !important;
            border-left: 4px solid #f59e0b !important;
        }

        .admin-alert .close {
            color: inherit !important;
            opacity: 0.6 !important;
            font-size: 18px !important;
            margin-left: 10px !important;
        }

        .admin-alert .close:hover {
            opacity: 1 !important;
        }

        /* Registration container */
        .registration-card {
            max-width: 650px !important;
        }

        @media (max-width: 480px) {
            .admin-login-card {
                padding: 28px 20px;
                border-radius: 16px;
            }
            .admin-login-title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body class="admin-login-body">
    
    <!-- Background Ambient Glows -->
    <div class="admin-login-glow-1"></div>
    <div class="admin-login-glow-2"></div>

    <div class="admin-login-container">
        
        <!-- ================= LOGIN PANEL ================= -->
        <div id="login">
            <div class="admin-login-card">
                
                <div class="admin-brand-header">
                    <?php if ($Settings->logo2) { ?>
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url('assets/uploads/logos/' . $Settings->logo2); ?>" alt="<?= $Settings->site_name; ?>" class="admin-logo-img">
                        </a>
                    <?php } ?>
                    <div>
                        <span class="admin-badge"><i class="fa fa-shield"></i> Panel de Administración</span>
                    </div>
                    <h2 class="admin-login-title">Bienvenido de nuevo</h2>
                    <p class="admin-login-subtitle">Ingresa tus credenciales para acceder al sistema</p>
                </div>

                <?php if ($Settings->mmode) { ?>
                    <div class="admin-alert admin-alert-warning">
                        <span><i class="fa fa-exclamation-triangle"></i> <?= lang('site_offline') ?></span>
                        <button data-dismiss="alert" class="close" type="button">×</button>
                    </div>
                <?php } ?>

                <?php if ($error) { ?>
                    <div class="admin-alert admin-alert-danger">
                        <span><i class="fa fa-exclamation-circle"></i> <?= $error; ?></span>
                        <button data-dismiss="alert" class="close" type="button">×</button>
                    </div>
                <?php } ?>

                <?php if ($message) { ?>
                    <div class="admin-alert admin-alert-success">
                        <span><i class="fa fa-check-circle"></i> <?= $message; ?></span>
                        <button data-dismiss="alert" class="close" type="button">×</button>
                    </div>
                <?php } ?>

                <?= admin_form_open('auth/login', 'class="admin-login-form" data-toggle="validator"'); ?>

                <div class="admin-form-group">
                    <label class="admin-label" for="identity">
                        <i class="fa fa-user-o text-primary"></i> <?= lang('username') ?> / <?= lang('email') ?>
                    </label>
                    <div class="admin-input-wrap">
                        <i class="fa fa-envelope-o admin-input-icon"></i>
                        <input type="text" name="identity" id="identity" class="form-control admin-input" value="<?= DEMO ? 'owner@tecdiary.com' : ''; ?>" required placeholder="nombre@correo.com" autofocus>
                    </div>
                </div>

                <div class="admin-form-group">
                    <div class="admin-label-row">
                        <label class="admin-label" for="password">
                            <i class="fa fa-lock text-primary"></i> <?= lang('password') ?>
                        </label>
                        <a href="#forgot_password" class="admin-forgot-link forgot_password_link">
                            <?= lang('forgot_your_password') ?>
                        </a>
                    </div>
                    <div class="admin-input-wrap">
                        <i class="fa fa-key admin-input-icon"></i>
                        <input type="password" name="password" id="password" class="form-control admin-input" value="<?= DEMO ? '12345678' : ''; ?>" required placeholder="••••••••">
                        <button type="button" class="btn-toggle-pw" onclick="togglePasswordVisibility('password', this)" tabindex="-1" title="Mostrar/Ocultar contraseña">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>

                <?php if ($Settings->captcha) { ?>
                    <div class="admin-captcha-wrap">
                        <div class="row ml-align-center" style="display:flex; align-items:center;">
                            <div class="col-xs-7">
                                <span class="captcha-image"><?= $image; ?></span>
                            </div>
                            <div class="col-xs-5 text-right">
                                <a href="<?= admin_url('auth/reload_captcha'); ?>" class="reload-captcha" title="Recargar código">
                                    <i class="fa fa-refresh"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-top-sm" style="margin-top:10px;">
                            <input type="text" name="captcha" id="captcha" class="form-control admin-input" required placeholder="<?= lang('type_captcha') ?>" style="padding-left:14px !important;">
                        </div>
                    </div>
                <?php } ?>

                <div class="admin-options-row">
                    <label class="admin-checkbox-label" for="remember">
                        <input type="checkbox" name="remember" id="remember" value="1">
                        <span><?= lang('remember_me') ?></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-admin-submit">
                    <i class="fa fa-sign-in"></i> <span>Acceder al Sistema</span>
                </button>

                <?= form_close(); ?>

                <?php if ($Settings->allow_reg) { ?>
                    <div class="text-center" style="margin-top: 16px;">
                        <span style="font-size: 13px; color: #64748b;">¿No tienes cuenta?</span>
                        <a href="#register" class="admin-forgot-link register_link">Crear una cuenta</a>
                    </div>
                <?php } ?>

                <div class="admin-footer-links">
                    <a href="<?= base_url(); ?>" class="admin-back-store">
                        <i class="fa fa-arrow-left"></i> Volver a la Tienda Virtual
                    </a>
                </div>

            </div>

            <div class="admin-security-note">
                <i class="fa fa-lock"></i> Conexión Cifrada SSL • Sistema de Gestión Cristalería
            </div>
        </div>

        <!-- ================= FORGOT PASSWORD PANEL ================= -->
        <div id="forgot_password" style="display: none;">
            <div class="admin-login-card">
                
                <div class="admin-brand-header">
                    <span class="admin-badge" style="background:#fee2e2; color:#b91c1c; border-color:#fecaca;">
                        <i class="fa fa-key"></i> Recuperación de Acceso
                    </span>
                    <h2 class="admin-login-title"><?= lang('forgot_password') ?></h2>
                    <p class="admin-login-subtitle"><?= lang('type_email_to_reset'); ?></p>
                </div>

                <?php if ($error) { ?>
                    <div class="admin-alert admin-alert-danger">
                        <span><i class="fa fa-exclamation-circle"></i> <?= $error; ?></span>
                        <button data-dismiss="alert" class="close" type="button">×</button>
                    </div>
                <?php } ?>

                <?php if ($message) { ?>
                    <div class="admin-alert admin-alert-success">
                        <span><i class="fa fa-check-circle"></i> <?= $message; ?></span>
                        <button data-dismiss="alert" class="close" type="button">×</button>
                    </div>
                <?php } ?>

                <?= admin_form_open('auth/forgot_password', 'class="admin-login-form" data-toggle="validator"'); ?>

                <div class="admin-form-group">
                    <label class="admin-label" for="forgot_email">
                        <i class="fa fa-envelope-o text-primary"></i> <?= lang('email_address') ?>
                    </label>
                    <div class="admin-input-wrap">
                        <i class="fa fa-envelope-o admin-input-icon"></i>
                        <input type="email" name="forgot_email" id="forgot_email" class="form-control admin-input" placeholder="tu@correo.com" required>
                    </div>
                    <span class="help-block text-muted" style="font-size: 12px; margin-top: 6px; display: block;">
                        Recibirás un enlace para restablecer tu contraseña.
                    </span>
                </div>

                <div style="margin-top: 24px;">
                    <button type="submit" class="btn btn-admin-submit margin-bottom-sm">
                        <i class="fa fa-paper-plane"></i> <span>Enviar Instrucciones</span>
                    </button>
                    
                    <a href="#login" class="btn btn-default btn-block login_link" style="height: 44px; display:flex; align-items:center; justify-content:center; border-radius: 12px; font-weight:600; margin-top:10px;">
                        <i class="fa fa-arrow-left"></i> &nbsp; Volver a Iniciar Sesión
                    </a>
                </div>

                <?= form_close(); ?>

            </div>
        </div>

        <!-- ================= REGISTER PANEL ================= -->
        <?php if ($Settings->allow_reg) { ?>
            <div id="register" style="display: none;">
                <div class="admin-login-card registration-card">
                    
                    <div class="admin-brand-header">
                        <span class="admin-badge"><i class="fa fa-user-plus"></i> Registro de Usuario</span>
                        <h2 class="admin-login-title"><?= lang('register_account_heading') ?></h2>
                        <p class="admin-login-subtitle">Ingresa tus datos para registrarte en el sistema</p>
                    </div>

                    <?= admin_form_open('auth/register', 'class="admin-login-form" data-toggle="validator"'); ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('first_name'); ?></label>
                                <input type="text" name="first_name" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('last_name'); ?></label>
                                <input type="text" name="last_name" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('company'); ?></label>
                                <input type="text" name="company" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('phone'); ?></label>
                                <input type="text" name="phone" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('email'); ?></label>
                                <input type="email" name="email" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('username'); ?></label>
                                <input type="text" name="username" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('password'); ?></label>
                                <input type="password" name="password" id="reg_password" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="admin-form-group">
                                <label class="admin-label"><?= lang('confirm_password'); ?></label>
                                <input type="password" name="confirm_password" class="form-control admin-input" style="padding-left:14px !important;" required>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 18px;">
                        <button type="submit" class="btn btn-admin-submit margin-bottom-sm">
                            <i class="fa fa-user-plus"></i> <span>Registrar Cuenta</span>
                        </button>
                        
                        <a href="#login" class="btn btn-default btn-block login_link" style="height: 44px; display:flex; align-items:center; justify-content:center; border-radius: 12px; font-weight:600; margin-top:10px;">
                            <i class="fa fa-arrow-left"></i> &nbsp; Ya tengo cuenta, Iniciar Sesión
                        </a>
                    </div>

                    <?= form_close(); ?>

                </div>
            </div>
        <?php } ?>

    </div>

    <script src="<?= $assets ?>js/bootstrap.min.js"></script>
    <script src="<?= $assets ?>js/jquery.cookie.js"></script>
    <script src="<?= $assets ?>js/login.js"></script>
    <script type="text/javascript">
        function togglePasswordVisibility(fieldId, btn) {
            var field = document.getElementById(fieldId);
            var icon = btn.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'fa fa-eye-slash';
            } else {
                field.type = 'password';
                icon.className = 'fa fa-eye';
            }
        }

        $(document).ready(function () {
            localStorage.clear();
            var hash = window.location.hash;
            if (hash && hash != '') {
                $("#login").hide();
                $(hash).show();
            }
        });
    </script>
</body>
</html>
