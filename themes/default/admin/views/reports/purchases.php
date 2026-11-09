<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$v = '';
if ($this->input->post('product')) {
    $v .= '&product=' . $this->input->post('product');
}
if ($this->input->post('reference_no')) {
    $v .= '&reference_no=' . $this->input->post('reference_no');
}
if ($this->input->post('supplier')) {
    $v .= '&supplier=' . $this->input->post('supplier');
}
if ($this->input->post('warehouse')) {
    $v .= '&warehouse=' . $this->input->post('warehouse');
}
if ($this->input->post('user')) {
    $v .= '&user=' . $this->input->post('user');
}
if ($this->input->post('start_date')) {
    $v .= '&start_date=' . $this->input->post('start_date');
}
if ($this->input->post('end_date')) {
    $v .= '&end_date=' . $this->input->post('end_date');
}
?>
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
        font-size: 20px;
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
    .filter-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: none;
    }
    .modern-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 6px;
        display: block;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        oTable = $('#PoRData').dataTable({
            "aaSorting": [[0, "desc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= admin_url('reports/getPurchasesReport/?v=1' . $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                nRow.id = aData[9];
                nRow.className = (aData[5] > 0) ? "purchase_link2" : "purchase_link2 warning";
                return nRow;
            },
            "aoColumns": [
                {"mRender": fld},
                null,
                null,
                null,
                {
                    "bSearchable": false,
                    "mRender": pqFormat
                },
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                {"mRender": currencyFormat},
                {"mRender": row_status}
            ],
            "fnDrawCallback": function (oSettings) {
                var total_records = oSettings.fnRecordsTotal();
                $("#kpi_purchases_count").text(total_records);
                
                var rows = oSettings.aoData;
                var tot_gtotal = 0, tot_paid = 0, tot_balance = 0;
                for (var i = 0; i < rows.length; i++) {
                    tot_gtotal += parseFloat(rows[i]._aData[5]) || 0;
                    tot_paid += parseFloat(rows[i]._aData[6]) || 0;
                    tot_balance += parseFloat(rows[i]._aData[7]) || 0;
                }
                $("#kpi_purchases_total").text(formatMoney(tot_gtotal));
                $("#kpi_purchases_paid").text(formatMoney(tot_paid));
                $("#kpi_purchases_balance").text(formatMoney(tot_balance));
            },
            "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                var gtotal = 0, paid = 0, balance = 0;
                for (var i = 0; i < aaData.length; i++) {
                    gtotal += parseFloat(aaData[aiDisplay[i]][5]);
                    paid += parseFloat(aaData[aiDisplay[i]][6]);
                    balance += parseFloat(aaData[aiDisplay[i]][7]);
                }
                var nCells = nRow.getElementsByTagName('th');
                nCells[5].innerHTML = currencyFormat(parseFloat(gtotal));
                nCells[6].innerHTML = currencyFormat(parseFloat(paid));
                nCells[7].innerHTML = currencyFormat(parseFloat(balance));
            }
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 0, filter_default_label: "[<?=lang('date');?> (yyyy-mm-dd)]", filter_type: "text", data: []},
            {column_number: 1, filter_default_label: "[<?=lang('ref_no');?>]", filter_type: "text", data: []},
            {column_number: 2, filter_default_label: "[<?=lang('warehouse');?>]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[<?=lang('supplier');?>]", filter_type: "text", data: []},
            {column_number: 8, filter_default_label: "[<?=lang('status');?>]", filter_type: "text", data: []},
        ], "footer");

        $('#btn_toggle_filter').click(function (e) {
            e.preventDefault();
            $('#form_filter_panel').slideToggle(200);
        });

        // Filter KPI clicks
        $('#card_all').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('', 8);
        });
        $('#card_received').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('received', 8);
        });
        $('#card_pending').click(function () {
            $('.kpi-card').removeClass('active-filter');
            $(this).addClass('active-filter');
            oTable.fnFilter('pending', 8);
        });
    });
</script>

<!-- ================= KPI METRIC CARDS ================= -->
<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card active-filter" id="card_all" title="Ver todas las compras">
            <div class="kpi-icon" style="background: #eff6ff; color: #2563eb;">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('total_purchases'); ?></div>
                <div class="kpi-value" id="kpi_purchases_count">0</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_received" title="Monto total de compras">
            <div class="kpi-icon" style="background: #fffbeb; color: #d97706;">
                <i class="fa fa-money"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('grand_total'); ?></div>
                <div class="kpi-value" id="kpi_purchases_total">0.00</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_paid" title="Total pagado a proveedores">
            <div class="kpi-icon" style="background: #f0fdf4; color: #16a34a;">
                <i class="fa fa-check-circle"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('paid'); ?></div>
                <div class="kpi-value" id="kpi_purchases_paid">0.00</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6" style="margin-bottom: 12px;">
        <div class="kpi-card" id="card_pending" title="Saldo pendiente de pago">
            <div class="kpi-icon" style="background: #fef2f2; color: #dc2626;">
                <i class="fa fa-clock-o"></i>
            </div>
            <div>
                <div class="kpi-title"><?= lang('balance'); ?></div>
                <div class="kpi-value" id="kpi_purchases_balance">0.00</div>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODERN ACTION BAR ================= -->
