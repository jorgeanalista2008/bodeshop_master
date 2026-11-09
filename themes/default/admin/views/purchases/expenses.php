<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Calculate expenses metrics from database
$e_stats = $this->db->query("SELECT 
    COUNT(*) as total_expenses,
    COALESCE(SUM(amount), 0) as total_amount,
    COALESCE(SUM(CASE WHEN date >= '" . date('Y-m-01 00:00:00') . "' THEN amount ELSE 0 END), 0) as month_amount
FROM {$this->db->dbprefix('expenses')}");
$exp_stats = $e_stats ? $e_stats->row() : null;
$total_expenses = $exp_stats ? (int)$exp_stats->total_expenses : 0;
$total_amount_exp = $exp_stats ? (float)$exp_stats->total_amount : 0.0;
$month_amount_exp = $exp_stats ? (float)$exp_stats->month_amount : 0.0;
$avg_exp = $total_expenses > 0 ? ($total_amount_exp / $total_expenses) : 0.0;
?>

<style>
    .exp-kpi-card {
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
    }
    .exp-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .exp-kpi-info span {
        font-size: 11.5px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
    }
    .exp-kpi-info h4 {
        margin: 0 0 2px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
    }
    .exp-kpi-icon {
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
    .kpi-icon-purple { background: #f5f3ff; color: #7c3aed; }

    .expenses-header-bar {
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
    .expenses-title-wrap h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .expenses-title-wrap p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .expenses-actions-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Modern Table Container */
    .expenses-table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        margin-bottom: 24px;
    }
    #EXPData {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        margin-top: 10px !important;
    }
    #EXPData thead th {
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
    #EXPData tbody tr.expense_link {
        cursor: pointer;
        transition: background-color 0.15s ease;
    }
    #EXPData tbody tr.expense_link:hover td {
        background-color: #f1f5f9 !important;
    }
    #EXPData tbody td {
        padding: 10px !important;
        vertical-align: middle !important;
        font-size: 13px !important;
        border-top: 1px solid #f1f5f9 !important;
    }
    #EXPData tfoot.dtFilter th {
        background: #f8fafc !important;
        padding: 8px !important;
        border-top: 2px solid #e2e8f0 !important;
        font-size: 13px !important;
    }
    #EXPData tfoot.dtFilter input {
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
    #EXPData tfoot.dtFilter input:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15) !important;
        outline: none !important;
    }
</style>

<script>
    $(document).ready(function () {
        function attachment(x) {
            if (x != null) {
                return '<a href="' + site.url + 'assets/uploads/' + x + '" target="_blank"><i class="fa fa-chain text-primary"></i></a>';
            }
            return x;
        }

        oTable = $('#EXPData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('purchases/getExpenses'); ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox},
                {"mRender": fld},
                null,
                null,
                {"mRender": currencyFormat},
                null,
                null,
                {"bSortable": false, "mRender": attachment},
                {"bSortable": false}
            ],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "expense_link";
                return nRow;
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var total = 0;
                for (var i = 0; i < aaData.length; i++) {
                    total += parseFloat(aaData[aiDisplay[i]][4]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[4].innerHTML = currencyFormat(total);
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('category');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('note');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('created_by');?>]", filter_type: "text", data: []},
        ], "footer");
    });
</script>

