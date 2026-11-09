<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    /* Modern Card Sections */
    .quote-card-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .quote-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .quote-card-header .step-badge {
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
    .quote-card-header h3 {
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

    /* Select2 Container Reset: Neutralize outer container double borders */
    .select2-container,
    .select2-container.form-control,
    .select2-container.input-tip,
    .select2-container.select {
        border: none !important;
        padding: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        height: 38px !important;
        display: block !important;
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

    /* Supplier button group styling */
    .supplier-btn-group,
    .customer-btn-group {
        display: table !important;
        width: 100% !important;
        border-collapse: separate !important;
    }
    .supplier-btn-group .select2-container,
    .customer-btn-group .select2-container {
        display: table-cell !important;
        width: 100% !important;
        vertical-align: middle !important;
        float: none !important;
    }
    .supplier-btn-group .select2-container .select2-choice,
    .customer-btn-group .select2-container .select2-choice {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    .supplier-btn-group .input-group-addon,
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
    .supplier-btn-group .input-group-addon a,
    .customer-btn-group .input-group-addon a {
        color: #475569;
        font-size: 14px;
        display: inline-block;
        line-height: 36px;
    }
    .supplier-btn-group .input-group-addon a:hover,
    .customer-btn-group .input-group-addon a:hover {
        color: #2563eb;
    }
    .supplier-btn-group .input-group-addon:last-child,
    .customer-btn-group .input-group-addon:last-child {
        border-top-right-radius: 6px !important;
        border-bottom-right-radius: 6px !important;
    }

    /* Empty state notice */
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

    /* Items Table */
    .table-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    #poTable {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }
    #poTable thead th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 10px;
        border-bottom: 2px solid #e2e8f0;
    }
    #poTable tbody td {
        padding: 10px;
        vertical-align: middle;
        font-size: 13px;
    }

    /* Sticky Totals Bar */
    #sticker,
    #sticker.stick {
        position: static !important;
        top: auto !important;
        left: auto !important;
        right: auto !important;
        width: 100% !important;
        z-index: 1 !important;
    }
    #sticker .well {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 14px;
    }
    #bottom-total,
    #bottom-total.stick {
        position: static !important;
        top: auto !important;
        bottom: auto !important;
        left: auto !important;
        right: auto !important;
        width: 100% !important;
        z-index: 1 !important;
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
    <?php if ($this->session->userdata('remove_pols')) { ?>
    if (localStorage.getItem('poitems')) {
        localStorage.removeItem('poitems');
    }
    if (localStorage.getItem('podiscount')) {
        localStorage.removeItem('podiscount');
    }
    if (localStorage.getItem('potax2')) {
        localStorage.removeItem('potax2');
    }
    if (localStorage.getItem('poshipping')) {
        localStorage.removeItem('poshipping');
    }
    if (localStorage.getItem('poref')) {
        localStorage.removeItem('poref');
    }
    if (localStorage.getItem('powarehouse')) {
        localStorage.removeItem('powarehouse');
    }
    if (localStorage.getItem('ponote')) {
        localStorage.removeItem('ponote');
    }
    if (localStorage.getItem('posupplier')) {
        localStorage.removeItem('posupplier');
    }
    if (localStorage.getItem('pocurrency')) {
        localStorage.removeItem('pocurrency');
    }
    if (localStorage.getItem('poextras')) {
        localStorage.removeItem('poextras');
    }
    if (localStorage.getItem('podate')) {
        localStorage.removeItem('podate');
    }
    if (localStorage.getItem('postatus')) {
        localStorage.removeItem('postatus');
    }
    if (localStorage.getItem('popayment_term')) {
        localStorage.removeItem('popayment_term');
    }
    <?php $this->sma->unset_data('remove_pols'); } ?>

    <?php if ($quote_id) { ?>
    localStorage.setItem('powarehouse', '<?= $quote->warehouse_id ?>');
    localStorage.setItem('ponote', '<?= str_replace(["\r", "\n"], '', $this->sma->decode_html($quote->note)); ?>');
    localStorage.setItem('podiscount', '<?= $quote->order_discount_id ?>');
    localStorage.setItem('potax2', '<?= $quote->order_tax_id ?>');
    localStorage.setItem('poshipping', '<?= $quote->shipping ?>');
    <?php if ($quote->supplier_id) { ?>
        localStorage.setItem('posupplier', '<?= $quote->supplier_id ?>');
    <?php } ?>
    localStorage.setItem('poitems', JSON.stringify(<?= $quote_items; ?>));
    <?php } ?>

    var count = 1, an = 1, po_edit = false, product_variant = 0, DT = <?= $Settings->default_tax_rate ?>, DC = '<?= $default_currency->code ?>', shipping = 0,
        product_tax = 0, invoice_tax = 0, total_discount = 0, total = 0,
        tax_rates = <?php echo json_encode($tax_rates); ?>, poitems = {},
        audio_success = new Audio('<?= $assets ?>sounds/sound2.mp3'),
        audio_error = new Audio('<?= $assets ?>sounds/sound3.mp3');

    function checkPoEmptyNotice() {
        if ($('#poTable tbody tr').length === 0 || $('#poTable tbody tr td.dataTables_empty').length > 0) {
            $('#poTableEmptyNotice').show();
            $('#poTableGroup').hide();
        } else {
            $('#poTableEmptyNotice').hide();
            $('#poTableGroup').show();
        }
    }

    $(document).ready(function () {
        <?php if ($this->input->get('supplier')) { ?>
        if (!localStorage.getItem('poitems')) {
            localStorage.setItem('posupplier', <?=$this->input->get('supplier'); ?>);
        }
        <?php } ?>

        <?php if ($Owner || $Admin) { ?>
        if (!localStorage.getItem('podate')) {
            $("#podate").datetimepicker({
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
        $(document).on('change', '#podate', function (e) {
            localStorage.setItem('podate', $(this).val());
        });
        if (podate = localStorage.getItem('podate')) {
            $('#podate').val(podate);
        }
        <?php } ?>

        if (!localStorage.getItem('potax2')) {
            localStorage.setItem('potax2', <?=$Settings->default_tax_rate2;?>);
        }
        ItemnTotals();
        checkPoEmptyNotice();

        $("#add_item").autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'get',
                    url: '<?= admin_url('purchases/suggestions'); ?>',
                    dataType: "json",
                    data: {
                        term: request.term,
                        supplier_id: $("#posupplier").val()
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
                    var row = add_purchase_item(ui.item);
                    if (row) {
                        $(this).val('');
                        checkPoEmptyNotice();
                    }
                } else {
                    bootbox.alert('<?= lang('no_match_found') ?>');
                }
            }
        });

        $(document).on('click', '#addItemManually', function (e) {
            if (!$('#mcode').val()) {
                $('#mError').text('<?= lang('product_code_is_required') ?>');
                $('#mError-con').show();
                return false;
            }
            if (!$('#mname').val()) {
                $('#mError').text('<?= lang('product_name_is_required') ?>');
                $('#mError-con').show();
                return false;
            }
            if (!$('#mcategory').val()) {
                $('#mError').text('<?= lang('product_category_is_required') ?>');
                $('#mError-con').show();
                return false;
            }
            if (!$('#munit').val()) {
                $('#mError').text('<?= lang('product_unit_is_required') ?>');
                $('#mError-con').show();
                return false;
            }
            if (!$('#mcost').val()) {
                $('#mError').text('<?= lang('product_cost_is_required') ?>');
                $('#mError-con').show();
                return false;
            }
            if (!$('#mprice').val()) {
                $('#mError').text('<?= lang('product_price_is_required') ?>');
                $('#mError-con').show();
                return false;
            }

            var msg, row = null, product = {
                type: 'standard',
                code: $('#mcode').val(),
                name: $('#mname').val(),
                tax_rate: $('#mtax').val(),
                tax_method: $('#mtax_method').val(),
                category_id: $('#mcategory').val(),
                unit: $('#munit').val(),
                cost: $('#mcost').val(),
                price: $('#mprice').val()
            };

            $.ajax({
                type: "get", async: false,
                url: site.base_url + "products/addByAjax",
                data: {token: "<?= $csrf; ?>", product: product},
                dataType: "json",
                success: function (data) {
                    if (data.msg == 'success') {
                        row = add_purchase_item(data.result);
                    } else {
                        msg = data.msg;
                    }
                }
            });
            if (row) {
                $('#mModal').modal('hide');
                checkPoEmptyNotice();
            } else {
                $('#mError').text(msg);
                $('#mError-con').show();
            }
            return false;
        });

        // Watch for changes in table rows to toggle empty state
        $(document).on('click', '.podel', function () {
            setTimeout(checkPoEmptyNotice, 150);
        });
    });
