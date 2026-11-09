<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Calculate quotes metrics from database
$wh_cond = $warehouse_id ? " WHERE warehouse_id = " . (int)$warehouse_id : "";
$q_stats = $this->db->query("SELECT 
    COUNT(*) as total_quotes,
    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_quotes,
    SUM(CASE WHEN status = 'sent' THEN 1 ELSE 0 END) as sent_quotes,
    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_quotes,
    COALESCE(SUM(grand_total), 0) as total_amount
FROM {$this->db->dbprefix('quotes')}" . $wh_cond);
$qu_stats = $q_stats ? $q_stats->row() : null;
$total_qu = $qu_stats ? (int)$qu_stats->total_quotes : 0;
$pending_qu = $qu_stats ? (int)$qu_stats->pending_quotes : 0;
$sent_qu = $qu_stats ? (int)$qu_stats->sent_quotes : 0;
$completed_qu = $qu_stats ? (int)$qu_stats->completed_quotes : 0;
$total_amount_qu = $qu_stats ? (float)$qu_stats->total_amount : 0.0;
?>

<style>
    .qu-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
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
    .qu-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .qu-kpi-card.active-filter {
        border-color: #2563eb;
        background-color: #eff6ff;
    }
    .qu-kpi-info h4 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
    }
    .qu-kpi-info span {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .qu-kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .kpi-icon-blue { background: #eff6ff; color: #2563eb; }
    .kpi-icon-amber { background: #fffbeb; color: #d97706; }
    .kpi-icon-indigo { background: #e0e7ff; color: #4338ca; }
    .kpi-icon-green { background: #f0fdf4; color: #16a34a; }

    .quotes-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .quotes-title-wrap h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .quotes-title-wrap p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .quotes-actions-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    #QUData {
        border-radius: 8px;
        overflow: hidden;
    }
    #QUData thead th {
        background-color: #f8fafc !important;
        color: #334155 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        font-size: 12px !important;
    }
    #QUData tbody tr {
        transition: background-color 0.15s ease;
    }
    #QUData tbody tr:hover {
        background-color: #f1f5f9 !important;
    }
</style>

<script>
    $(document).ready(function () {
        oTable = $('#QUData').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('quotes/getQuotes' . ($warehouse_id ? '/' . $warehouse_id : '')) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "quote_link";
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox}, {"mRender": fld}, null, null, null, null, {"mRender": currencyFormat}, {"mRender": row_status}, {"bSortable": false,"mRender": attachment}, {"bSortable": false}]
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('biller');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('supplier');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('total');?>]", filter_type: "text", data: []},
            {column_number: 7, filter_default_label: "[<?=lang('status');?>]", filter_type: "text", data: []},
        ], "footer");

        // KPI card filter integration
        $('.qu-kpi-card').on('click', function(e) {
            e.preventDefault();
            var filterVal = $(this).data('filter');
            $('.qu-kpi-card').removeClass('active-filter');

            var filterInput = $('#QUData tfoot tr th:nth-child(8) input');
            if (filterInput.length) {
                if (filterVal) {
                    $(this).addClass('active-filter');
                    filterInput.val(filterVal).keyup();
                } else {
                    filterInput.val('').keyup();
                }
            }
        });

        <?php if ($this->session->userdata('remove_quls')) { ?>
        if (localStorage.getItem('quitems')) { localStorage.removeItem('quitems'); }
        if (localStorage.getItem('qudiscount')) { localStorage.removeItem('qudiscount'); }
        if (localStorage.getItem('qutax2')) { localStorage.removeItem('qutax2'); }
        if (localStorage.getItem('qushipping')) { localStorage.removeItem('qushipping'); }
        if (localStorage.getItem('quref')) { localStorage.removeItem('quref'); }
        if (localStorage.getItem('quwarehouse')) { localStorage.removeItem('quwarehouse'); }
        if (localStorage.getItem('qusupplier')) { localStorage.removeItem('qusupplier'); }
        if (localStorage.getItem('qunote')) { localStorage.removeItem('qunote'); }
        if (localStorage.getItem('qucustomer')) { localStorage.removeItem('qucustomer'); }
        if (localStorage.getItem('qubiller')) { localStorage.removeItem('qubiller'); }
        if (localStorage.getItem('qucurrency')) { localStorage.removeItem('qucurrency'); }
        if (localStorage.getItem('qudate')) { localStorage.removeItem('qudate'); }
        if (localStorage.getItem('qustatus')) { localStorage.removeItem('qustatus'); }
        <?php $this->sma->unset_data('remove_quls'); } ?>
    });
