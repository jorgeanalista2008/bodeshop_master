<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    $(document).ready(function () {
        function detail(x) {
            return '<div style="font-weight: 600; color: #1e293b;">'+x+'</div>';
        }
        function model(x) {
            return '<pre style="min-width:700px; white-space:pre-wrap; margin-bottom:0; background: #0f172a; color: #38bdf8; border: 1px solid #1e293b; border-radius: 6px; padding: 10px; font-size: 12px; font-family: monospace;">'+x+'</pre>';
        }
        oTable = $('#LogsData').dataTable({
            "aaSorting": [[0, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('site_logs/getLogs') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender": fld}, {"mRender": detail}, {"bSortable": false, "bSearchable": false, "mRender": model}]
        });
    });
</script>

<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-history"></i>
            </span>
            <?= lang('site_logs'); ?>
        </h2>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="modern-table-header">
                    <div>
                        <div class="modern-table-header-title">
                            <i class="fa fa-database text-primary"></i> Registro de Actividades y Auditoría del Sistema
                        </div>
                        <div class="modern-table-header-desc">
                            Historial detallado de operaciones, cambios en tablas y eventos de usuario
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table width="100%" id="LogsData" cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th width="15%"><?= lang('date'); ?></th>
                            <th width="20%"><?= lang('detail'); ?></th>
                            <th width="65%"><?= lang('model'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="3" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
