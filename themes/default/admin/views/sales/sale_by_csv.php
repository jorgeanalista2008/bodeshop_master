<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script type="text/javascript">
    var count = 1, an = 1, product_variant = 0, DT = <?= $Settings->default_tax_rate ?>,
        product_tax = 0, invoice_tax = 0, total_discount = 0, total = 0,
        tax_rates = <?php echo json_encode($tax_rates); ?>;

    $(document).ready(function () {
        <?php if ($Owner || $Admin): ?>
            if (!localStorage.getItem('sldate')) {
                $("#sldate").datetimepicker({
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
            $(document).on('change', '#sldate', function (e) {
                localStorage.setItem('sldate', $(this).val());
            });
            if (sldate = localStorage.getItem('sldate')) {
                $('#sldate').val(sldate);
            }
            $(document).on('change', '#slbiller', function (e) {
                localStorage.setItem('slbiller', $(this).val());
            });
            if (slbiller = localStorage.getItem('slbiller')) {
                $('#slbiller').val(slbiller);
            }
        <?php endif; ?>

        if (!localStorage.getItem('slref')) {
            localStorage.setItem('slref', '<?= $slnumber ?>');
        }
    });
</script>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file-excel-o"></i><?= lang('add_sale_by_csv'); ?></h2>
        <div class="box-icon">
            <a href="<?= admin_url('sales'); ?>" class="btn btn-default btn-sm" style="border-radius: 8px; font-weight: 600; padding: 6px 14px; background: #ffffff;">
                <i class="fa fa-list text-primary" style="margin-right: 4px;"></i> Ver Ventas
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
                                <i class="fa fa-cloud-upload text-primary" style="margin-right: 8px;"></i> Importación Masiva de Venta por CSV
                            </h3>
                            <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">
                                Cargue múltiples productos en lote a partir de un archivo <code>.csv</code> con validación inmediata de precios, cantidades y cálculo automático del total de la venta.
                            </p>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right" style="margin-bottom: 10px;">
                            <a href="<?= base_url(); ?>assets/csv/sample_sale_products.csv" class="btn btn-success btn-lg" style="border-radius: 10px; font-weight: 700; font-size: 13.5px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
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
                            <span class="label label-primary" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">1. product_code (Código) *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">2. net_unit_price (Precio Unitario) *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">3. quantity (Cantidad) *</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">4. product_variant (Variante)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">5. tax_rate_name (Impuesto)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">6. discount (Descuento)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 6px 10px; border-radius: 6px;">7. serial_no (Nro Serie)</span>
                        </div>
                        <p class="text-muted" style="font-size: 12px; margin-bottom: 0;">
                            <i class="fa fa-info-circle text-primary"></i> <strong>Nota:</strong> Los tres primeros campos marcados con (*) son obligatorios. Las cantidades y precios deben ser numéricos mayores a cero.
                        </p>
                    </div>
                </div>

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'csv-sale-form'];
                echo admin_form_open_multipart('sales/sale_by_csv', $attrib);
                ?>

                <!-- PASO 1: DATOS DE LA VENTA -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill">Paso 1</span>
                            <span>Datos Generales de la Venta</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-building-o"></i> Cliente, sucursal, almacén y fecha
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="row">
                            <?php if ($Owner || $Admin): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sldate" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-calendar text-primary" style="margin-right: 4px;"></i> <?= lang('date', 'sldate'); ?> *
                                        </label>
                                        <?php echo form_input('date', (isset($_POST['date']) ? $_POST['date'] : ''), 'class="form-control input-tip datetime" id="sldate" required="required" style="height: 42px; border-radius: 8px;"'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="slref" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-hashtag text-primary" style="margin-right: 4px;"></i> <?= lang('reference_no', 'slref'); ?>
                                    </label>
                                    <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : $slnumber), 'class="form-control input-tip" id="slref" style="height: 42px; border-radius: 8px;"'); ?>
                                </div>
                            </div>

                            <?php if (!$Settings->restrict_user || $Owner || $Admin): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slbiller" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-briefcase text-primary" style="margin-right: 4px;"></i> <?= lang('biller', 'slbiller'); ?> *
                                        </label>
                                        <?php
                                        $bl[''] = '';
                                        foreach ($billers as $biller) {
                                            $bl[$biller->id] = $biller->company && $biller->company != '-' ? $biller->company : $biller->name;
                                        }
                                        echo form_dropdown('biller', $bl, (isset($_POST['biller']) ? $_POST['biller'] : $Settings->default_biller), 'id="slbiller" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('biller') . '" required="required" style="width:100%; height:42px;"'); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php
                                $biller_input = [
                                    'type'  => 'hidden',
                                    'name'  => 'biller',
                                    'id'    => 'slbiller',
                                    'value' => $this->session->userdata('biller_id'),
                                ];
                                echo form_input($biller_input);
                                ?>
                            <?php endif; ?>

                            <?php if (!$Settings->restrict_user || $Owner || $Admin): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slwarehouse" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-building text-primary" style="margin-right: 4px;"></i> <?= lang('warehouse', 'slwarehouse'); ?> *
                                        </label>
                                        <?php
                                        $wh[''] = '';
                                        foreach ($warehouses as $warehouse) {
                                            $wh[$warehouse->id] = $warehouse->name;
                                        }
                                        echo form_dropdown('warehouse', $wh, (isset($_POST['warehouse']) ? $_POST['warehouse'] : $Settings->default_warehouse), 'id="slwarehouse" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('warehouse') . '" required="required" style="width:100%; height:42px;"'); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php
                                $warehouse_input = [
                                    'type'  => 'hidden',
                                    'name'  => 'warehouse',
                                    'id'    => 'slwarehouse',
                                    'value' => $this->session->userdata('warehouse_id'),
                                ];
                                echo form_input($warehouse_input);
                                ?>
                            <?php endif; ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="slcustomer" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-user text-primary" style="margin-right: 4px;"></i> <?= lang('customer', 'slcustomer'); ?> *
                                    </label>
                                    <div class="input-group">
                                        <?php echo form_input('customer', (isset($_POST['customer']) ? $_POST['customer'] : ''), 'id="slcustomer" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('customer') . '" required="required" class="form-control input-tip" style="width:100%;"'); ?>
                                        <div class="input-group-addon no-print" style="padding: 2px 6px;">
                                            <a href="<?= admin_url('customers/add'); ?>" id="add-customer" class="external" data-toggle="modal" data-target="#myModal" title="Agregar Cliente">
                                                <i class="fa fa-plus-circle fa-lg text-primary" id="addIcon"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-paperclip text-primary" style="margin-right: 4px;"></i> <?= lang('document', 'document') ?>
                                    </label>
                                    <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false" data-show-preview="false" class="form-control file" style="height: 42px; border-radius: 8px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: CARGA DE ARCHIVO CSV Y PREVIEW EN VIVO -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #059669;">Paso 2</span>
                            <span>Archivo CSV de Productos y Diagnóstico en Vivo</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-file-text-o"></i> Detección instantánea de cantidades, precios y totales
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
                                    Arrastre su archivo CSV de venta aquí, o <span style="color: #2563eb; text-decoration: underline;">haga clic para examinar</span>
                                </h4>
                                <p style="color: #64748b; font-size: 13px; margin: 0;">Formato: <strong>.csv</strong> delimitado por comas (código, precio, cantidad...)</p>
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
                                            <p class="qa-kpi-title">Total Productos</p>
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
                                            <p class="qa-kpi-title" style="color: #1e3a8a;">Subtotal Estimado</p>
                                            <span class="qa-kpi-sub" style="color: #3b82f6;">Suma precio x cantidad</span>
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
                                    <i class="fa fa-info-circle text-primary"></i> Previsualización en tiempo real de los ítems de venta
                                </div>
                            </div>

                            <!-- Items Diagnostic Preview Table -->
                            <div class="table-responsive" style="max-height: 380px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 16px;">
                                <table id="csvPreviewTable" class="table table-bordered table-striped" style="margin-bottom: 0;">
                                    <thead style="position: sticky; top: 0; background: #f8fafc; z-index: 2;">
                                        <tr>
                                            <th style="width: 50px; text-align: center;">Fila</th>
                                            <th style="width: 150px;">Código</th>
                                            <th style="width: 120px; text-align: right;">Precio Unit.</th>
                                            <th style="width: 100px; text-align: center;">Cantidad</th>
                                            <th style="width: 120px; text-align: right;">Subtotal</th>
                                            <th style="width: 110px; text-align: center;">Estado</th>
                                            <th>Diagnóstico / Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="csvPreviewTbody"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- PASO 3: ESTADO, CONDICIONES COMERCIALES Y PAGO -->
                <div class="adj-form-card">
                    <div class="adj-form-header">
                        <h4>
                            <span class="adj-step-pill" style="background: #475569;">Paso 3</span>
                            <span>Condiciones Comerciales y Pago</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-sliders"></i> Estado de la venta, pago, impuestos y notas
                        </span>
                    </div>
                    <div class="adj-form-body">
                        <div class="row">
                            <?php if ($Settings->tax2): ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sltax2" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                            <i class="fa fa-percent text-primary" style="margin-right: 4px;"></i> <?= lang('order_tax', 'sltax2'); ?>
                                        </label>
                                        <?php
                                        $tr[''] = '';
                                        foreach ($tax_rates as $tax) {
                                            $tr[$tax->id] = $tax->name;
                                        }
                                        echo form_dropdown('order_tax', $tr, (isset($_POST['order_tax']) ? $_POST['order_tax'] : $Settings->default_tax_rate2), 'id="sltax2" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('order_tax') . '" class="form-control input-tip select" style="width:100%; height:42px;"'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sldiscount" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-tag text-primary" style="margin-right: 4px;"></i> <?= lang('order_discount', 'sldiscount'); ?>
                                    </label>
                                    <?php echo form_input('order_discount', '', 'class="form-control input-tip" id="sldiscount" placeholder="Ej. 5% o 10.00" style="height: 42px; border-radius: 8px;"'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="slshipping" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-truck text-primary" style="margin-right: 4px;"></i> <?= lang('shipping', 'slshipping'); ?>
                                    </label>
                                    <?php echo form_input('shipping', '', 'class="form-control input-tip" id="slshipping" placeholder="0.00" style="height: 42px; border-radius: 8px;"'); ?>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="slsale_status" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-flag text-primary" style="margin-right: 4px;"></i> <?= lang('sale_status', 'slsale_status'); ?> *
                                    </label>
                                    <?php $sst = ['completed' => lang('completed'), 'pending' => lang('pending')];
                                    echo form_dropdown('sale_status', $sst, '', 'class="form-control input-tip select" required="required" id="slsale_status" style="width:100%; height:42px;"'); ?>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="slpayment_status" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-credit-card text-primary" style="margin-right: 4px;"></i> <?= lang('payment_status', 'slpayment_status'); ?> *
                                    </label>
                                    <?php $pst = ['pending' => lang('pending'), 'due' => lang('due'), 'paid' => lang('paid')];
                                    echo form_dropdown('payment_status', $pst, '', 'class="form-control input-tip select" required="required" id="slpayment_status" style="width:100%; height:42px;"'); ?>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="slpayment_term" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-clock-o text-primary" style="margin-right: 4px;"></i> <?= lang('payment_term', 'slpayment_term'); ?>
                                    </label>
                                    <?php echo form_input('payment_term', '', 'class="form-control tip" data-trigger="focus" data-placement="top" title="' . lang('payment_term_tip') . '" id="slpayment_term" placeholder="Días de crédito" style="height: 42px; border-radius: 8px;"'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de Pago Inmediato si es 'Pagado' -->
                        <div id="payments" style="display: none; background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 12px; padding: 20px; margin-top: 14px; margin-bottom: 18px;">
                            <div style="font-weight: 700; color: #166534; font-size: 14px; margin-bottom: 14px;">
                                <i class="fa fa-money"></i> Datos del Pago Inmediato
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?= lang('payment_reference_no'); ?></label>
                                        <?= form_input('payment_reference_no', (isset($_POST['payment_reference_no']) ? $_POST['payment_reference_no'] : $payment_ref), 'class="form-control tip" id="payment_reference_no" style="height:40px; border-radius:6px;"'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?= lang('amount'); ?> *</label>
                                        <input name="amount-paid" type="text" id="amount_1" class="pa form-control kb-pad amount" placeholder="Monto pagado" style="height:40px; border-radius:6px; font-weight:700;"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><?= lang('paying_by'); ?> *</label>
                                        <select name="paid_by" id="paid_by_1" class="form-control paid_by" style="height:40px; border-radius:6px;">
                                            <?= $this->sma->paid_opts(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Items Hidden Input -->
                        <input type="hidden" name="total_items" value="0" id="total_items" required="required"/>

                        <!-- Notes -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slnote" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-comment-o text-primary" style="margin-right: 4px;"></i> <?= lang('sale_note', 'slnote'); ?>
                                    </label>
                                    <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ''), 'class="form-control" id="slnote" placeholder="Nota pública para el cliente..." style="height: 80px; border-radius: 8px;"'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="slinnote" style="font-weight: 700; color: #0f172a; margin-bottom: 6px;">
                                        <i class="fa fa-user-secret text-primary" style="margin-right: 4px;"></i> <?= lang('staff_note', 'slinnote'); ?>
                                    </label>
                                    <?php echo form_textarea('staff_note', (isset($_POST['staff_note']) ? $_POST['staff_note'] : ''), 'class="form-control" id="slinnote" placeholder="Nota interna del personal..." style="height: 80px; border-radius: 8px;"'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 20px; margin-top: 14px; border-top: 1px solid #e2e8f0;">
                            <button type="button" class="btn btn-default" id="reset" style="border-radius: 8px; font-weight: 600; padding: 10px 22px; color: #dc2626;">
                                <i class="fa fa-trash-o" style="margin-right: 6px;"></i> Limpiar Formulario
                            </button>

                            <?php echo form_submit('add_sale', 'Procesar e Importar Venta', 'id="add_sale" class="btn btn-primary" style="border-radius: 8px; font-weight: 700; padding: 10px 32px; font-size: 15px; box-shadow: 0 4px 14px rgba(37,99,235,0.25);"'); ?>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var $customer = $('#slcustomer');
        $customer.change(function (e) {
            localStorage.setItem('slcustomer', $(this).val());
        });
        if (slcustomer = localStorage.getItem('slcustomer')) {
            $customer.val(slcustomer).select2({
                minimumInputLength: 1,
                data: [],
                initSelection: function (element, callback) {
                    $.ajax({
                        type: "get", async: false,
                        url: site.base_url + "customers/getCustomer/" + $(element).val(),
                        dataType: "json",
                        success: function (data) {
                            callback(data[0]);
                        }
                    });
                },
                ajax: {
                    url: site.base_url + "customers/suggestions",
                    dataType: 'json',
                    quietMillis: 15,
                    data: function (term, page) {
                        return { term: term, limit: 10 };
                    },
                    results: function (data, page) {
                        if (data.results != null) return { results: data.results };
                        else return { results: [{ id: '', text: 'No Match Found' }] };
                    }
                }
            });
        } else {
            nsCustomer();
        }

        // Payment status toggle payments container
        function togglePayments() {
            var ps = $('#slpayment_status').val();
            if (ps === 'paid') {
                $('#payments').slideDown(200);
            } else {
                $('#payments').slideUp(200);
            }
        }
        $('#slpayment_status').change(function() {
            localStorage.setItem('slpayment_status', $(this).val());
            togglePayments();
        });
        if (slpayment_status = localStorage.getItem('slpayment_status')) {
            $('#slpayment_status').select2("val", slpayment_status);
            togglePayments();
        }

        // CSV Drag and Drop & Parser
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
                parseAndValidateSalesCSV(e.target.result);
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

        function parseAndValidateSalesCSV(csvText) {
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

            // Headers
            var headerCols = parseCSVLine(lines[0]);
            var rowsData = [];
            var totalValid = 0;
            var totalErrors = 0;
            var estimatedTotal = 0;

            for (var r = 1; r < lines.length; r++) {
                var cols = parseCSVLine(lines[r]);
                var lineNo = r + 1;
                var code = cols[0] ? cols[0].trim() : '';
                var priceStr = cols[1] ? cols[1].trim() : '';
                var qtyStr = cols[2] ? cols[2].trim() : '';
                var variant = cols[3] ? cols[3].trim() : '';
                var taxRate = cols[4] ? cols[4].trim() : '';
                var discount = cols[5] ? cols[5].trim() : '';
                var serial = cols[6] ? cols[6].trim() : '';

                var errors = [];
                var price = parseFloat(priceStr);
                var qty = parseFloat(qtyStr);

                if (!code || code === '') {
                    errors.push('Falta el código de producto.');
                }
                if (isNaN(price) || price < 0) {
                    errors.push('Precio unitario inválido (' + priceStr + ').');
                }
                if (isNaN(qty) || qty <= 0) {
                    errors.push('Cantidad inválida (' + qtyStr + ').');
                }

                var isRowValid = (errors.length === 0);
                var rowSubtotal = 0;
                if (isRowValid) {
                    rowSubtotal = price * qty;
                    estimatedTotal += rowSubtotal;
                    totalValid++;
                } else {
                    totalErrors++;
                }

                rowsData.push({
                    lineNo: lineNo,
                    code: code,
                    price: price,
                    qty: qty,
                    subtotal: rowSubtotal,
                    variant: variant,
                    errors: errors,
                    isValid: isRowValid
                });
            }

            // Update KPIs
            $('#kpi-total-items').text(rowsData.length);
            $('#kpi-valid-items').text(totalValid);
            $('#kpi-error-items').text(totalErrors);
            $('#kpi-subtotal-val').text('$' + estimatedTotal.toFixed(2));

            $('#count-all').text(rowsData.length);
            $('#count-valid').text(totalValid);
            $('#count-errors').text(totalErrors);

            // Update Total Items hidden input
            $('#total_items').val(totalValid);
            if ($('#amount_1').val() === '' || $('#amount_1').val() === '0') {
                $('#amount_1').val(estimatedTotal.toFixed(2));
            }

            // Render Preview Table
            var tbody = $('#csvPreviewTbody');
            tbody.empty();

            rowsData.forEach(function(row) {
                var trClass = row.isValid ? 'row-valid' : 'row-error';
                var statusBadge = row.isValid 
                    ? '<span class="label label-success" style="font-size: 11px;"><i class="fa fa-check"></i> Válido</span>'
                    : '<span class="label label-danger" style="font-size: 11px;"><i class="fa fa-times"></i> Error</span>';
                var errorNotes = row.isValid 
                    ? '<span class="text-success"><i class="fa fa-check"></i> Listo para procesar' + (row.variant ? ' (Variante: ' + row.variant + ')' : '') + '</span>'
                    : '<span class="text-danger font-bold"><i class="fa fa-warning"></i> ' + row.errors.join(' ') + '</span>';

                var html = '<tr class="' + trClass + '" data-status="' + (row.isValid ? 'valid' : 'error') + '">' +
                    '<td style="text-align: center; font-weight: 600;">' + row.lineNo + '</td>' +
                    '<td><strong>' + (row.code || '<span class="text-danger">[Vacío]</span>') + '</strong></td>' +
                    '<td style="text-align: right;">' + (isNaN(row.price) ? '-' : '$' + row.price.toFixed(2)) + '</td>' +
                    '<td style="text-align: center; font-weight: bold;">' + (isNaN(row.qty) ? '-' : row.qty) + '</td>' +
                    '<td style="text-align: right; font-weight: bold; color: #059669;">$' + row.subtotal.toFixed(2) + '</td>' +
                    '<td style="text-align: center;">' + statusBadge + '</td>' +
                    '<td>' + errorNotes + '</td>' +
                    '</tr>';

                tbody.append(html);
            });

            $('#csv-preview-section').slideDown(300);
        }

        // Filter buttons
        $('.filter-btn').click(function() {
            $('.filter-btn').removeClass('btn-primary active').addClass('btn-default');
            $(this).removeClass('btn-default').addClass('btn-primary active');

            var filter = $(this).attr('data-filter');
            if (filter === 'all') {
                $('#csvPreviewTbody tr').show();
            } else if (filter === 'errors') {
                $('#csvPreviewTbody tr').hide();
                $('#csvPreviewTbody tr[data-status="error"]').show();
            } else if (filter === 'valid') {
                $('#csvPreviewTbody tr').hide();
                $('#csvPreviewTbody tr[data-status="valid"]').show();
            }
        });

        // Reset Button
        $('#reset').click(function (e) {
            bootbox.confirm(lang.r_u_sure, function (result) {
                if (result) {
                    if (localStorage.getItem('sldate')) localStorage.removeItem('sldate');
                    if (localStorage.getItem('slbiller')) localStorage.removeItem('slbiller');
                    if (localStorage.getItem('slref')) localStorage.removeItem('slref');
                    if (localStorage.getItem('slwarehouse')) localStorage.removeItem('slwarehouse');
                    if (localStorage.getItem('slcustomer')) localStorage.removeItem('slcustomer');
                    if (localStorage.getItem('sldiscount')) localStorage.removeItem('sldiscount');
                    if (localStorage.getItem('sltax2')) localStorage.removeItem('sltax2');
                    if (localStorage.getItem('slshipping')) localStorage.removeItem('slshipping');
                    if (localStorage.getItem('slsale_status')) localStorage.removeItem('slsale_status');
                    if (localStorage.getItem('slpayment_status')) localStorage.removeItem('slpayment_status');
                    $('#modal-loading').show();
                    location.reload();
                }
            });
        });
    });

    function nsCustomer() {
        $('#slcustomer').select2({
            minimumInputLength: 1,
            ajax: {
                url: site.base_url + "customers/suggestions",
                dataType: 'json',
                quietMillis: 15,
                data: function (term, page) {
                    return { term: term, limit: 10 };
                },
                results: function (data, page) {
                    if (data.results != null) return { results: data.results };
                    else return { results: [{ id: '', text: 'No Match Found' }] };
                }
            }
        });
    }
</script>
