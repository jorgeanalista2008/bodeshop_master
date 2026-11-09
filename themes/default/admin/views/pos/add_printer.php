<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-print"></i>
            </span>
            <?= lang('add_printer'); ?>
        </h2>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">
                
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 800px; margin: 0 auto; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <div style="border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; margin-bottom: 20px;">
                        <h4 style="margin: 0 0 6px 0; font-weight: 700; color: #0f172a;">Configuración de Impresora POS</h4>
                        <p class="text-muted" style="margin: 0; font-size: 13px;"><?= lang('enter_info'); ?></p>
                    </div>

                    <?php echo admin_form_open('pos/add_printer');?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="title"><?= $this->lang->line('title'); ?> *</label>
                                <?= form_input('title', set_value('title'), 'class="form-control" id="title" required="required" placeholder="Ej. Impresora Barra"'); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="type"><?= lang('type', 'type'); ?> *</label>
                                <?php $topts = ['network' => lang('network'), 'windows' => lang('windows'), 'linux' => lang('linux')]; ?>
                                <?= form_dropdown('type', $topts, set_value('type', 'network'), 'class="form-control select2" id="type" required="required" style="width:100%;"'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="profile"><?= lang('profile', 'profile'); ?> *</label>
                                <?php $popts = ['default' => lang('default'), 'simple' => lang('simple'), 'SP2000' => lang('star_branded'), 'TEP-200M' => lang('epson_tep'), 'P822D' => lang('P822D')]; ?>
                                <?= form_dropdown('profile', $popts, set_value('profile', 'default'), 'class="form-control select2" id="profile" required="required" style="width:100%;"'); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="modern-label" for="char_per_line"><?= lang('char_per_line', 'char_per_line'); ?> *</label>
                                <?= form_input('char_per_line', set_value('char_per_line', '48'), 'class="form-control" id="char_per_line" required="required" placeholder="48"'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="path" style="display:none; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="modern-label" for="path"><?= lang('path', 'path'); ?> *</label>
                            <?= form_input('path', set_value('path'), 'class="form-control" id="path" placeholder="Ej. //localhost/POS58 o /dev/usb/lp0"'); ?>
                            <small class="help-block" style="margin-top: 6px; color: #64748b; font-size: 12px;"><?= lang('printer_path_tip'); ?></small>
                        </div>
                    </div>

                    <div class="network" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-bottom: 16px;">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="modern-label" for="ip_address"><?= lang('ip_address', 'ip_address'); ?> *</label>
                                    <?= form_input('ip_address', set_value('ip_address'), 'class="form-control" id="ip_address" placeholder="192.168.1.100"'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="port"><?= lang('port', 'port'); ?> *</label>
                                    <?= form_input('port', set_value('port', '9100'), 'class="form-control" id="port"'); ?>
                                </div>
                            </div>
                        </div>
                        <small class="help-block" style="margin: 0; color: #64748b; font-size: 12px;"><?= lang('printer_port_tip'); ?></small>
                    </div>

                    <div style="margin-top: 20px; display: flex; gap: 10px;">
                        <?php echo form_submit('add_printer', $this->lang->line('add_printer'), 'class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; border-radius: 6px;"');?>
                        <a href="<?= admin_url('pos/printers') ?>" class="btn btn-default" style="padding: 10px 20px; font-weight: 600; border-radius: 6px;"><?= lang('cancel') ?></a>
                    </div>

                    <?php echo form_close();?>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        function checkType() {
            var type = $('#type').val();
            if (type == 'network') {
                $('.network').slideDown();
                $('.path').slideUp();
            } else {
                $('.network').slideUp();
                $('.path').slideDown();
            }
        }
        $('#type').change(checkType);
        checkType();
    });
</script>
