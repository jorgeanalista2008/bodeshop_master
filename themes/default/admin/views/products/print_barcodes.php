<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="box">
    <div class="box-header no-print">
        <h2 class="blue"><i class="fa-fw fa fa-barcode"></i><?= lang('print_barcode_label'); ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" onclick="window.print();return false;" id="print-icon" class="tip" title="<?= lang('print') ?>">
                        <i class="icon fa fa-print"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Helper Guide Card -->
                <div class="alert alert-info alert-dismissable no-print" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: 10px; margin-bottom: 20px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #166534; opacity: 0.7;">&times;</button>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fa fa-lightbulb-o fa-2x" style="color: #16a34a; flex-shrink: 0;"></i>
                        <div style="font-size: 13px; line-height: 1.5;">
                            <strong>Estudio de Impresión de Códigos de Barra:</strong> 
                            <?php echo sprintf(
                                lang('print_barcode_heading'),
                                anchor('admin/system_settings/categories', lang('categories'), 'style="font-weight:600; text-decoration:underline; color:#15803d;"'),
                                anchor('admin/system_settings/subcategories', lang('subcategories'), 'style="font-weight:600; text-decoration:underline; color:#15803d;"'),
                                anchor('admin/purchases', lang('purchases'), 'style="font-weight:600; text-decoration:underline; color:#15803d;"'),
                                anchor('admin/transfers', lang('transfers'), 'style="font-weight:600; text-decoration:underline; color:#15803d;"')
                            ); ?>
                        </div>
                    </div>
                </div>

                <?= admin_form_open('products/print_barcodes', 'id="barcode-print-form" data-toggle="validator" class="no-print"'); ?>
                
                <!-- PASO 1: SELECCION DE PRODUCTOS -->
                <div class="bc-studio-panel">
                    <div class="bc-studio-header">
                        <h4>
                            <span class="bc-step-badge">Paso 1</span>
                            <span>Selección de Productos y Cantidades</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-info-circle"></i> Ingrese o escanee para agregar ítems a la cola
                        </span>
                    </div>
                    <div class="bc-studio-body">
                        <div class="bc-search-box">
                            <i class="fa fa-barcode bc-search-icon"></i>
                            <?php echo form_input('add_item', '', 'class="form-control" id="add_item" placeholder="Escanee el código de barras o escriba el nombre del producto..." autofocus'); ?>
                            <div class="bc-search-badge">
                                <i class="fa fa-keyboard-o"></i> Lector / Búsqueda
                            </div>
                        </div>

                        <!-- Empty state when no items -->
                        <div id="bc-empty-notice" class="bc-empty-table" style="display: none;">
                            <i class="fa fa-barcode"></i>
                            <h5>Cola de impresión vacía</h5>
                            <p>Escanee un código de barras o busque un producto para comenzar a preparar las etiquetas.</p>
                        </div>

                        <!-- Products table -->
                        <div class="table-responsive">
                            <table id="bcTable" class="table items table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 45%;"><i class="fa fa-cube" style="margin-right: 6px; color: #2563eb;"></i> <?= lang('product_name') . ' / ' . $this->lang->line('product_code'); ?></th>
                                        <th style="width: 20%; text-align: center;"><i class="fa fa-sort-numeric-asc" style="margin-right: 6px; color: #2563eb;"></i> <?= lang('quantity'); ?></th>
                                        <th style="width: 25%;"><i class="fa fa-tags" style="margin-right: 6px; color: #2563eb;"></i> <?= lang('variants'); ?></th>
                                        <th style="width: 10%; text-align: center;"><i class="fa fa-trash-o" style="color: #ef4444;"></i></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: CONFIGURACION DE FORMATO Y CAMPOS -->
                <div class="bc-studio-panel">
                    <div class="bc-studio-header">
                        <h4>
                            <span class="bc-step-badge" style="background: #475569;">Paso 2</span>
                            <span>Formato de Hoja y Campos Visibles</span>
                        </h4>
                        <span class="text-muted" style="font-size: 12px;">
                            <i class="fa fa-sliders"></i> Personalice qué datos imprimir en cada etiqueta
                        </span>
                    </div>
                    <div class="bc-studio-body">
                        <div class="row">
                            <!-- Left: Sheet format & continuous dimensions -->
                            <div class="col-md-4" style="border-right: 1px solid #e2e8f0; padding-right: 25px;">
                                <div class="form-group" style="margin-bottom: 16px;">
                                    <label for="style" style="font-weight: 700; color: #0f172a; margin-bottom: 6px; display: block;">
                                        <i class="fa fa-file-text-o text-primary" style="margin-right: 6px;"></i> Formato de Hoja / Rollo:
                                    </label>
                                    <?php 
                                        $opts = [
                                            '' => lang('select') . ' ' . lang('style'), 
                                            40 => '40 por hoja (A4)', 
                                            30 => '30 por hoja (Carta / Letter)', 
                                            24 => '24 por hoja (A4)', 
                                            20 => '20 por hoja (Carta / Letter)', 
                                            18 => '18 por hoja (A4)', 
                                            14 => '14 por hoja (Carta / Letter)', 
                                            12 => '12 por hoja (A4)', 
                                            10 => '10 por hoja (Carta / Letter)', 
                                            50 => 'Rollo Continuo (Impresora Térmica)'
                                        ]; 
                                    ?>
                                    <?= form_dropdown('style', $opts, set_value('style', 24), 'class="form-control tip" id="style" required="required" style="height: 42px; border-radius: 8px; font-weight: 600;"'); ?>
                                </div>

                                <!-- Continuous feed settings box -->
                                <div class="cf-con bc-cf-box" style="display: none;">
                                    <div style="font-weight: 700; font-size: 12px; color: #1e40af; margin-bottom: 10px; text-transform: uppercase;">
                                        <i class="fa fa-cog"></i> Dimensiones del Rollo Térmico
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label style="font-size: 11px; font-weight: 600; color: #475569;"><?= lang('width'); ?>:</label>
                                        <div class="input-group input-group-sm">
                                            <?= form_input('cf_width', '', 'class="form-control" id="cf_width" placeholder="' . lang('width') . '"'); ?>
                                            <span class="input-group-addon" style="font-weight: 600;"><?= lang('inches'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label style="font-size: 11px; font-weight: 600; color: #475569;"><?= lang('height'); ?>:</label>
                                        <div class="input-group input-group-sm">
                                            <?= form_input('cf_height', '', 'class="form-control" id="cf_height" placeholder="' . lang('height') . '"'); ?>
                                            <span class="input-group-addon" style="font-weight: 600;"><?= lang('inches'); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label style="font-size: 11px; font-weight: 600; color: #475569;"><?= lang('orientation'); ?>:</label>
                                        <?php $oopts = [0 => lang('portrait'), 1 => lang('landscape')]; ?>
                                        <?= form_dropdown('cf_orientation', $oopts, '', 'class="form-control input-sm" id="cf_orientation"'); ?>
                                    </div>
                                </div>

                                <div style="margin-top: 14px; font-size: 12px; color: #64748b; line-height: 1.4;">
                                    <i class="fa fa-info-circle text-muted"></i> <?= lang('barcode_tip'); ?>
                                </div>
                            </div>

                            <!-- Right: Field Toggles Grid -->
                            <div class="col-md-8" style="padding-left: 25px;">
                                <label style="font-weight: 700; color: #0f172a; margin-bottom: 8px; display: block;">
                                    <i class="fa fa-check-square-o text-primary" style="margin-right: 6px;"></i> Elementos a incluir en la etiqueta:
                                </label>

                                <div class="bc-options-grid">
                                    <!-- Site Name -->
                                    <div class="bc-opt-card" data-for="site_name">
                                        <div class="bc-opt-icon"><i class="fa fa-building-o"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('site_name'); ?></div>
                                            <div class="bc-opt-desc">Nombre de la empresa</div>
                                        </div>
                                        <input name="site_name" type="checkbox" id="site_name" value="1" checked="checked" />
                                    </div>

                                    <!-- Product Name -->
                                    <div class="bc-opt-card" data-for="product_name">
                                        <div class="bc-opt-icon"><i class="fa fa-font"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('product_name'); ?></div>
                                            <div class="bc-opt-desc">Descripción del ítem</div>
                                        </div>
                                        <input name="product_name" type="checkbox" id="product_name" value="1" checked="checked" />
                                    </div>

                                    <!-- Price -->
                                    <div class="bc-opt-card" data-for="price">
                                        <div class="bc-opt-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('price'); ?></div>
                                            <div class="bc-opt-desc">Precio de venta</div>
                                        </div>
                                        <input name="price" type="checkbox" id="price" value="1" checked="checked" />
                                    </div>

                                    <!-- Currencies -->
                                    <div class="bc-opt-card" data-for="currencies">
                                        <div class="bc-opt-icon"><i class="fa fa-globe"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('currencies'); ?></div>
                                            <div class="bc-opt-desc">Multi-moneda (USD / Bs)</div>
                                        </div>
                                        <input name="currencies" type="checkbox" id="currencies" value="1" />
                                    </div>

                                    <!-- Unit -->
                                    <div class="bc-opt-card" data-for="unit">
                                        <div class="bc-opt-icon"><i class="fa fa-balance-scale"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('unit'); ?></div>
                                            <div class="bc-opt-desc">Unidad de medida</div>
                                        </div>
                                        <input name="unit" type="checkbox" id="unit" value="1" />
                                    </div>

                                    <!-- Category -->
                                    <div class="bc-opt-card" data-for="category">
                                        <div class="bc-opt-icon"><i class="fa fa-folder-open-o"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('category'); ?></div>
                                            <div class="bc-opt-desc">Categoría del ítem</div>
                                        </div>
                                        <input name="category" type="checkbox" id="category" value="1" />
                                    </div>

                                    <!-- Variants -->
                                    <div class="bc-opt-card" data-for="variants">
                                        <div class="bc-opt-icon"><i class="fa fa-tags"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('variants'); ?></div>
                                            <div class="bc-opt-desc">Variantes de producto</div>
                                        </div>
                                        <input name="variants" type="checkbox" id="variants" value="1" />
                                    </div>

                                    <!-- Product Image -->
                                    <div class="bc-opt-card" data-for="product_image">
                                        <div class="bc-opt-icon"><i class="fa fa-picture-o"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('product_image'); ?></div>
                                            <div class="bc-opt-desc">Miniatura del ítem</div>
                                        </div>
                                        <input name="product_image" type="checkbox" id="product_image" value="1" />
                                    </div>

                                    <!-- Promo Price -->
                                    <div class="bc-opt-card" data-for="check_promo">
                                        <div class="bc-opt-icon"><i class="fa fa-percent"></i></div>
                                        <div class="bc-opt-content">
                                            <div class="bc-opt-title"><?= lang('check_promo'); ?></div>
                                            <div class="bc-opt-desc">Aplicar si hay promoción</div>
                                        </div>
                                        <input name="check_promo" type="checkbox" id="check_promo" value="1" checked="checked" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Bar -->
                        <div id="bc-btn-bar" style="margin-top: 24px; padding-top: 18px; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                            <button type="button" id="reset" class="btn btn-default" style="border-radius: 8px; font-weight: 600; padding: 10px 20px; color: #dc2626;">
                                <i class="fa fa-trash-o" style="margin-right: 6px;"></i> <?= lang('reset'); ?> / Limpiar Cola
                            </button>

                            <button type="submit" name="print" value="1" class="btn btn-primary" style="border-radius: 8px; font-weight: 700; padding: 10px 26px; box-shadow: 0 4px 14px rgba(37,99,235,0.25);">
                                <i class="fa fa-refresh" style="margin-right: 8px;"></i> <?= lang('update'); ?> / Generar Etiquetas
                            </button>
                        </div>
                    </div>
                </div>

                <?= form_close(); ?>

                <!-- ESTACION DE IMPRESION Y VISTA PREVIA -->
                <div id="barcode-con">
                    <?php if ($this->input->post('print')): ?>
                        <?php if (!empty($barcodes)): ?>
                            <?php 
                                $total_labels = 0;
                                foreach ($barcodes as $item) {
                                    $total_labels += $item['quantity'];
                                }
                            ?>
                            <div class="bc-preview-wrapper">
                                <!-- Print Toolbar -->
                                <div class="bc-preview-toolbar no-print">
                                    <div>
                                        <h4 style="margin: 0; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 8px;">
                                            <i class="fa fa-print text-primary"></i> Vista Previa de Impresión Lista
                                        </h4>
                                        <div style="font-size: 13px; color: #64748b; margin-top: 4px; display: flex; align-items: center; gap: 8px;">
                                            <span class="label label-primary" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><?= count($barcodes); ?> productos</span>
                                            <span class="label label-success" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><?= $total_labels; ?> etiquetas generadas</span>
                                            <span>&bull; Formato: <strong><?= ($style == 50 ? 'Rollo Continuo (' . $this->input->post('cf_width') . 'x' . $this->input->post('cf_height') . ' in)' : $style . ' por hoja'); ?></strong></span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" onclick="window.print();return false;" class="btn btn-success btn-lg tip" title="<?= lang('print') ?>" style="border-radius: 8px; font-weight: 700; padding: 10px 24px; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.3);">
                                            <i class="icon fa fa-print" style="margin-right: 6px;"></i> <?= lang('print'); ?> Ahora
                                        </button>
                                    </div>
                                </div>

                                <!-- Realistic Paper Sheet -->
                                <div class="bc-paper-sheet">
                                    <?php
                                        $c = 1;
                                        if ($style == 12 || $style == 18 || $style == 24 || $style == 40) {
                                            echo '<div class="barcodea4">';
                                        } elseif ($style != 50) {
                                            echo '<div class="barcode">';
                                        }
                                        foreach ($barcodes as $item) {
                                            for ($r = 1; $r <= $item['quantity']; $r++) {
                                                echo '<div class="item style' . $style . '" ' .
                                                ($style == 50 && $this->input->post('cf_width') && $this->input->post('cf_height') ?
                                                    'style="width:' . $this->input->post('cf_width') . 'in;height:' . $this->input->post('cf_height') . 'in;border:0;"' : '')
                                                . '>';
                                                if ($style == 50) {
                                                    if ($this->input->post('cf_orientation')) {
                                                        $ty        = (($this->input->post('cf_height') / $this->input->post('cf_width')) * 100) . '%';
                                                        $landscape = '
                                                        -webkit-transform-origin: 0 0;
                                                        -moz-transform-origin:    0 0;
                                                        -ms-transform-origin:     0 0;
                                                        transform-origin:         0 0;
                                                        -webkit-transform: translateY(' . $ty . ') rotate(-90deg);
                                                        -moz-transform:    translateY(' . $ty . ') rotate(-90deg);
                                                        -ms-transform:     translateY(' . $ty . ') rotate(-90deg);
                                                        transform:         translateY(' . $ty . ') rotate(-90deg);
                                                        ';
                                                        echo '<div class="div50" style="width:' . $this->input->post('cf_height') . 'in;height:' . $this->input->post('cf_width') . 'in;border: 1px dotted #CCC;' . $landscape . '">';
                                                    } else {
                                                        echo '<div class="div50" style="width:' . $this->input->post('cf_width') . 'in;height:' . $this->input->post('cf_height') . 'in;border: 1px dotted #CCC;padding-top:0.025in;">';
                                                    }
                                                }
                                                if ($item['image']) {
                                                    echo '<span class="product_image"><img src="' . base_url('assets/uploads/thumbs/' . $item['image']) . '" alt="" /></span>';
                                                }
                                                if ($item['site']) {
                                                    echo '<span class="barcode_site">' . $item['site'] . '</span>';
                                                }
                                                if ($item['name']) {
                                                    echo '<span class="barcode_name">' . $item['name'] . '</span>';
                                                }
                                                if ($item['price']) {
                                                    echo '<span class="barcode_price">' . lang('price') . ' ';
                                                    if ($item['currencies']) {
                                                        foreach ($currencies as $currency) {
                                                            echo $currency->code . ': ' . $this->sma->formatMoney($item['rprice'] * $currency->rate, 'none') . ', ';
                                                        }
                                                    } else {
                                                        echo $item['price'];
                                                    }
                                                    echo '</span> ';
                                                }
                                                if ($item['unit']) {
                                                    echo '<span class="barcode_unit">' . lang('unit') . ': ' . $item['unit'] . '</span>, ';
                                                }
                                                if ($item['category']) {
                                                    echo '<span class="barcode_category">' . lang('category') . ': ' . $item['category'] . '</span> ';
                                                }
                                                if ($item['variants']) {
                                                    echo '<span class="variants">' . lang('variants') . ': ';
                                                    foreach ($item['variants'] as $variant) {
                                                        echo $variant->name . ', ';
                                                    }
                                                    echo '</span> ';
                                                }
                                                echo '<span class="barcode_image"><img src="' . admin_url('products/barcode/' . $item['barcode'] . '/' . $item['bcs'] . '/' . $item['bcis']) . '" alt="' . $item['barcode'] . '" class="bcimg" /></span>';
                                                if ($style == 50) {
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                if ($style == 40) {
                                                    if ($c % 40 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                                    }
                                                } elseif ($style == 30) {
                                                    if ($c % 30 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcode">';
                                                    }
                                                } elseif ($style == 24) {
                                                    if ($c % 24 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                                    }
                                                } elseif ($style == 20) {
                                                    if ($c % 20 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcode">';
                                                    }
                                                } elseif ($style == 18) {
                                                    if ($c % 18 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                                    }
                                                } elseif ($style == 14) {
                                                    if ($c % 14 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcode">';
                                                    }
                                                } elseif ($style == 12) {
                                                    if ($c % 12 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcodea4">';
                                                    }
                                                } elseif ($style == 10) {
                                                    if ($c % 10 == 0) {
                                                        echo '</div><div class="clearfix"></div><div class="barcode">';
                                                    }
                                                }
                                                $c++;
                                            }
                                        }
                                        if ($style != 50) {
                                            echo '</div>';
                                        }
                                    ?>
                                </div>

                                <!-- Bottom Print CTA -->
                                <div class="no-print text-center" style="margin-top: 24px;">
                                    <button type="button" onclick="window.print();return false;" class="btn btn-success btn-lg tip" title="<?= lang('print') ?>" style="border-radius: 8px; font-weight: 700; padding: 12px 34px; font-size: 16px; box-shadow: 0 4px 16px rgba(5, 150, 105, 0.3);">
                                        <i class="icon fa fa-print" style="margin-right: 8px;"></i> <?= lang('print'); ?> Etiquetas Ahora
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning text-center no-print" style="border-radius: 12px; padding: 30px; margin-top: 20px;">
                                <i class="fa fa-exclamation-triangle fa-3x" style="color: #d97706; margin-bottom: 12px; display: block;"></i>
                                <h4 style="font-weight: 700; color: #92400e; margin: 0 0 6px 0;"><?= lang('no_product_selected'); ?></h4>
                                <p style="color: #b45309; font-size: 14px; margin: 0;">Seleccione productos en el Paso 1 para generar la vista previa de etiquetas.</p>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var ac = false; 
    var bcitems = {};
    if (localStorage.getItem('bcitems')) {
        bcitems = JSON.parse(localStorage.getItem('bcitems'));
    }
    <?php if ($items): ?>
        localStorage.setItem('bcitems', JSON.stringify(<?= $items; ?>));
        bcitems = <?= $items; ?>;
    <?php endif; ?>

    $(document).ready(function() {
        <?php if ($this->input->post('print')): ?>
            $(window).load(function() {
                $('html, body').animate({
                    scrollTop: ($("#barcode-con").offset().top) - 15
                }, 1000);
            });
        <?php endif; ?>

        loadItems();

        // Autocomplete on search input
        $("#add_item").autocomplete({
            source: '<?= admin_url('products/get_suggestions'); ?>',
            minLength: 1,
            autoFocus: false,
            delay: 250,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_product_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                    $(this).removeClass('ui-autocomplete-loading');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert('<?= lang('no_product_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
            },
            select: function (event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_product_item(ui.item);
                    if (row) {
                        $(this).val('');
                    }
                } else {
                    bootbox.alert('<?= lang('no_product_found') ?>');
                }
            }
        });
        check_add_item_val();

        // Style change handler
        $('#style').change(function (e) {
            localStorage.setItem('bcstyle', $(this).val());
            if ($(this).val() == 50) {
                $('.cf-con').slideDown(200);
            } else {
                $('.cf-con').slideUp(200);
            }
        });
        if (style = localStorage.getItem('bcstyle')) {
            $('#style').val(style);
            if ($('#style').data('select2')) {
                $('#style').select2("val", style);
            }
            if (style == 50) {
                $('.cf-con').slideDown(0);
            } else {
                $('.cf-con').slideUp(0);
            }
        }

        // Continuous feed dimensions
        $('#cf_width').change(function (e) {
            localStorage.setItem('cf_width', $(this).val());
        });
        if (cf_width = localStorage.getItem('cf_width')) {
            $('#cf_width').val(cf_width);
        }

        $('#cf_height').change(function (e) {
            localStorage.setItem('cf_height', $(this).val());
        });
        if (cf_height = localStorage.getItem('cf_height')) {
            $('#cf_height').val(cf_height);
        }

        $('#cf_orientation').change(function (e) {
            localStorage.setItem('cf_orientation', $(this).val());
        });
        if (cf_orientation = localStorage.getItem('cf_orientation')) {
            $('#cf_orientation').val(cf_orientation);
        }

        // Helper to sync option card active state
        function syncCardState(selector) {
            var el = $(selector);
            var card = el.closest('.bc-opt-card');
            if (el.is(':checked')) {
                card.addClass('active');
            } else {
                card.removeClass('active');
            }
        }

        // Click on entire option card toggles checkbox
        $(document).on('click', '.bc-opt-card', function(e) {
            if (!$(e.target).closest('.icheckbox_square-blue').length && !$(e.target).is('input[type="checkbox"]')) {
                var cb = $(this).find('input[type="checkbox"]');
                cb.iCheck('toggle');
            }
        });

        // Field toggles with localStorage and iCheck
        $(document).on('ifChecked', '#site_name', function(event) {
            localStorage.setItem('bcsite_name', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#site_name', function(event) {
            localStorage.setItem('bcsite_name', 0);
            syncCardState(this);
        });
        if (site_name = localStorage.getItem('bcsite_name')) {
            if (site_name == 1) $('#site_name').iCheck('check');
            else $('#site_name').iCheck('uncheck');
        }
        syncCardState('#site_name');

        $(document).on('ifChecked', '#product_name', function(event) {
            localStorage.setItem('bcproduct_name', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#product_name', function(event) {
            localStorage.setItem('bcproduct_name', 0);
            syncCardState(this);
        });
        if (product_name = localStorage.getItem('bcproduct_name')) {
            if (product_name == 1) $('#product_name').iCheck('check');
            else $('#product_name').iCheck('uncheck');
        }
        syncCardState('#product_name');

        $(document).on('ifChecked', '#price', function(event) {
            localStorage.setItem('bcprice', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#price', function(event) {
            localStorage.setItem('bcprice', 0);
            $('#currencies').iCheck('uncheck');
            syncCardState(this);
            syncCardState('#currencies');
        });
        if (price = localStorage.getItem('bcprice')) {
            if (price == 1) $('#price').iCheck('check');
            else $('#price').iCheck('uncheck');
        }
        syncCardState('#price');

        $(document).on('ifChecked', '#currencies', function(event) {
            localStorage.setItem('bccurrencies', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#currencies', function(event) {
            localStorage.setItem('bccurrencies', 0);
            syncCardState(this);
        });
        if (currencies = localStorage.getItem('bccurrencies')) {
            if (currencies == 1) $('#currencies').iCheck('check');
            else $('#currencies').iCheck('uncheck');
        }
        syncCardState('#currencies');

        $(document).on('ifChecked', '#unit', function(event) {
            localStorage.setItem('bcunit', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#unit', function(event) {
            localStorage.setItem('bcunit', 0);
            syncCardState(this);
        });
        if (unit = localStorage.getItem('bcunit')) {
            if (unit == 1) $('#unit').iCheck('check');
            else $('#unit').iCheck('uncheck');
        }
        syncCardState('#unit');

        $(document).on('ifChecked', '#category', function(event) {
            localStorage.setItem('bccategory', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#category', function(event) {
            localStorage.setItem('bccategory', 0);
            syncCardState(this);
        });
        if (category = localStorage.getItem('bccategory')) {
            if (category == 1) $('#category').iCheck('check');
            else $('#category').iCheck('uncheck');
        }
        syncCardState('#category');

        $(document).on('ifChecked', '#check_promo', function(event) {
            localStorage.setItem('bccheck_promo', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#check_promo', function(event) {
            localStorage.setItem('bccheck_promo', 0);
            syncCardState(this);
        });
        if (check_promo = localStorage.getItem('bccheck_promo')) {
            if (check_promo == 1) $('#check_promo').iCheck('check');
            else $('#check_promo').iCheck('uncheck');
        }
        syncCardState('#check_promo');

        $(document).on('ifChecked', '#product_image', function(event) {
            localStorage.setItem('bcproduct_image', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#product_image', function(event) {
            localStorage.setItem('bcproduct_image', 0);
            syncCardState(this);
        });
        if (product_image = localStorage.getItem('bcproduct_image')) {
            if (product_image == 1) $('#product_image').iCheck('check');
            else $('#product_image').iCheck('uncheck');
        }
        syncCardState('#product_image');

        $(document).on('ifChecked', '#variants', function(event) {
            localStorage.setItem('bcvariants', 1);
            syncCardState(this);
        });
        $(document).on('ifUnchecked', '#variants', function(event) {
            localStorage.setItem('bcvariants', 0);
            syncCardState(this);
        });
        if (variants = localStorage.getItem('bcvariants')) {
            if (variants == 1) $('#variants').iCheck('check');
            else $('#variants').iCheck('uncheck');
        }
        syncCardState('#variants');

        // Variant item checkboxes in table
        $(document).on('ifChecked', '.checkbox', function(event) {
            var item_id = $(this).attr('data-item-id');
            var vt_id = $(this).attr('id');
            if (bcitems[item_id]) {
                bcitems[item_id]['selected_variants'][vt_id] = 1;
                localStorage.setItem('bcitems', JSON.stringify(bcitems));
            }
            $(this).closest('.bc-variant-pill').addClass('active');
        });
        $(document).on('ifUnchecked', '.checkbox', function(event) {
            var item_id = $(this).attr('data-item-id');
            var vt_id = $(this).attr('id');
            if (bcitems[item_id]) {
                bcitems[item_id]['selected_variants'][vt_id] = 0;
                localStorage.setItem('bcitems', JSON.stringify(bcitems));
            }
            $(this).closest('.bc-variant-pill').removeClass('active');
        });

        // Delete item row
        $(document).on('click', '.del', function () {
            var id = $(this).attr('id');
            delete bcitems[id];
            localStorage.setItem('bcitems', JSON.stringify(bcitems));
            $(this).closest('#row_' + id).remove();
            checkEmptyState();
        });

        // Quantity Stepper buttons
        $(document).on('click', '.btn-qty-plus', function() {
            var id = $(this).attr('data-id');
            var input = $('#quantity_' + id);
            var val = parseFloat(input.val()) || 0;
            input.val(val + 1).trigger('change');
        });
        $(document).on('click', '.btn-qty-minus', function() {
            var id = $(this).attr('data-id');
            var input = $('#quantity_' + id);
            var val = parseFloat(input.val()) || 0;
            if (val > 1) {
                input.val(val - 1).trigger('change');
            }
        });

        // Quantity manual input change
        var old_row_qty;
        $(document).on("focus", '.quantity', function () {
            old_row_qty = $(this).val();
        }).on("change", '.quantity', function () {
            var row = $(this).closest('tr');
            if (!is_numeric($(this).val()) || parseFloat($(this).val()) <= 0) {
                $(this).val(old_row_qty);
                bootbox.alert(lang.unexpected_value);
                return;
            }
            var new_qty = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
            bcitems[item_id].qty = new_qty;
            localStorage.setItem('bcitems', JSON.stringify(bcitems));
        });

        // Reset Button
        $('#reset').click(function (e) {
            bootbox.confirm(lang.r_u_sure, function (result) {
                if (result) {
                    if (localStorage.getItem('bcitems')) localStorage.removeItem('bcitems');
                    if (localStorage.getItem('bcstyle')) localStorage.removeItem('bcstyle');
                    if (localStorage.getItem('bcsite_name')) localStorage.removeItem('bcsite_name');
                    if (localStorage.getItem('bcproduct_name')) localStorage.removeItem('bcproduct_name');
                    if (localStorage.getItem('bcprice')) localStorage.removeItem('bcprice');
                    if (localStorage.getItem('bccurrencies')) localStorage.removeItem('bccurrencies');
                    if (localStorage.getItem('bcunit')) localStorage.removeItem('bcunit');
                    if (localStorage.getItem('bccategory')) localStorage.removeItem('bccategory');
                    $('#modal-loading').show();
                    window.location.replace("<?= admin_url('products/print_barcodes'); ?>");
                }
            });
        });

    });

    function checkEmptyState() {
        var count = 0;
        if (bcitems) {
            count = Object.keys(bcitems).length;
        }
        if (count > 0) {
            $('#bcTable').show();
            $('#bc-empty-notice').hide();
        } else {
            $('#bcTable').hide();
            $('#bc-empty-notice').show();
        }
    }

    function add_product_item(item) {
        ac = true;
        if (item == null) {
            return false;
        }
        item_id = item.id;
        if (bcitems[item_id]) {
            bcitems[item_id].qty = parseFloat(bcitems[item_id].qty) + 1;
        } else {
            bcitems[item_id] = item;
            bcitems[item_id]['selected_variants'] = {};
            if (item.variants) {
                $.each(item.variants, function () {
                    bcitems[item_id]['selected_variants'][this.id] = 1;
                });
            }
        }

        localStorage.setItem('bcitems', JSON.stringify(bcitems));
        loadItems();
        return true;
    }

    function loadItems() {
        if (localStorage.getItem('bcitems')) {
            $("#bcTable tbody").empty();
            bcitems = JSON.parse(localStorage.getItem('bcitems'));

            $.each(bcitems, function () {
                var item = this;
                var row_no = item.id;
                var vd = '';
                var newTr = $('<tr id="row_' + row_no + '" class="row_' + item.id + '" data-item-id="' + item.id + '"></tr>');
                
                // Col 1: Product Name & Code
                tr_html = '<td><input name="product[]" type="hidden" value="' + item.id + '">';
                tr_html += '<span class="product-title" id="name_' + row_no + '">' + item.name + '</span> ';
                tr_html += '<span class="product-code-badge">' + item.code + '</span></td>';

                // Col 2: Quantity with Stepper
                tr_html += '<td>';
                tr_html += '<div class="input-group input-group-sm bc-qty-group">';
                tr_html += '<span class="input-group-btn"><button type="button" class="btn btn-default btn-qty-minus" data-id="' + row_no + '"><i class="fa fa-minus"></i></button></span>';
                tr_html += '<input class="form-control quantity text-center" name="quantity[]" type="text" value="' + formatDecimal(item.qty) + '" data-id="' + row_no + '" data-item="' + item.id + '" id="quantity_' + row_no + '" onClick="this.select();">';
                tr_html += '<span class="input-group-btn"><button type="button" class="btn btn-default btn-qty-plus" data-id="' + row_no + '"><i class="fa fa-plus"></i></button></span>';
                tr_html += '</div></td>';

                // Col 3: Variants
                if (item.variants && item.variants.length > 0) {
                    $.each(item.variants, function () {
                        var isChecked = item.selected_variants && item.selected_variants[this.id] == 1;
                        vd += '<label class="bc-variant-pill ' + (isChecked ? 'active' : '') + '">';
                        vd += '<input name="vt_' + item.id + '_' + this.id + '" type="checkbox" class="checkbox" id="' + this.id + '" data-item-id="' + item.id + '" value="' + this.id + '" ' + (isChecked ? 'checked="checked"' : '') + ' /> ';
                        vd += '<span>' + this.name + '</span>';
                        vd += '</label>';
                    });
                } else {
                    vd = '<span class="text-muted" style="font-size: 12px; font-style: italic;">Sin variantes</span>';
                }
                tr_html += '<td>' + vd + '</td>';

                // Col 4: Delete Action
                tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Eliminar de la lista" style="cursor:pointer;"></i></td>';

                newTr.html(tr_html);
                newTr.appendTo("#bcTable tbody");
            });

            // Re-bind iCheck
            $('input[type="checkbox"],[type="radio"]').not('.skip').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            checkEmptyState();
            return true;
        } else {
            checkEmptyState();
        }
    }
</script>
