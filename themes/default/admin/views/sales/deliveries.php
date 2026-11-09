<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Calculate delivery metrics from database
$q_stats = $this->db->query("SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN status = 'packing' THEN 1 ELSE 0 END) as packing,
    SUM(CASE WHEN status = 'delivering' THEN 1 ELSE 0 END) as delivering,
    SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered
FROM {$this->db->dbprefix('deliveries')}");
$del_stats = $q_stats ? $q_stats->row() : null;
$total_del = $del_stats ? (int)$del_stats->total : 0;
$packing_del = $del_stats ? (int)$del_stats->packing : 0;
$delivering_del = $del_stats ? (int)$del_stats->delivering : 0;
$delivered_del = $del_stats ? (int)$del_stats->delivered : 0;
?>

<style>
    .del-kpi-card {
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
    .del-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .del-kpi-card.active-filter {
        border-color: #2563eb;
        background-color: #eff6ff;
    }
    .del-kpi-info h4 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
    }
    .del-kpi-info span {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .del-kpi-icon {
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

    .delivery-status-pill {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-align: center;
        letter-spacing: 0.3px;
    }
    .pill-delivered { background-color: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .pill-delivering { background-color: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .pill-packing { background-color: #fef3c7; color: #b45309; border: 1px solid #fde68a; }

    .deliveries-header-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }
    .deliveries-title-wrap h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .deliveries-title-wrap p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .deliveries-actions-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    #DOData {
        border-radius: 8px;
        overflow: hidden;
    }
    #DOData thead th {
        background-color: #f8fafc !important;
        color: #334155 !important;
        font-weight: 600 !important;
        border-bottom: 2px solid #e2e8f0 !important;
        font-size: 12px !important;
    }
    #DOData tbody tr {
        transition: background-color 0.15s ease;
    }
    #DOData tbody tr:hover {
        background-color: #f1f5f9 !important;
    }
</style>

<script>
    $(document).ready(function () {
        var dss = <?= json_encode(['packing' => lang('packing'), 'delivering' => lang('delivering'), 'delivered' => lang('delivered')]); ?>;
        function ds(x) {
            if (x == 'delivered') {
                return '<div class="text-center"><span class="delivery-status-pill pill-delivered"><i class="fa fa-check-circle"></i> '+(dss[x] ? dss[x] : x)+'</span></div>';
            } else if (x == 'delivering') {
                return '<div class="text-center"><span class="delivery-status-pill pill-delivering"><i class="fa fa-truck"></i> '+(dss[x] ? dss[x] : x)+'</span></div>';
            } else if (x == 'packing') {
                return '<div class="text-center"><span class="delivery-status-pill pill-packing"><i class="fa fa-archive"></i> '+(dss[x] ? dss[x] : x)+'</span></div>';
            }
            return (x != null) ? (dss[x] ? dss[x] : x) : x;
        }

        oTable = $('#DOData').dataTable({
            "aaSorting": [[1, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('sales/getDeliveries') ?>',
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
                nRow.className = "delivery_link";
                return nRow;
            },
            "aoColumns": [{"bSortable": false,"mRender": checkbox}, {"mRender": fld}, null, null, null, null, {"mRender": ds}, {"bSortable": false,"mRender": attachment}, {"bSortable": false}]
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('do_reference_no');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('sale_reference_no');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('customer');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('address');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('status');?>]", filter_type: "text", data: []},
        ], "footer");

        // KPI card filter integration
        $('.del-kpi-card').on('click', function(e) {
            e.preventDefault();
            var filterVal = $(this).data('filter');
            $('.del-kpi-card').removeClass('active-filter');

            var filterInput = $('#DOData tfoot tr th:nth-child(7) input');
            if (filterInput.length) {
                if (filterVal) {
                    $(this).addClass('active-filter');
                    filterInput.val(filterVal).keyup();
                } else {
                    filterInput.val('').keyup();
                }
            }
        });
    });
</script>

<!-- KPI Cards -->
<div class="row" style="margin-top: 10px;">
    <div class="col-sm-6 col-md-3">
        <div class="del-kpi-card" data-filter="" title="Ver todos los envíos">
            <div class="del-kpi-info">
                <h4><?= number_format($total_del, 0, ',', '.') ?></h4>
                <span><?= lang('all'); ?> Envíos</span>
            </div>
            <div class="del-kpi-icon kpi-icon-blue">
                <i class="fa fa-cubes"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="del-kpi-card" data-filter="packing" title="Filtrar por empacando">
            <div class="del-kpi-info">
                <h4><?= number_format($packing_del, 0, ',', '.') ?></h4>
                <span><?= lang('packing'); ?></span>
            </div>
            <div class="del-kpi-icon kpi-icon-amber">
                <i class="fa fa-archive"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="del-kpi-card" data-filter="delivering" title="Filtrar por en ruta">
            <div class="del-kpi-info">
                <h4><?= number_format($delivering_del, 0, ',', '.') ?></h4>
                <span><?= lang('delivering'); ?></span>
            </div>
            <div class="del-kpi-icon kpi-icon-indigo">
                <i class="fa fa-truck"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="del-kpi-card" data-filter="delivered" title="Filtrar por entregados">
            <div class="del-kpi-info">
                <h4><?= number_format($delivered_del, 0, ',', '.') ?></h4>
                <span><?= lang('delivered'); ?></span>
            </div>
            <div class="del-kpi-icon kpi-icon-green">
                <i class="fa fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<?php if ($Owner) {
    ?><?= admin_form_open('sales/delivery_actions', 'id="action-form"') ?><?php
} ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-truck"></i><?= lang('deliveries'); ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_deliveries') ?></b>" 
                                data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>" 
                                data-html="true" data-placement="left">
                                <i class="fa fa-trash-o"></i> <?= lang('delete_deliveries') ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="deliveries-header-bar">
                    <div class="deliveries-title-wrap">
                        <h3><i class="fa fa-list-alt text-primary"></i> <?= lang('deliveries'); ?></h3>
                        <p><?= lang('list_results'); ?> &bull; Administre el despacho, embalaje y entrega de sus pedidos de venta.</p>
                    </div>
                    <div class="deliveries-actions-wrap">
                        <button type="button" class="btn btn-default btn-sm" onclick="$('#excel').click();" title="Exportar a Excel">
                            <i class="fa fa-file-excel-o text-success"></i> Exportar
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="DOData" class="table table-bordered table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('do_reference_no'); ?></th>
                            <th><?= lang('sale_reference_no'); ?></th>
                            <th><?= lang('customer'); ?></th>
                            <th><?= lang('address'); ?></th>
                            <th><?= lang('status'); ?></th>
                            <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                            <th style="width:100px; text-align:center;"><?= lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="9" class="dataTables_empty"><?= lang('loading_data'); ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th><th></th><th></th><th></th><th></th><th></th>
                            <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                            <th style="width:100px; text-align:center;"><?= lang('actions'); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($Owner) {
        ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('perform_action', 'perform_action', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                $('#form_action').val($(this).attr('data-action'));
                //$('#action-form').submit();
                $('#action-form-submit').click();
            });
        });
    </script>
<?php
    } ?>
