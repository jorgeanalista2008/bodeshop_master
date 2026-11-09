<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    var oTable;
    $(document).ready(function () {
        function count_type(x) {
            if (x == 'full') {
                return '<div class="text-center"><span class="label label-success" style="font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 6px;"><i class="fa fa-cubes" style="margin-right: 4px;"></i> <?= lang('full'); ?></span></div>';
            } else if (x == 'partial') {
                return '<div class="text-center"><span class="label label-primary" style="font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 6px;"><i class="fa fa-tag" style="margin-right: 4px;"></i> <?= lang('partial'); ?></span></div>';
            } else {
                return '<div class="text-center"><span class="label label-default" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;">' + x + '</span></div>';
            }
        }
        oTable = $('#STData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('products/getCounts' . ($warehouse_id ? '/' . $warehouse_id : '')) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[0]; 
                nRow.className = "count_link";
                // Reference badge
                $('td:eq(2)', nRow).html('<span class="qa-ref-badge"><i class="fa fa-hashtag"></i> ' + aData[2] + '</span>');
                // Warehouse formatting
                if (aData[3]) {
                    $('td:eq(3)', nRow).html('<span style="font-weight: 600; color: #1e293b;"><i class="fa fa-building-o text-muted" style="margin-right: 5px;"></i>' + aData[3] + '</span>');
                }
                // Brands empty fallback
                if (!aData[5] || aData[5] === '') {
                    $('td:eq(5)', nRow).html('<span class="text-muted" style="font-style: italic; font-size: 11px;">Todas</span>');
                }
                // Categories empty fallback
                if (!aData[6] || aData[6] === '') {
                    $('td:eq(6)', nRow).html('<span class="text-muted" style="font-style: italic; font-size: 11px;">Todas</span>');
                }
                return nRow;
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox}, 
                {"mRender": fld}, 
                null, 
                null, 
                {"mRender": count_type}, 
                null, 
                null, 
                {"bSortable": false, "mRender": attachment2}, 
                {"bSortable": false, "mRender": attachment}, 
                {"bSortable": false}
            ]
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('reference');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('warehouse');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('type');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('brands');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('categories');?>]", filter_type: "text", data: []},
        ], "footer");

    });
</script>

<?php 
// Calculate high-level KPIs for stock counts
$wh_clause = $warehouse_id ? "WHERE warehouse_id = " . (int)$warehouse_id : "";
$kpi_counts = $this->db->query("
    SELECT 
        COUNT(id) as total_counts,
        COUNT(CASE WHEN type = 'full' THEN 1 END) as full_counts,
        COUNT(CASE WHEN type = 'partial' THEN 1 END) as partial_counts,
        COUNT(CASE WHEN final_file IS NOT NULL AND final_file != '' THEN 1 END) as finalized_counts
    FROM " . $this->db->dbprefix('stock_counts') . "
    " . $wh_clause
)->row();

$tot_cnt = $kpi_counts ? (int)$kpi_counts->total_counts : 0;
$full_cnt = $kpi_counts ? (int)$kpi_counts->full_counts : 0;
$part_cnt = $kpi_counts ? (int)$kpi_counts->partial_counts : 0;
$fin_cnt = $kpi_counts ? (int)$kpi_counts->finalized_counts : 0;
?>

