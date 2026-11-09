<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Compute quick inventory metrics for situational awareness
$pr_stats_q = $this->db->query("SELECT
    COUNT(*) as total_products,
    SUM(CASE WHEN quantity > COALESCE(alert_quantity, 0) THEN 1 ELSE 0 END) as in_stock,
    SUM(CASE WHEN quantity <= COALESCE(alert_quantity, 0) AND quantity > 0 THEN 1 ELSE 0 END) as low_stock,
    SUM(CASE WHEN quantity <= 0 THEN 1 ELSE 0 END) as out_of_stock,
    COALESCE(SUM(quantity), 0) as total_units
    FROM " . $this->db->dbprefix('products'));
$stats = $pr_stats_q ? $pr_stats_q->row() : null;
?>
<style type="text/css" media="screen">
    /* Modern UI/UX Styles for Products Catalog */
    .products-page-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    /* Metric KPI Cards */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .metric-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08);
    }
    .metric-info h4 {
        margin: 0 0 4px 0;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        color: #64748b;
    }
    .metric-info .metric-num {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    .metric-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .metric-icon-blue { background: #eff6ff; color: #2563eb; }
    .metric-icon-green { background: #dcfce7; color: #16a34a; }
    .metric-icon-amber { background: #fef3c7; color: #d97706; }
    .metric-icon-red { background: #fee2e2; color: #dc2626; }

    /* Modern Table Card */
    .table-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .table-card-header {
        padding: 18px 24px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .table-card-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .table-card-title h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }
    .wh-active-badge {
        background: #f1f5f9;
        color: #475569;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
        border: 1px solid #e2e8f0;
    }
    .table-card-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .btn-action-primary {
        background: #2563eb;
        border: 1px solid #2563eb;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 13.5px;
        padding: 8px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.15s;
        box-shadow: 0 1px 2px rgba(37,99,235,0.2);
    }
    .btn-action-primary:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
        color: #ffffff !important;
        box-shadow: 0 4px 6px -1px rgba(37,99,235,0.3);
    }
    .btn-action-secondary {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155 !important;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 14px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s;
    }
    .btn-action-secondary:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        color: #0f172a !important;
    }

    /* Enhanced DataTables Styling */
    #PRData {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        margin-bottom: 0 !important;
    }
    #PRData thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        border-top: none !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 12px 14px !important;
    }
    #PRData tbody td {
        padding: 12px 14px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        border-bottom: none !important;
        color: #1e293b;
        font-size: 13.5px;
    }
    #PRData tbody tr:hover td {
        background-color: #f8fafc !important;
    }
    #PRData tbody tr.product_link {
        cursor: pointer;
    }
    /* Product Code badge */
    #PRData td:nth-child(3) {
        font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 12.5px;
        font-weight: 600;
        color: #2563eb;
    }
    /* Product Name */
    #PRData td:nth-child(4) {
        font-weight: 600;
        color: #0f172a;
    }
    /* Cost */
    #PRData td:nth-child(7) {
        color: #64748b;
        font-weight: 500;
        text-align: right;
    }
    /* Price */
    #PRData td:nth-child(8) {
        color: #16a34a;
        font-weight: 700;
        text-align: right;
    }
    /* Quantity */
    #PRData td:nth-child(9) {
        font-weight: 600;
    }
    /* Product Image thumbnails */
    #PRData img {
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        object-fit: cover;
    }
    #PRData img:hover {
        transform: scale(1.4);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.15);
        z-index: 10;
        position: relative;
    }
    /* Column Filter Inputs */
    tfoot.dtFilter th {
        background: #f8fafc !important;
        border-top: 1px solid #e2e8f0 !important;
        padding: 8px 10px !important;
    }
    tfoot.dtFilter input {
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        height: 32px !important;
        padding: 4px 8px !important;
        font-size: 12px !important;
        box-shadow: none !important;
        width: 100% !important;
        background: #ffffff !important;
        transition: border-color 0.2s;
    }
    tfoot.dtFilter input:focus {
        border-color: #3b82f6 !important;
        outline: none;
    }
    /* DataTables Controls bar */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        padding: 12px 20px;
    }
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 16px 20px;
    }
    .pagination > .active > a,
    .pagination > .active > a:hover {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
    }
</style>

