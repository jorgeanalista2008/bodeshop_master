<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .cust-modal-content {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .cust-modal-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 16px 20px;
    }
    .cust-modal-header h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .cust-section-title {
        font-size: 13px;
        font-weight: 700;
        color: #1e3a8a;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 16px 0 10px 0;
        padding-bottom: 5px;
        border-bottom: 1.5px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .cust-section-title:first-of-type {
        margin-top: 4px;
    }
    .cust-modal-body {
        padding: 16px 22px 20px 22px;
        background: #ffffff;
    }
    .cust-modal-footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }
    .form-group label {
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 4px;
    }
    .form-control {
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        box-shadow: none;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
    }
    .collapse-custom-fields-btn {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        padding: 10px 14px;
        font-weight: 600;
        font-size: 13px;
        color: #475569;
        display: block;
        width: 100%;
        text-align: left;
        margin-top: 16px;
        transition: all 0.2s;
        text-decoration: none !important;
    }
    .collapse-custom-fields-btn:hover {
        background: #f1f5f9;
        color: #1e293b;
        border-color: #94a3b8;
    }
</style>

<div class="modal-dialog modal-lg">
    <div class="modal-content cust-modal-content">
        <div class="modal-header cust-modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: 2px;">
                <i class="fa fa-times text-muted"></i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-user-plus text-primary"></i> <?= lang('add_customer'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-customer-form'];
        echo admin_form_open_multipart('customers/add', $attrib); ?>
        <div class="modal-body cust-modal-body">
            <p style="font-size: 12px; color: #64748b; margin-bottom: 12px;">
                <?= lang('enter_info'); ?> Los campos marcados con <span class="text-danger">*</span> son obligatorios.
            </p>

            <!-- 1. Clasificación y Tarifas -->
            <div class="cust-section-title">
                <i class="fa fa-tag"></i> 1. Clasificación y Grupo de Precios
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_group"><?= lang('customer_group'); ?> <span class="text-danger">*</span></label>
                        <?php
                        foreach ($customer_groups as $customer_group) {
                            $cgs[$customer_group->id] = $customer_group->name;
                        }
                        echo form_dropdown('customer_group', $cgs, $Settings->customer_group, 'class="form-control select" id="customer_group" style="width:100%;" required="required"');
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price_group"><?= lang('price_group'); ?></label>
                        <?php
                        $pgs[''] = lang('select') . ' ' . lang('price_group');
                        foreach ($price_groups as $price_group) {
                            $pgs[$price_group->id] = $price_group->name;
                        }
                        echo form_dropdown('price_group', $pgs, $Settings->price_group, 'class="form-control select" id="price_group" style="width:100%;"');
                        ?>
                    </div>
                </div>
            </div>

            <!-- 2. Identificación del Cliente -->
            <div class="cust-section-title">
                <i class="fa fa-id-card-o"></i> 2. Identificación del Cliente
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group person">
                        <label for="name"><?= lang('name'); ?> <span class="text-danger">*</span></label>
                        <?php echo form_input('name', '', 'class="form-control tip" id="name" placeholder="Ej: Juan Pérez" data-bv-notempty="true" required="required"'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group company">
                        <label for="company"><?= lang('company'); ?> <span class="text-danger">*</span></label>
                        <?php echo form_input('company', '', 'class="form-control tip" id="company" placeholder="Nombre comercial o razón social" data-bv-notempty="true" required="required"'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="vat_no"><?= lang('vat_no'); ?> (RIF / C.I. / NIT)</label>
                        <?php echo form_input('vat_no', '', 'class="form-control" id="vat_no" placeholder="Ej: V-12345678-0 ó J-12345678-0"'); ?>
                    </div>
                </div>
                <?php if ($Settings->indian_gst) { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gst_no"><?= lang('gst_no'); ?></label>
                            <?php echo form_input('gst_no', '', 'class="form-control" id="gst_no"'); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- 3. Contacto -->
            <div class="cust-section-title">
                <i class="fa fa-phone"></i> 3. Información de Contacto
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email_address"><?= lang('email_address'); ?> <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required="required" id="email_address"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone"><?= lang('phone'); ?> <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control" placeholder="Ej: 0414-1234567 / 0251-1234567" required="required" id="phone"/>
                    </div>
                </div>
            </div>

            <!-- 4. Dirección y Ubicación -->
            <div class="cust-section-title">
                <i class="fa fa-map-marker"></i> 4. Dirección y Ubicación Geográfica
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address"><?= lang('address'); ?> <span class="text-danger">*</span></label>
                        <?php echo form_input('address', '', 'class="form-control" id="address" placeholder="Calle, avenida, edificio, local o punto de referencia" required="required"'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="city"><?= lang('city'); ?> <span class="text-danger">*</span></label>
                        <?php echo form_input('city', '', 'class="form-control" id="city" placeholder="Ciudad" required="required"'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="state"><?= lang('state'); ?></label>
                        <?php
                        if ($Settings->indian_gst) {
                            $states = $this->gst->getIndianStates(true);
                            echo form_dropdown('state', $states, '', 'class="form-control select" id="state" required="required"');
                        } else {
                            echo form_input('state', '', 'class="form-control" id="state" placeholder="Estado / Provincia"');
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="country"><?= lang('country'); ?></label>
                        <?php echo form_input('country', '', 'class="form-control" id="country" placeholder="País"'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="postal_code"><?= lang('postal_code'); ?></label>
                        <?php echo form_input('postal_code', '', 'class="form-control" id="postal_code" placeholder="Código postal"'); ?>
                    </div>
                </div>
            </div>

            <!-- 5. Campos Personalizados (Colapsable) -->
            <a class="collapse-custom-fields-btn" data-toggle="collapse" href="#custCustomFieldsCollapse" role="button" aria-expanded="false" aria-controls="custCustomFieldsCollapse">
                <i class="fa fa-plus-circle text-primary"></i> Campos Personalizados e Información Adicional
                <i class="fa fa-angle-down pull-right" style="font-size: 16px;"></i>
            </a>

            <div class="collapse" id="custCustomFieldsCollapse" style="margin-top: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 14px 4px 14px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cf1"><?= lang('ccf1', 'cf1'); ?></label>
                            <?php echo form_input('cf1', '', 'class="form-control" id="cf1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cf2"><?= lang('ccf2', 'cf2'); ?></label>
                            <?php echo form_input('cf2', '', 'class="form-control" id="cf2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cf3"><?= lang('ccf3', 'cf3'); ?></label>
                            <?php echo form_input('cf3', '', 'class="form-control" id="cf3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cf4"><?= lang('ccf4', 'cf4'); ?></label>
                            <?php echo form_input('cf4', '', 'class="form-control" id="cf4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cf5"><?= lang('ccf5', 'cf5'); ?></label>
                            <?php echo form_input('cf5', '', 'class="form-control" id="cf5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cf6"><?= lang('ccf6', 'cf6'); ?></label>
                            <?php echo form_input('cf6', '', 'class="form-control" id="cf6"'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer cust-modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; padding: 7px 16px;">
                <?= lang('close'); ?>
            </button>
            <button type="submit" name="add_customer" class="btn btn-primary" style="border-radius: 6px; padding: 7px 22px; font-weight: 600;">
                <i class="fa fa-check"></i> <?= lang('add_customer'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (e) {
        $('#add-customer-form').bootstrapValidator({
            feedbackIcons: {
                valid: 'fa fa-check',
                invalid: 'fa fa-times',
                validating: 'fa fa-refresh'
            }, excluded: [':disabled']
        });
        $('select.select').select2({minimumResultsForSearch: 7});
        fields = $('.cust-modal-content').find('.form-control');
        $.each(fields, function () {
            var id = $(this).attr('id');
            var iname = $(this).attr('name');
            var iid = '#' + id;
            if (!!$(this).attr('data-bv-notempty') || !!$(this).attr('required')) {
                $(document).on('change', iid, function () {
                    $('form[data-toggle="validator"]').bootstrapValidator('revalidateField', iname);
                });
            }
        });
    });
</script>
