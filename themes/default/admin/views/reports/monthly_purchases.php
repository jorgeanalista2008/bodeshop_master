<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    .monthly-grid-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        padding: 16px;
        margin-top: 15px;
    }
    .dfTable th, .dfTable td {
        text-align: center;
        vertical-align: middle;
    }
    .dfTable td {
        padding: 4px;
    }
    .year_roller th {
        background: #0f172a !important;
        color: #ffffff !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        padding: 12px !important;
        border: none !important;
    }
    .year_roller th a {
        color: #93c5fd !important;
        text-decoration: none !important;
        font-size: 18px;
        display: inline-block;
        padding: 2px 10px;
        border-radius: 6px;
        transition: background 0.15s ease;
    }
    .year_roller th a:hover {
        background: rgba(255,255,255,0.15);
        color: #ffffff !important;
    }
    .month-header-cell {
        background: #f8fafc !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 10px 4px !important;
    }
    .month-header-cell a {
        font-weight: 700;
        color: #1e293b;
        font-size: 13px;
        display: block;
        padding: 4px;
        border-radius: 6px;
        transition: all 0.15s ease;
    }
    .month-header-cell a:hover {
        background: #eff6ff;
        color: #2563eb;
        text-decoration: none;
    }
    .data {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #e2e8f0 !important;
    }
    .data tr:nth-child(odd) td {
        background: #f8fafc;
        color: #64748b;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px !important;
    }
    .data tr:nth-child(even) td {
        text-align: right;
        font-size: 11px;
        font-weight: 600;
        color: #1e293b;
        padding: 4px !important;
    }
    .data tr:last-child td {
        background: #eff6ff !important;
        color: #2563eb !important;
        font-weight: 800 !important;
        font-size: 12px !important;
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
</style>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-calendar"></i><?= lang('monthly_purchases') . ' (' . ($sel_warehouse ? $sel_warehouse->name : lang('all_warehouses')) . ')'; ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <?php if (!empty($warehouses) && !$this->session->userdata('warehouse_id')) { ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?=lang('warehouses')?>"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?=admin_url('reports/monthly_purchases/0/' . $year)?>"><i class="fa fa-building-o"></i> <?=lang('all_warehouses')?></a></li>
                            <li class="divider"></li>
                            <?php foreach ($warehouses as $warehouse) {
                                echo '<li><a href="' . admin_url('reports/monthly_purchases/' . $warehouse->id . '/' . $year) . '"><i class="fa fa-building"></i>' . $warehouse->name . '</a></li>';
                            } ?>
                        </ul>
                    </li>
                <?php } ?>
                <li class="dropdown">
                    <a href="#" id="image" class="tip" title="<?= lang('save_image') ?>">
                        <i class="icon fa fa-file-picture-o"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <!-- ================= MODERN ACTION BAR ================= -->
                <div class="modern-action-bar">
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <a href="<?= admin_url('reports/monthly_purchases/' . ($warehouse_id ? $warehouse_id : 0) . '/' . ($year - 1)); ?>" class="btn btn-default" style="padding: 7px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600;">
                            <i class="fa fa-chevron-left"></i> <?= $year - 1 ?>
                        </a>
                        <span style="background: #eff6ff; color: #1d4ed8; padding: 7px 20px; border-radius: 20px; font-weight: 800; font-size: 15px; border: 1px solid #bfdbfe;">
                            Año: <?= $year ?>
                        </span>
                        <a href="<?= admin_url('reports/monthly_purchases/' . ($warehouse_id ? $warehouse_id : 0) . '/' . ($year + 1)); ?>" class="btn btn-default" style="padding: 7px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600;">
                            <?= $year + 1 ?> <i class="fa fa-chevron-right"></i>
                        </a>

                        <span style="background: #f8fafc; color: #475569; padding: 7px 14px; border-radius: 20px; font-weight: 600; font-size: 13px; border: 1px solid #e2e8f0; margin-left: 6px;">
                            <i class="fa fa-building-o text-muted" style="margin-right: 4px;"></i>
                            <?= $sel_warehouse ? $sel_warehouse->name : lang('all_warehouses'); ?>
                        </span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <?php if (!empty($warehouses) && !$this->session->userdata('warehouse_id')) { ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding: 8px 14px; border-radius: 8px; border: 1px solid #cbd5e1; font-weight: 600; font-size: 13px;">
                                    <i class="fa fa-building text-primary"></i> <?= lang('warehouses') ?> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?=admin_url('reports/monthly_purchases/0/' . $year)?>"><?=lang('all_warehouses')?></a></li>
                                    <li class="divider"></li>
                                    <?php foreach ($warehouses as $warehouse) { ?>
                                        <li><a href="<?= admin_url('reports/monthly_purchases/' . $warehouse->id . '/' . $year) ?>"><?= $warehouse->name ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <a href="#" id="pdf" class="btn btn-default" style="padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; border: 1px solid #cbd5e1;">
                            <i class="fa fa-file-pdf-o text-danger"></i> PDF
                        </a>
                        <button type="button" class="btn btn-default" onclick="window.print();" style="padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 13px; border: 1px solid #cbd5e1;">
                            <i class="fa fa-print text-muted"></i> Imprimir
                        </button>
                    </div>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; margin-bottom: 15px; font-size: 12px; color: #475569; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-info-circle text-primary"></i>
                    <span>Haga clic sobre el nombre de cualquier mes para abrir el análisis financiero y rentabilidad mensual en una ventana emergente.</span>
                </div>

                <!-- Monthly Grid Container -->
                <div class="monthly-grid-card">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dfTable reports-table" style="margin-bottom:0;">
                            <thead>
                            <tr class="year_roller">
                                <th><a href="<?= admin_url('reports/monthly_purchases/' . ($warehouse_id ? $warehouse_id : 0) . '/' . ($year - 1)); ?>">&laquo;</a></th>
                                <th colspan="10"><?php echo $year; ?></th>
                                <th><a href="<?= admin_url('reports/monthly_purchases/' . ($warehouse_id ? $warehouse_id : 0) . '/' . ($year + 1)); ?>">&raquo;</a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                $months = [
                                    '01' => 'cal_january', '02' => 'cal_february', '03' => 'cal_march',
                                    '04' => 'cal_april',   '05' => 'cal_may',      '06' => 'cal_june',
                                    '07' => 'cal_july',    '08' => 'cal_august',   '09' => 'cal_september',
                                    '10' => 'cal_october', '11' => 'cal_november', '12' => 'cal_december'
                                ];
                                foreach ($months as $num => $lang_key) { ?>
                                    <td class="bold text-center month-header-cell">
                                        <a href="<?= admin_url('reports/monthly_profit/' . $year . '/' . $num); ?>" data-toggle="modal" data-target="#myModal">
                                            <?= lang($lang_key); ?>
                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <?php
                                if (!empty($purchases)) {
                                    foreach ($purchases as $value) {
                                        $array[$value->date] = "<table class='table table-bordered table-hover table-striped table-condensed data' style='margin:0;'><tbody><tr><td>" . $this->lang->line('discount') . '</td></tr><tr><td>' . $this->sma->formatMoney($value->discount) . '</td></tr><tr><td>' . $this->lang->line('shipping') . '</td></tr><tr><td>' . $this->sma->formatMoney($value->shipping) . '</td></tr><tr><td>' . $this->lang->line('product_tax') . '</td></tr><tr><td>' . $this->sma->formatMoney($value->tax1) . '</td></tr><tr><td>' . $this->lang->line('order_tax') . '</td></tr><tr><td>' . $this->sma->formatMoney($value->tax2) . '</td></tr><tr><td>' . $this->lang->line('total') . '</td></tr><tr><td>' . $this->sma->formatMoney($value->total) . '</td></tr></tbody></table>';
                                    }
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo '<td width="8.3%" style="vertical-align:top; padding:4px;">';
                                        if (isset($array[$i])) {
                                            echo $array[$i];
                                        } else {
                                            echo '<div style="background:#f8fafc; border:1px dashed #cbd5e1; border-radius:6px; padding:20px 4px; color:#94a3b8; font-weight:700;">$0.00</div>';
                                        }
                                        echo '</td>';
                                    }
                                } else {
                                    for ($i = 1; $i <= 12; $i++) {
                                        echo '<td width="8.3%" style="vertical-align:top; padding:4px;"><div style="background:#f8fafc; border:1px dashed #cbd5e1; border-radius:6px; padding:20px 4px; color:#94a3b8; font-weight:700;">$0.00</div></td>';
                                    }
                                }
                                ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
            window.location.href = "<?=admin_url('reports/monthly_purchases/' . ($warehouse_id ? $warehouse_id : 0) . '/' . $year . '/pdf')?>";
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
