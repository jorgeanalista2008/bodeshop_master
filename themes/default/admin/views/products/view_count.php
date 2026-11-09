<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
        <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 16px 22px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-top: 2px;">
                <i class="fa fa-times"></i>
            </button>
            <button type="button" class="btn btn-sm btn-default no-print pull-right" style="margin-right: 15px; border-radius: 8px; font-weight: 600;" onclick="window.print();">
                <i class="fa fa-print" style="margin-right: 4px;"></i> <?= lang('print'); ?>
            </button>
            <h4 class="modal-title" id="myModalLabel" style="font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                <i class="fa fa-clipboard text-primary"></i> <?= lang('stock_count'); ?> / Detalle de Auditoría
            </h4>
        </div>
        <div class="modal-body" style="padding: 22px;">

            <div class="row">
                <div class="col-xs-12">
                    <!-- General Details Table -->
                    <table class="table table-bordered table-striped" style="border-radius: 10px; overflow: hidden; margin-bottom: 20px;">
                        <tbody>
                            <tr>
                                <td style="width: 25%; font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-building-o text-primary" style="margin-right: 5px;"></i> <?= lang('warehouse'); ?></td>
                                <td style="font-weight: 600; color: #0f172a;"><?= $warehouse->name . ' (' . $warehouse->code . ')'; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-calendar-check-o text-primary" style="margin-right: 5px;"></i> <?= lang('start_date'); ?></td>
                                <td><?= $this->sma->hrld($stock_count->date); ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-clock-o text-primary" style="margin-right: 5px;"></i> <?= lang('end_date'); ?></td>
                                <td><?= $stock_count->updated_at ? $this->sma->hrld($stock_count->updated_at) : '<span class="text-muted" style="font-style: italic;">En curso</span>'; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-hashtag text-primary" style="margin-right: 5px;"></i> <?= lang('reference'); ?></td>
                                <td><span class="qa-ref-badge"><i class="fa fa-hashtag"></i> <?= $stock_count->reference_no; ?></span></td>
                            </tr>
                            <tr>
                                <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-sliders text-primary" style="margin-right: 5px;"></i> <?= lang('type'); ?></td>
                                <td>
                                    <?php if ($stock_count->type == 'full'): ?>
                                        <span class="label label-success" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><i class="fa fa-cubes"></i> Total / Completo</span>
                                    <?php else: ?>
                                        <span class="label label-primary" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><i class="fa fa-tag"></i> Parcial</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php if ($stock_count->type == 'partial'): ?>
                                <tr>
                                    <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-folder-o text-primary" style="margin-right: 5px;"></i> <?= lang('categories'); ?></td>
                                    <td><?= $stock_count->category_names ? $stock_count->category_names : '<span class="text-muted">Todas</span>'; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-tags text-primary" style="margin-right: 5px;"></i> <?= lang('brands'); ?></td>
                                    <td><?= $stock_count->brand_names ? $stock_count->brand_names : '<span class="text-muted">Todas</span>'; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-file-text-o text-primary" style="margin-right: 5px;"></i> <?= lang('files'); ?></td>
                                <td>
                                    <?php if ($stock_count->initial_file): ?>
                                        <?= anchor('admin/welcome/download/' . $stock_count->initial_file, '<i class="fa fa-download" style="margin-right: 4px;"></i> ' . lang('initial_file'), 'class="btn btn-default btn-xs" style="border-radius: 6px; font-weight: 600; margin-right: 6px;"'); ?>
                                    <?php endif; ?>
                                    <?php if ($stock_count->final_file): ?>
                                        <?= anchor('admin/welcome/download/' . $stock_count->final_file, '<i class="fa fa-download" style="margin-right: 4px;"></i> ' . lang('final_file'), 'class="btn btn-success btn-xs" style="border-radius: 6px; font-weight: 600;"'); ?>
                                    <?php else: ?>
                                        <span class="text-muted" style="font-size: 12px; font-style: italic;">Sin archivo final cargado</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php if (!empty($stock_count_items)): ?>
                        <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">
                            <i class="fa fa-list text-primary" style="margin-right: 4px;"></i> Discrepancias Encontradas en la Auditoría:
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped order-table" style="border-radius: 10px; overflow: hidden;">
                                <thead>
                                    <tr style="background: #f1f5f9;">
                                        <th style="text-align: center; width: 40px; font-size: 11px; text-transform: uppercase;">#</th>
                                        <th style="font-size: 11px; text-transform: uppercase;"><i class="fa fa-cube text-primary" style="margin-right: 4px;"></i> <?= lang('description'); ?></th>
                                        <th style="text-align: center; width: 90px; font-size: 11px; text-transform: uppercase;"><?= lang('expected'); ?></th>
                                        <th style="text-align: center; width: 90px; font-size: 11px; text-transform: uppercase;"><?= lang('counted'); ?></th>
                                        <th style="text-align: right; width: 100px; font-size: 11px; text-transform: uppercase;"><?= lang('difference'); ?></th>
                                        <th style="text-align: right; width: 110px; font-size: 11px; text-transform: uppercase;"><?= lang('cost'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $r = 1;
                                    $total = 0;
                                    $items = 0;
                                    foreach ($stock_count_items as $row): 
                                        $diff = $row->counted - $row->expected;
                                        $diff_cost = $row->cost * $diff;
                                    ?>
                                        <tr>
                                            <td style="text-align: center; font-weight: 600; color: #64748b;"><?= $r; ?></td>
                                            <td style="text-align: left;">
                                                <div style="font-weight: 600; color: #1e293b;"><?= $row->product_name; ?></div>
                                                <span class="label label-default" style="font-size: 10px;"><?= $row->product_code; ?></span>
                                                <?= $row->product_variant ? '<span class="label label-info" style="font-size: 10px; margin-left: 4px;">' . $row->product_variant . '</span>' : ''; ?>
                                            </td>
                                            <td style="text-align: center; font-weight: 600; color: #475569;">
                                                <?= $this->sma->formatQuantity($row->expected); ?>
                                            </td>
                                            <td style="text-align: center; font-weight: 600; color: #0f172a;">
                                                <?= $this->sma->formatQuantity($row->counted); ?>
                                            </td>
                                            <td style="text-align: right; font-weight: 800; <?= $diff > 0 ? 'color: #059669;' : ($diff < 0 ? 'color: #dc2626;' : 'color: #64748b;'); ?>">
                                                <?= ($diff > 0 ? '+' : '') . $this->sma->formatQuantity($diff); ?>
                                            </td>
                                            <td style="text-align: right; font-weight: 700; <?= $diff_cost > 0 ? 'color: #059669;' : ($diff_cost < 0 ? 'color: #dc2626;' : 'color: #64748b;'); ?>">
                                                <?= $this->sma->formatMoney($diff_cost); ?>
                                            </td>
                                        </tr>
                                    <?php 
                                        $r++;
                                        $items += $diff;
                                        $total += $diff_cost;
                                    endforeach; 
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr style="background: #f8fafc; font-weight: 800;">
                                        <th colspan="4" style="text-align: right; text-transform: uppercase; font-size: 12px;"><?= lang('total'); ?> Discrepancia:</th>
                                        <th style="text-align: right; font-size: 13px; <?= $items > 0 ? 'color: #059669;' : ($items < 0 ? 'color: #dc2626;' : 'color: #0f172a;'); ?>">
                                            <?= ($items > 0 ? '+' : '') . $this->sma->formatQuantity($items); ?>
                                        </th>
                                        <th style="text-align: right; font-size: 13px; <?= $total > 0 ? 'color: #059669;' : ($total < 0 ? 'color: #dc2626;' : 'color: #0f172a;'); ?>">
                                            <?= $this->sma->formatMoney($total); ?>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-success" style="border-radius: 10px; margin-bottom: 20px;">
                            <i class="fa fa-check-circle fa-lg" style="margin-right: 6px;"></i> <?= lang('no_mismatch_found'); ?>
                        </div>
                    <?php endif; ?>

                    <div style="margin-top: 20px;">
                        <?php if ($adjustment): ?>
                            <a href="<?= admin_url('products/view_adjustment/' . $adjustment->id); ?>" class="btn btn-primary btn-block no-print" data-toggle="modal" data-target="#myModal2" style="border-radius: 8px; font-weight: 700; padding: 10px;">
                                <i class="fa fa-sliders" style="margin-right: 6px;"></i> <?= lang('view_adjustment'); ?>
                            </a>
                        <?php elseif (!empty($stock_count_items)): ?>
                            <a href="<?= admin_url('products/add_adjustment/' . $stock_count->id); ?>" class="btn btn-primary btn-block no-print" style="border-radius: 8px; font-weight: 700; padding: 10px; box-shadow: 0 4px 12px rgba(37,99,235,0.25);">
                                <i class="fa fa-sliders" style="margin-right: 6px;"></i> Generar Ajuste Automático desde este Conteo
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
