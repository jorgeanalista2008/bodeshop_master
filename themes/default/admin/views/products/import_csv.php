<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file-excel-o"></i><?= lang('import_products_by_csv'); ?></h2>
        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="<?= base_url(); ?>assets/csv/sample_products.csv" class="tip" title="<?= lang('download_sample_file') ?>">
                        <i class="icon fa fa-download"></i>
                    </a>
                </li>
            </ul>
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
                                <i class="fa fa-cloud-upload text-primary" style="margin-right: 8px;"></i> Carga Masiva de Productos con Diagnóstico en Vivo
                            </h3>
                            <p style="margin: 0; font-size: 13.5px; color: #64748b; line-height: 1.5;">
                                Sube tu archivo <code>.csv</code> para previsualizar los datos y detectar automáticamente cualquier error en categorías, unidades, códigos faltantes o duplicados <strong>antes de guardar</strong>.
                            </p>
                        </div>
                        <div class="col-md-4 col-sm-12 text-right" style="margin-bottom: 10px;">
                            <a href="<?= base_url(); ?>assets/csv/sample_products.csv" class="btn btn-success btn-lg" style="border-radius: 10px; font-weight: 700; font-size: 13.5px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa fa-download" style="margin-right: 6px;"></i> <?= lang('download_sample_file') ?>
                            </a>
                            <button type="button" class="btn btn-default btn-lg" data-toggle="collapse" data-target="#columnGuide" style="border-radius: 10px; font-weight: 600; font-size: 13.5px; border: 1.5px solid #cbd5e1; margin-left: 6px;">
                                <i class="fa fa-info-circle text-info"></i> Guía de Columnas
                            </button>
                        </div>
                    </div>

                    <!-- Column Guide Collapsible -->
                    <div id="columnGuide" class="collapse" style="margin-top: 18px; padding-top: 18px; border-top: 1px dashed #e2e8f0;">
                        <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 10px;">Estructura obligatoria de columnas (27 campos):</h4>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px;">
                            <span class="label label-primary" style="font-size: 11px; padding: 5px 8px;">0. Nombre *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 5px 8px;">1. Código *</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">2. Simbología (code128)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">3. Marca</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 5px 8px;">4. Código Categoría *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 5px 8px;">5. Código Unidad *</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">6. Unidad Venta</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">7. Unidad Compra</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 5px 8px;">8. Costo *</span>
                            <span class="label label-primary" style="font-size: 11px; padding: 5px 8px;">9. Precio *</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">10. Cantidad Alerta</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">11. Impuesto</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">12. Método Impuesto</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">13. Imagen</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">14. Subcategoría</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">15. Variantes (|)</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">16-21. Campos Personalizados 1-6</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">22. Código HSN</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">23. Segundo Nombre</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">24. Proveedor</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">25. Nro Parte Prov.</span>
                            <span class="label label-default" style="font-size: 11px; padding: 5px 8px;">26. Precio Prov.</span>
                        </div>
                        <p class="text-muted" style="font-size: 12px; margin-bottom: 0;">
                            <i class="fa fa-info-circle text-primary"></i> <strong>Nota:</strong> Los campos marcados con (*) son obligatorios. Si un código ya existe en tu inventario, sus datos se actualizarán automáticamente.
                        </p>
                    </div>
                </div>

                <!-- 2. Form Upload -->
                <?php
                $attrib = ['id' => 'csv-import-form', 'class' => 'form-horizontal', 'role' => 'form'];
                echo admin_form_open_multipart('products/import_csv', $attrib);
                ?>

                <!-- Drag & Drop Upload Zone -->
                <div id="dropzone-area" style="border: 2.5px dashed #cbd5e1; border-radius: 16px; background: #f8fafc; padding: 40px 20px; text-align: center; cursor: pointer; transition: all 0.25s ease; position: relative;">
                    <input type="file" name="userfile" id="csv_file" accept=".csv,text/csv" required="required" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 5;" />
                    
                    <div id="dropzone-content">
                        <div style="width: 64px; height: 64px; border-radius: 50%; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 14px; box-shadow: 0 4px 12px rgba(37,99,235,0.12);">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <h4 style="font-size: 17px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
                            Arrastra y suelta tu archivo CSV aquí, o <span style="color: #2563eb; text-decoration: underline;">haz clic para examinar</span>
                        </h4>
                        <p style="color: #64748b; font-size: 13px; margin: 0;">Formatos admitidos: <strong>.csv</strong> codificado en UTF-8 (separado por comas)</p>
                    </div>

                    <!-- File Selected Details (Hidden initially) -->
                    <div id="file-info-badge" style="display: none; padding-top: 10px;">
                        <span class="label label-info" style="font-size: 14px; padding: 8px 16px; border-radius: 20px; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fa fa-file-excel-o"></i> <span id="selected-file-name">archivo.csv</span> (<span id="selected-file-size">0 KB</span>)
                        </span>
                        <div style="margin-top: 10px;">
                            <span class="btn btn-sm btn-default" style="border-radius: 8px; font-weight: 600;"><i class="fa fa-refresh"></i> Cambiar archivo</span>
                        </div>
                    </div>
                </div>

                <!-- 3. Dynamic Live Preview & Error Diagnostic Section (Appears after file selection) -->
                <div id="csv-preview-section" style="display: none; margin-top: 24px;">

                    <!-- Validation Summary KPI Row -->
                    <div class="row" style="margin-bottom: 18px;">
                        <div class="col-md-3 col-sm-6">
                            <div class="modern-kpi-card kpi-blue" style="margin-bottom: 10px; border-radius: 12px; padding: 14px 16px;">
                                <div class="kpi-icon-wrapper" style="width: 44px; height: 44px; font-size: 18px;"><i class="fa fa-list"></i></div>
                                <div class="kpi-info">
                                    <span class="kpi-label">Total Productos</span>
                                    <h3 class="kpi-value" id="kpi-total-rows">0</h3>
                                    <span class="kpi-subtext">Filas detectadas</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="modern-kpi-card kpi-emerald" style="margin-bottom: 10px; border-radius: 12px; padding: 14px 16px;">
                                <div class="kpi-icon-wrapper" style="width: 44px; height: 44px; font-size: 18px;"><i class="fa fa-check"></i></div>
                                <div class="kpi-info">
                                    <span class="kpi-label">Listos / Válidos</span>
                                    <h3 class="kpi-value" id="kpi-valid-rows" style="color: #059669;">0</h3>
                                    <span class="kpi-subtext" style="color: #059669;">Sin errores críticos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="modern-kpi-card" style="margin-bottom: 10px; border-radius: 12px; padding: 14px 16px; background: #fff5f5; border: 1.5px solid #fecaca;">
                                <div class="kpi-icon-wrapper" style="width: 44px; height: 44px; font-size: 18px; background: #fee2e2; color: #dc2626;"><i class="fa fa-times"></i></div>
                                <div class="kpi-info">
                                    <span class="kpi-label" style="color: #991b1b;">Con Errores</span>
                                    <h3 class="kpi-value" id="kpi-error-rows" style="color: #dc2626;">0</h3>
                                    <span class="kpi-subtext" style="color: #dc2626;">Requieren corrección</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="modern-kpi-card kpi-amber" style="margin-bottom: 10px; border-radius: 12px; padding: 14px 16px;">
                                <div class="kpi-icon-wrapper" style="width: 44px; height: 44px; font-size: 18px;"><i class="fa fa-exclamation-triangle"></i></div>
                                <div class="kpi-info">
                                    <span class="kpi-label">Advertencias</span>
                                    <h3 class="kpi-value" id="kpi-warning-rows" style="color: #d97706;">0</h3>
                                    <span class="kpi-subtext">Actualizaciones / Alertas</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Pills & Table Controls -->
                    <div class="row" style="margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <div class="col-md-7 col-sm-12" style="margin-bottom: 8px;">
                            <div class="btn-group" id="preview-filter-buttons">
                                <button type="button" class="btn btn-default active" data-filter="all" style="border-radius: 8px 0 0 8px; font-weight: 600;">
                                    Todos (<span id="count-all">0</span>)
                                </button>
                                <button type="button" class="btn btn-default" data-filter="errors" style="font-weight: 600;">
                                    <span class="text-danger"><i class="fa fa-times-circle"></i> Solo con Errores (<span id="count-errors">0</span>)</span>
                                </button>
                                <button type="button" class="btn btn-default" data-filter="valid" style="border-radius: 0 8px 8px 0; font-weight: 600;">
                                    <span class="text-success"><i class="fa fa-check-circle"></i> Solo Válidos (<span id="count-valid">0</span>)</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12 text-right" style="margin-bottom: 8px;">
                            <input type="text" id="preview-search" class="form-control" placeholder="Buscar en la previsualización..." style="display: inline-block; width: 220px; border-radius: 8px; height: 36px;" />
                        </div>
                    </div>

                    <!-- Diagnostic Alert Message Container -->
                    <div id="diagnostic-alert-box" style="margin-bottom: 14px;"></div>

                    <!-- Live Preview Table -->
                    <div class="table-responsive" style="max-height: 440px; overflow-y: auto; border: 1.5px solid #e2e8f0; border-radius: 12px; background: #ffffff;">
                        <table class="table table-bordered table-hover" id="csv-preview-table" style="margin-bottom: 0; font-size: 13px;">
                            <thead>
                                <tr style="background: #f8fafc; color: #475569; position: sticky; top: 0; z-index: 2;">
                                    <th style="width: 60px; text-align: center;">Línea</th>
                                    <th style="width: 100px; text-align: center;">Estado</th>
                                    <th style="width: 280px;">Diagnóstico de Errores / Alertas</th>
                                    <th style="width: 120px;">Código</th>
                                    <th>Nombre del Producto</th>
                                    <th style="width: 110px;">Categoría</th>
                                    <th style="width: 90px;">Unidad</th>
                                    <th style="width: 90px; text-align: right;">Costo</th>
                                    <th style="width: 90px; text-align: right;">Precio</th>
                                </tr>
                            </thead>
                            <tbody id="csv-preview-tbody">
                                <!-- Populated dynamically by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Smart Submission Toolbar -->
                    <div class="well well-sm" style="background: #ffffff; border: 1.5px solid #e2e8f0; border-radius: 14px; padding: 18px 22px; margin-top: 20px; box-shadow: 0 4px 14px rgba(0,0,0,0.04); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                        <div style="margin-bottom: 8px;">
                            <label style="font-weight: 600; font-size: 13.5px; color: #334155; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <input type="checkbox" name="skip_errors" id="skip_errors" value="1" style="width: 17px; height: 17px; cursor: pointer;" />
                                <span>Omitir automáticamente filas con errores e importar solo las válidas</span>
                            </label>
                            <p class="text-muted" style="margin: 2px 0 0 25px; font-size: 12px;">
                                Si se desmarca y existen errores, la importación se detendrá para proteger la integridad de la base de datos.
                            </p>
                        </div>
                        <div style="margin-bottom: 8px;">
                            <button type="submit" id="btn-submit-import" class="btn btn-primary btn-lg" style="border-radius: 12px; font-weight: 800; font-size: 15px; padding: 12px 28px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border: none; box-shadow: 0 4px 14px rgba(37,99,235,0.35);">
                                <i class="fa fa-cloud-upload" style="margin-right: 8px;"></i> <span id="submit-btn-text">Importar Productos</span>
                            </button>
                        </div>
                    </div>

                </div>

                <?= form_close(); ?>

            </div>
        </div>
    </div>
