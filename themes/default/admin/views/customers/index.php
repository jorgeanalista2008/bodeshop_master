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
    .modern-action-bar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .action-btn-primary {
        background: #2563eb;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 13px;
        padding: 9px 18px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: background 0.15s ease;
    }
    .action-btn-primary:hover {
        background: #1d4ed8;
    }
    .action-btn-secondary {
        background: #f1f5f9;
        color: #334155 !important;
        font-weight: 600;
        font-size: 13px;
        padding: 9px 16px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid #e2e8f0;
        transition: all 0.15s ease;
    }
    .action-btn-secondary:hover {
        background: #e2e8f0;
        color: #0f172a !important;
    }
</style>

<script>
    var currentFilter = null;
    $(document).ready(function () {
        var cTable = $('#CusData').dataTable({
            "aaSorting": [[1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('customers/getCustomers') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[0];
                nRow.className = "customer_details_link";
                return nRow;
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {"mRender": currencyFormat},
                null,
                {"bSortable": false}
            ],
            "fnDrawCallback": function (oSettings) {
                var total = oSettings.fnRecordsTotal();
                $("#kpi_total_customers").text(total);
                
                var rows = oSettings.aoData;
                var with_phone = 0, with_email = 0, total_deposit = 0;
                for (var i = 0; i < rows.length; i++) {
                    var email = rows[i]._aData[3];
                    var phone = rows[i]._aData[4];
                    var dep = parseFloat(rows[i]._aData[9]) || 0;
                    if (email && email.trim() !== '' && email !== '-') with_email++;
                    if (phone && phone.trim() !== '' && phone !== '-') with_phone++;
                    total_deposit += dep;
                }
                $("#kpi_with_phone").text(with_phone);
                $("#kpi_with_email").text(with_email);
                $("#kpi_total_deposit").text(formatMoney(total_deposit));
            }
        }).dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('company');?>]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('name');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('email_address');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('phone');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('price_group');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('customer_group');?>]", filter_type: "text", data: []},
            {column_number: 7, filter_default_label: "[<?=lang('vat_no');?>]", filter_type: "text", data: []},
            {column_number: 8, filter_default_label: "[<?=lang('gst_no');?>]", filter_type: "text", data: []},
            {column_number: 9, filter_default_label: "[<?=lang('deposit');?>]", filter_type: "text", data: []},
            {column_number: 10, filter_default_label: "[<?=lang('award_points');?>]", filter_type: "text", data: []},
        ], "footer");

        $('#myModal').on('hidden.bs.modal', function () {
            cTable.fnDraw( false );
        });

        // Interactive KPI Filter Handlers
        $('#card_all').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            cTable.fnFilter('', 3);
            cTable.fnFilter('', 4);
            currentFilter = null;
        });

        $('#card_phone').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            cTable.fnFilter('', 3);
            cTable.fnFilter('[0-9]', 4, true, false);
            currentFilter = 'phone';
        });

        $('#card_email').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            cTable.fnFilter('', 4);
            cTable.fnFilter('@', 3);
            currentFilter = 'email';
        });
    });
</script>

<!-- ================= KPI METRIC CARDS ================= -->
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card active-filter" id="card_all" title="Ver todos los clientes">
            <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                <i class="fa fa-users"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('total_customers'); ?></div>
                <div class="kpi-value" id="kpi_total_customers">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_phone" title="Filtrar clientes con teléfono registrado">
            <div class="kpi-icon" style="background: #f0fdf4; color: #16a34a;">
                <i class="fa fa-phone"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('with_phone', 'Con Teléfono'); ?></div>
                <div class="kpi-value" id="kpi_with_phone">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_email" title="Filtrar clientes con correo registrado">
            <div class="kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
                <i class="fa fa-envelope-o"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('with_email', 'Con Email'); ?></div>
                <div class="kpi-value" id="kpi_with_email">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_deposit" title="Saldo en depósito registrado en vista">
            <div class="kpi-icon" style="background: #fffbeb; color: #d97706;">
                <i class="fa fa-money"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('deposit_balance', 'Saldo Depósitos'); ?></div>
                <div class="kpi-value" id="kpi_total_deposit">0.00</div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODERN ACTION BAR ================= -->
<div class="modern-action-bar">
    <div style="display: flex; align-items: center; gap: 10px;">
        <a href="<?= admin_url('customers/add'); ?>" data-toggle="modal" data-target="#myModal" id="add" class="action-btn-primary">
            <i class="fa fa-plus-circle"></i> <?= lang('add_customer'); ?>
        </a>
        <a href="<?= admin_url('customers/import_csv'); ?>" data-toggle="modal" data-target="#myModal" class="action-btn-secondary">
            <i class="fa fa-upload"></i> <?= lang('import_by_csv'); ?>
        </a>
    </div>
    <div style="display: flex; align-items: center; gap: 8px;">
        <?php if ($Owner) { ?>
            <a href="#" id="excel" data-action="export_excel" class="action-btn-secondary" title="<?= lang('export_to_excel') ?>">
                <i class="fa fa-file-excel-o text-success"></i> <?= lang('export_to_excel') ?>
            </a>
        <?php } ?>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 9px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 13px;">
                <i class="fa fa-ellipsis-v"></i> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="<?= admin_url('customers/add'); ?>" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus-circle"></i> <?= lang('add_customer'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?= admin_url('customers/import_csv'); ?>" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-file-text-o"></i> <?= lang('import_by_csv'); ?>
                    </a>
                </li>
                <?php if ($Owner) { ?>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_customers') ?></b>"
                           data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></button> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left">
                            <i class="fa fa-trash-o text-danger"></i> <?= lang('delete_customers') ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('customers/customer_actions', 'id="action-form"');
} ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= lang('customers'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= admin_url('customers/add'); ?>" data-toggle="modal" data-target="#myModal" id="add">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_customer'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= admin_url('customers/import_csv'); ?>" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> <?= lang('import_by_csv'); ?>
                            </a>
                        </li>
                        <?php if ($Owner) { ?>
                            <li>
                                <a href="#" id="excel" data-action="export_excel">
                                    <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_customers') ?></b>"
                                    data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></button> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left">
                                    <i class="fa fa-trash-o"></i> <?= lang('delete_customers') ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('list_results'); ?></p>

                <div class="table-responsive">
                    <table id="CusData" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkth" type="checkbox" name="check"/>
                            </th>
                            <th><?= lang('company'); ?></th>
                            <th><?= lang('name'); ?></th>
                            <th><?= lang('email_address'); ?></th>
                            <th><?= lang('phone'); ?></th>
                            <th><?= lang('price_group'); ?></th>
                            <th><?= lang('customer_group'); ?></th>
                            <th><?= lang('vat_no'); ?></th>
                            <th><?= lang('gst_no'); ?></th>
                            <th><?= lang('deposit'); ?></th>
                            <th><?= lang('award_points'); ?></th>
                            <th style="min-width:135px !important; text-align: center;"><?= lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="12" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                            <th style="min-width:135px !important;" class="text-center"><?= lang('actions'); ?></th>
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
<?php if ($action && $action == 'add') {
    echo '<script>$(document).ready(function(){$("#add").trigger("click");});</script>';
} ?>
