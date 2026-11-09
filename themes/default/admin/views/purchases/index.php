<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Calculate purchases metrics from database
$wh_cond = $warehouse_id ? " WHERE warehouse_id = " . (int)$warehouse_id : "";
$p_stats = $this->db->query("SELECT 
    COUNT(*) as total_purchases,
    SUM(CASE WHEN status = 'received' THEN 1 ELSE 0 END) as received_purchases,
    SUM(CASE WHEN status IN ('pending', 'ordered') THEN 1 ELSE 0 END) as pending_purchases,
    COALESCE(SUM(grand_total), 0) as total_amount,
    COALESCE(SUM(paid), 0) as total_paid,
    COALESCE(SUM(grand_total - paid), 0) as total_due
FROM {$this->db->dbprefix('purchases')}" . $wh_cond);
$po_stats = $p_stats ? $p_stats->row() : null;
$total_po = $po_stats ? (int)$po_stats->total_purchases : 0;
$received_po = $po_stats ? (int)$po_stats->received_purchases : 0;
$pending_po = $po_stats ? (int)$po_stats->pending_purchases : 0;
$total_amount_po = $po_stats ? (float)$po_stats->total_amount : 0.0;
$total_paid_po = $po_stats ? (float)$po_stats->total_paid : 0.0;
$total_due_po = $po_stats ? (float)$po_stats->total_due : 0.0;
?>

<style>
    .po-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: all 0.2s ease;
        cursor: pointer;
        text-decoration: none !important;
    }
    .po-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .po-kpi-card.active-filter {
        border-color: #2563eb;
        background-color: #eff6ff;
    }
    .po-kpi-info span {
        font-size: 11.5px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
    }
    .po-kpi-info h4 {
        margin: 0 0 2px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
    }
    .po-kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .kpi-icon-blue { background: #eff6ff; color: #2563eb; }
    .kpi-icon-green { background: #ecfdf5; color: #059669; }
    .kpi-icon-amber { background: #fffbeb; color: #d97706; }
    .kpi-icon-rose { background: #fef2f2; color: #dc2626; }

    .purchases-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 12px;
        background: #ffffff;
        padding: 16px 20px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .purchases-title-wrap h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .purchases-title-wrap p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .purchases-actions-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Modern Table Container */
    .purchases-table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        margin-bottom: 24px;
    }
    #POData {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        margin-top: 10px !important;
    }
    #POData thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 12px 10px !important;
        vertical-align: middle !important;
    }
    #POData tbody tr.purchase_link {
        cursor: pointer;
        transition: background-color 0.15s ease;
    }
    #POData tbody tr.purchase_link:hover td {
        background-color: #f1f5f9 !important;
    }
    #POData tbody td {
        padding: 10px !important;
        vertical-align: middle !important;
        font-size: 13px !important;
        border-top: 1px solid #f1f5f9 !important;
    }
    #POData tfoot.dtFilter th {
        background: #f8fafc !important;
        padding: 8px !important;
        border-top: 2px solid #e2e8f0 !important;
        font-size: 13px !important;
    }
    #POData tfoot.dtFilter input {
        height: 32px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        padding: 4px 8px !important;
        font-size: 12px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        background: #ffffff !important;
        transition: border-color 0.15s ease, box-shadow 0.15s ease !important;
    }
    #POData tfoot.dtFilter input:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15) !important;
        outline: none !important;
    }
</style>

