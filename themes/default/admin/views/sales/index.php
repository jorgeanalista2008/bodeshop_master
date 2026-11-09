<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Compute sales metrics for quick situational awareness
$wh_clause = $warehouse_id ? (" AND warehouse_id = " . (int)$warehouse_id) : "";
$sl_stats_q = $this->db->query("SELECT
    COUNT(*) as total_sales,
    COALESCE(SUM(grand_total), 0) as total_amount,
    COALESCE(SUM(paid), 0) as total_paid,
    COALESCE(SUM(grand_total - paid), 0) as total_due,
    SUM(CASE WHEN sale_status = 'completed' THEN 1 ELSE 0 END) as completed_count,
    SUM(CASE WHEN sale_status = 'pending' THEN 1 ELSE 0 END) as pending_count,
    SUM(CASE WHEN payment_status = 'paid' THEN 1 ELSE 0 END) as paid_count,
    SUM(CASE WHEN payment_status != 'paid' AND (grand_total - paid) > 0 THEN 1 ELSE 0 END) as pending_pay_count
    FROM " . $this->db->dbprefix('sales') . " WHERE pos != 1 " . $wh_clause);
$stats = $sl_stats_q ? $sl_stats_q->row() : null;
?>
<style type="text/css" media="screen">
    /* Modern UI/UX Styles for Sales Management */
    .sales-page-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    /* Metrics KPI Grid */
    .sales-metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .sales-metric-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .sales-metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08);
    }
    .sales-metric-info h4 {
        margin: 0 0 4px 0;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 700;
        color: #64748b;
    }
    .sales-metric-info .sales-metric-num {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    .sales-metric-info .sales-metric-sub {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
        display: block;
    }
    .sales-metric-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .sales-metric-icon.blue { background: #eff6ff; color: #2563eb; }
    .sales-metric-icon.green { background: #ecfdf5; color: #059669; }
    .sales-metric-icon.amber { background: #fffbeb; color: #d97706; }
    .sales-metric-icon.purple { background: #faf5ff; color: #7c3aed; }

    /* Modern Box Container */
    .box.modern-sales-box {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        background: #ffffff;
        margin-bottom: 30px;
    }
    .modern-sales-box .box-header {
        background: #ffffff;
        border-bottom: 1px solid #edf2f7;
        padding: 16px 20px;
        border-radius: 12px 12px 0 0;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }
    .modern-sales-box .box-header h2 {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modern-sales-box .box-header h2 i {
        color: #3b82f4;
        font-size: 20px;
    }

    /* Action Toolbar */
    .sales-action-bar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        padding: 4px 0;
    }
    .btn-sales-primary {
        background: #2563eb;
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 16px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s, transform 0.1s;
    }
    .btn-sales-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        color: #ffffff;
    }
    .btn-sales-secondary {
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        color: #334155 !important;
        font-weight: 600;
        border-radius: 8px;
        padding: 8px 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s;
    }
    .btn-sales-secondary:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }

    /* Filter Pills */
    .filter-pills {
        display: inline-flex;
        background: #f1f5f9;
        padding: 3px;
        border-radius: 8px;
        gap: 2px;
    }
    .filter-pill-item {
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        border-radius: 6px;
        text-decoration: none !important;
        transition: all 0.15s;
    }
    .filter-pill-item:hover {
        color: #0f172a;
    }
    .filter-pill-item.active {
        background: #ffffff;
        color: #2563eb;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    /* Modern Table Styling */
    #SLData {
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }
    #SLData thead th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 10px;
        border-top: none;
        border-bottom: 2px solid #e2e8f0;
        vertical-align: middle;
    }
    #SLData tbody tr {
        transition: background-color 0.15s;
        cursor: pointer;
    }
    #SLData tbody tr:hover {
        background-color: #f8fafc !important;
    }
    #SLData tbody td {
        padding: 12px 10px;
        vertical-align: middle;
        font-size: 13px;
        color: #1e293b;
        border-top: 1px solid #f1f5f9;
    }
    
    /* Modern Status Badges */
    .label.row_status, .label.payment_status {
        display: inline-block;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 9999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .label-success {
        background-color: #dcfce7 !important;
        color: #15803d !important;
        border: 1px solid #bbf7d0;
    }
    .label-warning {
        background-color: #fef3c7 !important;
        color: #b45309 !important;
        border: 1px solid #fde68a;
    }
    .label-danger {
        background-color: #fee2e2 !important;
        color: #b91c1c !important;
        border: 1px solid #fecaca;
    }
    .label-info {
        background-color: #e0f2fe !important;
        color: #0369a1 !important;
        border: 1px solid #bae6fd;
    }
    .label-default {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: 1px solid #e2e8f0;
    }

    /* Currency Columns */
    #SLData tbody td:nth-child(7) {
        font-weight: 700;
        color: #0f172a;
        text-align: right;
    }
    #SLData tbody td:nth-child(8) {
        font-weight: 600;
        color: #059669;
        text-align: right;
    }
    #SLData tbody td:nth-child(9) {
        font-weight: 700;
        color: #dc2626;
        text-align: right;
    }

    /* Table Footer Filters */
    #SLData tfoot th {
        background-color: #f8fafc;
        border-top: 2px solid #e2e8f0;
        padding: 10px;
    }
    #SLData tfoot input {
        width: 100% !important;
        padding: 6px 10px;
        font-size: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        outline: none;
        transition: border-color 0.15s;
    }
    #SLData tfoot input:focus {
        border-color: #3b82f4;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
    }