</script>

<!-- KPI Cards -->
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-6 col-md-3">
        <div class="qu-kpi-card" data-filter="" title="Ver todas las cotizaciones">
            <div class="qu-kpi-info">
                <h4><?= number_format($total_qu, 0, ',', '.') ?></h4>
                <span><?= lang('all'); ?> Cotizaciones</span>
            </div>
            <div class="del-kpi-icon kpi-icon-blue">
                <i class="fa fa-clipboard"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="qu-kpi-card" data-filter="pending" title="Filtrar por cotizaciones pendientes">
            <div class="qu-kpi-info">
                <h4><?= number_format($pending_qu, 0, ',', '.') ?></h4>
                <span><?= lang('pending'); ?></span>
            </div>
            <div class="del-kpi-icon kpi-icon-amber">
                <i class="fa fa-clock-o"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="qu-kpi-card" data-filter="sent" title="Filtrar por cotizaciones enviadas">
            <div class="qu-kpi-info">
                <h4><?= number_format($sent_qu, 0, ',', '.') ?></h4>
                <span><?= lang('sent'); ?></span>
            </div>
            <div class="del-kpi-icon kpi-icon-indigo">
                <i class="fa fa-paper-plane-o"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="qu-kpi-card" data-filter="completed" title="Filtrar por cotizaciones completadas">
            <div class="qu-kpi-info">
                <h4><?= number_format($completed_qu, 0, ',', '.') ?></h4>
                <span><?= lang('completed'); ?></span>
            </div>
            <div class="del-kpi-icon kpi-icon-green">
                <i class="fa fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('quotes/quote_actions', 'id="action-form"');
} ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-heart-o"></i><?= lang('quotes') . ' (' . ($warehouse_id ? $warehouse->name : lang('all_warehouses')) . ')'; ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= admin_url('quotes/add') ?>">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_quote') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="combine" data-action="combine">
                                <i class="fa fa-file-pdf-o"></i> <?=lang('combine_to_pdf')?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_quotes') ?></b>" 
                                data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>" 
                                data-html="true" data-placement="left"><i class="fa fa-trash-o"></i> <?= lang('delete_quotes') ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (!empty($warehouses)) { ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?= lang('warehouses') ?>"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?= admin_url('quotes') ?>"><i class="fa fa-building-o"></i> <?= lang('all_warehouses') ?></a></li>
                            <li class="divider"></li>
                            <?php
                            foreach ($warehouses as $wh) {
                                echo '<li><a href="' . admin_url('quotes/' . $wh->id) . '"><i class="fa fa-building"></i>' . $wh->name . '</a></li>';
                            } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="quotes-header-bar">
                    <div class="quotes-title-wrap">
                        <h3><i class="fa fa-file-text-o text-primary"></i> <?= lang('quotes'); ?></h3>
                        <p><?= lang('list_results'); ?> &bull; Gestione sus presupuestos y cotizaciones para clientes comerciales.</p>
                    </div>
                    <div class="quotes-actions-wrap">
                        <a href="<?= admin_url('quotes/add') ?>" class="btn btn-primary btn-sm" style="border-radius: 6px; padding: 6px 14px; font-weight: 600;">
                            <i class="fa fa-plus-circle"></i> <?= lang('add_quote') ?>
                        </a>
                        <button type="button" class="btn btn-default btn-sm" onclick="$('#excel').click();" title="Exportar a Excel" style="border-radius: 6px; padding: 6px 12px;">
                            <i class="fa fa-file-excel-o text-success"></i> Exportar
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="QUData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('reference_no'); ?></th>
                            <th><?= lang('biller'); ?></th>
                            <th><?= lang('customer'); ?></th>
                            <th><?= lang('supplier'); ?></th>
                            <th><?= lang('total'); ?></th>
                            <th><?= lang('status'); ?></th>
                            <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                            <th style="width:115px; text-align:center;"><?= lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="10" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                            <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                            <th style="width:115px; text-align:center;"><?= lang('actions'); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($Owner || $GP['bulk_actions']) { ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
<?php } ?>
