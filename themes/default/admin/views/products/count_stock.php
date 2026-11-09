<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-clipboard"></i><?= lang('count_stock'); ?></h2>
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
                        <i class="fa fa-lightbulb-o fa-2x" style="color: #16a34a; flex-shrink: 0;"></i>
                        <div style="font-size: 13px; line-height: 1.5;">
                            <strong>Auditoría de Conteo Físico:</strong> Al iniciar el conteo, el sistema generará un archivo CSV base con las existencias esperadas. Podrá realizar un conteo <strong>Total</strong> de todo el almacén o <strong>Parcial</strong> filtrando marcas y categorías específicas.
                        </div>
                    </div>
                </div>

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'stForm'];
                echo admin_form_open_multipart('products/count_stock', $attrib);
                ?>

                <!-- PASO 1: DATOS GENERALES -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill">Paso 1</span>
                            <span>Datos Generales de la Auditoría</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-calendar"></i> Almacén y fecha de inicio
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="row">
                            <?php if ($Owner || $Admin || !$this->session->userdata('warehouse_id')): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="warehouse" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-building text-primary" style="margin-right: 4px;"></i> <?= lang('warehouse', 'warehouse'); ?> *
                                        </label>
                                        <?php
                                        $wh[] = '';
                                        foreach ($warehouses as $warehouse) {
                                            $wh[$warehouse->id] = $warehouse->name;
                                        }
                                        echo form_dropdown('warehouse', $wh, ($_POST['warehouse'] ?? $Settings->default_warehouse), 'id="warehouse" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('warehouse') . '" required="required" style="width:100%; height:42px;"'); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php
                                $warehouse_input = [
                                    'type'  => 'hidden',
                                    'name'  => 'warehouse',
                                    'id'    => 'warehouse',
                                    'value' => $this->session->userdata('warehouse_id'),
                                ];
                                echo form_input($warehouse_input);
                                ?>
                            <?php endif; ?>

                            <?php if ($Owner || $Admin): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-calendar text-primary" style="margin-right: 4px;"></i> <?= lang('date', 'date'); ?> *
                                        </label>
                                        <?php echo form_input('date', ($_POST['date'] ?? $this->sma->hrld(date('Y-m-d H:i:s'))), 'class="form-control input-tip" id="date" required="required" style="height:42px; border-radius:8px;"'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="<?= ($Owner || $Admin) ? 'col-md-4' : 'col-md-8'; ?>">
                                <div class="form-group">
                                    <label for="ref" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-hashtag text-primary" style="margin-right: 4px;"></i> <?= lang('reference', 'ref'); ?>
                                    </label>
                                    <?php echo form_input('reference_no', ($_POST['reference_no'] ?? ''), 'class="form-control input-tip" id="ref" placeholder="Auto-generado si se deja en blanco" style="height:42px; border-radius:8px;"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: ALCANCE DEL CONTEO -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #059669;">Paso 2</span>
                            <span>Tipo y Alcance del Conteo de Stock</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-sliders"></i> Elija auditoría completa o segmentada
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <label style="font-weight: 700; color: #0f172a; margin-bottom: 12px; display: block;">
                            <?= lang('type'); ?> de Auditoría: *
                        </label>

                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-sm-6">
                                <label for="full" style="display: block; cursor: pointer;">
                                    <div class="bc-opt-card <?= (!$this->input->post('type') || $this->input->post('type') == 'full') ? 'active' : ''; ?>" style="padding: 16px;">
                                        <div class="bc-opt-icon" style="background: #ecfdf5; color: #059669; border-color: #a7f3d0;">
                                            <i class="fa fa-cubes"></i>
                                        </div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title" style="font-size: 14px;"><?= lang('full'); ?> (Auditoría Total)</div>
                                            <div class="bc-opt-desc">Conteo exhaustivo de todos los artículos registrados en el almacén</div>
                                        </div>
                                        <input type="radio" class="checkbox type" value="full" name="type" id="full" <?= (!$this->input->post('type') || $this->input->post('type') == 'full') ? 'checked="checked"' : ''; ?> required="required">
                                    </div>
                                </label>
                            </div>

                            <div class="col-sm-6">
                                <label for="partial" style="display: block; cursor: pointer;">
                                    <div class="bc-opt-card <?= ($this->input->post('type') == 'partial') ? 'active' : ''; ?>" style="padding: 16px;">
                                        <div class="bc-opt-icon" style="background: #ede9fe; color: #7c3aed; border-color: #ddd6fe;">
                                            <i class="fa fa-filter"></i>
                                        </div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title" style="font-size: 14px;"><?= lang('partial'); ?> (Conteo Selectivo)</div>
                                            <div class="bc-opt-desc">Auditoría rápida filtrada por marcas o categorías específicas</div>
                                        </div>
                                        <input type="radio" class="checkbox type" value="partial" name="type" id="partial" <?= ($this->input->post('type') == 'partial') ? 'checked="checked"' : ''; ?>>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Filtros para conteo parcial -->
                        <div class="partials" style="display:none; background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 20px; margin-top: 10px;">
                            <div style="font-weight: 700; font-size: 13px; color: #334155; margin-bottom: 12px;">
                                <i class="fa fa-tags text-primary"></i> Filtros de Selección Parcial:
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label for="brand" style="font-weight: 600; color: #475569; font-size: 12px;"><?= lang('brands', 'brand'); ?>:</label>
                                        <?php
                                        $bs = [];
                                        foreach ($brands as $brand) {
                                            $bs[$brand->id] = $brand->name;
                                        }
                                        echo form_dropdown('brand[]', $bs, ($_POST['brand'] ?? 0), 'id="brand" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('brand') . '" style="width:100%;" multiple');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label for="category" style="font-weight: 600; color: #475569; font-size: 12px;"><?= lang('categories', 'category'); ?>:</label>
                                        <?php
                                        $cs = [];
                                        foreach ($categories as $category) {
                                            $cs[$category->id] = $category->name;
                                        }
                                        echo form_dropdown('category[]', $cs, ($_POST['category'] ?? 0), 'id="category" class="form-control input-tip select" data-placeholder="' . lang('select') . ' ' . lang('category') . '" style="width:100%;" multiple');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 22px; margin-top: 20px; border-top: 1px solid #e2e8f0;">
                            <a href="<?= admin_url('products/stock_counts'); ?>" class="btn btn-default" style="border-radius: 8px; font-weight: 600; padding: 10px 22px;">
                                <i class="fa fa-arrow-left" style="margin-right: 6px;"></i> Cancelar
                            </a>

                            <?= form_submit('count_stock', lang('submit'), 'id="count_stock" class="btn btn-primary" style="border-radius: 8px; font-weight: 700; padding: 10px 32px; font-size: 15px; box-shadow: 0 4px 14px rgba(37,99,235,0.25);"'); ?>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#brand option[value=''], #category option[value='']").remove();
        $('.type').on('ifChecked', function(e){
            var type_opt = $(this).val();
            $('.bc-opt-card').removeClass('active');
            $(this).closest('.bc-opt-card').addClass('active');

            if (type_opt == 'partial') {
                $('.partials').slideDown(200);
            } else {
                $('.partials').slideUp(200);
            }
            $('#stForm').bootstrapValidator('revalidateField', $(this));
        });

        // Initialize state
        if ($('#partial').is(':checked')) {
            $('.partials').show();
        }

        $("#date").datetimepicker({
            format: site.dateFormats.js_ldate, 
            fontAwesome: true, 
            language: 'sma', 
            weekStart: 1, 
            todayBtn: 1, 
            autoclose: 1, 
            todayHighlight: 1, 
            startView: 2, 
            forceParse: 0, 
            startDate: "<?= $this->sma->hrld(date('Y-m-d H:i:s')); ?>"
        });
    });
</script>