</style>

<div class="sales-page-container">

    <!-- KPI Summary Metrics Grid -->
    <div class="sales-metrics-grid">
        <div class="sales-metric-card">
            <div class="sales-metric-info">
                <h4><?= lang('grand_total'); ?> Facturado</h4>
                <div class="sales-metric-num"><?= $this->sma->formatMoney($stats ? $stats->total_amount : 0); ?></div>
                <span class="sales-metric-sub"><?= $stats ? (int)$stats->total_sales : 0; ?> ventas registradas</span>
            </div>
            <div class="sales-metric-icon blue">
                <i class="fa fa-line-chart"></i>
            </div>
        </div>

        <div class="sales-metric-card">
            <div class="sales-metric-info">
                <h4><?= lang('paid'); ?> / Cobrado</h4>
                <div class="sales-metric-num" style="color: #059669;"><?= $this->sma->formatMoney($stats ? $stats->total_paid : 0); ?></div>
                <span class="sales-metric-sub"><?= $stats ? (int)$stats->paid_count : 0; ?> ventas liquidadas 100%</span>
            </div>
            <div class="sales-metric-icon green">
                <i class="fa fa-check-circle"></i>
            </div>
        </div>

        <div class="sales-metric-card">
            <div class="sales-metric-info">
                <h4><?= lang('balance'); ?> Pendiente</h4>
                <div class="sales-metric-num" style="color: #dc2626;"><?= $this->sma->formatMoney($stats ? $stats->total_due : 0); ?></div>
                <span class="sales-metric-sub"><?= $stats ? (int)$stats->pending_pay_count : 0; ?> facturas por cobrar</span>
            </div>
            <div class="sales-metric-icon amber">
                <i class="fa fa-clock-o"></i>
            </div>
        </div>

        <div class="sales-metric-card">
            <div class="sales-metric-info">
                <h4>Estado de Ventas</h4>
                <div class="sales-metric-num"><?= $stats ? (int)$stats->completed_count : 0; ?> <span style="font-size: 14px; font-weight: 500; color: #64748b;">Completadas</span></div>
                <span class="sales-metric-sub"><?= $stats ? (int)$stats->pending_count : 0; ?> pendientes por procesar</span>
            </div>
            <div class="sales-metric-icon purple">
                <i class="fa fa-shopping-bag"></i>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            oTable = $('#SLData').dataTable({
                "aaSorting": [[1, "desc"], [2, "desc"]],
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
                "iDisplayLength": <?=$Settings->rows_per_page?>,
                'bProcessing': true, 'bServerSide': true,
                'sAjaxSource': '<?=admin_url('sales/getSales' . ($warehouse_id ? '/' . $warehouse_id : '') . '?v=1' . ($this->input->get('shop') ? '&shop=' . $this->input->get('shop') : '') . ($this->input->get('attachment') ? '&attachment=' . $this->input->get('attachment') : '') . ($this->input->get('delivery') ? '&delivery=' . $this->input->get('delivery') : '')); ?>',
                'fnServerData': function (sSource, aoData, fnCallback) {
                    aoData.push({
                        "name": "<?=$this->security->get_csrf_token_name()?>",
                        "value": "<?=$this->security->get_csrf_hash()?>"
                    });
                    $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
                },
                'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                    var oSettings = oTable.fnSettings();
                    nRow.id = aData[0];
                    nRow.setAttribute('data-return-id', aData[11]);
                    nRow.className = "invoice_link re"+aData[11];
                    return nRow;
                },
                "aoColumns": [
                    {"bSortable": false,"mRender": checkbox},
                    {"mRender": fld},
                    null,
                    null,
                    null,
                    {"mRender": row_status},
                    {"mRender": currencyFormat},
                    {"mRender": currencyFormat},
                    {"mRender": currencyFormat},
                    {"mRender": pay_status},
                    {"bSortable": false,"mRender": attachment},
                    {"bVisible": false},
                    {"bSortable": false}
                ],
                "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                    var gtotal = 0, paid = 0, balance = 0;
                    for (var i = 0; i < aaData.length; i++) {
                        gtotal += parseFloat(aaData[aiDisplay[i]][6]);
                        paid += parseFloat(aaData[aiDisplay[i]][7]);
                        balance += parseFloat(formatDecimals(aaData[aiDisplay[i]][8]));
                    }
                    var nCells = nRow.getElementsByTagName('th');
                    nCells[6].innerHTML = currencyFormat(parseFloat(gtotal));
                    nCells[7].innerHTML = currencyFormat(parseFloat(paid));
                    nCells[8].innerHTML = currencyFormat(parseFloat(balance));
                }
            }).fnSetFilteringDelay().dtFilter([
                {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
                {column_number: 3, filter_default_label: "[<?=lang('biller');?>]", filter_type: "text", data: []},
                {column_number: 4, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
                {column_number: 5, filter_default_label: "[<?=lang('sale_status');?>]", filter_type: "text", data: []},
                {column_number: 9, filter_default_label: "[<?=lang('payment_status');?>]", filter_type: "text", data: []},
            ], "footer");

            if (localStorage.getItem('remove_slls')) {
                var keysToRemove = ['slitems', 'sldiscount', 'sltax2', 'slref', 'slshipping', 'slwarehouse', 'slnote', 'slinnote', 'slcustomer', 'slbiller', 'slcurrency', 'sldate', 'slsale_status', 'slpayment_status', 'paid_by', 'amount_1', 'paid_by_1', 'pcc_holder_1', 'pcc_type_1', 'pcc_month_1', 'pcc_year_1', 'pcc_no_1', 'cheque_no_1', 'slpayment_term'];
                keysToRemove.forEach(function(key) {
                    if (localStorage.getItem(key)) { localStorage.removeItem(key); }
                });
                localStorage.removeItem('remove_slls');
            }

            <?php if ($this->session->userdata('remove_slls')) { ?>
                var keysToRemoveSession = ['slitems', 'sldiscount', 'sltax2', 'slref', 'slshipping', 'slwarehouse', 'slnote', 'slinnote', 'slcustomer', 'slbiller', 'slcurrency', 'sldate', 'slsale_status', 'slpayment_status', 'paid_by', 'amount_1', 'paid_by_1', 'pcc_holder_1', 'pcc_type_1', 'pcc_month_1', 'pcc_year_1', 'pcc_no_1', 'cheque_no_1', 'slpayment_term'];
                keysToRemoveSession.forEach(function(key) {
                    if (localStorage.getItem(key)) { localStorage.removeItem(key); }
                });
                <?php $this->sma->unset_data('remove_slls'); ?>
            <?php } ?>

            $(document).on('click', '.sledit', function (e) {
                if (localStorage.getItem('slitems')) {
                    e.preventDefault();
                    var href = $(this).attr('href');
                    bootbox.confirm("<?=lang('you_will_loss_sale_data')?>", function (result) {
                        if (result) {
                            window.location.href = href;
                        }
                    });
                }
            });
            $(document).on('click', '.slduplicate', function (e) {
                if (localStorage.getItem('slitems')) {
                    e.preventDefault();
                    var href = $(this).attr('href');
                    bootbox.confirm("<?=lang('you_will_loss_sale_data')?>", function (result) {
                        if (result) {
                            window.location.href = href;
                        }
                    });
                }
            });
        });
    </script>

    <?php if ($Owner || $GP['bulk_actions']) {
        echo admin_form_open('sales/sale_actions', 'id="action-form"');
    } ?>

    <div class="box modern-sales-box">
        <div class="box-header">
            <h2>
                <i class="fa fa-shopping-cart"></i>
                <?=lang('sales') . ' (' . ($warehouse_id ? $warehouse->name : lang('all_warehouses')) . ')';?>
            </h2>

            <div class="box-icon">
                <ul class="btn-tasks">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon fa fa-tasks tip" data-placement="left" title="<?=lang('actions')?>"></i>
                        </a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li>
                                <a href="<?=admin_url('sales/add')?>">
                                    <i class="fa fa-plus-circle"></i> <?=lang('add_sale')?>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="excel" data-action="export_excel">
                                    <i class="fa fa-file-excel-o"></i> <?=lang('export_to_excel')?>
                                </a>
                            </li>
                            <li>
                                <a href="#" id="combine" data-action="combine">
                                    <i class="fa fa-file-pdf-o"></i> <?=lang('combine_to_pdf')?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" class="bpo" title="<b><?=lang('delete_sales')?></b>" data-content="<p><?=lang('r_u_sure')?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?=lang('i_m_sure')?></a> <button class='btn bpo-close'><?=lang('no')?></button>" data-html="true" data-placement="left">
                                    <i class="fa fa-trash-o"></i> <?=lang('delete_sales')?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php if (!empty($warehouses)) { ?>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?=lang('warehouses')?>"></i></a>
                            <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                                <li><a href="<?=admin_url('sales')?>"><i class="fa fa-building-o"></i> <?=lang('all_warehouses')?></a></li>
                                <li class="divider"></li>
                                <?php
                                foreach ($warehouses as $wh) {
                                    echo '<li><a href="' . admin_url('sales/' . $wh->id) . '"><i class="fa fa-building"></i>' . $wh->name . '</a></li>';
                                } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if (SHOP) { ?>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-list-alt tip" data-placement="left" title="<?=lang('sales')?>"></i></a>
                            <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                                <li<?= $this->input->get('shop') == 'yes' ? ' class="active"' : ''; ?>><a href="<?=admin_url('sales?shop=yes')?>"><i class="fa fa-shopping-cart"></i> <?=lang('shop_sales')?></a></li>
                                <li<?= $this->input->get('shop') == 'no' ? ' class="active"' : ''; ?>><a href="<?=admin_url('sales?shop=no')?>"><i class="fa fa-heart"></i> <?=lang('staff_sales')?></a></li>
                                <li<?= !$this->input->get('shop') ? ' class="active"' : ''; ?>><a href="<?=admin_url('sales')?>"><i class="fa fa-list-alt"></i> <?=lang('all_sales')?></a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="box-content" style="padding: 20px;">
            <!-- Modern Action Toolbar -->
            <div class="sales-action-bar">
                <a href="<?=admin_url('sales/add')?>" class="btn-sales-primary">
                    <i class="fa fa-plus-circle"></i> <?=lang('add_sale')?>
                </a>
                
                <div class="filter-pills">
                    <a href="<?=admin_url('sales')?>" class="filter-pill-item <?= empty($_GET['delivery']) && empty($_GET['attachment']) ? 'active' : '' ?>">
                        <i class="fa fa-list"></i> Todas las Ventas
                    </a>
                    <a href="<?=admin_url('sales?delivery=no')?>" class="filter-pill-item <?= (isset($_GET['delivery']) && $_GET['delivery'] == 'no') ? 'active' : '' ?>">
                        <i class="fa fa-truck"></i> Por Entregar
                    </a>
                    <a href="<?=admin_url('sales?attachment=yes')?>" class="filter-pill-item <?= (isset($_GET['attachment']) && $_GET['attachment'] == 'yes') ? 'active' : '' ?>">
                        <i class="fa fa-paperclip"></i> Con Adjuntos
                    </a>
                </div>

                <div class="btn-group pull-right">
                    <button type="button" class="btn-sales-secondary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-download"></i> Exportar <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="#" onclick="$('#excel').click(); return false;">
                                <i class="fa fa-file-excel-o"></i> <?=lang('export_to_excel')?>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="$('#combine').click(); return false;">
                                <i class="fa fa-file-pdf-o"></i> <?=lang('combine_to_pdf')?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive" style="margin-top: 15px;">
                <table id="SLData" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th style="min-width:30px; width: 30px; text-align: center;">
                            <input class="checkbox checkft" type="checkbox" name="check"/>
                        </th>
                        <th><?= lang('date'); ?></th>
                        <th><?= lang('reference_no'); ?></th>
                        <th><?= lang('biller'); ?></th>
                        <th><?= lang('customer'); ?></th>
                        <th style="text-align: center;"><?= lang('sale_status'); ?></th>
                        <th style="text-align: right;"><?= lang('grand_total'); ?></th>
                        <th style="text-align: right;"><?= lang('paid'); ?></th>
                        <th style="text-align: right;"><?= lang('balance'); ?></th>
                        <th style="text-align: center;"><?= lang('payment_status'); ?></th>
                        <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                        <th></th>
                        <th style="width:80px; text-align:center;"><?= lang('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="12" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                    </tr>
                    </tbody>
                    <tfoot class="dtFilter">
                    <tr class="active">
                        <th style="min-width:30px; width: 30px; text-align: center;">
                            <input class="checkbox checkft" type="checkbox" name="check"/>
                        </th>
                        <th></th><th></th><th></th><th></th><th></th>
                        <th style="text-align: right;"><?= lang('grand_total'); ?></th>
                        <th style="text-align: right;"><?= lang('paid'); ?></th>
                        <th style="text-align: right;"><?= lang('balance'); ?></th>
                        <th></th>
                        <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                        <th></th>
                        <th style="width:80px; text-align:center;"><?= lang('actions'); ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php if ($Owner || $GP['bulk_actions']) { ?>
        <div style="display: none;">
            <input type="hidden" name="form_action" value="" id="form_action"/>
            <?=form_submit('performAction', 'performAction', 'id="action-form-submit"')?>
        </div>
        <?=form_close()?>
    <?php } ?>
</div>