<!-- 1. Interactive KPI Metrics Cards -->
<div class="row" style="margin-top: 5px;">
    <!-- KPI 1: Total Gastos Registrados -->
    <div class="col-md-3 col-sm-6">
        <div class="exp-kpi-card" title="Total de gastos registrados">
            <div class="exp-kpi-info">
                <span>Total Gastos</span>
                <h4><?= number_format($total_expenses) ?></h4>
                <small style="color: #64748b; font-size: 11px;">Comprobantes en sistema</small>
            </div>
            <div class="exp-kpi-icon kpi-icon-blue">
                <i class="fa fa-calculator"></i>
            </div>
        </div>
    </div>

    <!-- KPI 2: Monto Total Acumulado -->
    <div class="col-md-3 col-sm-6">
        <div class="exp-kpi-card" title="Monto total acumulado en gastos">
            <div class="exp-kpi-info">
                <span>Monto Total</span>
                <h4 style="color: #2563eb;"><?= $this->sma->formatMoney($total_amount_exp) ?></h4>
                <small style="color: #64748b; font-size: 11px;">Gasto histórico total</small>
            </div>
            <div class="exp-kpi-icon kpi-icon-green">
                <i class="fa fa-money"></i>
            </div>
        </div>
    </div>

    <!-- KPI 3: Gastos de este Mes -->
    <div class="col-md-3 col-sm-6">
        <div class="exp-kpi-card" title="Gastos registrados en el mes actual">
            <div class="exp-kpi-info">
                <span>Gasto del Mes</span>
                <h4 style="color: #d97706;"><?= $this->sma->formatMoney($month_amount_exp) ?></h4>
                <small style="color: #d97706; font-size: 11px;">Mes en curso (<?= date('M Y') ?>)</small>
            </div>
            <div class="exp-kpi-icon kpi-icon-amber">
                <i class="fa fa-calendar-check-o"></i>
            </div>
        </div>
    </div>

    <!-- KPI 4: Promedio por Gasto -->
    <div class="col-md-3 col-sm-6">
        <div class="exp-kpi-card" title="Promedio por gasto registrado">
            <div class="exp-kpi-info">
                <span>Promedio por Gasto</span>
                <h4 style="color: #7c3aed;"><?= $this->sma->formatMoney($avg_exp) ?></h4>
                <small style="color: #7c3aed; font-size: 11px;">Ticket promedio de egreso</small>
            </div>
            <div class="exp-kpi-icon kpi-icon-purple">
                <i class="fa fa-pie-chart"></i>
            </div>
        </div>
    </div>
</div>

<!-- 2. Header Bar with Actions -->
<div class="expenses-header-bar">
    <div class="expenses-title-wrap">
        <h3><i class="fa fa-dollar text-primary"></i> <?= lang('expenses'); ?></h3>
        <p>Registro y control de gastos operativos, suministros y egresos comerciales.</p>
    </div>
    <div class="expenses-actions-wrap">
        <a href="<?= admin_url('purchases/add_expense'); ?>" data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="font-weight: 700; border-radius: 6px; padding: 8px 16px;">
            <i class="fa fa-plus-circle"></i> <?= lang('add_expense'); ?>
        </a>
        
        <!-- Actions Dropdown -->
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="border-radius: 6px; padding: 8px 12px; border: 1px solid #cbd5e1; background: #ffffff;">
                <i class="fa fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o text-success"></i> <?= lang('export_to_excel'); ?></a></li>
                <?php if ($Owner) { ?>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_expenses'); ?></b>"
                            data-content="<p><?= lang('r_u_sure'); ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure'); ?></button> <button class='btn bpo-close'><?= lang('no'); ?></button>"
                            data-html="true" data-placement="left">
                            <i class="fa fa-trash-o text-danger"></i> <?= lang('delete_expenses'); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php if ($Owner) {
    echo admin_form_open('purchases/expense_actions', 'id="action-form"');
} ?>

<!-- 3. Modern Expenses DataTable Card -->
<div class="expenses-table-card">
    <div class="table-responsive">
        <table id="EXPData" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover table-striped">
            <thead>
            <tr class="active">
                <th style="min-width:30px; width: 30px; text-align: center;">
                    <input class="checkbox checkft" type="checkbox" name="check"/>
                </th>
                <th class="col-xs-2"><?= lang('date'); ?></th>
                <th class="col-xs-2"><?= lang('reference'); ?></th>
                <th class="col-xs-2"><?= lang('category'); ?></th>
                <th class="col-xs-1"><?= lang('amount'); ?></th>
                <th class="col-xs-3"><?= lang('note'); ?></th>
                <th class="col-xs-2"><?= lang('created_by'); ?></th>
                <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                <th style="width:100px; text-align: center;"><?= lang('actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
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
                <th></th>
                <th></th>
                <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                <th style="width:100px; text-align: center;"><?= lang('actions'); ?></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php if ($Owner) { ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
<?php } ?>