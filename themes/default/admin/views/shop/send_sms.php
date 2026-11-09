<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-paper-plane"></i>
            </span>
            <?= lang('send_sms'); ?>
        </h2>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 700px; margin: 0 auto; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div style="border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
                        <h4 style="margin: 0 0 6px 0; font-weight: 700; color: #0f172a;">Redactor de Mensajes SMS</h4>
                        <p class="text-muted" style="margin: 0; font-size: 13px;"><?= lang('send_sms_heading'); ?></p>
                    </div>

                    <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'send-sms', 'autocomplete' => 'off'];
                    echo admin_form_open('shop_settings/send_sms', $attrib);
                    ?>

                    <div class="form-group">
                        <label class="modern-label" for="ncustomer"><i class="fa fa-user text-muted" style="margin-right: 5px;"></i> Buscar Cliente (Opcional)</label>
                        <?= form_input('customer', '', 'id="ncustomer" placeholder="' . lang('search_phone_by_customer') . '" class="form-control" style="width:100%;" autocomplete="off"'); ?>
                    </div>

                    <div class="form-group">
                        <label class="modern-label" for="mobile"><i class="fa fa-phone text-muted" style="margin-right: 5px;"></i> <?= lang('mobile', 'mobile'); ?> *</label>
                        <?= form_input('mobile', set_value('mobile'), 'class="form-control" id="mobile" required="required" placeholder="+584141234567, +584127654321"'); ?>
                        <small class="help-block" style="color: #64748b; font-size: 12px; margin-top: 4px;">Puede separar múltiples números telefónicos con coma (,)</small>
                    </div>

                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label class="modern-label" for="message" style="margin: 0;"><i class="fa fa-commenting-o text-muted" style="margin-right: 5px;"></i> <?= lang('message', 'message'); ?> *</label>
                            <span id="char-count" style="font-size: 12px; color: #64748b; font-weight: 600;">0 / 160 caracteres (1 SMS)</span>
                        </div>
                        <?= form_textarea('message', set_value('message'), 'class="form-control skip" rows="4" style="height:100px; resize:vertical;" id="message" required="required" placeholder="Escriba aquí el contenido del mensaje..."'); ?>
                    </div>

                    <div style="margin-top: 20px;">
                        <?= form_submit('send_sms', lang('send_sms'), 'class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; border-radius: 6px;"'); ?>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#message').on('input', function() {
        var len = $(this).val().length;
        var parts = Math.ceil(len / 160) || 1;
        $('#char-count').text(len + ' / ' + (parts * 160) + ' caracteres (' + parts + ' SMS)');
    });

    $('#ncustomer').autocomplete({
        minLength: 1,
        source: site.base_url+"customers/suggestions/0/0/1",
        response: function (event, ui) {
            if (ui.content.length == 1) {
                ui.item = ui.content[0];
                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                $(this).autocomplete('close');
            }
            $(this).removeClass('ui-autocomplete-loading');
            $(this).val('');
        },
        select: function (event, ui) {
            event.preventDefault();
            var mobile = $('#mobile').val();
            if (mobile.indexOf(ui.item.phone) == -1) {
                $('#mobile').val(mobile ? mobile + ', ' + ui.item.phone : ui.item.phone);
            }
        }
    });
});
</script>