<script>
    var oTable;
    $(document).ready(function () {
        oTable = $('#PRData').dataTable({
            "aaSorting": [[2, "asc"], [3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('products/getProducts' . ($warehouse_id ? '/' . $warehouse_id : '') . ($supplier ? '?supplier=' . $supplier->id : '')) ?>',
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
                nRow.className = "product_link";
                return nRow;
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox}, {"bSortable": false,"mRender": img_hl}, null, null, null, null, <?php if ($Owner || $Admin) {
                    echo '{"mRender": currencyFormat}, {"mRender": currencyFormat},';
                } else {
                    if ($this->session->userdata('show_cost')) {
                        echo '{"mRender": currencyFormat},';
                    }
                    if ($this->session->userdata('show_price')) {
                        echo '{"mRender": currencyFormat},';
                    }
                } ?> {"mRender": formatQuantity}, null, <?php if (!$warehouse_id || !$Settings->racks) {
                    echo '{"bVisible": false},';
                } else {
                    echo '{"bSortable": true},';
                } ?> {"mRender": formatQuantity}, {"bSortable": false}
            ]
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 2, filter_default_label: "[<?=lang('code');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('name');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('brand');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('category');?>]", filter_type: "text", data: []},
            <?php $col = 5;
            if ($Owner || $Admin) {
                echo '{column_number : 6, filter_default_label: "[' . lang('cost') . ']", filter_type: "text", data: [] },';
                echo '{column_number : 7, filter_default_label: "[' . lang('price') . ']", filter_type: "text", data: [] },';
                $col += 2;
            } else {
                if ($this->session->userdata('show_cost')) {
                    $col++;
                    echo '{column_number : ' . $col . ', filter_default_label: "[' . lang('cost') . ']", filter_type: "text", data: [] },';
                }
                if ($this->session->userdata('show_price')) {
                    $col++;
                    echo '{column_number : ' . $col . ', filter_default_label: "[' . lang('price') . ']", filter_type: "text, data: []" },';
                }
            }
            ?>
            {column_number: <?php $col++; echo $col; ?>, filter_default_label: "[<?=lang('quantity');?>]", filter_type: "text", data: []},
            {column_number: <?php $col++; echo $col; ?>, filter_default_label: "[<?=lang('unit');?>]", filter_type: "text", data: []},
            <?php $col++; if ($warehouse_id && $Settings->racks) {
                echo '{column_number : ' . $col . ', filter_default_label: "[' . lang('rack') . ']", filter_type: "text", data: [] },';
            } ?>
            {column_number: <?php $col++; echo $col; ?>, filter_default_label: "[<?=lang('alert_quantity');?>]", filter_type: "text", data: []},
        ], "footer");

    });
</script>

