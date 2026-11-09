<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .user-card-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px 26px;
        margin-bottom: 22px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .user-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .user-card-header .step-badge {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }
    .user-card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }
    .modern-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 6px;
        display: block;
    }
</style>

<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-user-plus"></i>
            </span>
            <?= lang('create_user'); ?>
        </h2>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">

                <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open('auth/create_user', $attrib);
                ?>

                <!-- ================= CARD 1: INFORMACIÓN PERSONAL ================= -->
                <div class="user-card-section">
                    <div class="user-card-header">
                        <div class="step-badge"><i class="fa fa-user"></i></div>
                        <div>
                            <h3>1. Datos Personales y de la Empresa</h3>
                            <small class="text-muted">Nombre completo, género, empresa y número telefónico</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="first_name"><?php echo lang('first_name', 'first_name'); ?> *</label>
                                <?php echo form_input('first_name', '', 'class="form-control" id="first_name" required="required" pattern=".{3,10}" placeholder="Ej. Carlos"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="last_name"><?php echo lang('last_name', 'last_name'); ?> *</label>
                                <?php echo form_input('last_name', '', 'class="form-control" id="last_name" required="required" placeholder="Ej. Mendoza"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="gender"><?= lang('gender', 'gender'); ?> *</label>
                                <?php
                                $ge[''] = ['male' => lang('male'), 'female' => lang('female')];
                                echo form_dropdown('gender', $ge, (isset($_POST['gender']) ? $_POST['gender'] : ''), 'class="tip form-control select" id="gender" style="width:100%;" required="required"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="company"><?php echo lang('company', 'company'); ?> *</label>
                                <?php echo form_input('company', '', 'class="form-control" id="company" required="required" placeholder="Empresa o Razón Social"'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="phone"><?php echo lang('phone', 'phone'); ?> *</label>
                                <?php echo form_input('phone', '', 'class="form-control" id="phone" required="required" placeholder="+58 412 1234567"'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= CARD 2: CUENTA Y SEGURIDAD ================= -->
                <div class="user-card-section">
                    <div class="user-card-header">
                        <div class="step-badge"><i class="fa fa-lock"></i></div>
                        <div>
                            <h3>2. Credenciales de Acceso y Seguridad</h3>
                            <small class="text-muted">Nombre de usuario, correo electrónico y contraseña segura</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="email"><?php echo lang('email', 'email'); ?> *</label>
                                <input type="email" id="email" name="email" class="form-control" required="required" placeholder="usuario@dominio.com"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="username"><?php echo lang('username', 'username'); ?> *</label>
                                <input type="text" id="username" name="username" class="form-control" required="required" pattern=".{4,20}" placeholder="usuario.login"/>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="password"><?php echo lang('password', 'password'); ?> *</label>
                                <?php echo form_password('password', '', 'class="form-control tip" id="password" required="required" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" data-bv-regexp-message="' . lang('pasword_hint') . '" placeholder="••••••••"'); ?>
                                <small class="help-block" style="margin-top: 5px; color: #64748b; font-size: 12px;"><i class="fa fa-info-circle"></i> <?= lang('pasword_hint') ?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="confirm_password"><?php echo lang('confirm_password', 'confirm_password'); ?> *</label>
                                <?php echo form_password('confirm_password', '', 'class="form-control" id="confirm_password" required="required" data-bv-identical="true" data-bv-identical-field="password" data-bv-identical-message="' . lang('pw_not_same') . '" placeholder="••••••••"'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= CARD 3: ROL Y PRIVILEGIOS ================= -->
                <div class="user-card-section">
                    <div class="user-card-header">
                        <div class="step-badge"><i class="fa fa-shield"></i></div>
                        <div>
                            <h3>3. Rol, Asignaciones y Permisos</h3>
                            <small class="text-muted">Estado del usuario, grupo y derechos de visualización/edición</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="status"><?= lang('status', 'status'); ?> *</label>
                                <?php
                                $opt = [1 => lang('active'), 0 => lang('inactive')];
                                echo form_dropdown('status', $opt, (isset($_POST['status']) ? $_POST['status'] : ''), 'id="status" required="required" class="form-control select" style="width:100%;"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="group"><?= lang('group', 'group'); ?> *</label>
                                <?php
                                foreach ($groups as $group) {
                                    if ($group['name'] != 'customer' && $group['name'] != 'supplier') {
                                        $gp[$group['id']] = $group['name'];
                                    }
                                }
                                echo form_dropdown('group', $gp, (isset($_POST['group']) ? $_POST['group'] : ''), 'id="group" required="required" class="form-control select" style="width:100%;"');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="no" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; margin-top: 15px;">
                        <h5 style="margin: 0 0 14px 0; font-size: 14px; font-weight: 700; color: #1e293b;">
                            <i class="fa fa-sliders text-primary"></i> Asignación de Sucursal y Derechos
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="modern-label" for="biller"><?= lang('biller', 'biller'); ?></label>
                                    <?php
                                    $bl[''] = lang('select') . ' ' . lang('biller');
                                    foreach ($billers as $biller) {
                                        $bl[$biller->id] = $biller->company && $biller->company != '-' ? $biller->company : $biller->name;
                                    }
                                    echo form_dropdown('biller', $bl, (isset($_POST['biller']) ? $_POST['biller'] : ''), 'id="biller" class="form-control select" style="width:100%;"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="modern-label" for="warehouse"><?= lang('warehouse', 'warehouse'); ?></label>
                                    <?php
                                    $wh[''] = lang('select') . ' ' . lang('warehouse');
                                    foreach ($warehouses as $warehouse) {
                                        $wh[$warehouse->id] = $warehouse->name;
                                    }
                                    echo form_dropdown('warehouse', $wh, (isset($_POST['warehouse']) ? $_POST['warehouse'] : ''), 'id="warehouse" class="form-control select" style="width:100%;"');
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="view_right"><?= lang('view_right', 'view_right'); ?></label>
                                    <?php
                                    $vropts = [1 => lang('all_records'), 0 => lang('own_records')];
                                    echo form_dropdown('view_right', $vropts, (isset($_POST['view_right']) ? $_POST['view_right'] : 1), 'id="view_right" class="form-control select" style="width:100%;"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="edit_right"><?= lang('edit_right', 'edit_right'); ?></label>
                                    <?php
                                    $opts = [1 => lang('yes'), 0 => lang('no')];
                                    echo form_dropdown('edit_right', $opts, (isset($_POST['edit_right']) ? $_POST['edit_right'] : 0), 'id="edit_right" class="form-control select" style="width:100%;"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="allow_discount"><?= lang('allow_discount', 'allow_discount'); ?></label>
                                    <?= form_dropdown('allow_discount', $opts, (isset($_POST['allow_discount']) ? $_POST['allow_discount'] : 0), 'id="allow_discount" class="form-control select" style="width:100%;"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 18px;">
                        <label class="checkbox" for="notify" style="display: flex; align-items: center; gap: 8px; font-weight: 600; color: #475569; cursor: pointer;">
                            <input type="checkbox" name="notify" value="1" id="notify" checked="checked" style="width: 18px; height: 18px; cursor: pointer;"/>
                            <?= lang('notify_user_by_email') ?>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div style="margin-top: 10px; margin-bottom: 25px;">
                    <?php echo form_submit('add_user', lang('add_user'), 'class="btn btn-primary" style="padding: 11px 28px; font-weight: 700; border-radius: 8px; font-size: 14px;"'); ?>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        var group = $('#group').val();
        if (group == 1 || group == 2) {
            $('.no').slideUp();
        } else {
            $('.no').slideDown();
        }
        $('#group').change(function (event) {
            var g = $(this).val();
            if (g == 1 || g == 2) {
                $('.no').slideUp();
            } else {
                $('.no').slideDown();
            }
        });
    });
</script>
