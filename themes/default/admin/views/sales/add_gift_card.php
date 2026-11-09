<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .gc-modal-content {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .gc-modal-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 16px 20px;
    }
    .gc-modal-header h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .gc-modal-body {
        padding: 18px 22px;
        background: #ffffff;
    }
    .gc-modal-footer {
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }
    /* Virtual Card Preview */
    .gc-preview-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #3b82f6 100%);
        border-radius: 12px;
        padding: 18px 22px;
        color: #ffffff;
        box-shadow: 0 6px 16px rgba(37,99,235,0.25);
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    .gc-preview-card::before {
        content: "";
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }
    .gc-preview-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }
    .gc-preview-brand {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #bfdbfe;
    }
    .gc-preview-icon {
        font-size: 24px;
        color: #fbbf24;
    }
    .gc-preview-number {
        font-family: Consolas, Monaco, monospace;
        font-size: 18px;
        letter-spacing: 2px;
        font-weight: 700;
        margin-bottom: 14px;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
    }
    .gc-preview-bottom {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }
    .gc-preview-value {
        font-size: 22px;
        font-weight: 800;
        color: #4ade80;
        line-height: 1;
    }
    .gc-preview-expiry {
        font-size: 11px;
        color: #e2e8f0;
        text-align: right;
    }
    .gc-preview-expiry strong {
        display: block;
        font-size: 13px;
        color: #ffffff;
    }
</style>

