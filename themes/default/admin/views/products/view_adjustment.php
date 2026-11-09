<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="modal-dialog modal-lg no-modal-header">
    <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
        <div class="modal-body" style="padding: 24px;">
            <!-- Modal Actions Bar -->
            <div class="no-print" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #e2e8f0;">
                <div style="font-size: 14px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                    <i class="fa fa-sliders text-primary"></i> Detalle de Ajuste de Inventario
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <button type="button" class="btn btn-sm btn-default" onclick="window.print();" style="border-radius: 8px; font-weight: 600;">
                        <i class="fa fa-print" style="margin-right: 4px;"></i> <?= lang('print'); ?>
                    </button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" style="border-radius: 8px;">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Header Info Banner -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; margin-bottom: 20px;">
                <div class="row">
                    <div class="col-xs-7">
                        <div style="margin-bottom: 12px;">
                            <img src="<?= base_url() . 'assets/uploads/logos/' . $Settings->logo; ?>" alt="<?= $Settings->site_name; ?>" style="max-height: 50px;">
                        </div>
                        <div style="font-size: 13px; color: #334155; line-height: 1.6;">
                            <div><strong style="color: #64748b;"><?= lang('reference_no'); ?>:</strong> <span class="label label-info" style="font-size: 13px; font-weight: 700; padding: 4px 8px; border-radius: 6px;"><i class="fa fa-hashtag"></i> <?= $inv->reference_no; ?></span></div>
                            <div style="margin-top: 4px;"><strong style="color: #64748b;"><?= lang('date'); ?>:</strong> <?= $this->sma->hrld($inv->date); ?></div>
                        </div>
                    </div>
                    <div class="col-xs-5 text-right order_barcodes">
                        <div style="display: inline-block; background: #ffffff; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; text-align: center;">
                            <img src="<?= admin_url('misc/barcode/' . $this->sma->base64url_encode($inv->reference_no) . '/code128/74/0/1'); ?>" alt="<?= $inv->reference_no; ?>" class="bcimg" style="max-width: 100%; height: auto;" />
                            <div style="margin-top: 6px;">
                                <?= $this->sma->qrcode('link', urlencode(admin_url('products/view_adjustment/' . $inv->id)), 2); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="table-responsive" style="margin-bottom: 20px;">
                <table class="table table-bordered table-hover table-striped print-table order-table" style="border-radius: 10px; overflow: hidden; border: 1px solid #e2e8f0;">
                    <thead>
                        <tr style="background: #f1f5f9;">
                            <th style="text-align: center; width: 45px; font-size: 11px; text-transform: uppercase;">#</th>
                            <th style="font-size: 11px; text-transform: uppercase;"><i class="fa fa-cube text-primary" style="margin-right: 4px;"></i> <?= lang('description'); ?></th>
                            <th style="font-size: 11px; text-transform: uppercase;"><i class="fa fa-tags text-primary" style="margin-right: 4px;"></i> <?= lang('variant'); ?></th>
                            <th style="text-align: center; width: 140px; font-size: 11px; text-transform: uppercase;"><i class="fa fa-exchange text-primary" style="margin-right: 4px;"></i> <?= lang('type'); ?></th>
                            <th style="text-align: center; width: 110px; font-size: 11px; text-transform: uppercase;"><i class="fa fa-sort-numeric-asc text-primary" style="margin-right: 4px;"></i> <?= lang('quantity'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $r = 1;
                        foreach ($rows as $row):
                            $is_addition = ($row->type == 'addition');
                        ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle; font-weight: 600; color: #64748b;"><?= $r; ?></td>
                                <td style="vertical-align: middle;">
                                    <div style="font-weight: 600; color: #1e293b;"><?= $row->product_name; ?></div>
                                    <span class="label label-default" style="font-size: 10px; font-weight: 700;"><?= $row->product_code; ?></span>
                                    <?= $row->serial_no ? '<div class="text-muted" style="font-size: 11px; margin-top: 3px;"><i class="fa fa-barcode"></i> S/N: ' . $row->serial_no . '</div>' : ''; ?>
                                </td>
                                <td style="vertical-align: middle; color: #475569;">
                                    <?= $row->variant ? '<span class="label label-info" style="font-size: 11px; border-radius: 4px;">' . $row->variant . '</span>' : '<span class="text-muted" style="font-style: italic; font-size: 11px;">Principal</span>'; ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php if ($is_addition): ?>
                                        <span class="label label-success" style="font-size: 11px; padding: 4px 8px; border-radius: 6px; font-weight: 600;">
                                            <i class="fa fa-plus"></i> Entrada / Adición
                                        </span>
                                    <?php else: ?>
                                        <span class="label label-danger" style="font-size: 11px; padding: 4px 8px; border-radius: 6px; font-weight: 600;">
                                            <i class="fa fa-minus"></i> Salida / Sustracción
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <span style="font-weight: 800; font-size: 14px; <?= $is_addition ? 'color: #059669;' : 'color: #e11d48;'; ?>">
                                        <?= ($is_addition ? '+' : '-') . $this->sma->formatQuantity($row->quantity); ?>
                                    </span>
                                </td>
                            </tr>
                            <?php $r++; endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer Details & Notes -->
            <div class="row">
                <div class="col-xs-7">
                    <?php if ($inv->note || $inv->note != ''): ?>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 16px;">
                            <div style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 4px;">
                                <i class="fa fa-comment-o text-primary"></i> <?= lang('note'); ?> / Justificación:
                            </div>
                            <div style="font-size: 13px; color: #1e293b;">
                                <?= $this->sma->decode_html($inv->note); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-xs-5 pull-right">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 16px; font-size: 12px; line-height: 1.6; color: #475569;">
                        <div>
                            <strong style="color: #1e293b;"><i class="fa fa-user-circle-o text-primary" style="margin-right: 4px;"></i> <?= lang('created_by'); ?>:</strong><br>
                            <?= $created_by->first_name . ' ' . $created_by->last_name; ?>
                        </div>
                        <div style="margin-top: 6px;">
                            <strong style="color: #1e293b;"><i class="fa fa-clock-o text-primary" style="margin-right: 4px;"></i> <?= lang('date'); ?>:</strong><br>
                            <?= $this->sma->hrld($inv->date); ?>
                        </div>
                        <?php if ($inv->updated_by): ?>
                            <div style="margin-top: 8px; padding-top: 6px; border-top: 1px dashed #cbd5e1;">
                                <strong style="color: #1e293b;"><i class="fa fa-pencil text-muted" style="margin-right: 4px;"></i> <?= lang('updated_by'); ?>:</strong><br>
                                <?= $updated_by->first_name . ' ' . $updated_by->last_name; ?> (<?= $this->sma->hrld($inv->updated_at); ?>)
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
