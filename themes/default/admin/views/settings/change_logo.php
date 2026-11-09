<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel" style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0f172a;">
                <span style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa fa-picture-o"></i>
                </span>
                <?php echo lang('change_logo'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open_multipart('system_settings/change_logo', $attrib); ?>
        <div class="modal-body" style="padding: 24px;">
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px; display: flex; align-items: flex-start; gap: 12px;">
                <i class="fa fa-info-circle text-primary" style="font-size: 18px; margin-top: 2px;"></i>
                <div style="font-size: 13px; color: #475569;">
                    <div><?= lang('enter_info'); ?></div>
                    <div style="font-weight: 600; color: #2563eb; margin-top: 4px;"><?= lang('logo_image_tip'); ?></div>
                </div>
            </div>

            <!-- Site Logo Card -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <label class="modern-label" for="site_logo" style="margin: 0; font-weight: 700;">
                        <i class="fa fa-desktop text-muted" style="margin-right: 6px;"></i> <?= lang('site_logo', 'site_logo') ?>
                    </label>
                    <?php if (!empty($Settings->logo)) { ?>
                        <span style="font-size: 11px; padding: 2px 8px; border-radius: 12px; background: #ecfdf5; color: #059669; font-weight: 600;">Actual: <?= $Settings->logo ?></span>
                    <?php } ?>
                </div>
                <input id="site_logo" type="file" data-browse-label="<?= lang('browse'); ?>" name="site_logo" data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>

            <!-- Login Logo Card -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <label class="modern-label" for="login_logo" style="margin: 0; font-weight: 700;">
                        <i class="fa fa-sign-in text-muted" style="margin-right: 6px;"></i> <?= lang('login_logo', 'login_logo') ?>
                    </label>
                    <?php if (!empty($Settings->logo2)) { ?>
                        <span style="font-size: 11px; padding: 2px 8px; border-radius: 12px; background: #ecfdf5; color: #059669; font-weight: 600;">Actual: <?= $Settings->logo2 ?></span>
                    <?php } ?>
                </div>
                <input id="login_logo" type="file" data-browse-label="<?= lang('browse'); ?>" name="login_logo" data-show-upload="false" data-show-preview="false" class="form-control file">
            </div>

            <!-- Biller Logo Card -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <label class="modern-label" for="biller_logo" style="margin: 0; font-weight: 700;">
                        <i class="fa fa-briefcase text-muted" style="margin-right: 6px;"></i> <?= lang('biller_logo', 'biller_logo') ?>
                    </label>
                </div>
                <input id="biller_logo" type="file" data-browse-label="<?= lang('browse'); ?>" name="biller_logo" data-show-upload="false" data-show-preview="false" class="form-control file">
                <small class="help-block" style="margin: 8px 0 0 0; color: #64748b; font-size: 12px;">
                    <i class="fa fa-info-circle"></i> <?= lang('biller_logo_tip'); ?>
                </small>
            </div>

        </div>
        <div class="modal-footer" style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="padding: 9px 18px; border-radius: 6px; font-weight: 600;">
                <?= lang('close') ?>
            </button>
            <?php echo form_submit('upload_logo', lang('upload_logo'), 'class="btn btn-primary" style="padding: 9px 22px; border-radius: 6px; font-weight: 700;"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<?= $modal_js ?>
