<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-check-square-o"></i><?= lang('finalize_count'); ?></h2>
        <div class="box-icon">
            <a href="<?= admin_url('products/stock_counts'); ?>" class="btn btn-default btn-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px; background: #ffffff;">
                <i class="fa fa-list text-primary" style="margin-right: 4px;"></i> <?= lang('stock_counts'); ?>
            </a>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <!-- Helper Guide Card -->
                <div class="alert alert-info alert-dismissable" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 12px; margin-bottom: 22px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #166534; opacity: 0.7;">&times;</button>
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <i class="fa fa-info-circle fa-2x" style="color: #16a34a; flex-shrink: 0;"></i>
                        <div style="font-size: 13px; line-height: 1.5;">
                            <strong>Finalización y Reconciliación de Auditoría:</strong> Descargue el archivo CSV inicial si aún no lo tiene, ingrese las cantidades contadas físicamente en la columna <code>counted</code> y suba el archivo completado para que el sistema calcule las discrepancias.
                        </div>
                    </div>
                </div>

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'stForm'];
                echo admin_form_open_multipart('products/finalize_count/' . $stock_count->id, $attrib);
                echo form_hidden('count_id', $stock_count->id);
                ?>

                <!-- RESUMEN DE LA AUDITORIA -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill">Paso 1</span>
                            <span>Datos de la Auditoría en Curso</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-calendar"></i> Almacén y fecha de apertura
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <table class="table table-bordered table-striped" style="border-radius: 10px; overflow: hidden; margin-bottom: 0;">
                            <tbody>
                                <tr>
                                    <td style="width: 25%; font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-building-o text-primary" style="margin-right: 5px;"></i> <?= lang('warehouse'); ?></td>
                                    <td style="font-weight: 600; color: #0f172a;"><?= $warehouse->name . ' (' . $warehouse->code . ')'; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 700; color: #475569; background: #f8fafc;"><i class="fa fa-calendar-check-o text-primary" style="margin-right: 5px;"></i> <?= lang('date'); ?></td>
                                    <td><?= $this->sma->hrld($stock_count->date); ?></td>
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
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- CARGA DEL CONTEO FISICO -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #059669;">Paso 2</span>
                            <span>Archivo CSV de Conteo Físico Real</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-file-excel-o"></i> Reconciliación de inventario
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <!-- Plantilla Descargable -->
                        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; padding: 18px 20px; margin-bottom: 22px; display: flex; align-items: center; justify-content: space-between;">
                            <div>
                                <h5 style="margin: 0 0 6px 0; font-weight: 700; color: #0f172a;">
                                    <i class="fa fa-file-excel-o text-success" style="margin-right: 6px;"></i> Archivo CSV Base Generado al Abrir el Conteo
                                </h5>
                                <div style="font-size: 12px; color: #64748b; line-height: 1.5;">
                                    Estructura del archivo: <code>product_code, product_name, variant, expected, counted</code>.<br>
                                    <strong>Consejo:</strong> Ingrese el conteo físico en la columna <code>counted</code> sin modificar los códigos de producto.
                                </div>
                            </div>
                            <div>
                                <a href="<?= admin_url('welcome/download/' . $stock_count->initial_file); ?>" class="btn btn-default btn-sm" style="border-radius: 8px; font-weight: 600; padding: 8px 16px; background: #ffffff; white-space: nowrap;">
                                    <i class="fa fa-download text-primary" style="margin-right: 6px;"></i> <?= lang('download_csv_file'); ?>
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="csv_file" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-upload text-primary" style="margin-right: 4px;"></i> <?= lang('upload_file'); ?> (CSV) *
                                    </label>
                                    <input type="file" data-browse-label="<?= lang('browse'); ?>" name="csv_file" class="form-control file" data-show-upload="false" data-show-preview="false" id="csv_file" required="required" style="height: 42px; border-radius: 8px;"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qanote" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-comment-o text-primary" style="margin-right: 4px;"></i> <?= lang('note'); ?> / Observaciones
                                    </label>
                                    <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ''), 'class="form-control" id="qanote" placeholder="Comentarios sobre la auditoría..." style="height: 42px; border-radius: 8px;"'); ?>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 20px; margin-top: 14px; border-top: 1px solid #e2e8f0;">
                            <a href="<?= admin_url('products/stock_counts'); ?>" class="btn btn-default" style="border-radius: 8px; font-weight: 600; padding: 10px 22px;">
                                <i class="fa fa-arrow-left" style="margin-right: 6px;"></i> <?= lang('cancel'); ?>
                            </a>

                            <?= form_submit('stock_count', lang('submit') . ' y Reconciliar', 'id="stock_count" class="btn btn-success" style="border-radius: 8px; font-weight: 700; padding: 10px 32px; font-size: 15px; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);"'); ?>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
