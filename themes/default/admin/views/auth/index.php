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
    .table td:nth-child(6) {
        text-align: right;
        width: 10%;
    }
    .table td:nth-child(8) {
        text-align: center;
    }
</style>

<script>
    var currentFilter = null;
    $(document).ready(function () {
        'use strict';
        oTable = $('#UsrTable').dataTable({
            "aaSorting": [[2, "asc"], [3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('auth/getUsers') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox},
                null,
                null,
                null,
                null,
                null,
                null,
                {"mRender": user_status},
                {"bSortable": false}
            ],
            "fnDrawCallback": function (oSettings) {
                var total = oSettings.fnRecordsTotal();
                $("#kpi_total_users").text(total);
                
                var rows = oSettings.aoData;
                var active = 0, inactive = 0, admins = 0;
                for (var i = 0; i < rows.length; i++) {
                    var grp = (rows[i]._aData[6] || '').toLowerCase();
                    var st = rows[i]._aData[7];
                    if (st == '1' || st == 1) active++;
                    else inactive++;
                    if (grp.indexOf('owner') !== -1 || grp.indexOf('admin') !== -1) admins++;
                }
                $("#kpi_active_users").text(active);
                $("#kpi_inactive_users").text(inactive);
                $("#kpi_admin_users").text(admins);
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('first_name');?>]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('last_name');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('email_address');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('company');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('award_points');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('group');?>]", filter_type: "text", data: []},
            {
                column_number: 7, select_type: 'select2',
                select_type_options: {
                    placeholder: '<?=lang('status');?>',
                    width: '100%',
                    style: 'width:100%;',
                    minimumResultsForSearch: -1,
                    allowClear: true
                },
                data: [{value: '1', label: '<?=lang('active');?>'}, {value: '0', label: '<?=lang('inactive');?>'}]
            }
        ], "footer");

        // Interactive KPI Filter Clicks
        $('#card_all').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 7);
            oTable.fnFilter('', 6);
            currentFilter = null;
        });

        $('#card_active').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 6);
            oTable.fnFilter('1', 7);
            currentFilter = 'active';
        });

        $('#card_admins').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 7);
            oTable.fnFilter('admin', 6);
            currentFilter = 'admins';
        });

        $('#card_inactive').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 6);
            oTable.fnFilter('0', 7);
            currentFilter = 'inactive';
        });
    });
</script>

<!-- ================= KPI METRIC CARDS ================= -->
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card active-filter" id="card_all" title="Ver todos los usuarios">
            <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                <i class="fa fa-users"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('total_users', 'Total Usuarios'); ?></div>
                <div class="kpi-value" id="kpi_total_users">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_active" title="Filtrar usuarios activos">
            <div class="kpi-icon" style="background: #f0fdf4; color: #16a34a;">
                <i class="fa fa-check-circle"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('active_users', 'Usuarios Activos'); ?></div>
                <div class="kpi-value" id="kpi_active_users">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_admins" title="Filtrar administradores">
            <div class="kpi-icon" style="background: #f5f3ff; color: #7c3aed;">
                <i class="fa fa-shield"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('administrators', 'Administradores'); ?></div>
                <div class="kpi-value" id="kpi_admin_users">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_inactive" title="Filtrar usuarios inactivos">
            <div class="kpi-icon" style="background: #fef2f2; color: #dc2626;">
                <i class="fa fa-user-times"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('inactive_users', 'Inactivos'); ?></div>
                <div class="kpi-value" id="kpi_inactive_users">0</div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODERN ACTION BAR ================= -->
<div class="modern-action-bar">
    <div style="display: flex; align-items: center; gap: 10px;">
        <a href="<?= admin_url('auth/create_user'); ?>" class="action-btn-primary">
            <i class="fa fa-user-plus"></i> <?= lang('add_user'); ?>
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
                    <a href="<?= admin_url('auth/create_user'); ?>">
                        <i class="fa fa-plus-circle"></i> <?= lang('add_user'); ?>
                    </a>
                </li>
                <?php if ($Owner) { ?>
                    <li class="divider"></li>
                    <li>
                        <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_users') ?></b>"
                           data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></button> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left">
                            <i class="fa fa-trash-o text-danger"></i> <?= lang('delete_users') ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php if ($Owner) {
    echo admin_form_open('auth/user_actions', 'id="action-form"');
} ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= lang('users'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip" data-placement="left" title="<?= lang('actions') ?>"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?= admin_url('auth/create_user'); ?>"><i class="fa fa-plus-circle"></i> <?= lang('add_user'); ?></a></li>
                        <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?></a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="bpo" title="<b><?= $this->lang->line('delete_users') ?></b>" data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></button> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left"><i class="fa fa-trash-o"></i> <?= lang('delete_users') ?></a></li>
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
                    <table id="UsrTable" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkth" type="checkbox" name="check"/>
                            </th>
                            <th class="col-xs-2"><?php echo lang('first_name'); ?></th>
                            <th class="col-xs-2"><?php echo lang('last_name'); ?></th>
                            <th class="col-xs-2"><?php echo lang('email_address'); ?></th>
                            <th class="col-xs-2"><?php echo lang('company'); ?></th>
                            <th class="col-xs-1"><?php echo lang('award_points'); ?></th>
                            <th class="col-xs-1"><?php echo lang('group'); ?></th>
                            <th style="width:100px;"><?php echo lang('status'); ?></th>
                            <th style="width:80px; text-align: center;"><?php echo lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
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
                            <th style="width:100px;"></th>
                            <th style="width:85px; text-align: center;"><?= lang('actions'); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<?php if ($Owner) { ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>

    <script language="javascript">
        $(document).ready(function () {
            $('#set_admin').click(function () {
                $('#usr-form-btn').trigger('click');
            });
        });
    </script>
<?php } ?>
