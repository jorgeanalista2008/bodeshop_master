<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    /* Card Sections */
    .transfer-card-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .transfer-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .transfer-card-header .step-badge {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #2563eb;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }
    .transfer-card-header h3 {
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
    .select2-container,
    .select2-container.form-control,
    .select2-container.input-tip,
    .select2-container.select {
        border: none !important;
        padding: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        height: 38px !important;
        display: block;
        width: 100% !important;
    }
    .select2-container .select2-choice {
        height: 38px !important;
        line-height: 36px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff !important;
        padding: 0 12px !important;
        box-shadow: none !important;
        color: #1e293b !important;
    }

    /* Empty state notice */
    .transfer-empty-state {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        padding: 35px 20px;
        text-align: center;
        margin: 15px 0;
    }
    .transfer-empty-state .empty-icon-wrap {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #e0e7ff;
        color: #4338ca;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 12px;
    }
    .transfer-empty-state h4 {
        margin: 0 0 6px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }
    .transfer-empty-state p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }

    /* Sticky Totals Bar */
    #sticker, #sticker.stick {
        position: static !important;
        width: 100% !important;
    }
    #sticker .well {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 14px;
    }
    #bottom-total {
        position: static !important;
        width: 100% !important;
        background: #0f172a !important;
        border: 1px solid #1e293b !important;
        border-radius: 10px !important;
        padding: 12px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
    #bottom-total table.totals {
        background: transparent !important;
    }
    #bottom-total table.totals tr td {
        background: #1e293b !important;
        color: #94a3b8 !important;
        border: 1px solid #334155 !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        padding: 8px 12px !important;
    }
    #bottom-total table.totals tr td .totals_val {
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
    }
    #bottom-total table.totals tr td:last-child {
        background: #1e3a8a !important;
        border-color: #2563eb !important;
    }
    #bottom-total table.totals tr td:last-child .totals_val {
        color: #4ade80 !important;
        font-size: 16px !important;
    }
</style>

<script type="text/javascript">
    <?php if ($this->session->userdata('remove_tols')) { ?>
    if (localStorage.getItem('toitems')) localStorage.removeItem('toitems');
    if (localStorage.getItem('toshipping')) localStorage.removeItem('toshipping');
    if (localStorage.getItem('toref')) localStorage.removeItem('toref');
    if (localStorage.getItem('to_warehouse')) localStorage.removeItem('to_warehouse');
    if (localStorage.getItem('tonote')) localStorage.removeItem('tonote');
    if (localStorage.getItem('from_warehouse')) localStorage.removeItem('from_warehouse');
    if (localStorage.getItem('todate')) localStorage.removeItem('todate');
    if (localStorage.getItem('tostatus')) localStorage.removeItem('tostatus');
    <?php $this->sma->unset_data('remove_tols'); } ?>

    var count = 1, an = 1, product_variant = 0, shipping = 0,
        product_tax = 0, total = 0,
        tax_rates = <?php echo json_encode($tax_rates); ?>, toitems = {},
        audio_success = new Audio('<?= $assets ?>sounds/sound2.mp3'),
        audio_error = new Audio('<?= $assets ?>sounds/sound3.mp3');

    function checkToEmptyNotice() {
        if ($('#toTable tbody tr').length === 0 || $('#toTable tbody tr td.dataTables_empty').length > 0) {
            $('#toTableEmptyNotice').show();
            $('#toTableGroup').hide();
        } else {
            $('#toTableEmptyNotice').hide();
            $('#toTableGroup').show();
        }
    }

    $(document).ready(function () {
        <?php if ($Owner || $Admin) { ?>
        if (!localStorage.getItem('todate')) {
            $("#todate").datetimepicker({
                format: site.dateFormats.js_ldate,
                fontAwesome: true,
                language: 'sma',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0
            }).datetimepicker('update', new Date());
        }
        $(document).on('change', '#todate', function (e) {
            localStorage.setItem('todate', $(this).val());
        });
        if (todate = localStorage.getItem('todate')) {
            $('#todate').val(todate);
        }
        <?php } ?>

        ItemnTotals();
        checkToEmptyNotice();
        var toTableBody = document.querySelector('#toTable tbody');
        if (toTableBody && window.MutationObserver) {
            var toObserver = new MutationObserver(function() {
                checkToEmptyNotice();
            });
            toObserver.observe(toTableBody, { childList: true, subtree: true });
        }

        $('#from_warehouse').change(function (e) {
            localStorage.setItem('from_warehouse', $(this).val());
        });
        if (from_warehouse = localStorage.getItem('from_warehouse')) {
            $('#from_warehouse').select2("val", from_warehouse);
        }
        $('#to_warehouse').change(function (e) {
            localStorage.setItem('to_warehouse', $(this).val());
        });
        if (to_warehouse = localStorage.getItem('to_warehouse')) {
            $('#to_warehouse').select2("val", to_warehouse);
        }
        $('#tostatus').change(function (e) {
            localStorage.setItem('tostatus', $(this).val());
        });
        if (tostatus = localStorage.getItem('tostatus')) {
            $('#tostatus').select2("val", toostatus);
        }

        var old_shipping;
        $('#toshipping').focus(function () {
            old_shipping = $(this).val();
        }).change(function () {
            if (!is_numeric($(this).val())) {
                $(this).val(old_shipping);
                bootbox.alert('Unexpected value provided!');
                return;
            } else {
                shipping = $(this).val() ? parseFloat($(this).val()) : '0';
            }
            localStorage.setItem('toshipping', shipping);
            var gtotal = total + shipping;
            $('#gtotal').text(formatMoney(gtotal));
            $('#tship').text(formatMoney(shipping));
        });
        if (toshipping = localStorage.getItem('toshipping')) {
            shipping = parseFloat(toshipping);
            $('#toshipping').val(shipping);
        }

        $('#toref').change(function (e) {
            localStorage.setItem('toref', $(this).val());
        });
        if (toref = localStorage.getItem('toref')) {
            $('#toref').val(toref);
        }

        $('#to_warehouse').change(function (e) {
            if ($(this).val() != '' && $(this).val() == $('#from_warehouse').val()) {
                $(this).select2('val', '');
                bootbox.alert('<?= lang('please_select_different_warehouse') ?>');
            }
        });
        $('#from_warehouse').change(function (e) {
            if ($(this).val() != '' && $(this).val() == $('#to_warehouse').val()) {
                $(this).select2('val', '');
                bootbox.alert('<?= lang('please_select_different_warehouse') ?>');
            }
        });
    });