<div class="modern-action-bar">
    <div style="display: flex; align-items: center; gap: 10px;">
        <button type="button" id="btn_toggle_filter" class="action-btn-primary">
            <i class="fa fa-filter"></i> Filtros Avanzados
        </button>
        <?php if ($this->input->post('start_date') || $this->input->post('warehouse') || $this->input->post('supplier')) { ?>
            <span style="font-size: 12px; font-weight: 600; color: #2563eb; background: #eff6ff; padding: 6px 12px; border-radius: 20px;">
                <i class="fa fa-info-circle"></i> Filtro personalizado aplicado
            </span>
        <?php } ?>
    </div>
    <div style="display: flex; align-items: center; gap: 8px;">
        <a href="#" id="xls" class="action-btn-secondary" title="<?= lang('download_xls') ?>">
            <i class="fa fa-file-excel-o text-success"></i> Excel
        </a>
        <a href="#" id="pdf" class="action-btn-secondary" title="<?= lang('download_pdf') ?>">
            <i class="fa fa-file-pdf-o text-danger"></i> PDF
        </a>
        <button type="button" class="action-btn-secondary" onclick="window.print();" title="Imprimir">
            <i class="fa fa-print text-muted"></i> Imprimir
        </button>
    </div>
</div>

<!-- ================= ADVANCED FILTER FORM ================= -->
<div id="form_filter_panel" class="filter-panel" <?= ($this->input->post('submit_report') ? 'style="display:block;"' : '') ?>>
    <?php echo admin_form_open('reports/purchases'); ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="suggest_product"><?= lang('product', 'suggest_product'); ?></label>
                <?php echo form_input('sproduct', ($_POST['sproduct'] ?? ''), 'class="form-control" id="suggest_product" placeholder="Escriba código o nombre del producto"'); ?>
                <input type="hidden" name="product" value="<?= $_POST['product'] ?? '' ?>" id="report_product_id"/>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="reference_no"><?= lang('reference_no'); ?></label>
                <?php echo form_input('reference_no', ($_POST['reference_no'] ?? ''), 'class="form-control tip" id="reference_no" placeholder="No. de Referencia"'); ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="user"><?= lang('created_by'); ?></label>
                <?php
                $us[''] = lang('select') . ' ' . lang('user');
                foreach ($users as $user) {
                    $us[$user->id] = $user->first_name . ' ' . $user->last_name;
                }
                echo form_dropdown('user', $us, ($_POST['user'] ?? ''), 'class="form-control" id="user" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('user') . '"');
                ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="supplier"><?= lang('supplier', 'supplier'); ?></label>
                <?php echo form_input('supplier', ($_POST['supplier'] ?? ''), 'class="form-control" id="supplier" placeholder="Nombre o código del proveedor"'); ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="warehouse"><?= lang('warehouse'); ?></label>
                <?php
                $wh[''] = lang('select') . ' ' . lang('warehouse');
                foreach ($warehouses as $warehouse) {
                    $wh[$warehouse->id] = $warehouse->name;
                }
                echo form_dropdown('warehouse', $wh, ($_POST['warehouse'] ?? ''), 'class="form-control" id="warehouse" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('warehouse') . '"');
                ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="start_date"><?= lang('start_date', 'start_date'); ?></label>
                <?php echo form_input('start_date', ($_POST['start_date'] ?? ''), 'class="form-control datetime" id="start_date"'); ?>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="modern-label" for="end_date"><?= lang('end_date', 'end_date'); ?></label>
                <?php echo form_input('end_date', ($_POST['end_date'] ?? ''), 'class="form-control datetime" id="end_date"'); ?>
            </div>
        </div>
    </div>
    <div style="display: flex; gap: 10px; margin-top: 10px;">
        <button type="submit" name="submit_report" value="submit" class="btn btn-primary" style="padding: 9px 22px; font-weight: 700; border-radius: 8px;">
            <i class="fa fa-search"></i> <?= lang('submit'); ?>
        </button>
        <a href="<?= admin_url('reports/purchases'); ?>" class="btn btn-default" style="padding: 9px 18px; font-weight: 600; border-radius: 8px;">
            <i class="fa fa-refresh text-danger"></i> <?= lang('reset'); ?>
        </a>
    </div>
    <?php echo form_close(); ?>
</div>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-shopping-cart"></i><?= lang('purchases_report'); ?> <?php
            if ($this->input->post('start_date')) {
                echo 'From ' . $this->input->post('start_date') . ' to ' . $this->input->post('end_date');
            }
            ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown"><a href="#" id="xls" class="tip" title="<?= lang('download_xls') ?>"><i class="icon fa fa-file-excel-o"></i></a></li>
                <li class="dropdown"><a href="#" id="image" class="tip" title="<?= lang('save_image') ?>"><i class="icon fa fa-file-picture-o"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?= lang('customize_report'); ?></p>

                <div class="table-responsive">
                    <table id="PoRData"
                           class="table table-bordered table-hover table-striped table-condensed reports-table">
                        <thead>
                        <tr>
                            <th><?= lang('date'); ?></th>
                            <th><?= lang('reference_no'); ?></th>
                            <th><?= lang('warehouse'); ?></th>
                            <th><?= lang('supplier'); ?></th>
                            <th><?= lang('product_qty'); ?></th>
                            <th><?= lang('grand_total'); ?></th>
                            <th><?= lang('paid'); ?></th>
                            <th><?= lang('balance'); ?></th>
                            <th><?= lang('status'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                        </tr>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?= lang('product_qty'); ?></th>
                            <th><?= lang('grand_total'); ?></th>
                            <th><?= lang('paid'); ?></th>
                            <th><?= lang('balance'); ?></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pdf').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=admin_url('reports/getPurchasesReport/pdf/?v=1' . $v)?>";
            return false;
        });
        $('#xls').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=admin_url('reports/getPurchasesReport/0/xls/?v=1' . $v)?>";
            return false;
        });
        $('#image').click(function (event) {
            event.preventDefault();
            html2canvas($('.box'), {
                onrendered: function (canvas) {
                    openImg(canvas.toDataURL());
                }
            });
            return false;
        });
    });
</script>
