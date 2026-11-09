<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        oTable = $('#SupData').dataTable({
            "aaSorting": [[1, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('suppliers/getSuppliers') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[0];
                nRow.className = "supplier_details_link";
                return nRow;
            },
            
            "fnDrawCallback": function (oSettings) {
                var total = oSettings.fnRecordsTotal();
                $("#kpi_total_suppliers").text(total);
                var rows = oSettings.aoData;
                var phoneCount = 0, emailCount = 0, vatCount = 0;
                for (var i = 0; i < rows.length; i++) {
                    var d = rows[i]._aData;
                    if (d[4] && d[4].trim() != "" && d[4].trim() != "-") phoneCount++;
                    if (d[3] && d[3].trim() != "" && d[3].trim() != "-") emailCount++;
                    if (d[7] && d[7].trim() != "" && d[7].trim() != "-") vatCount++;
                }
                $("#kpi_phone_suppliers").text(phoneCount);
                $("#kpi_email_suppliers").text(emailCount);
                $("#kpi_vat_suppliers").text(vatCount);
            },
    "aoColumns": [{
                "bSortable": false,
                "mRender": checkbox
            }, null, null, null, null, null, null, null, null, {"bSortable": false}]
        }).dtFilter([
            {column_number: 1, filter_default_label: "[<?=lang('company');?>]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('name');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('email_address');?>]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[<?=lang('phone');?>]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[<?=lang('city');?>]", filter_type: "text", data: []},
            {column_number: 6, filter_default_label: "[<?=lang('country');?>]", filter_type: "text", data: []},
            {column_number: 7, filter_default_label: "[<?=lang('vat_no');?>]", filter_type: "text", data: []},
            {column_number: 8, filter_default_label: "[<?=lang('gst_no');?>]", filter_type: "text", data: []},
        ], "footer");
    });
</script>
<?php if ($Owner || $GP['bulk_actions']) {
    echo admin_form_open('suppliers/supplier_actions', 'id="action-form"');
} ?>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-users"></i><?= lang('suppliers'); ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip"  data-placement="left" title="<?= lang('actions') ?>"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?= admin_url('suppliers/add'); ?>" data-toggle="modal" data-target="#myModal" id="add">
                                <i class="fa fa-plus-circle"></i> <?= lang('add_supplier'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= admin_url('suppliers/import_csv'); ?>" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-circle"></i> <?= lang('import_by_csv'); ?>

                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> <?= lang('export_to_excel') ?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<b><?= $this->lang->line('delete_suppliers') ?></b>"
                                data-content="<p><?= lang('r_u_sure') ?></p><button type='button' class='btn btn-danger' id='delete' data-action='delete'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button>" data-html="true" data-placement="left">
                                <i class="fa fa-trash-o"></i> <?= lang('delete_suppliers') ?>
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

                
                <!-- KPI METRIC CARDS -->
                <div class="row" style="margin-bottom: 22px;">
                    <div class="col-md-3 col-sm-6">
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Total Proveedores</div>
                                <div style="font-size: 22px; font-weight: 800; color: #0f172a;" id="kpi_total_suppliers">--</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Con Teléfono</div>
                                <div style="font-size: 22px; font-weight: 800; color: #059669;" id="kpi_phone_suppliers">--</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; border-radius: 10px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Con Email</div>
                                <div style="font-size: 22px; font-weight: 800; color: #4f46e5;" id="kpi_email_suppliers">--</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 16px;">
                            <div style="width: 48px; height: 48px; border-radius: 10px; background: #fdf2f8; color: #db2777; display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                            <div>
                                <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">Con NIF / RIF</div>
                                <div style="font-size: 22px; font-weight: 800; color: #db2777;" id="kpi_vat_suppliers">--</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS BAR -->
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 18px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <span style="font-weight: 700; color: #0f172a; font-size: 15px;"><i class="fa fa-truck text-primary" style="margin-right: 6px;"></i> Directorio de Proveedores</span>
                        <span class="text-muted" style="font-size: 13px; margin-left: 10px;">Gestione las cuentas por pagar, información fiscal y contactos de suministros</span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <a href="<?= admin_url('suppliers/import_csv'); ?>" data-toggle="modal" data-target="#myModal" class="btn btn-default" style="border-radius: 6px; font-weight: 600; padding: 8px 14px;">
                            <i class="fa fa-file-excel-o text-success" style="margin-right: 5px;"></i> <?= lang('import_by_csv'); ?>
                        </a>
                        <a href="<?= admin_url('suppliers/add'); ?>" data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="border-radius: 6px; font-weight: 700; padding: 8px 16px;">
                            <i class="fa fa-plus-circle" style="margin-right: 5px;"></i> <?= lang('add_supplier'); ?>
                        </a>
                    </div>
                </div>


                <div class="table-responsive">
                    <table id="SupData" cellpadding="0" cellspacing="0" border="0"
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
                            <th><?= lang('city'); ?></th>
                            <th><?= lang('country'); ?></th>
                            <th><?= lang('vat_no'); ?></th>
                            <th><?= lang('gst_no'); ?></th>
                            <th style="min-width:105px; text-align:center;"><?= lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="10" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                            <th style="min-width:105px;"><?= lang('actions'); ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($Owner || $GP['bulk_actions']) {
    ?>
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <?= form_submit('performAction', 'performAction', 'id="action-form-submit"') ?>
    </div>
    <?= form_close() ?>
<?php
} ?>
<?php if ($action && $action == 'add') {
        echo '<script>$(document).ready(function(){$("#add").trigger("click");});</script>';
    }
?>


