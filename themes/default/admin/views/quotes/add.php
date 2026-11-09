<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .quote-card-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .quote-card-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .quote-card-header .step-badge {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background-color: #2563eb;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
    }
    .quote-card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }
    .quote-empty-state {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        padding: 35px 20px;
        text-align: center;
        margin: 15px 0;
    }
    .quote-empty-state .empty-icon-wrap {
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
    .quote-empty-state h4 {
        margin: 0 0 6px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }
    .quote-empty-state p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .table-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    /* Select2 Container Reset: Neutralize outer double borders */
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
        transition: border-color 0.15s, box-shadow 0.15s !important;
    }
    .select2-container .select2-choice:hover {
        border-color: #94a3b8 !important;
    }
    .select2-container.select2-container-active .select2-choice,
    .select2-container-active .select2-choice {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
    }
    .select2-container .select2-choice .select2-arrow {
        border-radius: 0 5px 5px 0 !important;
        background: #f8fafc !important;
        border-left: 1px solid #e2e8f0 !important;
        width: 26px !important;
        height: 36px !important;
        top: 0 !important;
        right: 0 !important;
    }
    .select2-container .select2-choice .select2-arrow b {
        background-position: 0 6px !important;
    }
    .select2-container .select2-choice > .select2-chosen {
        line-height: 36px !important;
        margin-right: 28px !important;
        font-size: 13px !important;
        color: #0f172a !important;
    }

    /* Customer input group styling */
    .customer-btn-group {
        display: table !important;
        width: 100% !important;
        border-collapse: separate !important;
    }
    .customer-btn-group .select2-container,
    .customer-btn-group .select2-container.input-tip,
    .customer-btn-group .select2-container.form-control,
    .customer-btn-group > .select2-container {
        display: table-cell !important;
        width: 100% !important;
        vertical-align: middle !important;
        float: none !important;
    }
    .customer-btn-group .select2-container .select2-choice {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right: 0 !important;
    }
    .customer-btn-group .input-group-addon {
        display: table-cell !important;
        height: 38px !important;
        line-height: 36px !important;
        padding: 0 11px !important;
        vertical-align: middle !important;
        border: 1px solid #cbd5e1 !important;
        border-left: 0 !important;
        background: #f8fafc !important;
        width: 1% !important;
        white-space: nowrap !important;
        box-sizing: border-box !important;
        float: none !important;
    }
    .customer-btn-group .input-group-addon a {
        color: #475569;
        font-size: 14px;
        display: inline-block;
        line-height: 36px;
    }
    .customer-btn-group .input-group-addon a:hover {
        color: #2563eb;
    }
    .customer-btn-group .input-group-addon:last-child {
        border-top-right-radius: 6px !important;
        border-bottom-right-radius: 6px !important;
    }
    #sticker,
    #sticker.stick {
        position: static !important;
        top: auto !important;
        left: auto !important;
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
        bottom: auto !important;
        left: auto !important;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
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
    var count = 1, an = 1, product_variant = 0, DT = <?= $Settings->default_tax_rate ?>, allow_discount = <?= ($Owner || $Admin || $this->session->userdata('allow_discount')) ? 1 : 0; ?>,
        product_tax = 0, invoice_tax = 0, total_discount = 0, total = 0, shipping = 0,
        tax_rates = <?php echo json_encode($tax_rates); ?>;
    var audio_success = new Audio('<?=$assets?>sounds/sound2.mp3');
    var audio_error = new Audio('<?=$assets?>sounds/sound3.mp3');
    $(document).ready(function () {
        <?php if ($this->input->get('customer')) { ?>
        if (!localStorage.getItem('quitems')) {
            localStorage.setItem('qucustomer', <?=$this->input->get('customer'); ?>);
        }
        <?php } ?>
        <?php if ($Owner || $Admin) { ?>
        if (!localStorage.getItem('qudate')) {
            $("#qudate").datetimepicker({
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
        $(document).on('change', '#qudate', function (e) {
            localStorage.setItem('qudate', $(this).val());
        });
        if (qudate = localStorage.getItem('qudate')) {
            $('#qudate').val(qudate);
        }
        <?php } ?>
        $(document).on('change', '#qubiller', function (e) {
            localStorage.setItem('qubiller', $(this).val());
        });
        if (qubiller = localStorage.getItem('qubiller')) {
            $('#qubiller').val(qubiller);
        }
        if (!localStorage.getItem('qutax2')) {
            localStorage.setItem('qutax2', <?=$Settings->default_tax_rate2;?>);
        }
        ItemnTotals();
        $("#add_item").autocomplete({
            source: function (request, response) {
                if (!$('#qucustomer').val()) {
                    $('#add_item').val('').removeClass('ui-autocomplete-loading');
                    bootbox.alert('<?=lang('select_above');?>');
                    $('#add_item').focus();
                    return false;
                }
                $.ajax({
                    type: 'get',
                    url: '<?= admin_url('quotes/suggestions'); ?>',
                    dataType: "json",
                    data: {
                        term: request.term,
                        warehouse_id: $("#quwarehouse").val(),
                        customer_id: $("#qucustomer").val()
                    },
                    success: function (data) {
                        $(this).removeClass('ui-autocomplete-loading');
                        response(data);
                    }
                });
            },
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_match_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_match_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_invoice_item(ui.item);
                    if (row)
                        $(this).val('');
                } else {
                    bootbox.alert('<?= lang('no_match_found') ?>');
                }
            }
        });

        // Interactive Empty State Sync with #quTable
        function syncQuTableUI() {
            var itemsCount = $('#quTable tbody tr').length;
            if (itemsCount > 0) {
                $('#quTableEmptyNotice').hide();
                $('#quTableGroup').fadeIn(150);
                $('#quItemsCountBadge').text(itemsCount + (itemsCount === 1 ? ' artículo' : ' artículos'));
            } else {
                $('#quTableGroup').hide();
                $('#quTableEmptyNotice').fadeIn(150);
            }
        }
        syncQuTableUI();

        // Observe DOM modifications in #quTable tbody
        var quTableBody = document.querySelector('#quTable tbody');
        if (quTableBody) {
            var quObserver = new MutationObserver(function() {
                syncQuTableUI();
            });
            quObserver.observe(quTableBody, { childList: true, subtree: true });
        }

        $(document).on('click change keyup', function () {
            setTimeout(syncQuTableUI, 200);
        });
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i><?= lang('add_quote'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li>
                    <a href="<?= admin_url('quotes'); ?>" class="tip" title="<?= lang('quotes'); ?>">
                        <i class="icon fa fa-list"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('enter_info'); ?></p>
                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('quotes/add', $attrib)
                ?>

                <!-- ================= STEP 1: DATOS PRINCIPALES ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">1</span>
                        <h3>Datos Principales de la Cotización</h3>
                    </div>

                    <div class="row">
                        <?php if ($Owner || $Admin) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qudate" style="font-weight: 600; color: #334155;"><?= lang('date'); ?></label>
                                    <?php echo form_input('date', (isset($_POST['date']) ? $_POST['date'] : ''), 'class="form-control input-tip datetime" id="qudate" required="required"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quref" style="font-weight: 600; color: #334155;"><?= lang('reference_no'); ?></label>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : $qunumber), 'class="form-control input-tip" id="quref"'); ?>
                            </div>
                        </div>

                        <?php if ($Owner || $Admin || !$this->session->userdata('biller_id')) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qubiller" style="font-weight: 600; color: #334155;"><?= lang('biller'); ?></label>
                                    <?php
                                    $bl[''] = '';
                                    foreach ($billers as $biller) {
                                        $bl[$biller->id] = $biller->company && $biller->company != '-' ? $biller->company : $biller->name;
                                    }
                                    echo form_dropdown('biller', $bl, (isset($_POST['biller']) ? $_POST['biller'] : $Settings->default_biller), 'id="qubiller" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('biller') . '" required="required" class="form-control input-tip select" style="width:100%;"'); ?>
                                </div>
                            </div>
                        <?php } else {
                            $biller_input = [
                                'type'  => 'hidden',
                                'name'  => 'biller',
                                'id'    => 'qubiller',
                                'value' => $this->session->userdata('biller_id'),
                            ];
                            echo form_input($biller_input);
                        } ?>

                        <?php if ($Owner || $Admin || !$this->session->userdata('warehouse_id')) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quwarehouse" style="font-weight: 600; color: #334155;"><?= lang('warehouse'); ?></label>
                                    <?php
                                    $wh[''] = '';
                                    foreach ($warehouses as $warehouse) {
                                        $wh[$warehouse->id] = $warehouse->name;
                                    }
                                    echo form_dropdown('warehouse', $wh, (isset($_POST['warehouse']) ? $_POST['warehouse'] : $Settings->default_warehouse), 'id="quwarehouse" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('warehouse') . '" required="required" style="width:100%;" '); ?>
                                </div>
                            </div>
                        <?php } else {
                            $warehouse_input = [
                                'type'  => 'hidden',
                                'name'  => 'warehouse',
                                'id'    => 'quwarehouse',
                                'value' => $this->session->userdata('warehouse_id'),
                            ];
                            echo form_input($warehouse_input);
                        } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qucustomer" style="font-weight: 600; color: #334155;"><?= lang('customer'); ?></label>
                                <div class="input-group customer-btn-group">
                                    <?php
                                    echo form_input('customer', (isset($_POST['customer']) ? $_POST['customer'] : ''), 'id="qucustomer" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('customer') . '" required="required" class="form-control input-tip" style="width:100%;"');
                                    ?>
                                    <div class="input-group-addon no-print" style="padding: 2px 8px; border-left: 0;">
                                        <a href="#" id="toogle-customer-read-attr" class="external" title="Editar campo">
                                            <i class="fa fa-pencil" id="addIcon"></i>
                                        </a>
                                    </div>
                                    <div class="input-group-addon no-print" style="padding: 2px 7px; border-left: 0;">
                                        <a href="#" id="view-customer" class="external" data-toggle="modal" data-target="#myModal" title="Ver detalles del cliente">
                                            <i class="fa fa-eye" id="addIcon"></i>
                                        </a>
                                    </div>
                                    <?php if ($Owner || $Admin || $GP['customers-add']) { ?>
                                        <div class="input-group-addon no-print" style="padding: 2px 8px;">
                                            <a href="<?= admin_url('customers/add'); ?>" id="add-customer" class="external" data-toggle="modal" data-target="#myModal" title="Nuevo cliente">
                                                <i class="fa fa-plus-circle text-primary" id="addIcon"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qusupplier" style="font-weight: 600; color: #334155;"><?= lang('supplier'); ?></label>
                                <input type="hidden" name="supplier" value="" id="qusupplier" class="form-control" style="width:100%;" placeholder="<?= lang('select') . ' ' . lang('supplier') ?>">
                                <input type="hidden" name="supplier_id" value="" id="supplier_id" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= STEP 2: PRODUCTOS ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">2</span>
                        <h3>Búsqueda y Selección de Productos</h3>
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
                                        <?php if ($Owner || $Admin || $GP['products-add']) { ?>
                                            <div class="input-group-addon" style="padding-left: 14px; padding-right: 14px; background: #ffffff; border-color: #bfdbfe;">
                                                <a href="#" id="addManually" class="tip" title="<?= lang('add_product_manually') ?>">
                                                    <i class="fa fa-2x fa-plus-circle text-primary"></i>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <!-- Empty State Notice -->
                            <div id="quTableEmptyNotice" class="quote-empty-state">
                                <div class="empty-icon-wrap">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <h4>La cotización está vacía</h4>
                                <p>Escanee un producto o use el buscador superior para agregar artículos a la cotización.</p>
                            </div>

                            <!-- Table Group -->
                            <div class="control-group table-group" id="quTableGroup" style="display: none;">
                                <div class="table-label-row">
                                    <label class="table-label" style="font-weight: 700; color: #1e293b; margin: 0;"><?= lang('order_items'); ?> <span class="text-danger">*</span></label>
                                    <span class="badge" id="quItemsCountBadge" style="background-color: #2563eb; font-size: 11px;">0 artículos</span>
                                </div>
                                <div class="controls table-controls table-responsive">
                                    <table id="quTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
                                        <thead>
                                        <tr>
                                            <th class="col-md-4"><?= lang('product') . ' (' . lang('code') . ' - ' . lang('name') . ')'; ?></th>
                                            <th class="col-md-1"><?= lang('net_unit_price'); ?></th>
                                            <th class="col-md-1"><?= lang('quantity'); ?></th>
                                            <?php
                                            if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) {
                                                echo '<th class="col-md-1">' . $this->lang->line('discount') . '</th>';
                                            }
                                            ?>
                                            <?php
                                            if ($Settings->tax1) {
                                                echo '<th class="col-md-2">' . $this->lang->line('product_tax') . '</th>';
                                            }
                                            ?>
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

                <!-- ================= STEP 3: CONDICIONES COMERCIALES ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">3</span>
                        <h3>Condiciones Comerciales y Logística</h3>
                    </div>

                    <div class="row">
                        <?php if ($Owner || $Admin || $this->session->userdata('allow_discount')) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qudiscount" style="font-weight: 600; color: #334155;"><?= lang('discount'); ?></label>
                                    <?php echo form_input('discount', '', 'class="form-control input-tip" id="qudiscount"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($Settings->tax2) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qutax2" style="font-weight: 600; color: #334155;"><?= lang('order_tax'); ?></label>
                                    <?php
                                    $tr[''] = '';
                                    foreach ($tax_rates as $tax) {
                                        $tr[$tax->id] = $tax->name;
                                    }
                                    echo form_dropdown('order_tax', $tr, (isset($_POST['tax2']) ? $_POST['tax2'] : $Settings->default_tax_rate2), 'id="qutax2" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('order_tax') . '" required="required" class="form-control input-tip select" style="width:100%;"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qushipping" style="font-weight: 600; color: #334155;"><?= lang('shipping'); ?></label>
                                <?php echo form_input('shipping', '', 'class="form-control input-tip" id="qushipping"'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qustatus" style="font-weight: 600; color: #334155;"><?= lang('status'); ?></label>
                                <?php $st = ['pending' => lang('pending'), 'sent' => lang('sent')];
                                echo form_dropdown('status', $st, '', 'class="form-control input-tip select" id="qustatus" style="width:100%;"'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="document" style="font-weight: 600; color: #334155;"><?= lang('document') ?></label>
                                <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= STEP 4: OBSERVACIONES ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">4</span>
                        <h3>Notas y Términos de la Cotización</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="qunote" style="font-weight: 600; color: #334155;"><?= lang('note'); ?></label>
                                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ''), 'class="form-control" id="qunote" style="height: 100px; resize: vertical;" placeholder="Términos de validez, condiciones de pago, tiempo de entrega u observaciones para el cliente..."'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="total_items" value="" id="total_items" required="required"/>

                <!-- ================= STICKY TOTALS BAR ================= -->
                <div id="bottom-total" class="well well-sm">
                    <table class="table table-bordered table-condensed totals" style="margin-bottom:0;">
                        <tr>
                            <td><?= lang('items') ?> <span class="totals_val pull-right" id="titems">0</span></td>
                            <td><?= lang('total') ?> <span class="totals_val pull-right" id="total">0.00</span></td>
                            <?php if ($Owner || $Admin || $this->session->userdata('allow_discount')) { ?>
                                <td><?= lang('order_discount') ?> <span class="totals_val pull-right" id="tds">0.00</span></td>
                            <?php } ?>
                            <?php if ($Settings->tax2) { ?>
                                <td><?= lang('order_tax') ?> <span class="totals_val pull-right" id="ttax2">0.00</span></td>
                            <?php } ?>
                            <td><?= lang('shipping') ?> <span class="totals_val pull-right" id="tship">0.00</span></td>
                            <td><?= lang('grand_total') ?> <span class="totals_val pull-right" id="gtotal">0.00</span></td>
                        </tr>
                    </table>
                </div>

                <!-- Action Submit Buttons -->
                <div style="margin-top: 18px; margin-bottom: 30px; display: flex; gap: 10px;">
                    <button type="submit" name="add_quote" id="add_quote" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; border-radius: 6px;">
                        <i class="fa fa-check"></i> <?= lang('submit'); ?>
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

<!-- Modal Edit Item -->
<div class="modal fade" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=lang('close');?></span></button>
                <h4 class="modal-title" id="prModalLabel" style="font-weight: 700; color: #0f172a;"></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <?php if ($Settings->tax1) { ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?= lang('product_tax') ?></label>
                            <div class="col-sm-8">
                                <?php
                                $tr[''] = '';
                                foreach ($tax_rates as $tax) {
                                    $tr[$tax->id] = $tax->name;
                                }
                                echo form_dropdown('ptax', $tr, '', 'id="ptax" class="form-control pos-input-tip select" style="width:100%;"'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pquantity" class="col-sm-4 control-label"><?= lang('quantity') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="punit" class="col-sm-4 control-label"><?= lang('product_unit') ?></label>
                        <div class="col-sm-8">
                            <div id="punits-div"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="poption" class="col-sm-4 control-label"><?= lang('product_option') ?></label>
                        <div class="col-sm-8">
                            <div id="poptions-div"></div>
                        </div>
                    </div>
                    <?php if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) { ?>
                        <div class="form-group">
                            <label for="pdiscount" class="col-sm-4 control-label"><?= lang('product_discount') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pdiscount">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pprice" class="col-sm-4 control-label"><?= lang('unit_price') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pprice" <?= ($Owner || $Admin || $GP['edit_price']) ? '' : 'readonly'; ?>>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" style="margin-top: 10px;">
                        <tr>
                            <th style="width:25%;"><?= lang('net_unit_price'); ?></th>
                            <th style="width:25%;"><span id="net_price"></span></th>
                            <th style="width:25%;"><?= lang('product_tax'); ?></th>
                            <th style="width:25%;"><span id="pro_tax"></span></th>
                        </tr>
                    </table>
                    <input type="hidden" id="punit_price" value=""/>
                    <input type="hidden" id="old_tax" value=""/>
                    <input type="hidden" id="old_qty" value=""/>
                    <input type="hidden" id="old_price" value=""/>
                    <input type="hidden" id="row_id" value=""/>
                </form>
            </div>
            <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="button" class="btn btn-primary" id="editItem"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Manual Product -->
<div class="modal fade" id="mModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=lang('close');?></span></button>
                <h4 class="modal-title" id="mModalLabel" style="font-weight: 700; color: #0f172a;"><?= lang('add_product_manually') ?></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="mcode" class="col-sm-4 control-label"><?= lang('product_code') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mcode">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mname" class="col-sm-4 control-label"><?= lang('product_name') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mname">
                        </div>
                    </div>
                    <?php if ($Settings->tax1) { ?>
                        <div class="form-group">
                            <label for="mtax" class="col-sm-4 control-label"><?= lang('product_tax') ?> <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <?php
                                $tr[''] = '';
                                foreach ($tax_rates as $tax) {
                                    $tr[$tax->id] = $tax->name;
                                }
                                echo form_dropdown('mtax', $tr, '', 'id="mtax" class="form-control input-tip select" style="width:100%;"'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="mquantity" class="col-sm-4 control-label"><?= lang('quantity') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="munit" class="col-sm-4 control-label"><?= lang('unit') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <?php
                            $uts[''] = '';
                            foreach ($units as $unit) {
                                $uts[$unit->id] = $unit->name;
                            }
                            echo form_dropdown('munit', $uts, '', 'id="munit" class="form-control input-tip select" style="width:100%;"');
                            ?>
                        </div>
                    </div>
                    <?php if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) { ?>
                        <div class="form-group">
                            <label for="mdiscount" class="col-sm-4 control-label"><?= lang('product_discount') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mdiscount">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="mprice" class="col-sm-4 control-label"><?= lang('unit_price') ?> <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mprice">
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" style="margin-top: 10px;">
                        <tr>
                            <th style="width:25%;"><?= lang('net_unit_price'); ?></th>
                            <th style="width:25%;"><span id="mnet_price"></span></th>
                            <th style="width:25%;"><?= lang('product_tax'); ?></th>
                            <th style="width:25%;"><span id="mpro_tax"></span></th>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="button" class="btn btn-primary" id="addItemManually"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>