</div>

<!-- Raw master catalogs injected for real-time client-side validation -->
<script type="text/javascript">
    var masterCategories = <?= json_encode($categories ?? []); ?>;
    var masterUnits = <?= json_encode($units ?? []); ?>;
    var masterBrands = <?= json_encode($brands ?? []); ?>;
    var masterTaxRates = <?= json_encode($tax_rates ?? []); ?>;
    var existingCodes = <?= json_encode($existing_codes ?? []); ?>;

    // Create fast lookup Maps
    var validCategoryCodes = {};
    $.each(masterCategories, function(i, c) {
        validCategoryCodes[$.trim(c.code).toLowerCase()] = c.name;
    });

    var validUnitCodes = {};
    $.each(masterUnits, function(i, u) {
        validUnitCodes[$.trim(u.code).toLowerCase()] = u.name;
    });

    var existingCodesMap = {};
    $.each(existingCodes, function(i, code) {
        if (code) existingCodesMap[$.trim(code).toLowerCase()] = true;
    });

    // RFC-compliant CSV Parser that handles commas inside quotes and multiline cells
    function parseCSV(text) {
        var lines = [];
        var row = [];
        var inQuotes = false;
        var token = '';

        for (var i = 0; i < text.length; i++) {
            var c = text[i];
            var nextC = text[i + 1];

            if (c === '"') {
                if (inQuotes && nextC === '"') {
                    token += '"';
                    i++; // skip escaped quote
                } else {
                    inQuotes = !inQuotes;
                }
            } else if (c === ',' && !inQuotes) {
                row.push(token);
                token = '';
            } else if ((c === '\r' || c === '\n') && !inQuotes) {
                if (c === '\r' && nextC === '\n') i++;
                row.push(token);
                token = '';
                if (row.length > 1 || (row.length === 1 && row[0] !== '')) {
                    lines.push(row);
                }
                row = [];
            } else {
                token += c;
            }
        }
        if (token.length > 0 || row.length > 0) {
            row.push(token);
            lines.push(row);
        }
        return lines;
    }

    var parsedRowsData = [];

    // Drag and Drop Effects
    var dropzone = document.getElementById('dropzone-area');
    var fileInput = document.getElementById('csv_file');

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

    fileInput.addEventListener('change', function(e) {
        var file = this.files[0];
        if (!file) return;

        // Update file badge
        $('#dropzone-content').hide();
        $('#selected-file-name').text(file.name);
        $('#selected-file-size').text((file.size / 1024).toFixed(1) + ' KB');
        $('#file-info-badge').fadeIn();

        var reader = new FileReader();
        reader.onload = function(evt) {
            var content = evt.target.result;
            processCSVData(content);
        };
        reader.readAsText(file, 'UTF-8');
    });

    function processCSVData(csvText) {
        var allRows = parseCSV(csvText);
        if (allRows.length <= 1) {
            bootbox.alert('El archivo CSV está vacío o solo contiene la cabecera.');
            return;
        }

        var header = allRows.shift();
        parsedRowsData = [];

        var codeOccurrences = {};
        allRows.forEach(function(row) {
            var code = row[1] ? $.trim(row[1]).toLowerCase() : '';
            if (code) {
                codeOccurrences[code] = (codeOccurrences[code] || 0) + 1;
            }
        });

        var totalRows = allRows.length;
        var errorCount = 0;
        var warningCount = 0;
        var validCount = 0;

        allRows.forEach(function(row, idx) {
            var lineNo = idx + 2; // Line in original file
            var name = row[0] ? $.trim(row[0]) : '';
            var code = row[1] ? $.trim(row[1]) : '';
            var catCode = row[4] ? $.trim(row[4]) : '';
            var unitCode = row[5] ? $.trim(row[5]) : '';
            var cost = row[8] ? $.trim(row[8]) : '';
            var price = row[9] ? $.trim(row[9]) : '';

            var errors = [];
            var warnings = [];

            // 1. Mandatory Name
            if (!name) {
                errors.push('Falta el <strong>Nombre del producto</strong>');
            }

            // 2. Mandatory Code & Duplicate checks
            if (!code) {
                errors.push('Falta el <strong>Código del producto</strong>');
            } else {
                var codeLower = code.toLowerCase();
                if (codeOccurrences[codeLower] > 1) {
                    errors.push('Código duplicado en este archivo (' + codeOccurrences[codeLower] + ' veces)');
                }
                if (existingCodesMap[codeLower]) {
                    warnings.push('Código ya existe en base de datos (se actualizará)');
                }
            }

            // 3. Category Validation
            if (!catCode) {
                errors.push('Falta el <strong>Código de Categoría</strong>');
            } else if (!validCategoryCodes[catCode.toLowerCase()]) {
                errors.push('La categoría "<strong>' + catCode + '</strong>" no existe en el sistema');
            }

            // 4. Unit Validation
            if (!unitCode) {
                errors.push('Falta el <strong>Código de Unidad</strong>');
            } else if (!validUnitCodes[unitCode.toLowerCase()]) {
                errors.push('La unidad "<strong>' + unitCode + '</strong>" no existe en el sistema');
            }

            // 5. Cost & Price Validation
            var numCost = parseFloat(cost.replace(',', '.'));
            var numPrice = parseFloat(price.replace(',', '.'));

            if (cost === '' || isNaN(numCost) || numCost < 0) {
                errors.push('Costo inválido (' + (cost || 'vacío') + ')');
            }

            if (price === '' || isNaN(numPrice) || numPrice < 0) {
                errors.push('Precio inválido (' + (price || 'vacío') + ')');
            } else if (!isNaN(numCost) && numPrice < numCost) {
                warnings.push('Precio de venta menor al costo (margen negativo)');
            }

            var status = 'valid';
            if (errors.length > 0) {
                status = 'error';
                errorCount++;
            } else if (warnings.length > 0) {
                status = 'warning';
                warningCount++;
                validCount++;
            } else {
                validCount++;
            }

            parsedRowsData.push({
                lineNo: lineNo,
                status: status,
                errors: errors,
                warnings: warnings,
                name: name,
                code: code,
                catCode: catCode,
                catName: validCategoryCodes[catCode.toLowerCase()] || '',
                unitCode: unitCode,
                cost: cost,
                price: price
            });
        });

        // Update KPIs
        $('#kpi-total-rows').text(totalRows);
        $('#kpi-valid-rows').text(validCount);
        $('#kpi-error-rows').text(errorCount);
        $('#kpi-warning-rows').text(warningCount);

        $('#count-all').text(totalRows);
        $('#count-errors').text(errorCount);
        $('#count-valid').text(validCount);

        // Render Diagnostic Alert Box
        var $alertBox = $('#diagnostic-alert-box').empty();
        if (errorCount === 0) {
            $alertBox.html('<div class="alert alert-success" style="position:static !important; border-radius:10px; margin-bottom:0;"><i class="fa fa-check-circle fa-lg"></i> <strong>¡Archivo 100% Válido!</strong> Los ' + totalRows + ' productos cumplen con todas las reglas y están listos para ser importados.</div>');
            $('#skip_errors').prop('checked', false).prop('disabled', true);
            $('#btn-submit-import').removeClass('btn-danger btn-warning').addClass('btn-primary').prop('disabled', false);
            $('#submit-btn-text').html('Importar ' + totalRows + ' Productos al Catálogo');
        } else {
            $alertBox.html('<div class="alert alert-danger" style="position:static !important; border-radius:10px; margin-bottom:0;"><i class="fa fa-exclamation-circle fa-lg"></i> <strong>Se encontraron ' + errorCount + ' filas con errores.</strong> Por favor revísalas en la tabla a continuación. Puedes corregir el CSV y volver a cargarlo, o marcar la casilla inferior para importar únicamente las <strong>' + validCount + '</strong> filas válidas.</div>');
            $('#skip_errors').prop('disabled', false);
            updateSubmitButtonState(validCount, errorCount);
        }

        renderPreviewTable(parsedRowsData);
        $('#csv-preview-section').fadeIn(300);
    }

    function updateSubmitButtonState(validCount, errorCount) {
        var skipChecked = $('#skip_errors').is(':checked');
        if (skipChecked) {
            $('#btn-submit-import').removeClass('btn-danger').addClass('btn-success').prop('disabled', validCount === 0);
            $('#submit-btn-text').html('Importar ' + validCount + ' Productos Válidos (Omitiendo ' + errorCount + ' con error)');
        } else {
            $('#btn-submit-import').removeClass('btn-success').addClass('btn-primary').prop('disabled', false);
            $('#submit-btn-text').html('Importar Productos (Requiere corregir errores)');
        }
    }

    $('#skip_errors').on('change', function() {
        var validCount = parseInt($('#kpi-valid-rows').text()) || 0;
        var errorCount = parseInt($('#kpi-error-rows').text()) || 0;
        updateSubmitButtonState(validCount, errorCount);
    });

    // Form Submission Interception if errors exist and skip_errors is unchecked
    $('#csv-import-form').on('submit', function(e) {
        var errorCount = parseInt($('#kpi-error-rows').text()) || 0;
        var skipChecked = $('#skip_errors').is(':checked');

        if (errorCount > 0 && !skipChecked) {
            e.preventDefault();
            bootbox.dialog({
                title: "<span class='text-danger'><i class='fa fa-exclamation-triangle'></i> Errores Detectados en el CSV</span>",
                message: "<p>Se encontraron <strong>" + errorCount + " filas con errores</strong> en tu archivo. Si continúas sin marcar 'Omitir filas con errores', la importación fallará.</p><p>¿Deseas activar la opción de omitir filas con errores e importar las filas válidas ahora mismo?</p>",
                buttons: {
                    cancel: {
                        label: "Cancelar y corregir mi archivo",
                        className: "btn-default"
                    },
                    confirm: {
                        label: "<i class='fa fa-check'></i> Omitir errores e Importar",
                        className: "btn-success",
                        callback: function() {
                            $('#skip_errors').prop('checked', true);
                            $('#csv-import-form')[0].submit();
                        }
                    }
                }
            });
            return false;
        }
    });

    function renderPreviewTable(data) {
        var $tbody = $('#csv-preview-tbody').empty();
        var currentFilter = $('#preview-filter-buttons .btn.active').data('filter') || 'all';
        var searchQuery = $('#preview-search').val().toLowerCase();

        var rendered = 0;
        data.forEach(function(row) {
            // Apply filter
            if (currentFilter === 'errors' && row.status !== 'error') return;
            if (currentFilter === 'valid' && row.status === 'error') return;

            // Apply search query
            if (searchQuery) {
                var match = row.name.toLowerCase().indexOf(searchQuery) !== -1 ||
                            row.code.toLowerCase().indexOf(searchQuery) !== -1 ||
                            row.catCode.toLowerCase().indexOf(searchQuery) !== -1;
                if (!match) return;
            }

            rendered++;

            var trClass = '';
            var statusBadge = '';
            if (row.status === 'error') {
                trClass = 'danger';
                statusBadge = '<span class="label label-danger" style="font-size:11px; padding:4px 8px; border-radius:6px;"><i class="fa fa-times-circle"></i> Error</span>';
            } else if (row.status === 'warning') {
                trClass = 'warning';
                statusBadge = '<span class="label label-warning" style="font-size:11px; padding:4px 8px; border-radius:6px;"><i class="fa fa-exclamation-triangle"></i> Alerta</span>';
            } else {
                statusBadge = '<span class="label label-success" style="font-size:11px; padding:4px 8px; border-radius:6px;"><i class="fa fa-check-circle"></i> Válido</span>';
            }

            var diagnosticHtml = '';
            if (row.errors.length > 0) {
                diagnosticHtml = '<ul style="margin:0; padding-left:16px; color:#b91c1c; font-size:12px;">';
                row.errors.forEach(function(err) {
                    diagnosticHtml += '<li>' + err + '</li>';
                });
                diagnosticHtml += '</ul>';
            } else if (row.warnings.length > 0) {
                diagnosticHtml = '<ul style="margin:0; padding-left:16px; color:#b45309; font-size:12px;">';
                row.warnings.forEach(function(warn) {
                    diagnosticHtml += '<li>' + warn + '</li>';
                });
                diagnosticHtml += '</ul>';
            } else {
                diagnosticHtml = '<span class="text-success" style="font-size:12px;"><i class="fa fa-check"></i> Listo para procesar</span>';
            }

            var catDisplay = row.catCode ? '<code>' + row.catCode + '</code>' : '<span class="text-danger font-weight-bold">Faltante</span>';
            if (row.catName) {
                catDisplay += ' <small class="text-muted">(' + row.catName + ')</small>';
            }

            var unitDisplay = row.unitCode ? '<code>' + row.unitCode + '</code>' : '<span class="text-danger font-weight-bold">Faltante</span>';

            var tr = '<tr class="' + trClass + '">' +
                '<td class="text-center"><strong>L' + row.lineNo + '</strong></td>' +
                '<td class="text-center">' + statusBadge + '</td>' +
                '<td>' + diagnosticHtml + '</td>' +
                '<td><code>' + (row.code || 'N/A') + '</code></td>' +
                '<td><strong>' + (row.name || 'Sin nombre') + '</strong></td>' +
                '<td>' + catDisplay + '</td>' +
                '<td>' + unitDisplay + '</td>' +
                '<td class="text-right font-weight-bold">' + row.cost + '</td>' +
                '<td class="text-right font-weight-bold">' + row.price + '</td>' +
            '</tr>';

            $tbody.append(tr);
        });

        if (rendered === 0) {
            $tbody.append('<tr><td colspan="9" class="text-center text-muted" style="padding:20px;">No se encontraron filas que coincidan con el filtro seleccionado.</td></tr>');
        }
    }

    // Filter Buttons Click
    $('#preview-filter-buttons .btn').on('click', function() {
        $('#preview-filter-buttons .btn').removeClass('active btn-primary').addClass('btn-default');
        $(this).addClass('active btn-primary').removeClass('btn-default');
        renderPreviewTable(parsedRowsData);
    });

    // Search input typing
    $('#preview-search').on('keyup', function() {
        renderPreviewTable(parsedRowsData);
    });
</script>
