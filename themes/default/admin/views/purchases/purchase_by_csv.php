<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    /* Select2 Container Reset: Neutralize outer double borders */
    .select2-container,
    .select2-container.form-control,
    .select2-container.input-tip,
    .select2-container.select {
        border: none !important;
        padding: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        height: 38px !important;
        display: block !important;
        width: 100% !important;
    }
    .select2-container .select2-choice {
        height: 38px !important;
        line-height: 36px !important;
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        background-color: #ffffff !important;
        padding: 0 12px !important;
        box-shadow: none !important;
        color: #1e293b !important;
        transition: border-color 0.15s, box-shadow 0.15s !important;
    }
    .select2-container .select2-choice:hover {
        border-color: #94a3b8 !important;
    }
    .select2-container.select2-container-active .select2-choice,
    .select2-container-active .select2-choice {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12) !important;
    }
    .select2-container .select2-choice .select2-arrow {
        border-radius: 0 5px 5px 0 !important;
        background: #f8fafc !important;
        border-left: 1px solid #e2e8f0 !important;
        width: 26px !important;
        height: 36px !important;
        top: 0 !important;
        right: 0 !important;
    }
    .select2-container .select2-choice .select2-arrow b {
        background-position: 0 6px !important;
    }
    .select2-container .select2-choice > .select2-chosen {
        line-height: 36px !important;
        margin-right: 28px !important;
        font-size: 13px !important;
        color: #0f172a !important;
    }

    /* Supplier button group styling */
    .supplier-btn-group,
    .customer-btn-group {
        display: table !important;
        width: 100% !important;
        border-collapse: separate !important;
    }
    .supplier-btn-group .select2-container,
    .customer-btn-group .select2-container {
        display: table-cell !important;
        width: 100% !important;
        vertical-align: middle !important;
        float: none !important;
    }
    .supplier-btn-group .select2-container .select2-choice,
    .customer-btn-group .select2-container .select2-choice {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    .supplier-btn-group .input-group-addon,
    .customer-btn-group .input-group-addon {
        display: table-cell !important;
        height: 38px !important;
        line-height: 36px !important;
        padding: 0 11px !important;
        vertical-align: middle !important;
        border: 1px solid #cbd5e1 !important;
        border-left: 0 !important;
        background: #f8fafc !important;
        width: 1% !important;
        white-space: nowrap !important;
        box-sizing: border-box !important;
        float: none !important;
    }
    .supplier-btn-group .input-group-addon a,
    .customer-btn-group .input-group-addon a {
        color: #475569;
        font-size: 14px;
        display: inline-block;
        line-height: 36px;
    }
    .supplier-btn-group .input-group-addon a:hover,
    .customer-btn-group .input-group-addon a:hover {
        color: #2563eb;
    }
    .supplier-btn-group .input-group-addon:last-child,
    .customer-btn-group .input-group-addon:last-child {
        border-top-right-radius: 6px !important;
        border-bottom-right-radius: 6px !important;
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
    var count = 1, an = 1, po_edit = false, product_variant = 0, DT = <?= $Settings->default_tax_rate ?>, DC = '<?= $default_currency->code ?>', shipping = 0,
        product_tax = 0, invoice_tax = 0, total_discount = 0, total = 0,
        tax_rates = <?php echo json_encode($tax_rates); ?>, poitems = {},
        audio_success = new Audio('<?= $assets ?>sounds/sound2.mp3'),
        audio_error = new Audio('<?= $assets ?>sounds/sound3.mp3');

    $(document).ready(function () {
        <?php if ($this->input->get('supplier')) { ?>
        if (!localStorage.getItem('poitems')) {
            localStorage.setItem('posupplier', <?=$this->input->get('supplier'); ?>);
        }
        <?php } ?>

        <?php if ($Owner || $Admin) { ?>
        if (!localStorage.getItem('podate')) {
            $("#podate").datetimepicker({
                format: site.dateFormats.js_ldate,
                fontAwesome: true,
                language: 'sma',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0
            }).datetimepicker('update', new Date());
        }
        $(document).on('change', '#podate', function (e) {
            localStorage.setItem('podate', $(this).val());
        });
        if (podate = localStorage.getItem('podate')) {
            $('#podate').val(podate);
        }
        <?php } ?>

        if (!localStorage.getItem('poref')) {
            localStorage.setItem('poref', '<?= $ponumber ?>');
        }
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file-excel-o"></i><?= lang('add_purchase_by_csv'); ?></h2>
        <div class="box-icon">
            <a href="<?= admin_url('purchases'); ?>" class="btn btn-default btn-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px; background: #ffffff;">
                <i class="fa fa-list text-primary" style="margin-right: 4px;"></i> Ver Lista de Compras
            </a>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <!-- 1. Header Banner & Quick Actions -->
                <div class="well well-sm" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); margin-bottom: 24px;">
                    <div class="row" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <div class="col-md-8 col-sm-12" style="margin-bottom: 10px;">
                            <h3 style="margin: 0 0 6px 0; font-size: 18px; font-weight: 800; color: #0f172a;">
                                <i class="fa fa-cloud-upload text-primary" style="margin-right: 8px;"></i> Importación Masiva de Compras por CSV
                            </h3>
                            <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">
                                Cargue múltiples artículos de compra a partir de un archivo <code>.csv</code> con validación automática instantánea de costos, cantidades, variantes y fechas de caducidad.
                            </p>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right" style="margin-bottom: 10px;">
                            <a href="<?= base_url(); ?>assets/csv/sample_purchase_products.csv" class="btn btn-success btn-lg" style="border-radius: 10px; font-weight: 700; font-size: 13.5px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa fa-download" style="margin-right: 6px;"></i> Descargar Plantilla CSV
                            </a>
                            <button type="button" class="btn btn-default btn-lg" data-toggle="collapse" data-target="#columnGuide" style="border-radius: 10px; font-weight: 600; font-size: 13.5px; border: 1.5px solid #cbd5e1; margin-left: 6px;">
                                <i class="fa fa-info-circle text-info"></i> Columnas
                            </button>
                        </div>
                    </div>

                    <!-- Column Guide Collapsible -->
                    <div id="columnGuide" class="collapse" style="margin-top: 18px; padding-top: 18px; border-top: 1px dashed #e2e8f0;">
                        <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Estructura de Columnas Requeridas en el Archivo CSV (7 campos):</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 12px;">
                            <span class="label label-primary" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">1. Product Code (Código) *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">2. Net Unit Cost (Costo Unitario) *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">3. Quantity (Cantidad) *</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">4. Product Variant (Variante)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">5. Tax Rate Name (Impuesto)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">6. Discount (Descuento)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">7. Expiry (Caducidad dd/mm/aaaa)</span>
                        </div>
                        <p class="text-muted" style="font-size: 12px; margin-bottom: 0;">
                            <i class="fa fa-info-circle text-primary"></i> <strong>Nota:</strong> Los tres primeros campos marcados con (*) son obligatorios. Las cantidades y costos deben ser numéricos mayores a cero.
                        </p>
                    </div>
                </div>

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'class' => 'edit-po-form', 'id' => 'csv-purchase-form'];
                echo admin_form_open_multipart('purchases/purchase_by_csv', $attrib);
                ?>

                <!-- PASO 1: DATOS DE LA COMPRA -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill">Paso 1</span>
                            <span>Datos Generales de la Orden de Compra</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-building-o"></i> Proveedor, almacén, fecha y referencia
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="row">
                            <?php if ($Owner || $Admin) { ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="podate"><?= lang('date'); ?></label>
                                        <?php echo form_input('date', ($_POST['date'] ?? date($dateFormats['php_ldate'], now())), 'class="form-control input-tip datetime" id="podate" required="required"'); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="poref"><?= lang('reference_no'); ?></label>
                                    <?php echo form_input('reference_no', ($_POST['reference_no'] ?? $ponumber), 'class="form-control input-tip" id="poref"'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="powarehouse"><?= lang('warehouse'); ?></label>
                                    <?php
                                    $wh[''] = '';
                                    foreach ($warehouses as $warehouse) {
                                        $wh[$warehouse->id] = $warehouse->name;
                                    }
                                    echo form_dropdown('warehouse', $wh, ($_POST['warehouse'] ?? $Settings->default_warehouse), 'id="powarehouse" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('warehouse') . '" required="required" style="width:100%;" ');
                                    ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="postatus"><?= lang('status'); ?></label>
                                    <?php
                                    $post = ['received' => lang('received'), 'pending' => lang('pending'), 'ordered' => lang('ordered')];
                                    echo form_dropdown('status', $post, ($_POST['status'] ?? ''), 'id="postatus" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('status') . '" required="required" style="width:100%;" ');
                                    ?>
                                </div>
                            </div>

                            <!-- Proveedor with Addons -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="posupplier"><?= lang('supplier'); ?></label>
                                    <div class="input-group supplier-btn-group customer-btn-group">
                                        <input type="text" name="supplier" value="" id="posupplier" required="required"
                                               class="form-control suppliers" style="width:100%;"
                                               placeholder="<?= lang('select') . ' ' . lang('supplier') ?>">
                                        <input type="hidden" name="supplier_id" value="" id="supplier_id" class="form-control">

                                        <div class="input-group-addon no-print" style="padding: 2px 8px; border-left: 0;">
                                            <a href="#" id="removeReadonly" title="Desbloquear proveedor">
                                                <i class="fa fa-unlock"></i>
                                            </a>
                                        </div>
                                        <?php if ($Owner || $Admin || $GP['suppliers-index']) { ?>
                                            <div class="input-group-addon no-print" style="padding: 2px 7px; border-left: 0;">
                                                <a href="#" id="view-supplier" class="external" data-toggle="modal" data-target="#myModal" title="Ver detalles del proveedor">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <?php if ($Owner || $Admin || $GP['suppliers-add']) { ?>
                                            <div class="input-group-addon no-print" style="padding: 2px 8px;">
                                                <a href="<?= admin_url('suppliers/add'); ?>" id="add-supplier" class="external" data-toggle="modal" data-target="#myModal" title="Nuevo proveedor">
                                                    <i class="fa fa-plus-circle text-primary"></i>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="document"><?= lang('attach_document'); ?></label>
                                    <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false" data-show-preview="false" class="form-control file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: CARGA DE ARCHIVO CSV Y DIAGNÓSTICO EN VIVO -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #059669;">Paso 2</span>
                            <span>Archivo CSV de Compras y Diagnóstico en Vivo</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-file-text-o"></i> Detección instantánea de cantidades, costos y totales
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <!-- Drag & Drop Upload Zone -->
                        <div id="dropzone-area" style="border: 2.5px dashed #cbd5e1; border-radius: 16px; background: #f8fafc; padding: 36px 20px; text-align: center; cursor: pointer; transition: all 0.25s ease; position: relative; margin-bottom: 20px;">
                            <input type="file" name="userfile" id="csv_file" accept=".csv,text/csv" required="required" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 5;" />
                            
                            <div id="dropzone-content">
                                <div style="width: 60px; height: 60px; border-radius: 50%; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 12px; box-shadow: 0 4px 12px rgba(37,99,235,0.12);">
                                    <i class="fa fa-cloud-upload"></i>
                                </div>
                                <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
                                    Arrastre su archivo CSV de compra aquí, o <span style="color: #2563eb; text-decoration: underline;">haga clic para examinar</span>
                                </h4>
                                <p style="color: #64748b; font-size: 13px; margin: 0;">Formato: <strong>.csv</strong> delimitado por comas (código, costo unitario, cantidad...)</p>
                            </div>

                            <!-- File Selected Badge -->
                            <div id="file-info-badge" style="display: none; padding-top: 6px;">
                                <span class="label label-info" style="font-size: 13px; padding: 8px 16px; border-radius: 20px; display: inline-flex; align-items: center; gap: 8px;">
                                    <i class="fa fa-file-excel-o"></i> <span id="selected-file-name">archivo.csv</span> (<span id="selected-file-size">0 KB</span>)
                                </span>
                                <div style="margin-top: 8px;">
                                    <span class="btn btn-xs btn-default" style="border-radius: 6px; font-weight: 600;"><i class="fa fa-refresh"></i> Cambiar archivo</span>
                                </div>
                            </div>
                        </div>

                        <!-- Live Diagnostic Preview Area -->
                        <div id="csv-preview-section" style="display: none; margin-top: 20px;">
                            <!-- KPI Metrics Grid -->
                            <div class="row" style="margin-bottom: 18px;">
                                <div class="col-md-3 col-sm-6">
                                    <div class="qa-kpi-card" style="margin-bottom: 10px;">
                                        <div class="qa-kpi-icon" style="background: #eff6ff; color: #2563eb;"><i class="fa fa-cubes"></i></div>
                                        <div class="qa-kpi-info">
                                            <h3 class="qa-kpi-value" id="kpi-total-items">0</h3>
                                            <p class="qa-kpi-title">Total Artículos</p>
                                            <span class="qa-kpi-sub">Líneas en el CSV</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="qa-kpi-card" style="margin-bottom: 10px;">
                                        <div class="qa-kpi-icon" style="background: #ecfdf5; color: #059669;"><i class="fa fa-check"></i></div>
                                        <div class="qa-kpi-info">
                                            <h3 class="qa-kpi-value" id="kpi-valid-items" style="color: #059669;">0</h3>
                                            <p class="qa-kpi-title">Ítems Válidos</p>
                                            <span class="qa-kpi-sub">Listos para procesar</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="qa-kpi-card" style="margin-bottom: 10px;">
                                        <div class="qa-kpi-icon" style="background: #fff1f2; color: #e11d48;"><i class="fa fa-times"></i></div>
                                        <div class="qa-kpi-info">
                                            <h3 class="qa-kpi-value" id="kpi-error-items" style="color: #e11d48;">0</h3>
                                            <p class="qa-kpi-title">Con Errores</p>
                                            <span class="qa-kpi-sub">Requieren corrección</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="qa-kpi-card" style="margin-bottom: 10px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-color: #bfdbfe;">
                                        <div class="qa-kpi-icon" style="background: #2563eb; color: #ffffff;"><i class="fa fa-dollar"></i></div>
                                        <div class="qa-kpi-info">
                                            <h3 class="qa-kpi-value" id="kpi-subtotal-val" style="color: #1e40af;">$0.00</h3>
                                            <p class="qa-kpi-title" style="color: #1e3a8a;">Costo Estimado</p>
                                            <span class="qa-kpi-sub" style="color: #3b82f6;">Suma costo x cantidad</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Pills & Table Header -->
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px; flex-wrap: wrap; gap: 8px;">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-primary active filter-btn" data-filter="all" style="border-radius: 6px; font-weight: 600;">
                                        Ver Todos (<span id="count-all">0</span>)
                                    </button>
                                    <button type="button" class="btn btn-sm btn-default filter-btn" data-filter="errors" style="border-radius: 6px; font-weight: 600; color: #dc2626;">
                                        <i class="fa fa-exclamation-triangle"></i> Solo con Errores (<span id="count-errors">0</span>)
                                    </button>
                                    <button type="button" class="btn btn-sm btn-default filter-btn" data-filter="valid" style="border-radius: 6px; font-weight: 600; color: #059669;">
                                        <i class="fa fa-check-circle"></i> Solo Válidos (<span id="count-valid">0</span>)
                                    </button>
                                </div>
                                <div style="font-size: 12px; color: #64748b;">
                                    <i class="fa fa-info-circle text-primary"></i> Previsualización en tiempo real de los ítems de compra
                                </div>
                            </div>

                            <!-- Items Diagnostic Preview Table -->
                            <div class="table-responsive" style="max-height: 380px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 16px;">
                                <table id="csvPreviewTable" class="table table-bordered table-striped" style="margin-bottom: 0;">
                                    <thead style="position: sticky; top: 0; background: #f8fafc; z-index: 2;">
                                        <tr>
                                            <th style="width: 50px; text-align: center;">Fila</th>
                                            <th style="width: 150px;">Código</th>
                                            <th style="width: 120px; text-align: right;">Costo Unit.</th>
                                            <th style="width: 100px; text-align: center;">Cantidad</th>
                                            <th style="width: 130px; text-align: right;">Subtotal</th>
                                            <th style="width: 110px;">Variante</th>
                                            <th style="width: 110px;">Caducidad</th>
                                            <th style="width: 180px;">Diagnóstico</th>
                                        </tr>
                                    </thead>
                                    <tbody id="csvPreviewBody">
                                        <!-- Loaded by JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 3: CONDICIONES COMERCIALES Y NOTAS -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #4f46e5;">Paso 3</span>
                            <span>Condiciones Comerciales y Observaciones</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-calculator"></i> Impuestos, descuentos, flete y notas
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="row">
                            <?php if ($Settings->tax1) { ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="potax2"><?= lang('order_tax'); ?></label>
                                        <?php
                                        $tr[''] = '';
                                        foreach ($tax_rates as $tax) {
                                            $tr[$tax->id] = $tax->name;
                                        }
                                        echo form_dropdown('order_tax', $tr, '', 'id="potax2" class="form-control input-tip select" style="width:100%;"'); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="podiscount"><?= lang('discount_label'); ?></label>
                                    <?php echo form_input('discount', '', 'class="form-control input-tip" id="podiscount" placeholder="Ej: 5% o monto fijo"'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="poshipping"><?= lang('shipping'); ?></label>
                                    <?php echo form_input('shipping', '', 'class="form-control input-tip" id="poshipping" placeholder="0.00"'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group" style="margin-top: 10px;">
                                    <label class="modern-label" for="ponote"><?= lang('note'); ?></label>
                                    <?php echo form_textarea('note', ($_POST['note'] ?? ''), 'class="form-control" id="ponote" placeholder="Términos de recepción, observaciones del flete o notas para el proveedor..." style="height: 90px; border-radius: 8px;"'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 20px; margin-top: 14px; border-top: 1px solid #e2e8f0;">
                            <button type="button" class="btn btn-default" id="reset" style="border-radius: 8px; font-weight: 600; padding: 10px 22px; color: #dc2626;">
                                <i class="fa fa-trash-o" style="margin-right: 6px;"></i> Limpiar Formulario
                            </button>

                            <?php echo form_submit('add_pruchase', 'Procesar e Importar Compra', 'id="add_pruchase" class="btn btn-primary" style="border-radius: 8px; font-weight: 700; padding: 10px 32px; font-size: 15px; box-shadow: 0 4px 14px rgba(37,99,235,0.25);"'); ?>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="total_items" value="" id="total_items" required="required"/>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        // Drag and Drop & Live CSV Parser
        var dropzone = document.getElementById('dropzone-area');
        var fileInput = document.getElementById('csv_file');

        if (dropzone && fileInput) {
            ['dragenter', 'dragover'].forEach(function(eventName) {
                dropzone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.style.borderColor = '#2563eb';
                    dropzone.style.backgroundColor = '#eff6ff';
                }, false);
            });

            ['dragleave', 'drop'].forEach(function(eventName) {
                dropzone.addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.style.borderColor = '#cbd5e1';
                    dropzone.style.backgroundColor = '#f8fafc';
                }, false);
            });

            dropzone.addEventListener('drop', function(e) {
                var dt = e.dataTransfer;
                var files = dt.files;
                if (files.length) {
                    fileInput.files = files;
                    handleFileSelect(files[0]);
                }
            }, false);

            fileInput.addEventListener('change', function(e) {
                if (this.files.length) {
                    handleFileSelect(this.files[0]);
                }
            });
        }

        function handleFileSelect(file) {
            if (!file.name.toLowerCase().endsWith('.csv')) {
                bootbox.alert('El archivo seleccionado no es un CSV válido.');
                return;
            }

            $('#dropzone-content').hide();
            $('#file-info-badge').show();
            $('#selected-file-name').text(file.name);
            $('#selected-file-size').text((file.size / 1024).toFixed(1) + ' KB');

            var reader = new FileReader();
            reader.onload = function(e) {
                parseAndValidatePurchaseCSV(e.target.result);
            };
            reader.readAsText(file, 'UTF-8');
        }

        // RFC-compliant CSV Parser
        function parseCSVLine(text) {
            var p = '', row = [''], i = 0, r = 0, q = false;
            for (var c = 0; c < text.length; c++) {
                var cc = text[c], nc = text[c + 1];
                row[r] = row[r] || '';
                if (cc === '"') {
                    if (q && nc === '"') { row[r] += '"'; c++; }
                    else { q = !q; }
                } else if (cc === ',' && !q) {
                    r++;
                } else if ((cc === '\r' || cc === '\n') && !q) {
                    if (cc === '\r' && nc === '\n') { c++; }
                    break;
                } else {
                    row[r] += cc;
                }
            }
            return row;
        }

        function parseAndValidatePurchaseCSV(csvText) {
            var rawLines = csvText.split(/\r\n|\n|\r/);
            var lines = [];
            for (var i = 0; i < rawLines.length; i++) {
                if (rawLines[i].trim().length > 0) {
                    lines.push(rawLines[i]);
                }
            }

            if (lines.length < 2) {
                bootbox.alert('El archivo CSV está vacío o solo contiene la cabecera.');
                return;
            }

            var rowsData = [];
            var totalValid = 0;
            var totalErrors = 0;
            var estimatedTotal = 0;

            for (var r = 1; r < lines.length; r++) {
                var cols = parseCSVLine(lines[r]);
                var lineNo = r + 1;
                var code = cols[0] ? cols[0].trim() : '';
                var costStr = cols[1] ? cols[1].trim() : '';
                var qtyStr = cols[2] ? cols[2].trim() : '';
                var variant = cols[3] ? cols[3].trim() : '';
                var taxRate = cols[4] ? cols[4].trim() : '';
                var discount = cols[5] ? cols[5].trim() : '';
                var expiry = cols[6] ? cols[6].trim() : '';

                var errors = [];
                var cost = parseFloat(costStr);
                var qty = parseFloat(qtyStr);

                if (!code || code === '') {
                    errors.push('Falta el código de producto.');
                }
                if (isNaN(cost) || cost < 0) {
                    errors.push('Costo unitario inválido (' + costStr + ').');
                }
                if (isNaN(qty) || qty <= 0) {
                    errors.push('Cantidad inválida (' + qtyStr + ').');
                }

                var isRowValid = (errors.length === 0);
                var rowSubtotal = 0;
                if (isRowValid) {
                    rowSubtotal = cost * qty;
                    estimatedTotal += rowSubtotal;
                    totalValid++;
                } else {
                    totalErrors++;
                }

                rowsData.push({
                    line: lineNo,
                    code: code,
                    cost: isNaN(cost) ? costStr : cost,
                    qty: isNaN(qty) ? qtyStr : qty,
                    variant: variant,
                    expiry: expiry,
                    subtotal: rowSubtotal,
                    valid: isRowValid,
                    errors: errors
                });
            }

            // Update KPI metrics
            $('#kpi-total-items').text(rowsData.length);
            $('#kpi-valid-items').text(totalValid);
            $('#kpi-error-items').text(totalErrors);
            $('#kpi-subtotal-val').text('$' + estimatedTotal.toFixed(2));

            $('#count-all').text(rowsData.length);
            $('#count-errors').text(totalErrors);
            $('#count-valid').text(totalValid);

            // Populate preview table
            var tbody = $('#csvPreviewBody');
            tbody.empty();

            rowsData.forEach(function(row) {
                var tr = $('<tr class="preview-row" data-status="' + (row.valid ? 'valid' : 'error') + '"></tr>');
                if (!row.valid) {
                    tr.addClass('danger');
                }

                var statusBadge = '';
                if (row.valid) {
                    statusBadge = '<span class="label label-success" style="border-radius: 4px; font-size: 11px;"><i class="fa fa-check"></i> Válido</span>';
                } else {
                    statusBadge = '<span class="label label-danger" style="border-radius: 4px; font-size: 11px;" title="' + row.errors.join(' | ') + '"><i class="fa fa-exclamation-circle"></i> ' + row.errors[0] + '</span>';
                }

                tr.append('<td style="text-align: center; font-weight: 600; color: #64748b;">' + row.line + '</td>');
                tr.append('<td><strong>' + (row.code || '<span class="text-danger">[Vacío]</span>') + '</strong></td>');
                tr.append('<td style="text-align: right;">' + (typeof row.cost === 'number' ? '$' + row.cost.toFixed(2) : '<span class="text-danger">' + row.cost + '</span>') + '</td>');
                tr.append('<td style="text-align: center; font-weight: 600;">' + row.qty + '</td>');
                tr.append('<td style="text-align: right; font-weight: 700; color: #1e40af;">$' + row.subtotal.toFixed(2) + '</td>');
                tr.append('<td>' + (row.variant || '<span class="text-muted">-</span>') + '</td>');
                tr.append('<td>' + (row.expiry || '<span class="text-muted">-</span>') + '</td>');
                tr.append('<td>' + statusBadge + '</td>');

                tbody.append(tr);
            });

            $('#total_items').val(totalValid);
            $('#csv-preview-section').slideDown(300);
        }

        // Filter diagnostic rows
        $(document).on('click', '.filter-btn', function() {
            $('.filter-btn').removeClass('btn-primary active').addClass('btn-default');
            $(this).removeClass('btn-default').addClass('btn-primary active');

            var filter = $(this).data('filter');
            if (filter === 'all') {
                $('.preview-row').show();
            } else if (filter === 'errors') {
                $('.preview-row[data-status="error"]').show();
                $('.preview-row[data-status="valid"]').hide();
            } else if (filter === 'valid') {
                $('.preview-row[data-status="valid"]').show();
                $('.preview-row[data-status="error"]').hide();
            }
        });
    });
</script>