</script>

<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-plus"></i>
            </span>
            <?= lang('add_transfer'); ?>
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li>
                    <a href="<?= admin_url('transfers'); ?>" class="tip" title="<?= lang('transfers'); ?>">
                        <i class="icon fa fa-list"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('transfers/add', $attrib);
                ?>

                <!-- ================= STEP 1: DATOS PRINCIPALES ================= -->
                <div class="transfer-card-section">
                    <div class="transfer-card-header">
                        <span class="step-badge">1</span>
                        <div>
                            <h3>Datos Principales del Traslado</h3>
                            <small class="text-muted">Establezca los almacenes de origen/destino y las condiciones del traslado</small>
                        </div>
                    </div>

                    <div class="row">
                        <?php if ($Owner || $Admin) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="todate"><?= lang('date', 'todate'); ?> *</label>
                                    <?php echo form_input('date', (isset($_POST['date']) ? $_POST['date'] : ''), 'class="form-control input-tip datetime" id="todate" required="required"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="ref"><?= lang('reference_no', 'ref'); ?></label>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : $rnumber), 'class="form-control input-tip" id="ref"'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="tostatus"><?= lang('status', 'tostatus'); ?> *</label>
                                <?php
                                $post = ['completed' => lang('completed'), 'pending' => lang('pending'), 'sent' => lang('sent')];
                                echo form_dropdown('status', $post, (isset($_POST['status']) ? $_POST['status'] : ''), 'id="tostatus" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('status') . '" required="required" style="width:100%;" ');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="from_warehouse"><?= lang('from_warehouse', 'from_warehouse'); ?> *</label>
                                <?php
                                $wh[''] = '';
                                foreach ($warehouses as $warehouse) {
                                    $wh[$warehouse->id] = $warehouse->name;
                                }
                                if ($Owner || $Admin || !$this->session->userdata('warehouse_id')) {
                                    echo form_dropdown('from_warehouse', $wh, (isset($_POST['from_warehouse']) ? $_POST['from_warehouse'] : ''), 'id="from_warehouse" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('from_warehouse') . '" required="required" style="width:100%;" ');
                                } else {
                                    echo form_dropdown('from_warehouse', $wh, $this->session->userdata('warehouse_id'), 'id="from_warehouse" class="form-control input-tip select" disabled="disabled" style="width:100%;" ');
                                    echo '<input type="hidden" name="from_warehouse" value="' . $this->session->userdata('warehouse_id') . '" />';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="to_warehouse"><?= lang('to_warehouse', 'to_warehouse'); ?> *</label>
                                <?php
                                echo form_dropdown('to_warehouse', $wh, (isset($_POST['to_warehouse']) ? $_POST['to_warehouse'] : ''), 'id="to_warehouse" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('to_warehouse') . '" required="required" style="width:100%;" ');
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="toshipping"><?= lang('shipping', 'toshipping'); ?></label>
                                <?php echo form_input('shipping', '', 'class="form-control input-tip" id="toshipping" placeholder="0.00"'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modern-label" for="document"><?= lang('document', 'document') ?></label>
                                <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= STEP 2: PRODUCTOS ================= -->
                <div class="transfer-card-section">
                    <div class="transfer-card-header">
                        <span class="step-badge">2</span>
                        <div>
                            <h3>Búsqueda y Selección de Productos a Transferir</h3>
                            <small class="text-muted">Escanee el código de barras o busque productos para transferir</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="sticker">
                            <div class="well well-sm">
                                <div class="form-group" style="margin-bottom:0;">
                                    <div class="input-group wide-tip">
                                        <div class="input-group-addon" style="padding-left: 14px; padding-right: 14px; background: #eff6ff; color: #2563eb; border-color: #bfdbfe;">
                                            <i class="fa fa-2x fa-barcode"></i>
                                        </div>
                                        <?php echo form_input('add_item', '', 'class="form-control input-lg" id="add_item" placeholder="' . $this->lang->line('add_product_to_order') . '" style="border-color: #bfdbfe;"'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <!-- Empty State Notice -->
                            <div id="toTableEmptyNotice" class="transfer-empty-state">
                                <div class="empty-icon-wrap">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <h4>El traslado está vacío</h4>
                                <p>Escanee un producto o use el buscador superior para agregar artículos a la orden de traslado.</p>
                            </div>

                            <!-- Table Group -->
                            <div class="control-group table-group" id="toTableGroup" style="display: none;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <label class="modern-label" style="margin: 0;"><?= lang('order_items'); ?> *</label>
                                </div>
                                <div class="controls table-controls table-responsive">
                                    <table id="toTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
                                        <thead>
                                        <tr>
                                            <th class="col-md-4"><?= lang('product') . ' (' . lang('code') . ' - ' . lang('name') . ')'; ?></th>
                                            <?php if ($Settings->product_expiry) {
                                                echo '<th class="col-md-2">' . $this->lang->line('expiry_date') . '</th>';
                                            } ?>
                                            <th class="col-md-1"><?= lang('net_unit_cost'); ?></th>
                                            <th class="col-md-1"><?= lang('quantity'); ?></th>
                                            <?php if ($Settings->tax1) {
                                                echo '<th class="col-md-1">' . $this->lang->line('product_tax') . '</th>';
                                            } ?>
                                            <th><?= lang('subtotal'); ?> (<span class="currency"><?= $default_currency->code ?></span>)</th>
                                            <th style="width: 30px !important; text-align: center;"><i class="fa fa-trash-o text-muted"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= STEP 3: OBSERVACIONES ================= -->
                <div class="transfer-card-section">
                    <div class="transfer-card-header">
                        <span class="step-badge">3</span>
                        <div>
                            <h3>Notas y Observaciones del Traslado</h3>
                            <small class="text-muted">Motivo del movimiento, chofer o transportista asignado, instrucciones de recepción</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modern-label" for="tonote"><?= lang('note', 'tonote'); ?></label>
                                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ''), 'id="tonote" class="form-control" style="height: 100px; resize: vertical;" placeholder="Observaciones del traslado, chofer o guía de remisión..."'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= TOTALS BAR ================= -->
                <div id="bottom-total" class="well well-sm">
                    <table class="table table-bordered table-condensed totals" style="margin-bottom:0;">
                        <tr>
                            <td><?= lang('items') ?> <span class="totals_val pull-right" id="titems">0</span></td>
                            <td><?= lang('total') ?> <span class="totals_val pull-right" id="total">0.00</span></td>
                            <td><?= lang('shipping') ?> <span class="totals_val pull-right" id="tship">0.00</span></td>
                            <td><?= lang('grand_total') ?> <span class="totals_val pull-right" id="gtotal">0.00</span></td>
                        </tr>
                    </table>
                </div>

                <!-- Action Submit Buttons -->
                <div style="margin-top: 18px; margin-bottom: 30px; display: flex; gap: 10px;">
                    <button type="submit" name="add_transfer" id="add_transfer" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; border-radius: 6px;">
                        <i class="fa fa-check"></i> <?= $this->lang->line('submit'); ?>
                    </button>
                    <button type="button" class="btn btn-default" id="reset" style="padding: 10px 20px; font-weight: 600; border-radius: 6px;">
                        <i class="fa fa-refresh text-danger"></i> <?= lang('reset') ?>
                    </button>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<div class="modal" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-2x">&times;</i></span><span class="sr-only"><?=lang('close');?></span></button>
                <h4 class="modal-title" id="prModalLabel"></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= lang('unit_cost') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="net_cost">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= lang('unit_quantity') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= lang('product_unit') ?></label>
                        <div class="col-sm-8">
                            <div id="punits-div"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?= lang('product_tax') ?></label>
                        <div class="col-sm-8">
                            <div id="ptax-div"></div>
                        </div>
                    </div>
                    <input type="hidden" id="punit_cost" value=""/>
                    <input type="hidden" id="old_tax" value=""/>
                    <input type="hidden" id="old_qty" value=""/>
                    <input type="hidden" id="row_id" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editItem"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>
