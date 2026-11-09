<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>$(document).ready(function () {
    CURI = '<?= admin_url('shop_settings/sms_log'); ?>';
});</script>
<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-terminal"></i>
            </span>
            <?= lang('sms_log'); ?>
        </h2>
        <div class="box-icon">
            <div class="form-group choose-date hidden-xs" style="margin: 0;">
                <div class="controls">
                    <div class="input-group">
                        <span class="input-group-addon" style="background: #eff6ff; color: #2563eb; border-color: #bfdbfe;"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="<?= $date; ?>" id="log-date" class="form-control" style="border-color: #bfdbfe; font-weight: 600;">
                        <span class="input-group-addon" style="background: #eff6ff; color: #2563eb; border-color: #bfdbfe;"><i class="fa fa-chevron-down"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">
                
                <div style="background: #0f172a; border: 1px solid #1e293b; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                    <div style="background: #1e293b; padding: 10px 16px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #334155;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: #ef4444; display: inline-block;"></span>
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: #f59e0b; display: inline-block;"></span>
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: #10b981; display: inline-block;"></span>
                            <span style="color: #94a3b8; font-size: 12px; font-family: monospace; margin-left: 8px;">sms-<?= $date ?>.log</span>
                        </div>
                        <span style="color: #64748b; font-size: 11px;"><?= lang('sms_log_heading'); ?></span>
                    </div>
                    <pre style="background: transparent; border: none; padding: 18px; color: #38bdf8; font-family: Consolas, monospace; font-size: 12px; line-height: 1.6; margin: 0; min-height: 250px; max-height: 600px; overflow-y: auto;"><?php echo $log; ?></pre>
                </div>

            </div>
        </div>
    </div>
</div>