<script>
    var oTable;
    $(document).ready(function () {
        oTable = $('#POData').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?=lang('all')?>"]],
            "iDisplayLength": <?=$Settings->rows_per_page?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?=admin_url('purchases/getPurchases' . ($warehouse_id ? '/' . $warehouse_id : ''))?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?=$this->security->get_csrf_token_name()?>",
                    "value": "<?=$this->security->get_csrf_hash()?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox},
                {"mRender": fld},
                null,
                null,
                {"mRender": row_status},
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                {"mRender": pay_status},
                {"bSortable": false, "mRender": attachment},
                {"bSortable": false}
            ],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "purchase_link";
                return nRow;
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var total = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    total += parseFloat(aaData[aiDisplay[i]][5]);
                    paid += parseFloat(aaData[aiDisplay[i]][6]);
                    balance += parseFloat(aaData[aiDisplay[i]][7]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[5].innerHTML = currencyFormat(total);
                nCells[6].innerHTML = currencyFormat(paid);
                nCells[7].innerHTML = currencyFormat(balance);
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('ref_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('supplier');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('purchase_status');?>]", filter_type: "text", data: []},
            {column_number: 8, filter_default_label: "[<?=lang('payment_status');?>]", filter_type: "text", data: []},
        ], "footer");

        // KPI Card interactive filters
        $(document).on('click', '#filter-all-po', function () {
            $('.po-kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 4);
            oTable.fnFilter('', 8);
        });

        $(document).on('click', '#filter-received-po', function () {
            $('.po-kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 8);
            oTable.fnFilter('received', 4);
        });

        $(document).on('click', '#filter-pending-po', function () {
            $('.po-kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 8);
            oTable.fnFilter('pending|ordered', 4, true, false);
        });

        $(document).on('click', '#filter-due-po', function () {
            $('.po-kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 4);
            oTable.fnFilter('due|partial|pending', 8, true, false);
        });

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
    });
</script>

<!-- 1. Interactive KPI Metrics Cards -->
<div class="row" style="margin-top: 5px;">
    <!-- KPI 1: Total Compras -->
    <div class="col-md-3 col-sm-6">
        <div class="po-kpi-card active-filter" id="filter-all-po" title="Ver todas las compras">
            <div class="po-kpi-info">
                <span>Total Compras</span>
                <h4><?= number_format($total_po) ?></h4>
                <small style="color: #64748b; font-size: 11px;">Monto: <?= $this->sma->formatMoney($total_amount_po) ?></small>
            </div>
            <div class="po-kpi-icon kpi-icon-blue">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <!-- KPI 2: Recibidas -->
    <div class="col-md-3 col-sm-6">
        <div class="po-kpi-card" id="filter-received-po" title="Filtrar compras recibidas">
            <div class="po-kpi-info">
                <span>Mercadería Recibida</span>
                <h4><?= number_format($received_po) ?></h4>
                <small style="color: #16a34a; font-size: 11px;">En almacén / stock</small>
            </div>
            <div class="po-kpi-icon kpi-icon-green">
                <i class="fa fa-check-circle"></i>
            </div>
        </div>
    </div>

    <!-- KPI 3: Pendientes / Por Recibir -->
    <div class="col-md-3 col-sm-6">
        <div class="po-kpi-card" id="filter-pending-po" title="Filtrar compras pendientes u ordenadas">
            <div class="po-kpi-info">
                <span>En Tránsito / Pendiente</span>
                <h4><?= number_format($pending_po) ?></h4>
                <small style="color: #d97706; font-size: 11px;">Por despachar / recibir</small>
            </div>
            <div class="po-kpi-icon kpi-icon-amber">
                <i class="fa fa-truck"></i>
            </div>
        </div>
    </div>

    <!-- KPI 4: Saldo Pendiente por Pagar -->
    <div class="col-md-3 col-sm-6">
        <div class="po-kpi-card" id="filter-due-po" title="Filtrar compras con saldo pendiente">
            <div class="po-kpi-info">
                <span>Saldo por Pagar</span>
                <h4 style="color: #dc2626;"><?= $this->sma->formatMoney($total_due_po) ?></h4>
                <small style="color: #dc2626; font-size: 11px;">Cuentas por pagar a proveedores</small>
            </div>
            <div class="po-kpi-icon kpi-icon-rose">
                <i class="fa fa-exclamation-circle"></i>
            </div>
        </div>
    </div>
</div>

<!-- 2. Header Bar with Actions -->
<div class="purchases-header-bar">
    <div class="purchases-title-wrap">
        <h3><i class="fa fa-shopping-bag text-primary"></i> <?= lang('purchases') . ' (' . ($warehouse_id ? $warehouse->name : lang('all_warehouses')) . ')'; ?></h3>
        <p>Gestión integral de órdenes a proveedores, recepción de mercancías e histórico de pagos.</p>
    </div>
    <div class="purchases-actions-wrap">
        <a href="<?= admin_url('purchases/add'); ?>" class="btn btn-primary" style="font-weight: 700; border-radius: 6px; padding: 8px 16px;">
            <i class="fa fa-plus-circle"></i> <?= lang('add_purchase'); ?>
        </a>
        <a href="<?= admin_url('purchases/purchase_by_csv'); ?>" class="btn btn-default" style="font-weight: 600; border-radius: 6px; padding: 8px 14px; border: 1px solid #cbd5e1; background: #ffffff;">
            <i class="fa fa-file-text-o text-success"></i> <?= lang('add_purchase_by_csv'); ?>
        </a>
        
        <!-- Actions & Warehouse Selector Dropdown -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 6px; padding: 8px 12px; border: 1px solid #cbd5e1; background: #ffffff;">
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o text-success"></i> <?= lang('export_to_excel'); ?></a></li>
                <li><a href="#" id="combine" data-action="combine"><i class="fa fa-file-pdf-o text-danger"></i> <?= lang('combine_to_pdf'); ?></a></li>
                <?php if (!empty($warehouses)) { ?>
                    <li class="divider"></li>
                    <li class="dropdown-header"><?= lang('warehouses'); ?></li>
                    <li><a href="<?= admin_url('purchases'); ?>"><i class="fa fa-building-o"></i> <?= lang('all_warehouses'); ?></a></li>
                    <?php foreach ($warehouses as $wh) { ?>
                        <li <?= ($warehouse_id && $warehouse_id == $wh->id) ? 'class="active"' : ''; ?>>
                            <a href="<?= admin_url('purchases/' . $wh->id); ?>"><i class="fa fa-building"></i> <?= $wh->name; ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <?php if ($Owner || $Admin) { ?>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="bpo" title="<b><?= lang('delete_purchases'); ?></b>"
                            data-content="<p><?= lang('r_u_sure'); ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure'); ?></button> <button class='btn bpo-close'><?= lang('no'); ?></button>"
                            data-html="true" data-placement="left">
                            <i class="fa fa-trash-o text-danger"></i> <?= lang('delete_purchases'); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('purchases/purchase_actions', 'id="action-form"');
} ?>

<!-- 3. Modern Purchases DataTable Card -->
<div class="purchases-table-card">
    <div class="table-responsive">
        <table id="POData" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
            <thead>
            <tr class="active">
                <th style="min-width:30px; width: 30px; text-align: center;">
                    <input class="checkbox checkft" type="checkbox" name="check"/>
                </th>
                <th><?= lang('date'); ?></th>
                <th><?= lang('ref_no'); ?></th>
                <th><?= lang('supplier'); ?></th>
                <th><?= lang('purchase_status'); ?></th>
                <th><?= lang('grand_total'); ?></th>
                <th><?= lang('paid'); ?></th>
                <th><?= lang('balance'); ?></th>
                <th><?= lang('payment_status'); ?></th>
                <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                <th style="width:100px; text-align: center;"><?= lang('actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="11" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
            </tr>
            </tbody>
            <tfoot class="dtFilter">
            <tr class="active">
                <th style="min-width:30px; width: 30px; text-align: center;">
                    <input class="checkbox checkft" type="checkbox" name="check"/>
                </th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?= lang('grand_total'); ?></th>
                <th><?= lang('paid'); ?></th>
                <th><?= lang('balance'); ?></th>
                <th></th>
                <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                <th style="width:100px; text-align: center;"><?= lang('actions'); ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']) { ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
<?php } ?>