<div class="products-page-container">

    <!-- KPI Metrics Dashboard -->
    <div class="metrics-grid">
        <div class="metric-card">
            <div class="metric-info">
                <h4>Total Productos</h4>
                <div class="metric-num"><?= $stats ? number_format($stats->total_products) : '0'; ?></div>
            </div>
            <div class="metric-icon-box metric-icon-blue">
                <i class="fa fa-cubes"></i>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-info">
                <h4>Stock Disponible</h4>
                <div class="metric-num" style="color: #16a34a;"><?= $stats ? number_format($stats->in_stock) : '0'; ?></div>
            </div>
            <div class="metric-icon-box metric-icon-green">
                <i class="fa fa-check-circle"></i>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-info">
                <h4>Stock Bajo (Alerta)</h4>
                <div class="metric-num" style="color: #d97706;"><?= $stats ? number_format($stats->low_stock) : '0'; ?></div>
            </div>
            <div class="metric-icon-box metric-icon-amber">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
        </div>

        <div class="metric-card">
            <div class="metric-info">
                <h4>Agotados</h4>
                <div class="metric-num" style="color: #dc2626;"><?= $stats ? number_format($stats->out_of_stock) : '0'; ?></div>
            </div>
            <div class="metric-icon-box metric-icon-red">
                <i class="fa fa-times-circle"></i>
            </div>
        </div>
    </div>

    <?php if ($Owner || $GP['bulk_actions']) {
        echo admin_form_open('products/product_actions' . ($warehouse_id ? '/' . $warehouse_id : ''), 'id="action-form"');
    } ?>

    <!-- Main Table Card -->
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">
                <i class="fa fa-barcode text-primary" style="font-size: 20px;"></i>
                <h2><?= lang('products'); ?></h2>
                <span class="wh-active-badge">
                    <i class="fa fa-building-o" style="margin-right: 4px;"></i>
                    <?= ($warehouse_id ? $warehouse->name : lang('all_warehouses')) . ($supplier ? ' | Proveedor: ' . ($supplier->company && $supplier->company != '-' ? $supplier->company : $supplier->name) : ''); ?>
                </span>
            </div>

            <!-- Action Buttons Toolbar -->
            <div class="table-card-actions">
                <a href="<?= admin_url('products/add') ?>" class="btn btn-action-primary">
                    <i class="fa fa-plus-circle"></i> <?= lang('add_product') ?>
                </a>

                <?php if (!empty($warehouses)) { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-action-secondary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-building-o"></i> <?= $warehouse_id ? $warehouse->name : lang('all_warehouses'); ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="<?= admin_url('products') ?>"><i class="fa fa-building-o"></i> <?= lang('all_warehouses') ?></a></li>
                        <li class="divider"></li>
                        <?php foreach ($warehouses as $wh) {
                            echo '<li><a href="' . admin_url('products/' . $wh->id) . '"><i class="fa fa-building"></i> ' . $wh->name . '</a></li>';
                        } ?>
                    </ul>
                </div>
                <?php } ?>

                <a href="#" id="excel" data-action="export_excel" class="btn btn-action-secondary" title="<?= lang('export_to_excel') ?>">
                    <i class="fa fa-file-excel-o text-success"></i> Excel
                </a>

                <a href="#" id="labelProducts" data-action="labels" class="btn btn-action-secondary" title="<?= lang('print_barcode_label') ?>">
                    <i class="fa fa-print text-primary"></i> Etiquetas
                </a>

                <div class="btn-group">
                    <button type="button" class="btn btn-action-secondary dropdown-toggle" data-toggle="dropdown" title="Más Acciones">
                        <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <?php if (!$warehouse_id) { ?>
                        <li>
                            <a href="<?= admin_url('products/update_price') ?>" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-dollar"></i> <?= lang('update_price') ?>
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="#" id="sync_quantity" data-action="sync_quantity">
                                <i class="fa fa-refresh"></i> <?= lang('sync_quantity') ?>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="set_avg_cost" data-action="set_avg_cost">
                                <i class="fa fa-calculator"></i> <?= lang('set_avg_cost') ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo text-danger" title="<b><?= $this->lang->line('delete_products') ?></b>"
                                data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></button> <button class='btn bpo-close'><?= lang('no') ?></button>"
                                data-html="true" data-placement="left">
                                <i class="fa fa-trash-o text-danger"></i> <?= lang('delete_products') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- DataTable Container -->
        <div class="table-responsive" style="margin: 0; padding: 0;">
            <table id="PRData" class="table table-hover table-striped">
                <thead>
                    <tr class="primary">
                        <th style="min-width:30px; width: 30px; text-align: center;">
                            <input class="checkbox checkth" type="checkbox" name="check"/>
                        </th>
                        <th style="min-width:48px; width: 48px; text-align: center;"><?php echo $this->lang->line('image'); ?></th>
                        <th><?= lang('code') ?></th>
                        <th><?= lang('name') ?></th>
                        <th><?= lang('brand') ?></th>
                        <th><?= lang('category') ?></th>
                        <?php
                        if ($Owner || $Admin) {
                            echo '<th>' . lang('cost') . '</th>';
                            echo '<th>' . lang('price') . '</th>';
                        } else {
                            if ($this->session->userdata('show_cost')) {
                                echo '<th>' . lang('cost') . '</th>';
                            }
                            if ($this->session->userdata('show_price')) {
                                echo '<th>' . lang('price') . '</th>';
                            }
                        }
                        ?>
                        <th><?= lang('quantity') ?></th>
                        <th><?= lang('unit') ?></th>
                        <th><?= lang('rack') ?></th>
                        <th><?= lang('alert_quantity') ?></th>
                        <th style="min-width:70px; text-align:center;"><?= lang('actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="12" class="dataTables_empty" style="text-align: center; padding: 30px; color: #64748b;">
                            <i class="fa fa-spinner fa-spin fa-2x"></i><br><span style="margin-top: 8px; display: inline-block;"><?= lang('loading_data_from_server'); ?></span>
                        </td>
                    </tr>
                </tbody>

                <tfoot class="dtFilter">
                    <tr class="active">
                        <th style="min-width:30px; width: 30px; text-align: center;">
                            <input class="checkbox checkft" type="checkbox" name="check"/>
                        </th>
                        <th style="min-width:48px; width: 48px; text-align: center;"><?php echo $this->lang->line('image'); ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <?php
                        if ($Owner || $Admin) {
                            echo '<th></th>';
                            echo '<th></th>';
                        } else {
                            if ($this->session->userdata('show_cost')) {
                                echo '<th></th>';
                            }
                            if ($this->session->userdata('show_price')) {
                                echo '<th></th>';
                            }
                        }
                        ?>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="width:70px; text-align:center;"><?= lang('actions') ?></th>
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

</div>
