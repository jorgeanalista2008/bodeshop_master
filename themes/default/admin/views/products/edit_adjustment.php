<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script type="text/javascript">
    var count = 1, an = 1;
    var type_opt = {'addition': '<?= lang('addition'); ?>', 'subtraction': '<?= lang('subtraction'); ?>'};
    $(document).ready(function () {
        if (localStorage.getItem('remove_qals')) {
            if (localStorage.getItem('qaitems')) {
                localStorage.removeItem('qaitems');
            }
            if (localStorage.getItem('qaref')) {
                localStorage.removeItem('qaref');
            }
            if (localStorage.getItem('qawarehouse')) {
                localStorage.removeItem('qawarehouse');
            }
            if (localStorage.getItem('qanote')) {
                localStorage.removeItem('qanote');
            }
            if (localStorage.getItem('qadate')) {
                localStorage.removeItem('qadate');
            }
            localStorage.removeItem('remove_qals');
        }
        <?php if ($adjustment): ?>
            localStorage.setItem('qadate', '<?= $this->sma->hrld($adjustment->date); ?>');
            localStorage.setItem('qaref', '<?= $adjustment->reference_no; ?>');
            localStorage.setItem('qawarehouse', '<?= $adjustment->warehouse_id; ?>');
            localStorage.setItem('qanote', '<?= str_replace(["\r", "\n"], '', $this->sma->decode_html($adjustment->note)); ?>');
            localStorage.setItem('qaitems', JSON.stringify(<?= $adjustment_items; ?>));
            localStorage.setItem('remove_qals', '1');
        <?php endif; ?>
        
        $("#add_item").autocomplete({
            source: '<?= admin_url('products/qa_suggestions'); ?>',
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_match_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_match_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).removeClass('ui-autocomplete-loading');
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_adjustment_item(ui.item);
                    if (row) {
                        $(this).val('');
                        setTimeout(checkEmptyNotice, 100);
                    }
                } else {
                    bootbox.alert('<?= lang('no_match_found') ?>');
                }
            }
        });

        function checkEmptyNotice() {
            var items = localStorage.getItem('qaitems');
            if (!items || items === '{}' || Object.keys(JSON.parse(items)).length === 0) {
                $('#qa-empty-notice').show();
                $('#qaTable').hide();
            } else {
                $('#qa-empty-notice').hide();
                $('#qaTable').show();
            }
        }
        setTimeout(checkEmptyNotice, 300);

        $(document).on('click', '.qadel', function() {
            setTimeout(checkEmptyNotice, 100);
        });
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-pencil"></i><?= lang('edit_adjustment'); ?></h2>
        <div class="box-icon">
            <a href="<?= admin_url('products/quantity_adjustments'); ?>" class="btn btn-default btn-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px; background: #ffffff;">
                <i class="fa fa-list text-primary" style="margin-right: 4px;"></i> <?= lang('quantity_adjustments'); ?>
            </a>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Helper Guide Banner -->
                <div class="alert alert-info alert-dismissable" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 12px; margin-bottom: 22px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #166534; opacity: 0.7;">&times;</button>
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <i class="fa fa-info-circle fa-2x" style="color: #16a34a; flex-shrink: 0;"></i>
                        <div style="font-size: 13px; line-height: 1.5;">
                            <strong>Editando Ajuste de Inventario:</strong> Verifique los almacenes, cantidades y justificaciones antes de actualizar el movimiento.
                        </div>
                    </div>
                </div>

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('products/edit_adjustment/' . $adjustment->id, $attrib);
                ?>

                <!-- PASO 1: DATOS GENERALES -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill">Paso 1</span>
                            <span>Datos Generales del Ajuste</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-calendar"></i> Fecha, almacén y referencia de control
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="row">
                            <?php if ($Owner || $Admin): ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="qadate" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-calendar text-primary" style="margin-right: 4px;"></i> <?= lang('date', 'qadate'); ?> *
                                        </label>
                                        <?php echo form_input('date', (isset($_POST['date']) ? $_POST['date'] : $this->sma->hrld($adjustment->date)), 'class="form-control input-tip datetime" id="qadate" required="required" style="height: 42px; border-radius: 8px;"'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="<?= ($Owner || $Admin) ? 'col-md-3' : 'col-md-4'; ?>">
                                <div class="form-group">
                                    <label for="qaref" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-hashtag text-primary" style="margin-right: 4px;"></i> <?= lang('reference_no', 'qaref'); ?>
                                    </label>
                                    <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : $adjustment->reference_no), 'class="form-control input-tip" id="qaref" style="height: 42px; border-radius: 8px;"'); ?>
                                </div>
                            </div>

                            <?php if ($Owner || $Admin || !$this->session->userdata('warehouse_id')): ?>
                                <div class="<?= ($Owner || $Admin) ? 'col-md-3' : 'col-md-4'; ?>">
                                    <div class="form-group">
                                        <label for="qawarehouse" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-building text-primary" style="margin-right: 4px;"></i> <?= lang('warehouse', 'qawarehouse'); ?> *
                                        </label>
                                        <?php
                                        $wh[''] = '';
                                        foreach ($warehouses as $warehouse) {
                                            $wh[$warehouse->id] = $warehouse->name;
                                        }
                                        echo form_dropdown('warehouse', $wh, (isset($_POST['warehouse']) ? $_POST['warehouse'] : $adjustment->warehouse_id), 'id="qawarehouse" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('warehouse') . '" required="required" style="width:100%; height:42px;"'); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php
                                $warehouse_input = [
                                    'type'  => 'hidden',
                                    'name'  => 'warehouse',
                                    'id'    => 'qawarehouse',
                                    'value' => $this->session->userdata('warehouse_id'),
                                ];
                                echo form_input($warehouse_input);
                                ?>
                            <?php endif; ?>

                            <div class="<?= ($Owner || $Admin) ? 'col-md-3' : 'col-md-4'; ?>">
                                <div class="form-group">
                                    <label for="document" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-paperclip text-primary" style="margin-right: 4px;"></i> <?= lang('document', 'document') ?>
                                    </label>
                                    <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false"
                                           data-show-preview="false" class="form-control file" style="height: 42px; border-radius: 8px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: PRODUCTOS A AJUSTAR -->
                <div class="adj-form-card" id="sticker">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #059669;">Paso 2</span>
                            <span>Productos y Cantidades a Ajustar</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-barcode"></i> Escaneo rápido con pistola o buscador por texto
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <!-- High Tech Scanner Box -->
                        <div class="adj-search-wrap">
                            <i class="fa fa-barcode adj-scanner-icon"></i>
                            <?php echo form_input('add_item', '', 'class="form-control" id="add_item" placeholder="' . lang('add_product_to_order') . '"'); ?>
                            <div class="adj-scanner-badge">
                                <i class="fa fa-keyboard-o"></i> Lector / Búsqueda
                            </div>
                        </div>

                        <!-- Empty State Notice -->
                        <div id="qa-empty-notice" class="adj-empty-notice" style="display: none;">
                            <i class="fa fa-cubes"></i>
                            <h5>Sin productos seleccionados</h5>
                            <p>Utilice el buscador o lector de códigos de barras superior para añadir artículos a la lista de ajuste.</p>
                        </div>

                        <!-- Products Table -->
                        <div class="table-responsive">
                            <table id="qaTable" class="table items table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 35%;"><i class="fa fa-cube text-primary" style="margin-right: 6px;"></i> <?= lang('product_name') . ' (' . lang('product_code') . ')'; ?></th>
                                        <th style="width: 20%;"><i class="fa fa-tags text-primary" style="margin-right: 6px;"></i> <?= lang('variant'); ?></th>
                                        <th style="width: 20%; text-align: center;"><i class="fa fa-exchange text-primary" style="margin-right: 6px;"></i> <?= lang('type'); ?></th>
                                        <th style="width: 15%; text-align: center;"><i class="fa fa-sort-numeric-asc text-primary" style="margin-right: 6px;"></i> <?= lang('quantity'); ?></th>
                                        <?php if ($Settings->product_serial): ?>
                                            <th style="width: 15%;"><i class="fa fa-barcode text-primary" style="margin-right: 6px;"></i> <?= lang('serial_no'); ?></th>
                                        <?php endif; ?>
                                        <th style="width: 45px; text-align: center;"><i class="fa fa-trash-o text-danger"></i></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PASO 3: JUSTIFICACION Y ACCIONES -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #475569;">Paso 3</span>
                            <span>Motivo o Justificación del Movimiento</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-comment-o"></i> Indique la causa del ajuste para fines de auditoría
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="form-group" style="margin-bottom: 20px;">
                            <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ''), 'class="form-control" id="qanote" placeholder="Detalle la justificación del ajuste..." style="height: 100px; border-radius: 8px;"'); ?>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                            <button type="button" class="btn btn-default" id="reset" style="border-radius: 8px; font-weight: 600; padding: 10px 22px; color: #dc2626;">
                                <i class="fa fa-trash-o" style="margin-right: 6px;"></i> <?= lang('reset') ?> Formulario
                            </button>

                            <?php echo form_submit('edit_adjustment', lang('submit'), 'id="edit_adjustment" class="btn btn-primary" style="border-radius: 8px; font-weight: 700; padding: 10px 30px; font-size: 15px; box-shadow: 0 4px 14px rgba(37,99,235,0.25);"'); ?>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
