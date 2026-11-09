<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .daily-calendar-wrap {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        padding: 16px;
        margin-top: 15px;
    }
    .daily-calendar-wrap table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
    }
    .daily-calendar-wrap th {
        background: #f8fafc;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        text-align: center;
        padding: 12px 6px;
        border-bottom: 2px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
    }
    .daily-calendar-wrap th:last-child {
        border-right: none;
    }
    .daily-calendar-wrap td.day {
        width: 14.28%;
        min-height: 110px;
        height: 110px;
        padding: 8px !important;
        vertical-align: top !important;
        background: #ffffff;
        border-right: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s ease;
    }
    .daily-calendar-wrap td.day:hover {
        background: #f8fafc;
    }
    .day_num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        font-weight: 700;
        font-size: 12px;
        color: #334155;
        background: #f1f5f9;
        cursor: pointer;
        transition: all 0.15s ease;
        margin-bottom: 6px;
    }
    .day_num:hover {
        background: #2563eb;
        color: #ffffff;
        transform: scale(1.05);
    }
    .content {
        width: 100%;
        text-align: left;
        color: #2563eb;
        padding: 2px 4px;
        font-size: 11px;
    }
    .content table {
        border: none !important;
    }
    .content table td {
        padding: 2px 0 !important;
        border: none !important;
        font-size: 11px;
    }
    .highlight {
        color: #2563eb;
        font-weight: 700;
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
        <h2 class="blue"><i class="fa-fw fa fa-calendar"></i><?= lang('daily_purchases') . ' (' . ($sel_warehouse ? $sel_warehouse->name : lang('all_warehouses')) . ')'; ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <?php if (!empty($warehouses) && !$this->session->userdata('warehouse_id')) { ?>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="<?=lang('warehouses')?>"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?=admin_url('reports/daily_purchases/0/' . $year . '/' . $month)?>"><i class="fa fa-building-o"></i> <?=lang('all_warehouses')?></a></li>
                            <li class="divider"></li>
                            <?php
                                foreach ($warehouses as $warehouse) {
                                    echo '<li><a href="' . admin_url('reports/daily_purchases/' . $warehouse->id . '/' . $year . '/' . $month) . '"><i class="fa fa-building"></i>' . $warehouse->name . '</a></li>';
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
                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span style="font-weight: 700; color: #1e293b; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa fa-calendar-check-o text-primary"></i> Período:
                        </span>
                        <span style="background: #eff6ff; color: #1d4ed8; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 13px; border: 1px solid #bfdbfe;">
                            <?= sprintf('%02d', $month) . ' / ' . $year; ?>
                        </span>
                        <span style="background: #f8fafc; color: #475569; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 13px; border: 1px solid #e2e8f0;">
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
                                    <li><a href="<?=admin_url('reports/daily_purchases/0/' . $year . '/' . $month)?>"><?=lang('all_warehouses')?></a></li>
                                    <li class="divider"></li>
                                    <?php foreach ($warehouses as $warehouse) { ?>
                                        <li><a href="<?= admin_url('reports/daily_purchases/' . $warehouse->id . '/' . $year . '/' . $month) ?>"><?= $warehouse->name ?></a></li>
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
                    <span>Haga clic sobre el número de cualquier día para consultar en detalle las operaciones de compra y rentabilidad diaria.</span>
                </div>

                <!-- Calendar Output Container -->
                <div class="daily-calendar-wrap">
                    <?php echo $calender; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.table .day_num').click(function () {
            var day = $(this).html();
            var date = '<?= $year . '-' . $month . '-'; ?>' + day;
            var href = '<?= admin_url('reports/profit'); ?>/' + date + '/<?= ($warehouse_id ? $warehouse_id : ''); ?>';
            $.get(href, function( data ) {
                $("#myModal").html(data).modal();
            });
        });
        $('#pdf').click(function (event) {
            event.preventDefault();
            window.location.href = "<?=admin_url('reports/daily_purchases/' . ($warehouse_id ? $warehouse_id : 0) . '/' . $year . '/' . $month . '/pdf')?>";
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
