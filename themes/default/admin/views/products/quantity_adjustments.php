<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<script>
    $(document).ready(function () {
        oTable = $('#dmpData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('products/getadjustments/' . ($warehouse ? $warehouse->id : '')); ?>',
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
                null, 
                {"mRender": decode_html}, 
                {"bSortable": false, "mRender": attachment}, 
                {"bSortable": false}
            ],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[0];
                nRow.className = "adjustment_link";
                // Reference badge
                $('td:eq(2)', nRow).html('<span class="qa-ref-badge"><i class="fa fa-hashtag"></i> ' + aData[2] + '</span>');
                // Warehouse formatting
                if (aData[3]) {
                    $('td:eq(3)', nRow).html('<span style="font-weight: 600; color: #1e293b;"><i class="fa fa-building-o text-muted" style="margin-right: 5px;"></i>' + aData[3] + '</span>');
                }
                // Created By formatting
                if (aData[4]) {
                    $('td:eq(4)', nRow).html('<span style="color: #475569; font-size: 13px;"><i class="fa fa-user-circle-o text-primary" style="margin-right: 5px;"></i>' + aData[4] + '</span>');
                }
                return nRow;
            },
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('warehouse');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('created_by');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang(' note');?>]", filter_type: "text", data: []},
        ], "footer");

        if (localStorage.getItem('remove_qals')) {
            if (localStorage.getItem('qaitems')) {
                localStorage.removeItem('qaitems');
            }
            if (localStorage.getItem('qaref')) {
                localStorage.removeItem('qaref');
            }
            if (localStorage.getItem('qawarehouse')) {
                localStorage.removeItem('qawarehouse');
            }
            if (localStorage.getItem('qanote')) {
                localStorage.removeItem('qanote');
            }
            if (localStorage.getItem('qadate')) {
                localStorage.removeItem('qadate');
            }
            localStorage.removeItem('remove_qals');
        }

        <?php if ($this->session->userdata('remove_qals')): ?>
            if (localStorage.getItem('qaitems')) {
                localStorage.removeItem('qaitems');
            }
            if (localStorage.getItem('qaref')) {
                localStorage.removeItem('qaref');
            }
            if (localStorage.getItem('qawarehouse')) {
                localStorage.removeItem('qawarehouse');
            }
            if (localStorage.getItem('qanote')) {
                localStorage.removeItem('qanote');
            }
            if (localStorage.getItem('qadate')) {
                localStorage.removeItem('qadate');
            }
            <?php $this->sma->unset_data('remove_qals'); ?>
        <?php endif; ?>
    });
</script>

<?php 
// Calculate high-level KPIs for adjustments
$wh_clause = $warehouse ? "WHERE a.warehouse_id = " . (int)$warehouse->id : "";
$kpi_stats = $this->db->query("
    SELECT 
        COUNT(DISTINCT a.id) as total_adjustments,
        COUNT(DISTINCT CASE WHEN ai.type = 'addition' THEN a.id END) as total_additions,
        COUNT(DISTINCT CASE WHEN ai.type = 'subtraction' THEN a.id END) as total_subtractions
    FROM " . $this->db->dbprefix('adjustments') . " a
    LEFT JOIN " . $this->db->dbprefix('adjustment_items') . " ai ON ai.adjustment_id = a.id
    " . $wh_clause
)->row();

$tot_adj = $kpi_stats ? (int)$kpi_stats->total_adjustments : 0;
$tot_add = $kpi_stats ? (int)$kpi_stats->total_additions : 0;
$tot_sub = $kpi_stats ? (int)$kpi_stats->total_subtractions : 0;
?>

