<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 18px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }
    .kpi-card.active-filter {
        border-color: #2563eb;
        background: #f8fafc;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }
    .kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .kpi-title {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .kpi-value {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
</style>

<script>
    var currentFilter = null;
    $(document).ready(function () {
        oTable = $('#TOData').dataTable({
            "aaSorting": [[1, "desc"], [2, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('transfers/getTransfers') ?>',
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
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                {"mRender": row_status},
                {"bSortable": false, "mRender": attachment},
                {"bSortable": false}
            ],
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "transfer_link";
                return nRow;
            },
            "fnDrawCallback": function (oSettings) {
                var total = oSettings.fnRecordsTotal();
                $("#kpi_total_transfers").text(total);
                
                var rows = oSettings.aoData;
                var completed = 0, sent = 0, pending = 0;
                for (var i = 0; i < rows.length; i++) {
                    var st = rows[i]._aData[8];
                    if (st == "completed") completed++;
                    else if (st == "sent") sent++;
                    else if (st == "pending") pending++;
                }
                $("#kpi_completed_transfers").text(completed);
                $("#kpi_sent_transfers").text(sent);
                $("#kpi_pending_transfers").text(pending);
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var row_total = 0, tax = 0, gtotal = 0;
                for (var i = 0; i < aaData.length; i++) {
                    row_total += parseFloat(aaData[aiDisplay[i]][5]);
                    tax += parseFloat(aaData[aiDisplay[i]][6]);
                    gtotal += parseFloat(aaData[aiDisplay[i]][7]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[5].innerHTML = currencyFormat(formatMoney(row_total));
                nCells[6].innerHTML = currencyFormat(formatMoney(tax));
                nCells[7].innerHTML = currencyFormat(formatMoney(gtotal));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('ref_no');?>]", filter_type: "text", data: []},
            {
                column_number: 3,
                filter_default_label: "[<?=lang('warehouse') . ' (' . lang('from') . ')';?>]",
                filter_type: "text", data: []
            },
            {
                column_number: 4,
                filter_default_label: "[<?=lang('warehouse') . ' (' . lang('to') . ')';?>]",
                filter_type: "text", data: []
            },
            {column_number: 8, filter_default_label: "[<?=lang('status');?>]", filter_type: "text", data: []},
        ], "footer");

        // KPI Card click-to-filter
        $('.kpi-card').click(function () {
            var filter = $(this).data('filter');
            if (currentFilter === filter) {
                $('.kpi-card').removeClass('active-filter');
                currentFilter = null;
                oTable.fnFilter('', 8);
            } else {
                $('.kpi-card').removeClass('active-filter');
                $(this).addClass('active-filter');
                currentFilter = filter;
                oTable.fnFilter(filter, 8);
            }
        });
    });
</script>
<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('transfers/transfer_actions', 'id="action-form"');
} ?>
<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-exchange"></i>
            </span>
            <?= lang('transfers'); ?>
        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= admin_url('transfers/add') ?>">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_transfer') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= admin_url('transfers/transfer_by_csv') ?>">
                                <i class="fa fa-file-excel-o"></i> <?= lang('add_transfer_by_csv') ?>
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
                            <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_transfers') ?></b>"
                             data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>"
                             data-html="true" data-placement="left">
                             <i class="fa fa-trash-o"></i> <?= lang('delete_transfers') ?>
                         </a>
                     </li>
                 </ul>
             </li>
            </ul>
        </div>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">

                <!-- 4 KPI METRIC CARDS -->
                <div class="row" style="margin-bottom: 22px;">
                    <div class="col-md-3 col-sm-6">
                        <div class="kpi-card" data-filter="">
                            <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <div>
                                <div class="kpi-title">Total Traslados</div>
                                <div class="kpi-value" id="kpi_total_transfers">--</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="kpi-card" data-filter="completed">
                            <div class="kpi-icon" style="background: #ecfdf5; color: #059669;">
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div>
                                <div class="kpi-title">Completadas</div>
                                <div class="kpi-value" style="color: #059669;" id="kpi_completed_transfers">--</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="kpi-card" data-filter="sent">
                            <div class="kpi-icon" style="background: #fff7ed; color: #ea580c;">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div>
                                <div class="kpi-title">En Tránsito</div>
                                <div class="kpi-value" style="color: #ea580c;" id="kpi_sent_transfers">--</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="kpi-card" data-filter="pending">
                            <div class="kpi-icon" style="background: #fef2f2; color: #dc2626;">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <div>
                                <div class="kpi-title">Pendientes</div>
                                <div class="kpi-value" style="color: #dc2626;" id="kpi_pending_transfers">--</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS BAR -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <span style="font-weight: 700; color: #0f172a; font-size: 15px;"><i class="fa fa-list text-primary" style="margin-right: 6px;"></i> Registro de Transferencias Entre Almacenes</span>
                        <span class="text-muted" style="font-size: 13px; margin-left: 10px;">Haga clic en una tarjeta KPI para filtrar por estado</span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="<?= admin_url('transfers/transfer_by_csv'); ?>" class="btn btn-default" style="border-radius: 6px; font-weight: 600; padding: 8px 14px;">
                            <i class="fa fa-file-excel-o text-success" style="margin-right: 5px;"></i> <?= lang('add_transfer_by_csv'); ?>
                        </a>
                        <a href="<?= admin_url('transfers/add'); ?>" class="btn btn-primary" style="border-radius: 6px; font-weight: 700; padding: 8px 16px;">
                            <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <?= lang('add_transfer'); ?>
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="TOData" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('ref_no'); ?></th>
                            <th><?= lang('warehouse') . ' (' . lang('from') . ')'; ?></th>
                            <th><?= lang('warehouse') . ' (' . lang('to') . ')'; ?></th>
                            <th><?= lang('total'); ?></th>
                            <th><?= lang('product_tax'); ?></th>
                            <th><?= lang('grand_total'); ?></th>
                            <th><?= lang('status'); ?></th>
                            <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                            <th style="width:100px;"><?= lang('actions'); ?></th>
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