</script>

<div class="box">
    <div class="box-content" style="padding: 15px;">
        <div class="row">
            <div class="col-lg-12">

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('purchases/add', $attrib);
                ?>

                <!-- ================= STEP 1: DATOS PRINCIPALES DE LA COMPRA ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">1</span>
                        <h3>Datos Principales de la Orden de Compra</h3>
                    </div>

                    <div class="row">
                        <?php if ($Owner || $Admin) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="podate"><?= lang('date'); ?></label>
                                    <?php echo form_input('date', ($_POST['date'] ?? ''), 'class="form-control input-tip datetime" id="podate" required="required"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="poref"><?= lang('reference_no'); ?></label>
                                <?php echo form_input('reference_no', ($_POST['reference_no'] ?? $ponumber), 'class="form-control input-tip" id="poref"'); ?>
                            </div>
                        </div>

                        <?php if ($Owner || $Admin || !$this->session->userdata('warehouse_id')) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="powarehouse"><?= lang('warehouse'); ?></label>
                                    <?php
                                    $wh[''] = '';
                                    foreach ($warehouses as $warehouse) {
                                        $wh[$warehouse->id] = $warehouse->name;
                                    }
                                    echo form_dropdown('warehouse', $wh, ($_POST['warehouse'] ?? $Settings->default_warehouse), 'id="powarehouse" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('warehouse') . '" required="required" style="width:100%;" '); ?>
                                </div>
                            </div>
                        <?php } else {
                            $warehouse_input = [
                                'type'  => 'hidden',
                                'name'  => 'warehouse',
                                'id'    => 'slwarehouse',
                                'value' => $this->session->userdata('warehouse_id'),
                            ];
                            echo form_input($warehouse_input);
                        } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="postatus"><?= lang('status'); ?></label>
                                <?php
                                $post = ['received' => lang('received'), 'pending' => lang('pending'), 'ordered' => lang('ordered')];
                                echo form_dropdown('status', $post, ($_POST['status'] ?? ''), 'id="postatus" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('status') . '" required="required" style="width:100%;" ');
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="document"><?= lang('attach_document') ?></label>
                                <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>

                        <!-- Proveedor Selector with Addons -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="posupplier"><?= lang('supplier'); ?></label>
                                <div class="input-group supplier-btn-group customer-btn-group">
                                    <input type="hidden" name="supplier" value="" id="posupplier" class="form-control" style="width:100%;" placeholder="<?= lang('select') . ' ' . lang('supplier') ?>" required="required">
                                    <input type="hidden" name="supplier_id" value="" id="supplier_id" class="form-control">

                                    <div class="input-group-addon no-print" style="padding: 2px 8px; border-left: 0;">
                                        <a href="#" id="removeReadonly" title="Desbloquear proveedor">
                                            <i class="fa fa-unlock" id="removeReadonly"></i>
                                        </a>
                                    </div>
                                    <?php if ($Owner || $Admin || $GP['suppliers-index']) { ?>
                                        <div class="input-group-addon no-print" style="padding: 2px 7px; border-left: 0;">
                                            <a href="#" id="view-supplier" class="external" data-toggle="modal" data-target="#myModal" title="Ver detalles del proveedor">
                                                <i class="fa fa-eye" id="addIcon"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($Owner || $Admin || $GP['suppliers-add']) { ?>
                                        <div class="input-group-addon no-print" style="padding: 2px 8px;">
                                            <a href="<?= admin_url('suppliers/add'); ?>" id="add-supplier" class="external" data-toggle="modal" data-target="#myModal" title="Nuevo proveedor">
                                                <i class="fa fa-plus-circle text-primary" id="addIcon"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
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
                                                <a href="<?= admin_url('products/add') ?>" id="addManually1" title="<?= lang('add_product_manually') ?>">
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
                            <div id="poTableEmptyNotice" class="quote-empty-state">
                                <div class="empty-icon-wrap">
                                    <i class="fa fa-shopping-bag"></i>
                                </div>
                                <h4>La orden de compra está vacía</h4>
                                <p>Escanee un producto o use el buscador superior para agregar artículos a la orden de compra.</p>
                            </div>

                            <!-- Table Group -->
                            <div class="control-group table-group" id="poTableGroup" style="display: none;">
                                <div class="table-label-row">
                                    <label class="modern-label" style="margin: 0;"><?= lang('order_items'); ?></label>
                                </div>
                                <div class="controls table-controls table-responsive">
                                    <table id="poTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
                                        <thead>
                                        <tr>
                                            <th class="col-md-4"><?= lang('product') . ' (' . lang('code') . ' - ' . lang('name') . ')'; ?></th>
                                            <?php if ($Settings->product_expiry) { ?>
                                                <th class="col-md-2"><?= $this->lang->line('expiry_date'); ?></th>
                                            <?php } ?>
                                            <th class="col-md-1"><?= lang('net_unit_cost'); ?></th>
                                            <th class="col-md-1"><?= lang('quantity'); ?></th>
                                            <?php if ($Settings->product_discount) { ?>
                                                <th class="col-md-1"><?= $this->lang->line('discount'); ?></th>
                                            <?php } ?>
                                            <?php if ($Settings->tax1) { ?>
                                                <th class="col-md-1"><?= $this->lang->line('product_tax'); ?></th>
                                            <?php } ?>
                                            <th><?= lang('subtotal'); ?> (<span class="currency"><?= $default_currency->code ?></span>)</th>
                                            <th style="width: 30px !important; text-align: center;"><i class="fa fa-trash-o" style="opacity:0.5;"></i></th>
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

                <!-- ================= STEP 3: CONDICIONES COMERCIALES Y LOGÍSTICA ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">3</span>
                        <h3>Condiciones Comerciales y Logística</h3>
                    </div>

                    <div class="row">
                        <?php if ($Settings->tax2) { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="modern-label" for="potax2"><?= lang('order_tax') ?></label>
                                    <?php
                                    $tr[''] = '';
                                    foreach ($tax_rates as $tax) {
                                        $tr[$tax->id] = $tax->name;
                                    }
                                    echo form_dropdown('order_tax', $tr, '', 'id="potax2" class="form-control input-tip select" style="width:100%;"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="modern-label" for="podiscount"><?= lang('discount_label'); ?></label>
                                <?php echo form_input('discount', '', 'class="form-control input-tip" id="podiscount"'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="modern-label" for="poshipping"><?= lang('shipping'); ?></label>
                                <?php echo form_input('shipping', '', 'class="form-control input-tip" id="poshipping"'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="modern-label" for="popayment_term"><?= lang('payment_term'); ?></label>
                                <?php echo form_input('payment_term', '', 'class="form-control tip" data-trigger="focus" data-placement="top" title="' . lang('payment_term_tip') . '" id="popayment_term"'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= STEP 4: OBSERVACIONES Y NOTAS ================= -->
                <div class="quote-card-section">
                    <div class="quote-card-header">
                        <span class="step-badge">4</span>
                        <h3>Notas y Observaciones de la Compra</h3>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="modern-label" for="ponote"><?= lang('note'); ?></label>
                                <?php echo form_textarea('note', ($_POST['note'] ?? ''), 'class="form-control" id="ponote" style="height: 100px; resize: vertical;" placeholder="Observaciones de la orden de compra, condiciones de recepción, notas para el proveedor..."'); ?>
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
                            <td><?= lang('order_discount') ?> <span class="totals_val pull-right" id="tds">0.00</span></td>
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
                    <button type="submit" name="add_pruchase" id="add_pruchase" class="btn btn-primary" style="padding: 10px 24px; font-weight: 700; border-radius: 6px;">
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

<!-- Modal Edit Purchase Item -->
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
                    <?php if ($Settings->product_expiry) { ?>
                        <div class="form-group">
                            <label for="pexpiry" class="col-sm-4 control-label"><?= lang('product_expiry') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control date" id="pexpiry">
                            </div>
                        </div>
                    <?php } ?>
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
                    <?php if ($Settings->product_discount) { ?>
                        <div class="form-group">
                            <label for="pdiscount" class="col-sm-4 control-label"><?= lang('product_discount') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pdiscount">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pcost" class="col-sm-4 control-label"><?= lang('unit_cost') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pcost">
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width:25%;"><?= lang('net_unit_cost'); ?></th>
                            <th style="width:25%;"><span id="net_cost"></span></th>
                            <th style="width:25%;"><?= lang('product_tax'); ?></th>
                            <th style="width:25%;"><span id="pro_tax"></span></th>
                        </tr>
                    </table>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?= lang('calculate_unit_cost'); ?></div>
                        <div class="panel-body">
                            <div class="form-group" style="margin-bottom:0;">
                                <label for="psubtotal" class="col-sm-4 control-label"><?= lang('subtotal') ?></label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="psubtotal">
                                        <div class="input-group-addon" style="padding: 2px 8px;">
                                            <a href="#" id="calculate_unit_price" class="tip" title="<?= lang('calculate_unit_cost'); ?>">
                                                <i class="fa fa-calculator"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="punit_cost" value=""/>
                    <input type="hidden" id="old_tax" value=""/>
                    <input type="hidden" id="old_qty" value=""/>
                    <input type="hidden" id="old_cost" value=""/>
                    <input type="hidden" id="row_id" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editItem"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Standard Product Manually -->
<div class="modal fade" id="mModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
            <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=lang('close');?></span></button>
                <h4 class="modal-title" id="mModalLabel" style="font-weight: 700; color: #0f172a;"><?= lang('add_standard_product') ?></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <div class="alert alert-danger" id="mError-con" style="display: none;">
                    <span id="mError"></span>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="modern-label" for="mcode"><?= lang('product_code', 'mcode') ?></label>
                            <input type="text" class="form-control" id="mcode">
                        </div>
                        <div class="form-group">
                            <label class="modern-label" for="mname"><?= lang('product_name', 'mname') ?></label>
                            <input type="text" class="form-control" id="mname">
                        </div>
                        <div class="form-group">
                            <label class="modern-label" for="mcategory"><?= lang('category', 'mcategory') ?></label>
                            <?php
                            $cat[''] = '';
                            foreach ($categories as $category) {
                                $cat[$category->id] = $category->name;
                            }
                            echo form_dropdown('category', $cat, '', 'class="form-control select" id="mcategory" placeholder="' . lang('select') . ' ' . lang('category') . '" style="width:100%"')
                            ?>
                        </div>
                        <div class="form-group">
                            <label class="modern-label" for="munit"><?= lang('unit', 'munit') ?></label>
                            <input type="text" class="form-control" id="munit">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="modern-label" for="mcost"><?= lang('cost', 'mcost') ?></label>
                            <input type="text" class="form-control" id="mcost">
                        </div>
                        <div class="form-group">
                            <label class="modern-label" for="mprice"><?= lang('price', 'mprice') ?></label>
                            <input type="text" class="form-control" id="mprice">
                        </div>

                        <?php if ($Settings->tax1) { ?>
                            <div class="form-group">
                                <label class="modern-label" for="mtax"><?= lang('product_tax', 'mtax') ?></label>
                                <?php
                                $tr[''] = '';
                                foreach ($tax_rates as $tax) {
                                    $tr[$tax->id] = $tax->name;
                                }
                                echo form_dropdown('mtax', $tr, '', 'id="mtax" class="form-control input-tip select" style="width:100%;"'); ?>
                            </div>
                            <div class="form-group all">
                                <label class="modern-label" for="mtax_method"><?= lang('tax_method', 'mtax_method') ?></label>
                                <?php
                                $tm = ['0' => lang('inclusive'), '1' => lang('exclusive')];
                                echo form_dropdown('tax_method', $tm, '', 'class="form-control select" id="mtax_method" placeholder="' . lang('select') . ' ' . lang('tax_method') . '" style="width:100%"')
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addItemManually"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>