<!-- KPI Overview Grid -->
<div class="qa-kpi-grid">
    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #eff6ff; color: #2563eb;">
            <i class="fa fa-clipboard"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value"><?= $tot_cnt; ?></h3>
            <p class="qa-kpi-title">Total Conteos</p>
            <span class="qa-kpi-sub">Auditorías registradas</span>
        </div>
    </div>

    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #ecfdf5; color: #059669;">
            <i class="fa fa-cubes"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value" style="color: #059669;"><?= $full_cnt; ?></h3>
            <p class="qa-kpi-title">Auditorías Totales</p>
            <span class="qa-kpi-sub">Conteo completo de almacén</span>
        </div>
    </div>

    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
            <i class="fa fa-tags"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value" style="color: #7c3aed;"><?= $part_cnt; ?></h3>
            <p class="qa-kpi-title">Conteos Parciales</p>
            <span class="qa-kpi-sub">Por marcas o categorías</span>
        </div>
    </div>

    <div class="qa-kpi-card">
        <div class="qa-kpi-icon" style="background: #f0fdf4; color: #16a34a;">
            <i class="fa fa-check-circle-o"></i>
        </div>
        <div class="qa-kpi-info">
            <h3 class="qa-kpi-value" style="color: #16a34a;"><?= $fin_cnt; ?></h3>
            <p class="qa-kpi-title">Reconciliados</p>
            <span class="qa-kpi-sub"><?= ($tot_cnt - $fin_cnt); ?> pendientes por archivo final</span>
        </div>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('products/count_actions' . ($warehouse_id ? '/' . $warehouse_id : ''), 'id="action-form"');
} ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue">
            <i class="fa-fw fa fa-clipboard"></i>
            <?= lang('stock_counts'); ?>
            <?php if ($warehouse_id && $warehouse): ?>
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
                <a href="<?= admin_url('products/count_stock'); ?>" class="btn btn-primary btn-sm" style="border-radius: 8px; font-weight: 700; padding: 6px 14px; box-shadow: 0 2px 6px rgba(37,99,235,0.25);">
                    <i class="fa fa-plus-circle" style="margin-right: 4px;"></i> <?= lang('count_stock'); ?>
                </a>
            </div>

            <ul class="btn-tasks">
                <?php if (!empty($warehouses)): ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon fa fa-building-o tip" data-placement="left" title="<?= lang('warehouses') ?>"></i>
                        </a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?= admin_url('products/stock_counts') ?>"><i class="fa fa-building-o"></i> <?= lang('all_warehouses') ?></a></li>
                            <li class="divider"></li>
                            <?php foreach ($warehouses as $wh): ?>
                                <li>
                                    <a href="<?= admin_url('products/stock_counts/' . $wh->id); ?>">
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
                    <i class="fa fa-info-circle text-primary" style="margin-right: 4px;"></i> <?= lang('list_results'); ?> Haga clic en cualquier fila para inspeccionar los detalles de la auditoría y discrepancias.
                </p>

                <div class="table-responsive">
                    <table id="STData" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkth" type="checkbox" name="check"/>
                                </th>
                                <th class="col-xs-2"><i class="fa fa-calendar text-primary" style="margin-right: 6px;"></i><?= lang('date'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-hashtag text-primary" style="margin-right: 6px;"></i><?= lang('reference'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-building-o text-primary" style="margin-right: 6px;"></i><?= lang('warehouse'); ?></th>
                                <th class="col-xs-1 text-center"><i class="fa fa-sliders text-primary" style="margin-right: 6px;"></i><?= lang('type'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-tags text-primary" style="margin-right: 6px;"></i><?= lang('brands'); ?></th>
                                <th class="col-xs-2"><i class="fa fa-folder-o text-primary" style="margin-right: 6px;"></i><?= lang('categories'); ?></th>
                                <th style="max-width:35px; text-align:center;"><i class="fa fa-file-excel-o text-primary" title="<?= lang('initial_file'); ?>"></i></th>
                                <th style="max-width:35px; text-align:center;"><i class="fa fa-check-circle-o text-success" title="<?= lang('final_file'); ?>"></i></th>
                                <th style="max-width:75px; width: 85px; text-align:center;"><i class="fa fa-cog"></i> <?= lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="10" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
                            </tr>
                        </tbody>

                        <tfoot class="dtFilter">
                            <tr class="active">
                                <th style="min-width:30px; width: 30px; text-align: center;">
                                    <input class="checkbox checkft" type="checkbox" name="check"/>
                                </th>
                                <th></th><th></th><th></th><th></th><th></th><th></th>
                                <th style="max-width:35px; text-align:center;"><i class="fa fa-file-excel-o"></i></th>
                                <th style="max-width:35px; text-align:center;"><i class="fa fa-check-circle-o"></i></th>
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
