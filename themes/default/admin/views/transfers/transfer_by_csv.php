<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .transfer-card-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 22px 26px;
        margin-bottom: 22px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .transfer-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .transfer-card-header .step-badge {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }
    .transfer-card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }
    .modern-label {
        font-weight: 600;
        color: #334155;
        font-size: 13px;
        margin-bottom: 6px;
        display: block;
    }
    .select2-container,
    .select2-container.form-control,
    .select2-container.input-tip,
    .select2-container.select {
        border: none !important;
        padding: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        height: 38px !important;
        display: block;
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
    }

    /* CSV Dropzone */
    .csv-dropzone {
        border: 2px dashed #93c5fd;
        background: #f8fafc;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .csv-dropzone:hover, .csv-dropzone.dragover {
        border-color: #2563eb;
        background: #eff6ff;
    }
    .csv-dropzone i.upload-icon {
        font-size: 40px;
        color: #3b82f6;
        margin-bottom: 12px;
        display: inline-block;
    }

    /* KPI Summary Cards */
    .csv-kpi {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
    }
    .csv-kpi-title {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .csv-kpi-val {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        <?php if ($Owner || $Admin) { ?>
        if (!localStorage.getItem('todate')) {
            $("#todate").datetimepicker({
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
        $(document).on('change', '#todate', function (e) {
            localStorage.setItem('todate', $(this).val());
        });
        if (todate = localStorage.getItem('todate')) {
            $('#todate').val(todate);
        }
        <?php } ?>

        $('#tostatus').change(function (e) {
            localStorage.setItem('tostatus', $(this).val());
        });
        if (tostatus = localStorage.getItem('tostatus')) {
            $('#tostatus').select2("val", tostatus);
        }

        $('#toshipping').change(function () {
            localStorage.setItem('toshipping', $(this).val());
        });
        if (toshipping = localStorage.getItem('toshipping')) {
            $('#toshipping').val(toshipping);
        }

        $('#toref').change(function (e) {
            localStorage.setItem('toref', $(this).val());
        });
        if (toref = localStorage.getItem('toref')) {
            $('#toref').val(toref);
        }

        $('#to_warehouse').on("select2-close", function (e) {
            if ($(this).val() == $('#from_warehouse').val()) {
                $(this).select2('val', '');
                bootbox.alert('<?= lang('please_select_different_warehouse') ?>');
            }
        });
        $('#from_warehouse').on("select2-close", function (e) {
            if ($(this).val() == $('#to_warehouse').val()) {
                $(this).select2('val', '');
                bootbox.alert('<?= lang('please_select_different_warehouse') ?>');
            }
        });

        // Client-side CSV parser
        var fileInput = document.getElementById('csv_file');
        var dropzone = document.getElementById('csvDropzone');

        if (dropzone && fileInput) {
            dropzone.addEventListener('click', function () { fileInput.click(); });
            dropzone.addEventListener('dragover', function (e) {
                e.preventDefault();
                $(this).addClass('dragover');
            });
            dropzone.addEventListener('dragleave', function () {
                $(this).removeClass('dragover');
            });
            dropzone.addEventListener('drop', function (e) {
                e.preventDefault();
                $(this).removeClass('dragover');
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    handleCsvFile(e.dataTransfer.files[0]);
                }
            });
            fileInput.addEventListener('change', function () {
                if (this.files.length) handleCsvFile(this.files[0]);
            });
        }

        function handleCsvFile(file) {
            if (!file) return;
            $('#fileNameDisplay').text(file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)');
            $('#dropzonePrompt').hide();
            $('#dropzoneFileInfo').show();

            var reader = new FileReader();
            reader.onload = function (e) {
                var text = e.target.result;
                var lines = text.split(/\r\n|\n/);
                var validRows = 0, totalQty = 0, totalCost = 0, errors = 0;
                var tbody = $('#csvPreviewTable tbody');
                tbody.empty();

                for (var i = 1; i < lines.length; i++) {
                    var line = lines[i].trim();
                    if (!line) continue;
                    var cols = line.split(',');
                    var code = cols[0] ? cols[0].trim() : '';
                    var cost = cols[1] ? parseFloat(cols[1].trim()) : 0;
                    var qty = cols[2] ? parseFloat(cols[2].trim()) : 0;
                    var variant = cols[3] ? cols[3].trim() : '-';
                    var expiry = cols[4] ? cols[4].trim() : '-';

                    if (code && !isNaN(cost) && !isNaN(qty) && qty > 0) {
                        validRows++;
                        totalQty += qty;
                        totalCost += (cost * qty);
                        if (validRows <= 20) {
                            tbody.append('<tr><td>' + validRows + '</td><td><code>' + code + '</code></td><td>' + cost.toFixed(2) + '</td><td>' + qty + '</td><td>' + variant + '</td><td>' + expiry + '</td><td><span class="label label-success">OK</span></td></tr>');
                        }
                    } else {
                        errors++;
                    }
                }

                $('#kpi_total_rows').text(validRows + errors);
                $('#kpi_valid_rows').text(validRows);
                $('#kpi_total_qty').text(totalQty);
                $('#kpi_total_cost').text(formatMoney(totalCost));
                $('#csvDiagnosticsSection').slideDown();
            };
            reader.readAsText(file);
        }
    });
</script>

<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-file-excel-o"></i>
            </span>
            <?= lang('transfer_by_csv'); ?>
        </h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li>
                    <a href="<?= admin_url('transfers'); ?>" class="tip" title="<?= lang('transfers'); ?>">
                        <i class="icon fa fa-list"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">

                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('transfers/transfer_by_csv', $attrib);
                ?>

                <!-- ================= PASO 1: DATOS PRINCIPALES ================= -->
                <div class="transfer-card-section">
                    <div class="transfer-card-header">
                        <span class="step-badge">1</span>
                        <div>
                            <h3>Datos Principales del Traslado</h3>
                            <small class="text-muted">Almacenes participantes y estatus del movimiento</small>
                        </div>
                    </div>

                    <div class="row">
                        <?php if ($Owner || $Admin) { ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="modern-label" for="todate"><?= lang('date', 'todate'); ?> *</label>
                                    <?php echo form_input('date', (isset($_POST['date']) ? $_POST['date'] : ''), 'class="form-control input-tip datetime" id="todate" required="required"'); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="toref"><?= lang('reference_no', 'toref'); ?></label>
                                <?php echo form_input('reference_no', (isset($_POST['reference_no']) ? $_POST['reference_no'] : $rnumber), 'class="form-control input-tip" id="toref"'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="tostatus"><?= lang('status', 'tostatus'); ?> *</label>
                                <?php
                                $post = ['completed' => lang('completed'), 'pending' => lang('pending'), 'sent' => lang('sent')];
                                echo form_dropdown('status', $post, (isset($_POST['status']) ? $_POST['status'] : ''), 'id="tostatus" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('status') . '" required="required" style="width:100%;" ');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="from_warehouse"><?= lang('from_warehouse', 'from_warehouse'); ?> *</label>
                                <?php
                                $wh[''] = '';
                                foreach ($warehouses as $warehouse) {
                                    $wh[$warehouse->id] = $warehouse->name;
                                }
                                echo form_dropdown('from_warehouse', $wh, (isset($_POST['from_warehouse']) ? $_POST['from_warehouse'] : ''), 'id="from_warehouse" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('from_warehouse') . '" required="required" style="width:100%;" ');
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="to_warehouse"><?= lang('to_warehouse', 'to_warehouse'); ?> *</label>
                                <?php
                                echo form_dropdown('to_warehouse', $wh, (isset($_POST['to_warehouse']) ? $_POST['to_warehouse'] : ''), 'id="to_warehouse" class="form-control input-tip select" data-placeholder="' . $this->lang->line('select') . ' ' . $this->lang->line('to_warehouse') . '" required="required" style="width:100%;" ');
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="toshipping"><?= lang('shipping', 'toshipping'); ?></label>
                                <?php echo form_input('shipping', '', 'class="form-control input-tip" id="toshipping" placeholder="0.00"'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= PASO 2: CARGA Y PARSER DE ARCHIVO CSV ================= -->
                <div class="transfer-card-section">
                    <div class="transfer-card-header" style="justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <span class="step-badge">2</span>
                            <div>
                                <h3>Carga y Diagnóstico del Archivo CSV</h3>
                                <small class="text-muted">Importe el listado de productos a transferir mediante un archivo CSV estructurado</small>
                            </div>
                        </div>
                        <a href="<?= base_url('assets/csv/sample_transfer_products.csv'); ?>" class="btn btn-default" style="font-weight: 600; border-radius: 6px;">
                            <i class="fa fa-download text-primary"></i> <?= lang('download_sample_file') ?>
                        </a>
                    </div>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; margin-bottom: 20px;">
                        <span style="font-weight: 700; color: #1e293b;"><i class="fa fa-info-circle text-primary"></i> Formato de Columnas requerido:</span>
                        <div style="margin-top: 6px; font-size: 13px; color: #475569;">
                            <code>(1) Código de Producto *</code>, <code>(2) Costo Unitario *</code>, <code>(3) Cantidad *</code>, <code>(4) Variante</code>, <code>(5) Fecha Caducidad</code>
                        </div>
                    </div>

                    <div class="csv-dropzone" id="csvDropzone">
                        <i class="fa fa-cloud-upload upload-icon"></i>
                        <div id="dropzonePrompt">
                            <h4 style="margin: 0 0 6px 0; font-weight: 700; color: #1e293b;">Arrastre y suelte su archivo CSV aquí</h4>
                            <p style="margin: 0; color: #64748b; font-size: 13px;">O haga clic en cualquier parte de este recuadro para seleccionar desde su equipo</p>
                        </div>
                        <div id="dropzoneFileInfo" style="display: none;">
                            <h4 style="margin: 0 0 6px 0; font-weight: 700; color: #059669;" id="fileNameDisplay"></h4>
                            <p style="margin: 0; color: #64748b; font-size: 13px;">Haga clic de nuevo si desea seleccionar otro archivo</p>
                        </div>
                        <input id="csv_file" type="file" name="userfile" required="required" style="display: none;" accept=".csv, text/csv">
                    </div>

                    <!-- Live CSV Diagnostics -->
                    <div id="csvDiagnosticsSection" style="display: none; margin-top: 24px;">
                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-3">
                                <div class="csv-kpi">
                                    <div class="csv-kpi-title">Filas Detectadas</div>
                                    <div class="csv-kpi-val" id="kpi_total_rows">0</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="csv-kpi">
                                    <div class="csv-kpi-title">Filas Válidas</div>
                                    <div class="csv-kpi-val" style="color: #059669;" id="kpi_valid_rows">0</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="csv-kpi">
                                    <div class="csv-kpi-title">Total Unidades</div>
                                    <div class="csv-kpi-val" style="color: #2563eb;" id="kpi_total_qty">0</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="csv-kpi">
                                    <div class="csv-kpi-title">Costo Estimado</div>
                                    <div class="csv-kpi-val" style="color: #ea580c;" id="kpi_total_cost">0.00</div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="max-height: 280px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px;">
                            <table class="table table-bordered table-striped" id="csvPreviewTable" style="margin-bottom: 0;">
                                <thead>
                                <tr style="background: #f8fafc;">
                                    <th style="width: 50px;">#</th>
                                    <th>Código</th>
                                    <th>Costo Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Variante</th>
                                    <th>Caducidad</th>
                                    <th>Diagnóstico</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modern-label" for="document"><?= lang('document', 'document') ?></label>
                                <input id="document" type="file" data-browse-label="<?= lang('browse'); ?>" name="document" data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= PASO 3: OBSERVACIONES ================= -->
                <div class="transfer-card-section">
                    <div class="transfer-card-header">
                        <span class="step-badge">3</span>
                        <div>
                            <h3>Notas y Observaciones</h3>
                            <small class="text-muted">Instrucciones de recepción o notas adicionales para el traslado</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modern-label" for="tonote"><?= lang('note', 'tonote'); ?></label>
                                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ''), 'id="tonote" class="form-control" style="height: 100px; resize: vertical;" placeholder="Observaciones del traslado por CSV, instrucciones de embalaje..."'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Submit Buttons -->
                <div style="margin-top: 15px; margin-bottom: 30px; display: flex; gap: 10px;">
                    <button type="submit" name="add_transfer" id="add_transfer" class="btn btn-primary" style="padding: 11px 28px; font-weight: 700; border-radius: 6px;">
                        <i class="fa fa-check"></i> <?= $this->lang->line('submit'); ?>
                    </button>
                    <a href="<?= admin_url('transfers'); ?>" class="btn btn-default" style="padding: 11px 20px; font-weight: 600; border-radius: 6px;">
                        <?= lang('cancel') ?>
                    </a>
                </div>

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
