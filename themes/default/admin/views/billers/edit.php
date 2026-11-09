<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel" style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0f172a;">
                <span style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa fa-edit"></i>
                </span>
                <?php echo lang('edit_biller'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('billers/edit/' . $biller->id, $attrib); ?>
        <div class="modal-body" style="padding: 24px;">
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; margin-bottom: 22px; display: flex; align-items: center; gap: 12px;">
                <i class="fa fa-info-circle text-primary" style="font-size: 18px;"></i>
                <span style="color: #475569; font-size: 13px;"><?= lang('enter_info'); ?></span>
            </div>

            <!-- SECCIÓN 1: Identificación y Logo -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; margin-bottom: 20px;">
                <h5 style="margin: 0 0 16px 0; font-size: 14px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-id-card-o text-primary"></i> Identificación del Vendedor
                </h5>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="modern-label" for="biller_logo"><?= lang('logo', 'biller_logo'); ?> *</label>
                            <?php
                            $biller_logos[''] = lang('select') . ' ' . lang('logo');
                            foreach ($logos as $key => $value) {
                                $biller_logos[$value] = $value;
                            }
                            echo form_dropdown('logo', $biller_logos, $biller->logo, 'class="form-control select" id="biller_logo" required="required" style="width:100%;" '); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div id="logo-con" class="text-center" style="min-height: 55px; border: 1px solid #cbd5e1; border-radius: 8px; display: flex; align-items: center; justify-content: center; background: #f8fafc; padding: 6px;">
                            <img src="<?= base_url('assets/uploads/logos/' . $biller->logo) ?>" alt="" style="max-height: 48px; max-width: 100%; border-radius: 4px;" />
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-6">
                        <div class="form-group company">
                            <label class="modern-label" for="company"><?= lang('company', 'company'); ?> *</label>
                            <?php echo form_input('company', $biller->company, 'class="form-control" id="company" required="required"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group person">
                            <label class="modern-label" for="name"><?= lang('name', 'name'); ?> *</label>
                            <?php echo form_input('name', $biller->name, 'class="form-control" id="name" required="required"'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="vat_no"><?= lang('vat_no', 'vat_no'); ?></label>
                            <?php echo form_input('vat_no', $biller->vat_no, 'class="form-control" id="vat_no"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="gst_no"><?= lang('gst_no', 'gst_no'); ?></label>
                            <?php echo form_input('gst_no', $biller->gst_no, 'class="form-control" id="gst_no"'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: Contacto y Ubicación -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 18px; margin-bottom: 20px;">
                <h5 style="margin: 0 0 16px 0; font-size: 14px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-map-marker text-primary"></i> Contacto y Dirección
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="email_address"><?= lang('email_address', 'email_address'); ?> *</label>
                            <input type="email" name="email" class="form-control" required="required" id="email_address" value="<?= $biller->email ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="phone"><?= lang('phone', 'phone'); ?> *</label>
                            <input type="tel" name="phone" class="form-control" required="required" id="phone" value="<?= $biller->phone ?>"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="modern-label" for="address"><?= lang('address', 'address'); ?> *</label>
                            <?php echo form_input('address', $biller->address, 'class="form-control" id="address" required="required"'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="city"><?= lang('city', 'city'); ?> *</label>
                            <?php echo form_input('city', $biller->city, 'class="form-control" id="city" required="required"'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="state"><?= lang('state', 'state'); ?></label>
                            <?php
                            if ($Settings->indian_gst) {
                                $states = $this->gst->getIndianStates();
                                echo form_dropdown('state', $states, $biller->state, 'class="form-control select" id="state" required="required"');
                            } else {
                                echo form_input('state', $biller->state, 'class="form-control" id="state"');
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="modern-label" for="postal_code"><?= lang('postal_code', 'postal_code'); ?></label>
                            <?php echo form_input('postal_code', $biller->postal_code, 'class="form-control" id="postal_code"'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="modern-label" for="country"><?= lang('country', 'country'); ?></label>
                            <?php echo form_input('country', $biller->country, 'class="form-control" id="country"'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 3: Campos Personalizados (Acordeón) -->
            <details style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;">
                <summary style="font-weight: 700; color: #475569; cursor: pointer; outline: none; font-size: 13px;">
                    <i class="fa fa-sliders text-primary" style="margin-right: 6px;"></i> Campos Personalizados Opcionales
                </summary>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="cf1"><?= lang('bcf1', 'cf1'); ?></label>
                            <?php echo form_input('cf1', $biller->cf1, 'class="form-control" id="cf1"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="cf2"><?= lang('bcf2', 'cf2'); ?></label>
                            <?php echo form_input('cf2', $biller->cf2, 'class="form-control" id="cf2"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="cf3"><?= lang('bcf3', 'cf3'); ?></label>
                            <?php echo form_input('cf3', $biller->cf3, 'class="form-control" id="cf3"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="cf4"><?= lang('bcf4', 'cf4'); ?></label>
                            <?php echo form_input('cf4', $biller->cf4, 'class="form-control" id="cf4"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="cf5"><?= lang('bcf5', 'cf5'); ?></label>
                            <?php echo form_input('cf5', $biller->cf5, 'class="form-control" id="cf5"'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="cf6"><?= lang('bcf6', 'cf6'); ?></label>
                            <?php echo form_input('cf6', $biller->cf6, 'class="form-control" id="cf6"'); ?>
                        </div>
                    </div>
                </div>
            </details>

            <!-- SECCIÓN 4: Pie de Página de Factura -->
            <div class="form-group" style="margin-bottom: 0;">
                <label class="modern-label" for="invoice_footer"><?= lang('invoice_footer', 'invoice_footer'); ?></label>
                <?php echo form_textarea('invoice_footer', $biller->invoice_footer, 'class="form-control skip" id="invoice_footer" style="height:90px; resize:vertical;"'); ?>
            </div>

        </div>
        <div class="modal-footer" style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 9px 18px; border-radius: 6px; font-weight: 600;">
                <?= lang('close') ?>
            </button>
            <?php echo form_submit('edit_biller', lang('edit_biller'), 'class="btn btn-primary" style="padding: 9px 22px; border-radius: 6px; font-weight: 700;"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#biller_logo').change(function (event) {
            var biller_logo = $(this).val();
            if (biller_logo) {
                $('#logo-con').html('<img src="<?=base_url('assets/uploads/logos')?>/' + biller_logo + '" alt="" style="max-height: 48px; max-width: 100%; border-radius: 4px;" />');
            } else {
                $('#logo-con').html('<span class="text-muted" style="font-size: 12px;"><i class="fa fa-image"></i> Sin logo seleccionado</span>');
            }
        });
    });
</script>
<?= $modal_js ?>
