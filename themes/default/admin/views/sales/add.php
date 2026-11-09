<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script type="text/javascript">
    var count = 1, an = 1, product_variant = 0, DT = <?= $Settings->default_tax_rate ?>,
        product_tax = 0, invoice_tax = 0, product_discount = 0, order_discount = 0, total_discount = 0, total = 0, allow_discount = <?= ($Owner || $Admin || $this->session->userdata('allow_discount')) ? 1 : 0; ?>,
        tax_rates = <?php echo json_encode($tax_rates); ?>;
    //var audio_success = new Audio('<?=$assets?>sounds/sound2.mp3');
    //var audio_error = new Audio('<?=$assets?>sounds/sound3.mp3');
    $(document).ready(function () {
        if (localStorage.getItem('remove_slls')) {
            if (localStorage.getItem('slitems')) {
                localStorage.removeItem('slitems');
            }
            if (localStorage.getItem('sldiscount')) {
                localStorage.removeItem('sldiscount');
            }
            if (localStorage.getItem('sltax2')) {
                localStorage.removeItem('sltax2');
            }
            if (localStorage.getItem('slref')) {
                localStorage.removeItem('slref');
            }
            if (localStorage.getItem('slshipping')) {
                localStorage.removeItem('slshipping');
            }
            if (localStorage.getItem('slwarehouse')) {
                localStorage.removeItem('slwarehouse');
            }
            if (localStorage.getItem('slnote')) {
                localStorage.removeItem('slnote');
            }
            if (localStorage.getItem('slinnote')) {
                localStorage.removeItem('slinnote');
            }
            if (localStorage.getItem('slcustomer')) {
                localStorage.removeItem('slcustomer');
            }
            if (localStorage.getItem('slbiller')) {
                localStorage.removeItem('slbiller');
            }
            if (localStorage.getItem('slcurrency')) {
                localStorage.removeItem('slcurrency');
            }
            if (localStorage.getItem('sldate')) {
                localStorage.removeItem('sldate');
            }
            if (localStorage.getItem('slsale_status')) {
                localStorage.removeItem('slsale_status');
            }
            if (localStorage.getItem('slpayment_status')) {
                localStorage.removeItem('slpayment_status');
            }
            if (localStorage.getItem('paid_by')) {
                localStorage.removeItem('paid_by');
            }
            if (localStorage.getItem('amount_1')) {
                localStorage.removeItem('amount_1');
            }
            if (localStorage.getItem('paid_by_1')) {
                localStorage.removeItem('paid_by_1');
            }
            if (localStorage.getItem('pcc_holder_1')) {
                localStorage.removeItem('pcc_holder_1');
            }
            if (localStorage.getItem('pcc_type_1')) {
                localStorage.removeItem('pcc_type_1');
            }
            if (localStorage.getItem('pcc_month_1')) {
                localStorage.removeItem('pcc_month_1');
            }
            if (localStorage.getItem('pcc_year_1')) {
                localStorage.removeItem('pcc_year_1');
            }
            if (localStorage.getItem('pcc_no_1')) {
                localStorage.removeItem('pcc_no_1');
            }
            if (localStorage.getItem('cheque_no_1')) {
                localStorage.removeItem('cheque_no_1');
            }
            if (localStorage.getItem('payment_note_1')) {
                localStorage.removeItem('payment_note_1');
            }
            if (localStorage.getItem('slpayment_term')) {
                localStorage.removeItem('slpayment_term');
            }
            localStorage.removeItem('remove_slls');
        }
        <?php if ($quote_id) {
    ?>
        // localStorage.setItem('sldate', '<?= $this->sma->hrld($quote->date) ?>');
        localStorage.setItem('slcustomer', '<?= $quote->customer_id ?>');
        localStorage.setItem('slbiller', '<?= $quote->biller_id ?>');
        localStorage.setItem('slwarehouse', '<?= $quote->warehouse_id ?>');
        localStorage.setItem('slnote', '<?= str_replace(["\r", "\n"], '', $this->sma->decode_html($quote->note)); ?>');
        localStorage.setItem('sldiscount', '<?= $quote->order_discount_id ?>');
        localStorage.setItem('sltax2', '<?= $quote->order_tax_id ?>');
        localStorage.setItem('slshipping', '<?= $quote->shipping ?>');
        localStorage.setItem('slitems', JSON.stringify(<?= $quote_items; ?>));
        <?php
} ?>
        <?php if ($this->input->get('customer')) {
        ?>
        if (!localStorage.getItem('slitems')) {
            localStorage.setItem('slcustomer', <?=$this->input->get('customer'); ?>);
        }
        <?php
    } ?>
        <?php if ($Owner || $Admin) {
        ?>
        if (!localStorage.getItem('sldate')) {
            $("#sldate").datetimepicker({
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
        $(document).on('change', '#sldate', function (e) {
            localStorage.setItem('sldate', $(this).val());
        });
        if (sldate = localStorage.getItem('sldate')) {
            $('#sldate').val(sldate);
        }
        <?php
    } ?>
        $(document).on('change', '#slbiller', function (e) {
            localStorage.setItem('slbiller', $(this).val());
        });
        if (slbiller = localStorage.getItem('slbiller')) {
            $('#slbiller').val(slbiller);
        }
        if (!localStorage.getItem('slref')) {
            localStorage.setItem('slref', '<?=$slnumber?>');
        }
        if (!localStorage.getItem('sltax2')) {
            localStorage.setItem('sltax2', <?=$Settings->default_tax_rate2;?>);
        }
        ItemnTotals();
        $('.bootbox').on('hidden.bs.modal', function (e) {
            $('#add_item').focus();
        });
        $("#add_item").autocomplete({
            source: function (request, response) {
                if (!$('#slcustomer').val()) {
                    $('#add_item').val('').removeClass('ui-autocomplete-loading');
                    bootbox.alert('<?=lang('select_above');?>');
                    $('#add_item').focus();
                    return false;
                }
                $.ajax({
                    type: 'get',
                    url: '<?= admin_url('sales/suggestions'); ?>',
                    dataType: "json",
                    data: {
                        term: request.term,
                        warehouse_id: $("#slwarehouse").val(),
                        customer_id: $("#slcustomer").val()
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
        $(document).on('change', '#gift_card_no', function () {
            var cn = $(this).val() ? $(this).val() : '';
            if (cn != '') {
                $.ajax({
                    type: "get", async: false,
                    url: site.base_url + "sales/validate_gift_card/" + cn,
                    dataType: "json",
                    success: function (data) {
                        if (data === false) {
                            $('#gift_card_no').parent('.form-group').addClass('has-error');
                            bootbox.alert('<?=lang('incorrect_gift_card')?>');
                        } else if (data.customer_id !== null && data.customer_id !== $('#slcustomer').val()) {
                            $('#gift_card_no').parent('.form-group').addClass('has-error');
                            bootbox.alert('<?=lang('gift_card_not_for_customer')?>');

                        } else {
                            $('#gc_details').html('<small>Card No: ' + data.card_no + '<br>Value: ' + data.value + ' - Balance: ' + data.balance + '</small>');
                            $('#gift_card_no').parent('.form-group').removeClass('has-error');
                        }
                    }
                });
            }
        });
    });
</script>


<style type="text/css">
    /* Modern UI/UX Styles for Sales Creation */
    .sales-form-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .modern-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        margin-bottom: 22px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .modern-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07);
    }
    .modern-card-header {
        padding: 14px 20px;
        background: #fafbfd;
        border-bottom: 1px solid #f1f5f9;
        border-top-left-radius: 11px;
        border-top-right-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modern-card-header h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
    }
    .modern-card-header h3 i {
        margin-right: 10px;
        width: 28px;
        height: 28px;
        line-height: 28px;
        text-align: center;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 6px;
        font-size: 14px;
    }
    .modern-card-body {
        padding: 20px;
    }
    .modern-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        display: block;
    }
    .modern-input {
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: none !important;
        height: 38px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .modern-input:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
    }
    .header-action-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    .header-title-box h1 {
        margin: 0 0 4px 0;
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
    }
    .header-title-box p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    
    /* Product Scanner Bar */
    .scanner-search-box {
        background: #ffffff;
        border: 2px solid #3b82f4;
        border-radius: 10px;
        padding: 6px 14px;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        gap: 12px;
    }
    .scanner-search-box i.barcode-icon {
        font-size: 24px;
        color: #3b82f4;
        margin-right: 2px;
    }
    .scanner-search-box input#add_item {
        border: none !important;
        box-shadow: none !important;
        font-size: 14.5px;
        height: 40px;
        width: 100%;
        outline: none;
        background: transparent;
    }
    .scanner-shortcut-badge {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .action-pill-btn {
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        border-color: #cbd5e1 !important;
        background: #ffffff !important;
        transition: all 0.15s ease !important;
    }
    .action-pill-btn:hover {
        background: #f8fafc !important;
        border-color: #94a3b8 !important;
    }

    /* Select2 Reset for Sales Add: Remove outer container double border */
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

    /* Customer input group styling */
    .customer-input-group {
        display: table !important;
        width: 100% !important;
        border-collapse: separate !important;
    }
    .customer-input-group .select2-container {
        display: table-cell !important;
        width: 100% !important;
        vertical-align: middle !important;
        float: none !important;
    }
    .customer-input-group .select2-container .select2-choice {
        height: 38px !important;
        line-height: 36px !important;
        border-radius: 6px 0 0 6px !important;
        border-color: #cbd5e1 !important;
    }
    .customer-btn-addon {
        display: table-cell !important;
        background: #f8fafc !important;
        border: 1px solid #cbd5e1 !important;
        border-left: 0 !important;
        padding: 0 11px !important;
        height: 38px !important;
        line-height: 36px !important;
        vertical-align: middle !important;
    }
    .customer-btn-addon a {
        color: #475569;
        font-size: 14px;
        display: inline-block;
        padding: 6px 2px;
        transition: color 0.15s ease;
    }
    .customer-btn-addon a:hover {
        color: #2563eb;
    }
    .customer-btn-addon:last-child {
        border-top-right-radius: 6px !important;
        border-bottom-right-radius: 6px !important;
    }

    /* Items Table */
    .table-label-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
    }
    #slTable {
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }
    #slTable thead th {
        background: #f8fafc;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 10px;
        border-bottom: 2px solid #e2e8f0;
    }
    #slTable tbody td {
        padding: 10px;
        vertical-align: middle;
        font-size: 13px;
    }

    /* Empty state notice */
    .sales-empty-state {
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 36px 20px;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 10px;
        transition: all 0.2s ease;
    }
    .sales-empty-state:hover {
        border-color: #94a3b8;
        background: #f1f5f9;
    }
    .empty-icon-wrap {
        width: 56px;
        height: 56px;
        line-height: 56px;
        background: #eff6ff;
        color: #2563eb;
        border-radius: 50%;
        margin: 0 auto 12px auto;
        font-size: 24px;
    }
    .sales-empty-state h4 {
        margin: 0 0 6px 0;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
    }
    .sales-empty-state p {
        margin: 0;
        font-size: 12.5px;
        color: #64748b;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Modern Bottom Totals Bar */
    #sticker { box-sizing: border-box !important; max-width: 100% !important; }
    #sticker.stick { position: fixed !important; background: #ffffff !important; padding: 8px 16px !important; border-bottom: 2px solid #3b82f4 !important; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1) !important; box-sizing: border-box !important; max-width: 100% !important; }
    .modern-totals-bar, #bottom-total {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .totals-metrics-group {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
    }
    .total-metric-item {
        display: flex;
        flex-direction: column;
    }
    .total-metric-label {
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
    }
    .total-metric-val {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }
    .total-metric-val.grand {
        font-size: 24px;
        font-weight: 800;
        color: #2563eb;
    }
</style>

<div class="sales-form-container">
    <div class="header-action-bar">
        <div class="header-title-box">
            <h1><i class="fa fa-shopping-cart text-primary"></i> <?= lang('add_sale'); ?></h1>
            <p><?= lang('enter_info'); ?> &bull; Registrar factura o nota de venta comercial</p>
        </div>
        <div class="header-buttons">
            <a href="<?= admin_url('pos'); ?>" class="btn btn-warning" style="border-radius: 6px; margin-right: 8px;">
                <i class="fa fa-th"></i> Abrir Modo POS
            </a>
            <a href="<?= admin_url('sales'); ?>" class="btn btn-default" style="border-radius: 6px;">
                <i class="fa fa-arrow-left"></i> Volver a Lista de Ventas
            </a>
        </div>
    </div>

    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo admin_form_open_multipart('sales/add', $attrib);
    if ($quote_id) {
        echo form_hidden('quote_id', $quote_id);
    }
    ?>

    <!-- 1. DATOS PRINCIPALES DE LA FACTURA -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3><i class="fa fa-file-text-o"></i> 1. Datos Principales de la Factura</h3>
        </div>
        <div class="modern-card-body">
            <div class="row">
                <?php if ($Owner || $Admin) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="sldate"><?= lang('date'); ?></label>
                            <?php echo form_input('date', ($_POST['date'] ?? ''), 'class="form-control modern-input input-tip datetime" id="sldate" required="required"'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="modern-label" for="slref"><?= lang('reference_no'); ?></label>
                        <?php echo form_input('reference_no', ($_POST['reference_no'] ?? $slnumber), 'class="form-control modern-input input-tip" id="slref"'); ?>
                    </div>
                </div>

                <?php if ($Owner || $Admin || !$this->session->userdata('biller_id')) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="slbiller"><?= lang('biller'); ?></label>
                            <?php
                            $bl[''] = '';
                            foreach ($billers as $biller) {
                                $bl[$biller->id] = $biller->company && $biller->company != '-' ? $biller->company : $biller->name;
                            }
                            echo form_dropdown('biller', $bl, ($_POST['biller'] ?? $Settings->default_biller), 'id="slbiller" data-placeholder="' . lang('select') . ' ' . lang('biller') . '" required="required" class="form-control input-tip select" style="width:100%;"'); ?>
                        </div>
                    </div>
                <?php } else {
                    $biller_input = [
                        'type'  => 'hidden',
                        'name'  => 'biller',
                        'id'    => 'slbiller',
                        'value' => $this->session->userdata('biller_id'),
                    ];
                    echo form_input($biller_input);
                } ?>
            </div>

            <div class="row" style="margin-top: 10px; padding-top: 14px; border-top: 1px dashed #e2e8f0;">
                <?php if ($Owner || $Admin || !$this->session->userdata('warehouse_id')) { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="modern-label" for="slwarehouse"><?= lang('warehouse'); ?></label>
                            <?php
                            $wh[''] = '';
                            foreach ($warehouses as $warehouse) {
                                $wh[$warehouse->id] = $warehouse->name;
                            }
                            echo form_dropdown('warehouse', $wh, ($_POST['warehouse'] ?? $Settings->default_warehouse), 'id="slwarehouse" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('warehouse') . '" required="required" style="width:100%;" '); ?>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="modern-label" for="slcustomer"><?= lang('customer'); ?></label>
                        <div class="input-group customer-input-group">
                            <?php echo form_input('customer', ($_POST['customer'] ?? ''), 'id="slcustomer" data-placeholder="' . lang('select') . ' ' . lang('customer') . '" required="required" class="form-control input-tip" style="width:100%;"'); ?>
                            <span class="input-group-addon customer-btn-addon no-print">
                                <a href="#" id="toogle-customer-read-attr" class="external" title="Desbloquear / Editar Nombre"><i class="fa fa-pencil"></i></a>
                            </span>
                            <span class="input-group-addon customer-btn-addon no-print">
                                <a href="#" id="view-customer" class="external" data-toggle="modal" data-target="#myModal" title="Ver Detalle del Cliente"><i class="fa fa-eye"></i></a>
                            </span>
                            <?php if ($Owner || $Admin || $GP['customers-add']) { ?>
                                <span class="input-group-addon customer-btn-addon no-print">
                                    <a href="<?= admin_url('customers/add'); ?>" id="add-customer" class="external" data-toggle="modal" data-target="#myModal" title="Crear Nuevo Cliente"><i class="fa fa-plus-circle text-primary"></i></a>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. BÚSQUEDA Y SELECCIÓN DE PRODUCTOS -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3><i class="fa fa-barcode"></i> 2. Búsqueda y Selección de Productos</h3>
            <div style="display: flex; gap: 8px;">
                <?php if ($Owner || $Admin || $GP['products-add']) { ?>
                    <a href="#" id="addManually" class="btn btn-default btn-sm action-pill-btn" title="<?= lang('add_product_manually') ?>">
                        <i class="fa fa-plus-circle text-primary"></i> <?= lang('add_product_manually') ?>
                    </a>
                <?php } ?>
                <?php if ($Owner || $Admin || $GP['sales-add_gift_card']) { ?>
                    <a href="#" id="sellGiftCard" class="btn btn-default btn-sm action-pill-btn" title="<?= lang('sell_gift_card') ?>">
                        <i class="fa fa-credit-card text-success"></i> <?= lang('sell_gift_card') ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="modern-card-body">
            <div id="sticker">
                <div class="scanner-search-box">
                    <i class="fa fa-barcode barcode-icon"></i>
                    <?php echo form_input('add_item', '', 'class="form-control" id="add_item" placeholder="' . lang('add_product_to_order') . '"'); ?>
                    <span class="scanner-shortcut-badge"><i class="fa fa-keyboard-o"></i> Teclado o Pistola</span>
                </div>
            </div>

            <!-- Empty State Notice (shown when slTable is empty) -->
            <div id="slTableEmptyNotice" class="sales-empty-state">
                <div class="empty-icon-wrap">
                    <i class="fa fa-shopping-basket"></i>
                </div>
                <h4>La orden de venta está vacía</h4>
                <p>Escanee un producto con la pistola lectora o escriba su nombre/código en el buscador superior para añadirlo a la factura.</p>
            </div>

            <!-- TABLA DE ARTÍCULOS PEDIDOS -->
            <div class="control-group table-group" id="slTableGroup" style="display: none;">
                <div class="table-label-row">
                    <label class="table-label" style="font-weight: 700; color: #1e293b; margin: 0;"><?= lang('order_items'); ?> <span class="text-danger">*</span></label>
                    <span class="badge" id="itemsCountBadge" style="background-color: #2563eb; font-size: 11px;">0 artículos</span>
                </div>
                <div class="table-responsive" style="margin-top: 8px;">
                    <table id="slTable" class="table items table-striped table-bordered table-condensed table-hover sortable_table">
                        <thead>
                            <tr>
                                <th class="col-md-4"><?= lang('product') . ' (' . lang('code') . ' - ' . lang('name') . ')'; ?></th>
                                <?php if ($Settings->product_serial) {
                                    echo '<th class="col-md-2">' . lang('serial_no') . '</th>';
                                } ?>
                                <th class="col-md-1" style="text-align: right;"><?= lang('net_unit_price'); ?></th>
                                <th class="col-md-1" style="text-align: center;"><?= lang('quantity'); ?></th>
                                <?php if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) {
                                    echo '<th class="col-md-1" style="text-align: right;">' . lang('discount') . '</th>';
                                } ?>
                                <?php if ($Settings->tax1) {
                                    echo '<th class="col-md-1" style="text-align: right;">' . lang('product_tax') . '</th>';
                                } ?>
                                <th style="text-align: right;">
                                    <?= lang('subtotal'); ?> (<span class="currency"><?= $default_currency->code ?></span>)
                                </th>
                                <th style="width: 30px !important; text-align: center;">
                                    <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. CONDICIONES COMERCIALES, IMPUESTOS Y ESTADOS -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3><i class="fa fa-sliders"></i> 3. Condiciones Comerciales y Logística</h3>
        </div>
        <div class="modern-card-body">
            <div class="row">
                <?php if ($Settings->tax2) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="sltax2"><?= lang('order_tax'); ?></label>
                            <?php
                            $tr[''] = '';
                            foreach ($tax_rates as $tax) {
                                $tr[$tax->id] = $tax->name;
                            }
                            echo form_dropdown('order_tax', $tr, ($_POST['order_tax'] ?? $Settings->default_tax_rate2), 'id="sltax2" data-placeholder="' . lang('select') . ' ' . lang('order_tax') . '" class="form-control input-tip select" style="width:100%;"'); ?>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($Owner || $Admin || $this->session->userdata('allow_discount')) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="sldiscount"><?= lang('order_discount'); ?></label>
                            <?php echo form_input('order_discount', '', 'class="form-control modern-input input-tip" id="sldiscount" placeholder="0"'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="modern-label" for="slshipping"><?= lang('shipping'); ?></label>
                        <?php echo form_input('shipping', '', 'class="form-control modern-input input-tip" id="slshipping" placeholder="0.00"'); ?>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="modern-label" for="slsale_status"><?= lang('sale_status'); ?></label>
                        <?php $sst = ['completed' => lang('completed'), 'pending' => lang('pending')];
                        echo form_dropdown('sale_status', $sst, '', 'class="form-control modern-input input-tip" required="required" id="slsale_status"'); ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="modern-label" for="slpayment_term"><?= lang('payment_term'); ?></label>
                        <?php echo form_input('payment_term', '', 'class="form-control modern-input tip" placeholder="Días de crédito" title="' . lang('payment_term_tip') . '" id="slpayment_term"'); ?>
                    </div>
                </div>

                <?php if ($Owner || $Admin || $GP['sales-payments']) { ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="modern-label" for="slpayment_status"><?= lang('payment_status'); ?></label>
                            <?php $pst = ['pending' => lang('pending'), 'due' => lang('due'), 'partial' => lang('partial'), 'paid' => lang('paid')];
                            echo form_dropdown('payment_status', $pst, '', 'class="form-control modern-input input-tip" required="required" id="slpayment_status"'); ?>
                        </div>
                    </div>
                <?php } else {
                    echo form_hidden('payment_status', 'pending');
                } ?>
            </div>

            <div class="row" style="margin-top: 10px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="modern-label" for="document"><?= lang('document') ?></label>
                        <input id="document" type="file" name="document" data-show-upload="false" data-show-preview="false" class="form-control file">
                    </div>
                </div>
            </div>

            <!-- BLOQUE DINÁMICO DE PAGO (SE MUESTRA CUANDO PAYMENT_STATUS != PENDING) -->
            <div id="payments" style="display: none; margin-top: 16px;">
                <div class="well well-sm" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 16px;">
                    <h4 style="margin: 0 0 14px 0; font-size: 14px; font-weight: 700; color: #166534;"><i class="fa fa-money"></i> Datos de Cobro Inmediato</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="payment_reference_no"><?= lang('payment_reference_no'); ?></label>
                                <?= form_input('payment_reference_no', ($_POST['payment_reference_no'] ?? $payment_ref), 'class="form-control modern-input tip" id="payment_reference_no"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ngc">
                                <label class="modern-label" for="amount_1"><?= lang('amount'); ?></label>
                                <input name="amount-paid" type="text" id="amount_1" class="pa form-control modern-input kb-pad amount"/>
                            </div>
                            <div class="form-group gc" style="display: none;">
                                <label class="modern-label" for="gift_card_no"><?= lang('gift_card_no'); ?></label>
                                <input name="gift_card_no" type="text" id="gift_card_no" class="pa form-control modern-input kb-pad"/>
                                <div id="gc_details"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="paid_by_1"><?= lang('paying_by'); ?></label>
                                <select name="paid_by" id="paid_by_1" class="form-control modern-input paid_by">
                                    <?= $this->sma->paid_opts(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pcc_1" style="display:none; margin-top: 10px;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="pcc_no" type="text" id="pcc_no_1" class="form-control modern-input" placeholder="<?= lang('cc_no') ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="pcc_holder" type="text" id="pcc_holder_1" class="form-control modern-input" placeholder="<?= lang('cc_holder') ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="pcc_type" id="pcc_type_1" class="form-control modern-input pcc_type">
                                        <option value="Visa"><?= lang('Visa'); ?></option>
                                        <option value="MasterCard"><?= lang('MasterCard'); ?></option>
                                        <option value="Amex"><?= lang('Amex'); ?></option>
                                        <option value="Discover"><?= lang('Discover'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="pcc_month" type="text" id="pcc_month_1" class="form-control modern-input" placeholder="<?= lang('month') ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="pcc_year" type="text" id="pcc_year_1" class="form-control modern-input" placeholder="<?= lang('year') ?>"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input name="pcc_ccv" type="text" id="pcc_cvv2_1" class="form-control modern-input" placeholder="<?= lang('cvv2') ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pcheque_1" style="display:none; margin-top: 10px;">
                        <div class="form-group">
                            <label class="modern-label" for="cheque_no_1"><?= lang('cheque_no'); ?></label>
                            <input name="cheque_no" type="text" id="cheque_no_1" class="form-control modern-input cheque_no"/>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="modern-label" for="payment_note_1"><?= lang('payment_note'); ?></label>
                        <textarea name="payment_note" id="payment_note_1" class="pa form-control modern-input kb-text payment_note" rows="2"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. NOTAS Y OBSERVACIONES -->
    <div class="modern-card">
        <div class="modern-card-header">
            <h3><i class="fa fa-comment-o"></i> 4. Notas y Observaciones</h3>
        </div>
        <div class="modern-card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="modern-label" for="slnote"><?= lang('sale_note'); ?> <span style="font-weight: normal; color: #64748b;">(Visible al Cliente)</span></label>
                        <?php echo form_textarea('note', ($_POST['note'] ?? ''), 'class="form-control" id="slnote" rows="3"'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="modern-label" for="slinnote"><?= lang('staff_note'); ?> <span style="font-weight: normal; color: #64748b;">(Privada de Personal)</span></label>
                        <?php echo form_textarea('staff_note', ($_POST['staff_note'] ?? ''), 'class="form-control" id="slinnote" rows="3"'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="total_items" value="" id="total_items" required="required"/>

    <!-- MODERN TOTALS & ACTIONS BAR -->
    <div class="modern-totals-bar" id="bottom-total">
        <div class="totals-metrics-group">
            <div class="total-metric-item">
                <span class="total-metric-label"><?= lang('items') ?></span>
                <span class="total-metric-val" id="titems">0</span>
            </div>
            <div class="total-metric-item">
                <span class="total-metric-label"><?= lang('total') ?> Neto</span>
                <span class="total-metric-val" id="total">0.00</span>
            </div>
            <?php if ($Owner || $Admin || $this->session->userdata('allow_discount')) { ?>
                <div class="total-metric-item">
                    <span class="total-metric-label"><?= lang('order_discount') ?></span>
                    <span class="total-metric-val" style="color: #dc2626;" id="tds">0.00</span>
                </div>
            <?php } ?>
            <?php if ($Settings->tax2) { ?>
                <div class="total-metric-item">
                    <span class="total-metric-label"><?= lang('order_tax') ?></span>
                    <span class="total-metric-val" id="ttax2">0.00</span>
                </div>
            <?php } ?>
            <div class="total-metric-item">
                <span class="total-metric-label"><?= lang('shipping') ?></span>
                <span class="total-metric-val" id="tship">0.00</span>
            </div>
            <div class="total-metric-item" style="border-left: 2px solid #e2e8f0; padding-left: 16px;">
                <span class="total-metric-label"><?= lang('grand_total') ?></span>
                <span class="total-metric-val grand" id="gtotal">0.00</span>
            </div>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <button type="button" class="btn btn-default" id="reset" style="border-radius: 8px; font-weight: 600;">
                <i class="fa fa-refresh"></i> <?= lang('reset') ?>
            </button>
            <?php echo form_submit('add_sale', lang('submit'), 'id="add_sale" class="btn btn-primary btn-lg" style="border-radius: 8px; font-weight: 700; padding: 10px 24px; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);"'); ?>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>
<div class="modal" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
                            class="fa fa-2x">&times;</i></span><span class="sr-only"><?=lang('close');?></span></button>
                <h4 class="modal-title" id="prModalLabel"></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <?php if ($Settings->tax1) {
                            ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><?= lang('product_tax') ?></label>
                            <div class="col-sm-8">
                                <?php
                                $tr[''] = '';
                            foreach ($tax_rates as $tax) {
                                $tr[$tax->id] = $tax->name;
                            }
                            echo form_dropdown('ptax', $tr, '', 'id="ptax" class="form-control pos-input-tip" style="width:100%;"'); ?>
                            </div>
                        </div>
                    <?php
                        } ?>
                    <?php if ($Settings->product_serial) {
                            ?>
                        <div class="form-group">
                            <label for="pserial" class="col-sm-4 control-label"><?= lang('serial_no') ?></label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pserial">
                            </div>
                        </div>
                    <?php
                        } ?>
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
                    <?php if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) {
                            ?>
                        <div class="form-group">
                            <label for="pdiscount"
                                   class="col-sm-4 control-label"><?= lang('product_discount') ?></label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pdiscount">
                            </div>
                        </div>
                    <?php
                        } ?>
                    <div class="form-group">
                        <label for="pprice" class="col-sm-4 control-label"><?= lang('unit_price') ?></label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pprice" <?= ($Owner || $Admin || $GP['edit_price']) ? '' : 'readonly'; ?>>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width:25%;"><?= lang('net_unit_price'); ?></th>
                            <th style="width:25%;"><span id="net_price"></span></th>
                            <th style="width:25%;"><?= lang('product_tax'); ?></th>
                            <th style="width:25%;"><span id="pro_tax"></span></th>
                        </tr>
                    </table>
                    <?php if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) {
                            ?>
                        <div class="form-group">
                            <label for="psubt"
                                   class="col-sm-4 control-label"><?= lang('subtotal') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="psubt" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pdiscount"
                                   class="col-sm-4 control-label"><?= lang('adjust_subtotal') ?></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="padiscount" placeholder="<?= lang('nearest_subtotal'); ?>">
                            </div>
                        </div>
                    <?php
                        } ?>
                    <input type="hidden" id="punit_price" value=""/>
                    <input type="hidden" id="old_tax" value=""/>
                    <input type="hidden" id="old_qty" value=""/>
                    <input type="hidden" id="old_price" value=""/>
                    <input type="hidden" id="row_id" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editItem"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="mModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
                            class="fa fa-2x">&times;</i></span><span class="sr-only"><?=lang('close');?></span></button>
                <h4 class="modal-title" id="mModalLabel"><?= lang('add_product_manually') ?></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="mcode" class="col-sm-4 control-label"><?= lang('product_code') ?> *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mcode">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mname" class="col-sm-4 control-label"><?= lang('product_name') ?> *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mname">
                        </div>
                    </div>
                    <?php if ($Settings->tax1) {
                            ?>
                        <div class="form-group">
                            <label for="mtax" class="col-sm-4 control-label"><?= lang('product_tax') ?> *</label>

                            <div class="col-sm-8">
                                <?php
                                $tr[''] = '';
                            foreach ($tax_rates as $tax) {
                                $tr[$tax->id] = $tax->name;
                            }
                            echo form_dropdown('mtax', $tr, '', 'id="mtax" class="form-control input-tip select" style="width:100%;"'); ?>
                            </div>
                        </div>
                    <?php
                        } ?>
                    <div class="form-group">
                        <label for="mquantity" class="col-sm-4 control-label"><?= lang('quantity') ?> *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="munit" class="col-sm-4 control-label"><?= lang('unit') ?> *</label>

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
                    <?php if ($Settings->product_discount && ($Owner || $Admin || $this->session->userdata('allow_discount'))) {
                                ?>
                        <div class="form-group">
                            <label for="mdiscount"
                                   class="col-sm-4 control-label"><?= lang('product_discount') ?></label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mdiscount">
                            </div>
                        </div>
                    <?php
                            } ?>
                    <div class="form-group">
                        <label for="mprice" class="col-sm-4 control-label"><?= lang('unit_price') ?> *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mprice">
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width:25%;"><?= lang('net_unit_price'); ?></th>
                            <th style="width:25%;"><span id="mnet_price"></span></th>
                            <th style="width:25%;"><?= lang('product_tax'); ?></th>
                            <th style="width:25%;"><span id="mpro_tax"></span></th>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addItemManually"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="gcModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                        class="fa fa-2x">&times;</i></button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('sell_gift_card'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?= lang('enter_info'); ?></p>

                <div class="alert alert-danger gcerror-con" style="display: none;">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <span id="gcerror"></span>
                </div>
                <div class="form-group">
                    <?= lang('card_no', 'gccard_no'); ?> *
                    <div class="input-group">
                        <?php echo form_input('gccard_no', '', 'class="form-control" id="gccard_no"'); ?>
                        <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;"><a href="#"
                                                                                                           id="genNo"><i
                                    class="fa fa-cogs"></i></a></div>
                    </div>
                </div>
                <input type="hidden" name="gcname" value="<?= lang('gift_card') ?>" id="gcname"/>

                <div class="form-group">
                    <?= lang('value', 'gcvalue'); ?> *
                    <?php echo form_input('gcvalue', '', 'class="form-control" id="gcvalue"'); ?>
                </div>
                <div class="form-group">
                    <?= lang('price', 'gcprice'); ?> *
                    <?php echo form_input('gcprice', '', 'class="form-control" id="gcprice"'); ?>
                </div>
                <div class="form-group">
                    <?= lang('customer', 'gccustomer'); ?>
                    <?php echo form_input('gccustomer', '', 'class="form-control" id="gccustomer"'); ?>
                </div>
                <div class="form-group">
                    <?= lang('expiry_date', 'gcexpiry'); ?>
                    <?php echo form_input('gcexpiry', $this->sma->hrsd(date('Y-m-d', strtotime('+2 year'))), 'class="form-control date" id="gcexpiry"'); ?>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="addGiftCard" class="btn btn-primary"><?= lang('sell_gift_card') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#gccustomer').select2({
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
        $('#genNo').click(function () {
            var no = generateCardNo();
            $(this).parent().parent('.input-group').children('input').val(no);
            return false;
        });

        // Reactive UI sync for Sales Items table and Empty State
        function syncSlTableUI() {
            var itemsCount = $('#slTable tbody tr').length;
            if (itemsCount > 0) {
                $('#slTableEmptyNotice').hide();
                $('#slTableGroup').fadeIn(150);
                $('#itemsCountBadge').text(itemsCount + (itemsCount === 1 ? ' artículo' : ' artículos'));
            } else {
                $('#slTableGroup').hide();
                $('#slTableEmptyNotice').fadeIn(150);
            }
        }

        syncSlTableUI();

        // Observe DOM modifications in #slTable tbody
        var slTableBody = document.querySelector('#slTable tbody');
        if (slTableBody) {
            var slObserver = new MutationObserver(function() {
                syncSlTableUI();
            });
            slObserver.observe(slTableBody, { childList: true, subtree: true });
        }

        // Periodic/event fallback for dynamic localStorage updates
        $(document).on('click change keyup', function () {
            setTimeout(syncSlTableUI, 200);
        });
    });
</script>