<script type="text/javascript" src="<?= $assets ?>js/custom.js"></script>
<div class="modal-dialog">
    <div class="modal-content gc-modal-content">
        <div class="modal-header gc-modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: 2px;">
                <i class="fa fa-times text-muted"></i>
            </button>
            <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-gift text-primary"></i> <?= lang('add_gift_card'); ?>
            </h4>
        </div>
        <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
        echo admin_form_open('sales/add_gift_card', $attrib); ?>
        <div class="modal-body gc-modal-body">

            <!-- Interactive Virtual Gift Card Preview -->
            <div class="gc-preview-card">
                <div class="gc-preview-top">
                    <span class="gc-preview-brand"><?= htmlspecialchars($Settings->site_name) ?> &bull; TARJETA DE REGALO</span>
                    <i class="fa fa-gift gc-preview-icon"></i>
                </div>
                <div class="gc-preview-number" id="previewCardNo">•••• •••• •••• ••••</div>
                <div class="gc-preview-bottom">
                    <div>
                        <span style="font-size: 10px; color: #bfdbfe; text-transform: uppercase;">Saldo Inicial:</span>
                        <div class="gc-preview-value" id="previewCardVal">$ 0.00</div>
                    </div>
                    <div class="gc-preview-expiry">
                        <span>Vence:</span>
                        <strong id="previewCardExp"><?= date('d/m/Y', strtotime('+2 year')) ?></strong>
                    </div>
                </div>
            </div>

            <p style="font-size: 12px; color: #64748b; margin-bottom: 14px;">
                <?= lang('enter_info'); ?> Los campos marcados con <span class="text-danger">*</span> son obligatorios.
            </p>

            <div class="form-group">
                <label for="card_no" style="font-weight: 600; color: #334155;"><?= lang('card_no'); ?> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <?php echo form_input('card_no', '', 'class="form-control" id="card_no" required="required" placeholder="Ej: 16 dígitos" style="font-family: monospace; font-size: 14px;"'); ?>
                    <div class="input-group-addon" style="padding: 0;">
                        <a href="#" id="genNo" class="btn btn-default" style="border: none; border-radius: 0; height: 32px; padding: 6px 12px; font-weight: 600;" title="Generar número aleatorio">
                            <i class="fa fa-magic text-primary"></i> Generar
                        </a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="value" style="font-weight: 600; color: #334155;"><?= lang('value'); ?> (Monto Inicial) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                    <?php echo form_input('value', '', 'class="form-control" id="value" required="required" placeholder="0.00"'); ?>
                </div>
            </div>

            <div class="form-group" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;">
                <input type="checkbox" class="checkbox" name="staff_points" id="staff_points">
                <label for="staff_points" style="font-weight: 600; color: #334155; margin-left: 6px;"><?= lang('use_staff_award_points'); ?></label>
            </div>

            <div id="staff-con" style="display:none; margin-bottom: 14px;">
                <div class="form-group">
                    <label class="control-label" for="user" style="font-weight: 600; color: #334155;"><?= lang('user'); ?></label>
                    <?php
                    $us[''] = '';
                    foreach ($users as $user) {
                        $us[$user->id] = $user->first_name . ' ' . $user->last_name;
                    }
                    echo form_dropdown('user', $us, (isset($_POST['user']) ? $_POST['user'] : ''), 'class="form-control" id="user" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('user') . '"');
                    ?>
                </div>
                <div class="form-group well well-sm" id="sa-points-con" style="display:none; background: #fffbeb; border-color: #fde68a;">
                    <p class="bold" style="color: #b45309; margin-bottom: 6px;"><?= lang('award_points'); ?> disponibles: <span id="staff_award_points">0</span></p>
                    <label for="sa_points"><?= lang('use_points'); ?></label>
                    <?php echo form_input('sa_points', '', 'class="form-control" id="sa_points" placeholder="Puntos a canjear"'); ?>
                </div>
            </div>

            <div id="customer-con">
                <div class="form-group">
                    <label for="customer" style="font-weight: 600; color: #334155;"><?= lang('customer'); ?> (Asignar a cliente)</label>
                    <?php echo form_input('customer', '', 'class="form-control" id="customer" style="width: 100%;"'); ?>
                </div>
                <div class="well well-sm" id="award-points-con" style="display:none; background: #fffbeb; border-color: #fde68a;">
                    <div class="form-group" style="margin-bottom: 6px;">
                        <p class="bold" style="color: #b45309; margin-bottom: 4px;"><?= lang('award_points'); ?> del cliente: <span id="award_points">0</span></p>
                        <input type="checkbox" class="checkbox" name="use_points" id="use_points">
                        <label for="use_points" style="font-weight: 600; margin-left: 6px;"><?= lang('use_award_points'); ?></label>
                    </div>
                    <div class="form-group" id="ca-points-con" style="display:none; margin-bottom: 0;">
                        <label for="ca_points"><?= lang('use_points'); ?></label>
                        <?php echo form_input('ca_points', '', 'class="form-control" id="ca_points" placeholder="Puntos a canjear"'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group" style="margin-top: 14px;">
                <label for="expiry" style="font-weight: 600; color: #334155;"><?= lang('expiry_date'); ?></label>
                <?php echo form_input('expiry', $this->sma->hrsd(date('Y-m-d', strtotime('+2 year'))), 'class="form-control date" id="expiry" placeholder="dd/mm/yyyy"'); ?>
            </div>

        </div>
        <div class="modal-footer gc-modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 6px; padding: 7px 16px;">
                <?= lang('close'); ?>
            </button>
            <button type="submit" name="add_gift_card" class="btn btn-primary" style="border-radius: 6px; padding: 7px 22px; font-weight: 600;">
                <i class="fa fa-check"></i> <?= lang('add_gift_card'); ?>
            </button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?= $modal_js ?>
<script type="text/javascript">
    $(document).ready(function () {
        $.fn.datetimepicker.dates['sma'] = <?=$dp_lang?>;
        $('#customer').select2({
            minimumInputLength: 1,
            ajax: {
                url: site.base_url + "customers/suggestions",
                dataType: 'json',
                quietMillis: 15,
                data: function (term, page) {
                    return {
                        term: term,
                        limit: 10
                    };
                },
                results: function (data, page) {
                    if (data.results != null) {
                        return {results: data.results};
                    } else {
                        return {results: [{id: '', text: 'No Match Found'}]};
                    }
                }
            }
        });

        // Dynamic Virtual Card Preview Updates
        function updateCardPreview() {
            var cardNo = $('#card_no').val();
            if (cardNo && cardNo.trim() !== '') {
                $('#previewCardNo').text(cardNo);
            } else {
                $('#previewCardNo').text('•••• •••• •••• ••••');
            }

            var cardVal = $('#value').val();
            if (cardVal && !isNaN(parseFloat(cardVal))) {
                $('#previewCardVal').text('$' + parseFloat(cardVal).toFixed(2));
            } else {
                $('#previewCardVal').text('$ 0.00');
            }

            var cardExp = $('#expiry').val();
            if (cardExp && cardExp.trim() !== '') {
                $('#previewCardExp').text(cardExp);
            }
        }

        $('#card_no, #value, #expiry').on('input change keyup', updateCardPreview);

        var customer_points = 0;
        $('#customer').on('select2-close', function () {
            var selected_customer = $(this).val();
            $.ajax({
                type: "get", async: false,
                url: site.base_url + "customers/get_award_points/" + selected_customer,
                dataType: 'json',
                success: function (data) {
                    if (data != null) {
                        $('#award_points').html(data.ca_points);
                        $('#ca_points').val(data.ca_points);
                        customer_points = parseInt(data.ca_points);
                        if (data.ca_points > 0) {
                            $('#award-points-con').slideDown();
                        } else {
                            $('#award-points-con').slideUp();
                        }
                    } else {
                        $('#award-points-con').slideUp();
                    }
                }
            });
        });
        $(document).on('change', '#ca_points', function () {
            if (parseInt($(this).val()) <= customer_points) {
                $("[name='add_gift_card']").attr('disabled', false);
            } else {
                $("[name='add_gift_card']").attr('disabled', true);
            }
        });
        $(document).on('ifChecked', '#use_points', function (event) {
            $('#ca-points-con').slideDown();
        });
        $(document).on('ifUnchecked', '#use_points', function (event) {
            $('#ca-points-con').slideUp();
        });
        $('#genNo').click(function (e) {
            e.preventDefault();
            var no = generateCardNo();
            $('#card_no').val(no);
            updateCardPreview();
            return false;
        });
        $('#staff_points').on('ifChecked', function (event) {
            $('#customer-con').slideUp('fast');
            $('#staff-con').slideDown();
        });
        $('#staff_points').on('ifUnchecked', function (event) {
            $('#staff-con').slideUp('fast');
            $('#customer-con').slideDown();
        });
        $('#user').change(function () {
            var selected_user = $(this).val();
            $.ajax({
                type: "get", async: false,
                url: site.base_url + "sales/get_award_points/" + selected_user,
                dataType: 'json',
                success: function (data) {
                    if (data != null) {
                        $('#staff_award_points').html(data.sa_points);
                        $('#sa_points').val(data.sa_points);
                        if (data.sa_points > 0) {
                            $('#sa-points-con').slideDown();
                        } else {
                            $('#sa-points-con').slideUp();
                        }
                    } else {
                        $('#sa-points-con').slideUp();
                    }
                }
            });
        });
    });
</script>