<!-- KPI Overview Grid -->
<div class="qa-kpi-grid">
    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #eff6ff; color: #2563eb;">
            <i class="fa fa-sliders"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value"><?= $tot_adj; ?></h3>
            <p class="qa-kpi-title">Total Ajustes</p>
            <span class="qa-kpi-sub">Movimientos registrados</span>
        </div>
    </div>

    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #ecfdf5; color: #059669;">
            <i class="fa fa-arrow-up"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value" style="color: #059669;"><?= $tot_add; ?></h3>
            <p class="qa-kpi-title">Adiciones (+)</p>
            <span class="qa-kpi-sub">Ingresos y sobrantes</span>
        </div>
    </div>

    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #fff1f2; color: #e11d48;">
            <i class="fa fa-arrow-down"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value" style="color: #e11d48;"><?= $tot_sub; ?></h3>
            <p class="qa-kpi-title">Sustracciones (-)</p>
            <span class="qa-kpi-sub">Mermas, mermas y descartes</span>
        </div>
    </div>

    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
            <i class="fa fa-building-o"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value" style="font-size: 16px; font-weight: 700; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <?= $warehouse ? $warehouse->name : 'Consolidado'; ?>
            </h3>
            <p class="qa-kpi-title">Almacén Activo</p>
            <span class="qa-kpi-sub"><?= $warehouse ? 'Filtro por sucursal' : 'Todos los almacenes'; ?></span>
        </div>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('products/adjustment_actions', 'id="action-form"');
} ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue">
            <i class="fa-fw fa fa-sliders"></i><?= lang('quantity_adjustments'); ?>
            <?php if ($warehouse): ?>
                <span class="label label-primary" style="font-size: 11px; margin-left: 6px; border-radius: 6px; vertical-align: middle;">
                    <i class="fa fa-building"></i> <?= $warehouse->name; ?>
                </span>
            <?php else: ?>
                <span class="label label-default" style="font-size: 11px; margin-left: 6px; border-radius: 6px; vertical-align: middle;">
                    <i class="fa fa-cubes"></i> <?= lang('all_warehouses'); ?>
                </span>
            <?php endif; ?>
        </h2>
        <div class="box-icon">
            <div style="display: inline-flex; align-items: center; gap: 8px; margin-right: 12px;">
                <a href="<?= admin_url('products/add_adjustment'); ?>" class="btn btn-primary btn-sm" style="border-radius: 8px; font-weight: 700; padding: 6px 14px; box-shadow: 0 2px 6px rgba(37,99,235,0.25);">
                    <i class="fa fa-plus-circle" style="margin-right: 4px;"></i> <?= lang('add_adjustment'); ?>
                </a>
                <a href="<?= admin_url('products/add_adjustment_by_csv'); ?>" class="btn btn-default btn-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px; background: #ffffff;">
                    <i class="fa fa-file-excel-o text-success" style="margin-right: 4px;"></i> <?= lang('add_adjustment_by_csv'); ?>
                </a>
            </div>

            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= admin_url('products/add_adjustment') ?>">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_adjustment') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= admin_url('products/add_adjustment_by_csv') ?>">
                                <i class="fa fa-file-excel-o"></i> <?= lang('add_adjustment_by_csv') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                            </a>
                        </li>
                        <?php if ($Owner || $Admin): ?>
                            <li class="divider"></li>
                            <li>
                                <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_products') ?></b>"
                                    data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></button> <button class='btn bpo-close'><?= lang('no') ?></button>"
                                    data-html="true" data-placement="left">
                                    <i class="fa fa-trash-o text-danger"></i> <?= lang('delete_products') ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php if (!empty($warehouses)): ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon fa fa-building-o tip" data-placement="left" title="<?= lang('warehouses') ?>"></i>
                        </a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?= admin_url('products/quantity_adjustments') ?>"><i class="fa fa-building-o"></i> <?= lang('all_warehouses') ?></a></li>
                            <li class="divider"></li>
                            <?php foreach ($warehouses as $wh): ?>
                                <li>
                                    <a href="<?= admin_url('products/quantity_adjustments/' . $wh->id); ?>">
                                        <i class="fa fa-building"></i> <?= $wh->name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext" style="color: #64748b; margin-bottom: 16px;">
                    <i class="fa fa-info-circle text-primary" style="margin-right: 4px;"></i> <?= lang('list_results'); ?> Haga clic en cualquier registro para ver el detalle del ajuste.
                </p>

                <div class="table-responsive">
                    <table id="dmpData" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkft" type="checkbox" name="check"/>
                                </th>
                                <th class="col-xs-2"><i class="fa fa-calendar" style="margin-right: 6px; color: #2563eb;"></i><?= lang('date'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-hashtag" style="margin-right: 6px; color: #2563eb;"></i><?= lang('reference_no'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-building-o" style="margin-right: 6px; color: #2563eb;"></i><?= lang('warehouse'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-user" style="margin-right: 6px; color: #2563eb;"></i><?= lang('created_by'); ?></th>
                                <th><i class="fa fa-comment-o" style="margin-right: 6px; color: #2563eb;"></i><?= lang('note'); ?></th>
                                <th style="min-width:35px; width: 35px; text-align: center;"><i class="fa fa-chain" title="<?= lang('attachment') ?>"></i></th>
                                <th style="min-width:75px; width: 85px; text-align:center;"><i class="fa fa-cog"></i> <?= lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                            </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                            <tr class="active">
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkft" type="checkbox" name="check"/>
                                </th>
                                <th></th><th></th><th></th><th></th><th></th>
                                <th style="min-width:35px; width: 35px; text-align: center;"><i class="fa fa-chain"></i></th>
                                <th style="width:75px; text-align:center;"><?= lang('actions'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']): ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
<?php endif; ?>
