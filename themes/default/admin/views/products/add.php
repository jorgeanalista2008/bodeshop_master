<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
if (!empty($variants)) {
    foreach ($variants as $variant) {
        $vars[] = addslashes($variant->name);
    }
} else {
    $vars = [];
}
?>
<style type="text/css">
    /* Modern UI/UX Styles for Product Form */
    .product-form-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    .modern-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
        margin-bottom: 22px;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .modern-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -1px rgba(0,0,0,0.04);
    }
    .modern-card-header {
        padding: 14px 20px;
        background: #fafbfd;
        border-bottom: 1px solid #f1f5f9;
        border-top-left-radius: 9px;
        border-top-right-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modern-card-header h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
    }
    .modern-card-header h3 i {
        margin-right: 10px;
        width: 28px;
        height: 28px;
        line-height: 28px;
        text-align: center;
        background: #e0f2fe;
        color: #0284c7;
        border-radius: 6px;
        font-size: 14px;
    }
    .modern-card-body {
        padding: 20px;
    }
    .modern-label {
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 6px;
        display: block;
    }
    .modern-input {
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: none !important;
        transition: border-color 0.2s, box-shadow 0.2s;
        height: 38px;
    }
    .modern-input:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15) !important;
    }
    .select2-container .select2-choice {
        border-radius: 6px !important;
        border: 1px solid #cbd5e1 !important;
        height: 38px !important;
        line-height: 36px !important;
        background: #ffffff !important;
    }
    .select2-container .select2-choice .select2-arrow {
        border-radius: 0 6px 6px 0 !important;
    }
    .input-group-addon {
        border-radius: 6px !important;
        background-color: #f8fafc !important;
        border-color: #cbd5e1 !important;
    }
    .profit-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 6px;
        background: #f1f5f9;
        color: #475569;
    }
    .profit-badge.positive {
        background: #dcfce7;
        color: #15803d;
    }
    .profit-badge.negative {
        background: #fee2e2;
        color: #b91c1c;
    }
    .switch-option {
        padding: 10px 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        transition: background 0.15s;
    }
    .switch-option:hover {
        background: #f1f5f9;
    }
    .switch-option label {
        margin: 0 0 0 10px;
        font-weight: 600;
        font-size: 13px;
        color: #334155;
        cursor: pointer;
    }
    .header-action-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
    }
    .header-title-box h1 {
        margin: 0 0 4px 0;
        font-size: 22px;
        font-weight: 700;
        color: #0f172a;
    }
    .header-title-box p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
    }
    .sticky-submit-box {
        position: sticky;
        top: 20px;
        z-index: 10;
    }
    .btn-save-product {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.25);
        transition: all 0.2s;
    }
    .btn-save-product:hover, .btn-save-product:focus {
        background: #1d4ed8;
        border-color: #1d4ed8;
        color: #ffffff;
        box-shadow: 0 6px 10px -1px rgba(37, 99, 235, 0.35);
        transform: translateY(-1px);
    }
    .btn-cancel-product {
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 16px;
        color: #64748b;
        background: #ffffff;
        border: 1px solid #cbd5e1;
    }
    .btn-cancel-product:hover {
        background: #f8fafc;
        color: #0f172a;
    }
    .dropzone-upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 10px;
        padding: 20px 15px;
        text-align: center;
        background: #fafbfd;
        transition: border-color 0.2s, background-color 0.2s;
    }
    .dropzone-upload-box:hover {
        border-color: #3b82f6;
        background: #f0f7ff;
    }
    .dropzone-upload-icon {
        font-size: 32px;
        color: #94a3b8;
        margin-bottom: 8px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'products');
        });
        $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_category_to_load') ?>").select2({
            placeholder: "<?= lang('select_category_to_load') ?>", minimumResultsForSearch: 7, data: [
                {id: '', text: '<?= lang('select_category_to_load') ?>'}
            ]
        });
        $('#category').change(function () {
            var v = $(this).val();
            $('#modal-loading').show();
            if (v) {
                $.ajax({
                    type: "get",
                    async: false,
                    url: "<?= admin_url('products/getSubCategories') ?>/" + v,
                    dataType: "json",
                    success: function (scdata) {
                        if (scdata != null) {
                            scdata.push({id: '', text: '<?= lang('select_subcategory') ?>'});
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_subcategory') ?>").select2({
                                placeholder: "<?= lang('select_category_to_load') ?>",
                                minimumResultsForSearch: 7,
                                data: scdata
                            });
                        } else {
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('no_subcategory') ?>").select2({
                                placeholder: "<?= lang('no_subcategory') ?>",
                                minimumResultsForSearch: 7,
                                data: [{id: '', text: '<?= lang('no_subcategory') ?>'}]
                            });
                        }
                    },
                    error: function () {
                        bootbox.alert('<?= lang('ajax_error') ?>');
                        $('#modal-loading').hide();
                    }
                });
            } else {
                $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_category_to_load') ?>").select2({
                    placeholder: "<?= lang('select_category_to_load') ?>",
                    minimumResultsForSearch: 7,
                    data: [{id: '', text: '<?= lang('select_category_to_load') ?>'}]
                });
            }
            $('#modal-loading').hide();
        });
        $('#code').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>

<div class="product-form-container">
    <div class="box">
        <div class="box-content" style="padding: 25px 30px;">

            <!-- Header Action Bar -->
            <div class="header-action-bar">
                <div class="header-title-box">
                    <h1><i class="fa fa-cube text-primary" style="margin-right: 8px;"></i> <?= lang('add_product'); ?></h1>
                    <p><?= lang('enter_info'); ?></p>
                </div>
                <div>
                    <a href="<?= admin_url('products'); ?>" class="btn btn-cancel-product">
                        <i class="fa fa-arrow-left"></i> Volver a Productos
                    </a>
                </div>
            </div>

            <?php
            $attrib = ['data-toggle' => 'validator', 'role' => 'form', 'id' => 'add-product-form'];
            echo admin_form_open_multipart('products/add', $attrib)
            ?>

            <div class="row">
                <!-- Columna Izquierda Principal (Campos Core) -->
                <div class="col-lg-8 col-md-7">

                    <!-- CARD 1: INFORMACIÓN GENERAL -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-info-circle"></i> Información General</h3>
                            <span class="label label-primary" style="border-radius: 4px;">Datos Básicos</span>
                        </div>
                        <div class="modern-card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="type"><?= lang('product_type', 'type') ?> *</label>
                                        <?php
                                        $opts = ['standard' => lang('standard'), 'combo' => lang('combo'), 'digital' => lang('digital'), 'service' => lang('service')];
                                        echo form_dropdown('type', $opts, ($_POST['type'] ?? ($product ? $product->type : '')), 'class="form-control select modern-input" id="type" required="required" style="width:100%;"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="name"><?= lang('product_name', 'name') ?> *</label>
                                        <?= form_input('name', ($_POST['name'] ?? ($product ? $product->name : '')), 'class="form-control modern-input' . ($Settings->use_code_for_slug ? '' : ' gen_slug') . '" id="name" required="required" placeholder="Ej: Vaso de Cristal 12oz"'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="code"><?= lang('product_code', 'code') ?> *</label>
                                        <div class="input-group">
                                            <?= form_input('code', ($_POST['code'] ?? ($product ? $product->code : '')), 'class="form-control modern-input' . ($Settings->use_code_for_slug ? ' gen_slug' : '') . '" id="code" required="required" placeholder="Código o Barra"') ?>
                                            <span class="input-group-addon pointer" id="random_num" title="Generar código aleatorio" style="cursor: pointer;">
                                                <i class="fa fa-random text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="category"><?= lang('category', 'category') ?> *</label>
                                        <?php
                                        $cat[''] = '';
                                        foreach ($categories as $category) {
                                            $cat[$category->id] = $category->name;
                                        }
                                        echo form_dropdown('category', $cat, ($_POST['category'] ?? ($product ? $product->category_id : '')), 'class="form-control select modern-input" id="category" placeholder="' . lang('select') . ' ' . lang('category') . '" required="required" style="width:100%"')
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="subcategory"><?= lang('subcategory', 'subcategory') ?></label>
                                        <div class="controls" id="subcat_data">
                                            <?php
                                            echo form_input('subcategory', ($product ? $product->subcategory_id : ''), 'class="form-control modern-input" id="subcategory" placeholder="' . lang('select_category_to_load') . '"');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="brand"><?= lang('brand', 'brand') ?></label>
                                        <?php
                                        $br[''] = '';
                                        foreach ($brands as $brand) {
                                            $br[$brand->id] = $brand->name;
                                        }
                                        echo form_dropdown('brand', $br, ($_POST['brand'] ?? ($product ? $product->brand : '')), 'class="form-control select modern-input" id="brand" placeholder="' . lang('select') . ' ' . lang('brand') . '" style="width:100%"')
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="slug"><?= lang('slug', 'slug'); ?> *</label>
                                        <?= form_input('slug', set_value('slug'), 'class="form-control modern-input tip" id="slug" required="required" placeholder="url-amigable"'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="second_name"><?= lang('second_name', 'second_name'); ?></label>
                                        <?= form_input('second_name', set_value('second_name'), 'class="form-control modern-input tip" id="second_name" placeholder="Nombre alternativo"'); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group all">
                                        <label class="modern-label" for="barcode_symbology"><?= lang('barcode_symbology', 'barcode_symbology') ?> *</label>
                                        <?php
                                        $bs = ['code25' => 'Code25', 'code39' => 'Code39', 'code128' => 'Code128', 'ean8' => 'EAN8', 'ean13' => 'EAN13', 'upca' => 'UPC-A', 'upce' => 'UPC-E'];
                                        echo form_dropdown('barcode_symbology', $bs, ($_POST['barcode_symbology'] ?? ($product ? $product->barcode_symbology : 'code128')), 'class="form-control select modern-input" id="barcode_symbology" required="required" style="width:100%;"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group standard_combo">
                                        <label class="modern-label" for="weight"><?= lang('weight', 'weight'); ?></label>
                                        <?= form_input('weight', set_value('weight'), 'class="form-control modern-input tip" id="weight" placeholder="Kg"'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: PRECIOS, COSTOS E IMPUESTOS -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-tag"></i> Precios, Costos e Impuestos</h3>
                            <div id="live_profit_margin">
                                <span class="profit-badge" id="profit_margin_val">Margen: 0.00%</span>
                            </div>
                        </div>
                        <div class="modern-card-body">
                            <div class="row">
                                <div class="col-md-4 standard">
                                    <div class="form-group">
                                        <label class="modern-label" for="cost"><?= lang('product_cost', 'cost') ?> *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            <?= form_input('cost', ($_POST['cost'] ?? ($product ? $this->sma->formatDecimal($product->cost) : '')), 'class="form-control modern-input tip" id="cost" required="required" placeholder="0.00"') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="price"><?= lang('product_price', 'price') ?> *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <?= form_input('price', ($_POST['price'] ?? ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control modern-input tip" id="price" required="required" placeholder="0.00"') ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($Settings->tax1) { ?>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="tax_rate"><?= lang('product_tax', 'tax_rate') ?></label>
                                        <?php
                                        $tr[''] = '';
                                        foreach ($tax_rates as $tax) {
                                            $tr[$tax->id] = $tax->name;
                                        }
                                        echo form_dropdown('tax_rate', $tr, ($_POST['tax_rate'] ?? ($product ? $product->tax_rate : $Settings->default_tax_rate)), 'class="form-control select modern-input" id="tax_rate" placeholder="' . lang('select') . ' ' . lang('product_tax') . '" style="width:100%"')
                                        ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <?php if ($Settings->tax1) { ?>
                                <div class="col-md-4">
                                    <div class="form-group all">
                                        <label class="modern-label" for="tax_method"><?= lang('tax_method', 'tax_method') ?></label>
                                        <?php
                                        $tm = ['1' => lang('exclusive'), '0' => lang('inclusive')];
                                        echo form_dropdown('tax_method', $tm, ($_POST['tax_method'] ?? ($product ? $product->tax_method : '')), 'class="form-control select modern-input" id="tax_method" placeholder="' . lang('select') . ' ' . lang('tax_method') . '" style="width:100%"'); ?>
                                    </div>
                                </div>
                                <?php } ?>

                                <?php if ($Settings->invoice_view == 2) { ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="hsn_code"><?= lang('hsn_code', 'hsn_code'); ?></label>
                                        <?= form_input('hsn_code', set_value('hsn_code', ($product ? $product->hsn_code : '')), 'class="form-control modern-input" id="hsn_code" placeholder="Código HSN"'); ?>
                                    </div>
                                </div>
                                <?php } ?>

                                <div class="col-md-4">
                                    <div class="form-group" style="padding-top: 25px;">
                                        <input type="checkbox" class="checkbox" value="1" name="promotion" id="promotion" <?= $this->input->post('promotion') ? 'checked="checked"' : ''; ?>>
                                        <label for="promotion" class="padding05 modern-label" style="display: inline; font-size: 13.5px; cursor: pointer;">
                                            <i class="fa fa-percent text-danger" style="margin-right: 4px;"></i> <?= lang('promotion'); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Panel Desplegable de Promoción -->
                            <div id="promo" style="display:none; margin-top: 15px;">
                                <div class="well" style="background: #fff8f8; border-color: #fed7d7; border-radius: 8px;">
                                    <h4 style="margin-top: 0; font-size: 14px; font-weight: 700; color: #c53030;">
                                        <i class="fa fa-bullhorn"></i> Configuración de la Oferta / Promoción
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="modern-label" for="promo_price"><?= lang('promo_price', 'promo_price'); ?></label>
                                                <?= form_input('promo_price', set_value('promo_price'), 'class="form-control modern-input tip" id="promo_price" placeholder="Precio especial"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="modern-label" for="start_date"><?= lang('start_date', 'start_date'); ?></label>
                                                <?= form_input('start_date', set_value('start_date'), 'class="form-control modern-input tip date" id="start_date" placeholder="Fecha inicio"'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="modern-label" for="end_date"><?= lang('end_date', 'end_date'); ?></label>
                                                <?= form_input('end_date', set_value('end_date'), 'class="form-control modern-input tip date" id="end_date" placeholder="Fecha fin"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD 3: INVENTARIO Y UNIDADES -->
                    <div class="modern-card standard">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-cubes"></i> Unidades e Inventario</h3>
                            <span class="label label-info" style="border-radius: 4px;">Stock & Conversión</span>
                        </div>
                        <div class="modern-card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="unit"><?= lang('product_unit', 'unit'); ?> *</label>
                                        <?php
                                        $pu[''] = lang('select') . ' ' . lang('unit');
                                        foreach ($base_units as $bu) {
                                            $pu[$bu->id] = $bu->name . ' (' . $bu->code . ')';
                                        }
                                        ?>
                                        <?= form_dropdown('unit', $pu, set_value('unit', ($product ? $product->unit : '')), 'class="form-control select modern-input tip" id="unit" required="required" style="width:100%;"'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="default_sale_unit"><?= lang('default_sale_unit', 'default_sale_unit'); ?></label>
                                        <?php $uopts[''] = lang('select_unit_first'); ?>
                                        <?= form_dropdown('default_sale_unit', $uopts, ($product ? $product->sale_unit : ''), 'class="form-control select modern-input" id="default_sale_unit" style="width:100%;"'); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="modern-label" for="default_purchase_unit"><?= lang('default_purchase_unit', 'default_purchase_unit'); ?></label>
                                        <?= form_dropdown('default_purchase_unit', $uopts, ($product ? $product->purchase_unit : ''), 'class="form-control select modern-input" id="default_purchase_unit" style="width:100%;"'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="modern-label" for="alert_quantity"><?= lang('alert_quantity', 'alert_quantity') ?></label>
                                        <div class="input-group">
                                            <?= form_input('alert_quantity', ($_POST['alert_quantity'] ?? ($product ? $this->sma->formatQuantityDecimal($product->alert_quantity) : '')), 'class="form-control modern-input tip" id="alert_quantity" placeholder="Ej: 5"') ?>
                                            <span class="input-group-addon" title="Monitorear stock para este producto">
                                                <input type="checkbox" name="track_quantity" id="track_quantity" value="1" <?= ($product ? (isset($product->track_quantity) ? 'checked="checked"' : '') : 'checked="checked"') ?>>
                                                <label for="track_quantity" style="margin: 0; font-size: 11px; cursor: pointer;">Seguimiento</label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: VARIANTES, COMBOS Y PROVEEDORES -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-sliders"></i> Variantes, Combos y Proveedores</h3>
                        </div>
                        <div class="modern-card-body">

                            <!-- Atributos / Variantes -->
                            <div class="standard">
                                <div id="attrs"></div>
                                <div class="form-group" style="margin-bottom: 12px;">
                                    <input type="checkbox" class="checkbox" name="attributes" id="attributes" <?= $this->input->post('attributes') || $product_options ? 'checked="checked"' : ''; ?>>
                                    <label for="attributes" class="padding05 modern-label" style="display:inline; cursor:pointer;">
                                        <?= lang('product_has_attributes'); ?> <small class="text-muted">(<?= lang('eg_sizes_colors'); ?>)</small>
                                    </label>
                                </div>

                                <div class="well" id="attr-con" style="<?= $this->input->post('attributes') || $product_options ? '' : 'display:none;'; ?> background: #f8fafc; border-radius: 8px;">
                                    <div class="form-group" id="ui" style="margin-bottom: 10px;">
                                        <div class="input-group">
                                            <?php echo form_input('attributesInput', '', 'class="form-control select-tags" id="attributesInput" placeholder="' . $this->lang->line('enter_attributes') . '"'); ?>
                                            <div class="input-group-addon" style="padding: 2px 10px;">
                                                <a href="#" id="addAttributes" title="Agregar Variantes">
                                                    <i class="fa fa-2x fa-plus-circle text-primary" id="addIcon"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="attrTable" class="table table-bordered table-striped" style="<?= $this->input->post('attributes') || $product_options ? '' : 'display:none;'; ?> margin-bottom: 0;">
                                            <thead>
                                                <tr class="active">
                                                    <th><?= lang('name') ?></th>
                                                    <th><?= lang('warehouse') ?></th>
                                                    <th><?= lang('price_addition') ?></th>
                                                    <th class="text-center" style="width: 40px;"><i class="fa fa-times attr-remove-all text-danger" title="Limpiar todas" style="cursor: pointer;"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody><?php
                                            if ($this->input->post('attributes')) {
                                                $a = sizeof($_POST['attr_name']);
                                                for ($r = 0; $r <= $a; $r++) {
                                                    if (isset($_POST['attr_name'][$r]) && (isset($_POST['attr_warehouse'][$r]) || isset($_POST['attr_quantity'][$r]))) {
                                                        echo '<tr class="attr"><td><input type="hidden" name="attr_name[]" value="' . $_POST['attr_name'][$r] . '"><span>' . $_POST['attr_name'][$r] . '</span></td><td class="code text-center"><input type="hidden" name="attr_warehouse[]" value="' . $_POST['attr_warehouse'][$r] . '"><input type="hidden" name="attr_wh_name[]" value="' . $_POST['attr_wh_name'][$r] . '"><span>' . $_POST['attr_wh_name'][$r] . '</span></td><td class="price text-right"><input type="hidden" name="attr_price[]" value="' . $_POST['attr_price'][$r] . '"><span>' . $_POST['attr_price'][$r] . '</span></td><td class="text-center"><i class="fa fa-times delAttr text-danger" style="cursor:pointer;"></i></td></tr>';
                                                    }
                                                }
                                            } elseif ($product_options) {
                                                foreach ($product_options as $option) {
                                                    echo '<tr class="attr"><td><input type="hidden" name="attr_name[]" value="' . $option->name . '"><span>' . $option->name . '</span></td><td class="code text-center"><input type="hidden" name="attr_warehouse[]" value="' . $option->warehouse_id . '"><input type="hidden" name="attr_wh_name[]" value="' . $option->wh_name . '"><span>' . $option->wh_name . '</span></td><td class="price text-right"><input type="hidden" name="attr_price[]" value="' . $this->sma->formatMoney($option->price) . '"><span>' . $this->sma->formatMoney($option->price) . '</span></td><td class="text-center"><i class="fa fa-times delAttr text-danger" style="cursor:pointer;"></i></td></tr>';
                                                }
                                            }
                                            ?></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Combo Products Section -->
                            <div class="combo" style="display:none;">
                                <div class="form-group">
                                    <label class="modern-label" for="add_item"><?= lang('add_product', 'add_item') . ' (' . lang('not_with_variants') . ')'; ?></label>
                                    <?php echo form_input('add_item', '', 'class="form-control modern-input ttip" id="add_item" placeholder="' . $this->lang->line('add_item') . '"'); ?>
                                </div>
                                <div class="table-responsive">
                                    <table id="prTable" class="table items table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr class="active">
                                                <th class="col-md-5"><?= lang('product') . ' (' . lang('code') . ' - ' . lang('name') . ')'; ?></th>
                                                <th class="col-md-2 text-center"><?= lang('quantity'); ?></th>
                                                <th class="col-md-3 text-center"><?= lang('unit_price'); ?></th>
                                                <th class="col-md-1 text-center"><i class="fa fa-trash-o"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Digital Product Section -->
                            <div class="digital" style="display:none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="modern-label" for="digital_file"><?= lang('digital_file', 'digital_file') ?></label>
                                            <input id="digital_file" type="file" data-browse-label="<?= lang('browse'); ?>" name="digital_file" data-show-upload="false" data-show-preview="false" class="form-control file">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="modern-label" for="file_link"><?= lang('file_link', 'file_link'); ?></label>
                                            <?= form_input('file_link', set_value('file_link'), 'class="form-control modern-input" id="file_link" placeholder="https://"'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Suppliers Section -->
                            <div class="standard" style="margin-top: 15px; border-top: 1px dashed #e2e8f0; padding-top: 15px;">
                                <div class="form-group" style="display:flex; justify-content:space-between; align-items:center;">
                                    <label class="modern-label" style="margin:0;"><i class="fa fa-truck text-muted"></i> <?= lang('supplier', 'supplier') ?></label>
                                    <button type="button" class="btn btn-primary btn-xs" id="addSupplier" style="border-radius: 4px;">
                                        <i class="fa fa-plus"></i> Añadir otro proveedor
                                    </button>
                                </div>
                                <div class="row" id="supplier-con">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo form_input('supplier', ($_POST['supplier'] ?? ''), 'class="form-control modern-input ' . ($product ? '' : 'suppliers') . '" id="' . ($product && !empty($product->supplier1) ? 'supplier1' : 'supplier') . '" placeholder="' . lang('select') . ' ' . lang('supplier') . '" style="width:100%;"');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?= form_input('supplier_part_no', ($_POST['supplier_part_no'] ?? ''), 'class="form-control modern-input tip" id="supplier_part_no" placeholder="' . lang('supplier_part_no') . '"'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?= form_input('supplier_price', ($_POST['supplier_price'] ?? ''), 'class="form-control modern-input tip" id="supplier_price" placeholder="' . lang('supplier_price') . '"'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="ex-suppliers"></div>
                            </div>

                        </div>
                    </div>

                    <!-- CARD 5: DESCRIPCIONES Y DETALLES -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-align-left"></i> Descripciones y Notas</h3>
                        </div>
                        <div class="modern-card-body">
                            <div class="form-group all">
                                <label class="modern-label" for="product_details"><?= lang('product_details', 'product_details') ?></label>
                                <?= form_textarea('product_details', ($_POST['product_details'] ?? ($product ? $product->product_details : '')), 'class="form-control" id="product_details" placeholder="Descripción detallada del producto para el catálogo o tienda online..." style="height: 120px;"'); ?>
                            </div>
                            <div class="form-group all" style="margin-top: 15px;">
                                <label class="modern-label" for="details"><?= lang('product_details_for_invoice', 'details') ?></label>
                                <?= form_textarea('details', ($_POST['details'] ?? ($product ? $product->details : '')), 'class="form-control" id="details" placeholder="Información o notas adicionales que aparecerán en la factura o ticket impreso..." style="height: 90px;"'); ?>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Columna Derecha Lateral (Media, Opciones y Botón Guardar) -->
                <div class="col-lg-4 col-md-5">

                    <!-- STICKY ACTION CARD -->
                    <div class="modern-card sticky-submit-box">
                        <div class="modern-card-body" style="padding: 16px;">
                            <button type="submit" name="add_product" value="1" class="btn btn-save-product btn-block">
                                <i class="fa fa-check-circle" style="margin-right: 6px;"></i> <?= $this->lang->line('add_product'); ?>
                            </button>
                            <div style="margin-top: 10px; text-align: center;">
                                <a href="<?= admin_url('products'); ?>" class="btn btn-link text-muted" style="font-size: 13px;">
                                    <i class="fa fa-times"></i> Cancelar y volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- CARD: IMÁGENES -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-image"></i> Imágenes del Producto</h3>
                        </div>
                        <div class="modern-card-body">
                            <div class="form-group all">
                                <label class="modern-label" for="product_image"><?= lang('product_image', 'product_image') ?></label>
                                <div class="dropzone-upload-box">
                                    <div class="dropzone-upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                    <input id="product_image" type="file" data-browse-label="<?= lang('browse'); ?>" name="product_image" data-show-upload="false" data-show-preview="true" accept="image/*" class="form-control file">
                                    <small class="text-muted" style="display:block; margin-top: 6px;">Formatos: JPG, PNG, WEBP</small>
                                </div>
                            </div>

                            <div class="form-group all" style="margin-top: 15px;">
                                <label class="modern-label" for="images"><?= lang('product_gallery_images', 'images') ?></label>
                                <input id="images" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile[]" multiple="true" data-show-upload="false" data-show-preview="false" class="form-control file" accept="image/*">
                                <small class="text-muted">Puede seleccionar múltiples fotos para la galería.</small>
                            </div>
                            <div id="img-details"></div>
                        </div>
                    </div>

                    <!-- CARD: VISIBILIDAD Y OPCIONES -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-eye"></i> Visibilidad en Canales</h3>
                        </div>
                        <div class="modern-card-body" style="padding-bottom: 8px;">
                            <div class="switch-option">
                                <input name="featured" type="checkbox" class="checkbox" id="featured" value="1" <?= isset($_POST['featured']) ? 'checked="checked"' : '' ?>/>
                                <label for="featured">
                                    <i class="fa fa-star text-warning" style="margin-right: 4px;"></i> <?= lang('featured') ?>
                                </label>
                            </div>

                            <div class="switch-option">
                                <input name="hide_pos" type="checkbox" class="checkbox" id="hide_pos" value="1" <?= isset($_POST['hide_pos']) ? 'checked="checked"' : '' ?>/>
                                <label for="hide_pos">
                                    <i class="fa fa-desktop text-muted" style="margin-right: 4px;"></i> <?= lang('hide_in_pos') ?>
                                </label>
                            </div>

                            <div class="switch-option">
                                <input name="hide" type="checkbox" class="checkbox" id="hide" value="1" <?= isset($_POST['hide']) ? 'checked="checked"' : '' ?>/>
                                <label for="hide">
                                    <i class="fa fa-shopping-cart text-muted" style="margin-right: 4px;"></i> <?= lang('hide_in_shop') ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- CARD: CAMPOS PERSONALIZADOS -->
                    <div class="modern-card">
                        <div class="modern-card-header">
                            <h3><i class="fa fa-cog"></i> Campos Personalizados</h3>
                            <input name="cf" type="checkbox" class="checkbox" id="extras" value="" <?= isset($_POST['cf']) ? 'checked="checked"' : '' ?>/>
                        </div>
                        <div class="modern-card-body" id="extras-con" style="display: none;">
                            <div class="form-group all">
                                <label class="modern-label" for="cf1"><?= lang('pcf1', 'cf1') ?></label>
                                <?= form_input('cf1', ($_POST['cf1'] ?? ($product ? $product->cf1 : '')), 'class="form-control modern-input tip" id="cf1"') ?>
                            </div>
                            <div class="form-group all">
                                <label class="modern-label" for="cf2"><?= lang('pcf2', 'cf2') ?></label>
                                <?= form_input('cf2', ($_POST['cf2'] ?? ($product ? $product->cf2 : '')), 'class="form-control modern-input tip" id="cf2"') ?>
                            </div>
                            <div class="form-group all">
                                <label class="modern-label" for="cf3"><?= lang('pcf3', 'cf3') ?></label>
                                <?= form_input('cf3', ($_POST['cf3'] ?? ($product ? $product->cf3 : '')), 'class="form-control modern-input tip" id="cf3"') ?>
                            </div>
                            <div class="form-group all">
                                <label class="modern-label" for="cf4"><?= lang('pcf4', 'cf4') ?></label>
                                <?= form_input('cf4', ($_POST['cf4'] ?? ($product ? $product->cf4 : '')), 'class="form-control modern-input tip" id="cf4"') ?>
                            </div>
                            <div class="form-group all">
                                <label class="modern-label" for="cf5"><?= lang('pcf5', 'cf5') ?></label>
                                <?= form_input('cf5', ($_POST['cf5'] ?? ($product ? $product->cf5 : '')), 'class="form-control modern-input tip" id="cf5"') ?>
                            </div>
                            <div class="form-group all">
                                <label class="modern-label" for="cf6"><?= lang('pcf6', 'cf6') ?></label>
                                <?= form_input('cf6', ($_POST['cf6'] ?? ($product ? $product->cf6 : '')), 'class="form-control modern-input tip" id="cf6"') ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?= form_close(); ?>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('form[data-toggle="validator"]').bootstrapValidator({ excluded: [':disabled'] });
        var audio_success = new Audio('<?= $assets ?>sounds/sound2.mp3');
        var audio_error = new Audio('<?= $assets ?>sounds/sound3.mp3');
        var items = {};

        // Dynamic Profit Margin Calculation
        function updateProfitMargin() {
            var cost = parseFloat($('#cost').val()) || 0;
            var price = parseFloat($('#price').val()) || 0;
            var $badge = $('#profit_margin_val');
            if (price > 0) {
                var profit = price - cost;
                var margin = (profit / price) * 100;
                var sign = profit >= 0 ? '+' : '';
                $badge.removeClass('positive negative').addClass(profit >= 0 ? 'positive' : 'negative');
                $badge.html('Margen: ' + sign + margin.toFixed(1) + '% (Ganancia: $' + profit.toFixed(2) + ')');
            } else {
                $badge.removeClass('positive negative').text('Margen: 0.00%');
            }
        }
        $(document).on('keyup change', '#cost, #price', updateProfitMargin);
        updateProfitMargin();

        <?php
        if ($combo_items) {
            foreach ($combo_items as $item) {
                if ($item->code) {
                    echo 'add_product_item(' . json_encode($item) . ');';
                }
            }
        }
        ?>
        <?=isset($_POST['cf']) ? '$("#extras").iCheck("check");' : '' ?>
        $('#extras').on('ifChecked', function () {
            $('#extras-con').slideDown();
        });
        $('#extras').on('ifUnchecked', function () {
            $('#extras-con').slideUp();
        });

        <?= isset($_POST['promotion']) ? '$("#promotion").iCheck("check");' : '' ?>
        $('#promotion').on('ifChecked', function (e) {
            $('#promo').slideDown();
        });
        $('#promotion').on('ifUnchecked', function (e) {
            $('#promo').slideUp();
        });

        $('.attributes').on('ifChecked', function (event) {
            $('#options_' + $(this).attr('id')).slideDown();
        });
        $('.attributes').on('ifUnchecked', function (event) {
            $('#options_' + $(this).attr('id')).slideUp();
        });

        $('#digital_file').change(function () {
            if ($(this).val()) {
                $('#file_link').removeAttr('required');
                $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'file_link');
            } else {
                $('#file_link').attr('required', 'required');
                $('form[data-toggle="validator"]').bootstrapValidator('addField', 'file_link');
            }
        });
        $('#type').change(function () {
            var t = $(this).val();
            if (t !== 'standard') {
                $('.standard').slideUp();
                $('#unit').attr('disabled', true);
                $('#cost').attr('disabled', true);
                $('#track_quantity').iCheck('uncheck');
            } else {
                $('.standard').slideDown();
                $('#track_quantity').iCheck('check');
                $('#unit').attr('disabled', false);
                $('#cost').attr('disabled', false);
            }
            if (t !== 'digital') {
                $('.digital').slideUp();
                $('#file_link').removeAttr('required');
                $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'file_link');
            } else {
                $('.digital').slideDown();
                $('#file_link').attr('required', 'required');
                $('form[data-toggle="validator"]').bootstrapValidator('addField', 'file_link');
            }
            if (t !== 'combo') {
                $('.combo').slideUp();
            } else {
                $('.combo').slideDown();
            }
            if (t == 'standard' || t == 'combo') {
                $('.standard_combo').slideDown();
            } else {
                $('.standard_combo').slideUp();
            }
        });

        var t = $('#type').val();
        if (t !== 'standard') {
            $('.standard').slideUp();
            $('#unit').attr('disabled', true);
            $('#cost').attr('disabled', true);
            $('#track_quantity').iCheck('uncheck');
        } else {
            $('.standard').slideDown();
            $('#track_quantity').iCheck('check');
            $('#unit').attr('disabled', false);
            $('#cost').attr('disabled', false);
        }
        if (t !== 'digital') {
            $('.digital').slideUp();
            $('#file_link').removeAttr('required');
            $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'file_link');
        } else {
            $('.digital').slideDown();
            $('#file_link').attr('required', 'required');
            $('form[data-toggle="validator"]').bootstrapValidator('addField', 'file_link');
        }
        if (t !== 'combo') {
            $('.combo').slideUp();
        } else {
            $('.combo').slideDown();
        }
        if (t == 'standard' || t == 'combo') {
            $('.standard_combo').slideDown();
        } else {
            $('.standard_combo').slideUp();
        }

        $("#add_item").autocomplete({
            source: '<?= admin_url('products/suggestions'); ?>',
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

        <?php
        if ($this->input->post('type') == 'combo') {
            $c = isset($_POST['combo_item_code']) ? sizeof($_POST['combo_item_code']) : 0;
            for ($r = 0; $r <= $c; $r++) {
                if (isset($_POST['combo_item_code'][$r]) && isset($_POST['combo_item_quantity'][$r]) && isset($_POST['combo_item_price'][$r])) {
                    $items[] = ['id' => $_POST['combo_item_id'][$r], 'name' => $_POST['combo_item_name'][$r], 'code' => $_POST['combo_item_code'][$r], 'qty' => $_POST['combo_item_quantity'][$r], 'price' => $_POST['combo_item_price'][$r]];
                }
            }
            echo '
            var ci = ' . (isset($items) ? json_encode($items) : "''") . ';
            $.each(ci, function() { add_product_item(this); });
            ';
        }
        ?>
        function add_product_item(item) {
            if (item == null) {
                return false;
            }
            item_id = item.id;
            if (items[item_id]) {
                items[item_id].qty = (parseFloat(items[item_id].qty) + 1).toFixed(2);
            } else {
                items[item_id] = item;
            }
            var pp = 0;
            $("#prTable tbody").empty();
            $.each(items, function () {
                var row_no = this.id;
                var newTr = $('<tr id="row_' + row_no + '" class="item_' + this.id + '" data-item-id="' + row_no + '"></tr>');
                tr_html = '<td><input name="combo_item_id[]" type="hidden" value="' + this.id + '"><input name="combo_item_name[]" type="hidden" value="' + this.name + '"><input name="combo_item_code[]" type="hidden" value="' + this.code + '"><span id="name_' + row_no + '">' + this.code + ' - ' + this.name + '</span></td>';
                tr_html += '<td><input class="form-control text-center rquantity" name="combo_item_quantity[]" type="text" value="' + formatDecimal(this.qty) + '" data-id="' + row_no + '" data-item="' + this.id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
                tr_html += '<td><input class="form-control text-center rprice" name="combo_item_price[]" type="text" value="' + formatDecimal(this.price) + '" data-id="' + row_no + '" data-item="' + this.id + '" id="combo_item_price_' + row_no + '" onClick="this.select();"></td>';
                tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
                newTr.html(tr_html);
                newTr.prependTo("#prTable");
                pp += formatDecimal(parseFloat(this.price)*parseFloat(this.qty));
            });
            $('.item_' + item_id).addClass('warning');
            $('#price').val(pp);
            return true;
        }

        function calculate_price() {
            var rows = $('#prTable').children('tbody').children('tr');
            var pp = 0;
            $.each(rows, function () {
                pp += formatDecimal(parseFloat($(this).find('.rprice').val())*parseFloat($(this).find('.rquantity').val()));
            });
            $('#price').val(pp);
            return true;
        }

        $(document).on('change', '.rquantity, .rprice', function () {
            calculate_price();
        });

        $(document).on('click', '.del', function () {
            var id = $(this).attr('id');
            delete items[id];
            $(this).closest('#row_' + id).remove();
            calculate_price();
        });
        var su = 2;
        $('#addSupplier').click(function () {
            if (su <= 5) {
                $('#supplier_1').select2('destroy');
                var html = '<div style="clear:both;height:5px;"></div><div class="row"><div class="col-xs-12"><div class="form-group"><input type="hidden" name="supplier_' + su + '", class="form-control" id="supplier_' + su + '" placeholder="<?= lang('select') . ' ' . lang('supplier') ?>" style="width:100%;display: block !important;" /></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="supplier_' + su + '_part_no" class="form-control tip" id="supplier_' + su + '_part_no" placeholder="<?= lang('supplier_part_no') ?>" /></div></div><div class="col-xs-6"><div class="form-group"><input type="text" name="supplier_' + su + '_price" class="form-control tip" id="supplier_' + su + '_price" placeholder="<?= lang('supplier_price') ?>" /></div></div></div>';
                $('#ex-suppliers').append(html);
                var sup = $('#supplier_' + su);
                suppliers(sup);
                su++;
            } else {
                bootbox.alert('<?= lang('max_reached') ?>');
                return false;
            }
        });

        var variants = <?=json_encode($vars);?>;
        $(".select-tags").select2({
            tags: variants,
            tokenSeparators: [","],
            multiple: true
        });
        $(document).on('ifChecked', '#attributes', function (e) {
            $('#attr-con').slideDown();
        });
        $(document).on('ifUnchecked', '#attributes', function (e) {
            $(".select-tags").select2("val", "");
            $('.attr-remove-all').trigger('click');
            $('#attr-con').slideUp();
        });
        $('#addAttributes').click(function (e) {
            e.preventDefault();
            var attrs_val = $('#attributesInput').val(), attrs;
            attrs = attrs_val.split(',');
            for (var i in attrs) {
                if (attrs[i] !== '') {
                    <?php if (!empty($warehouses)) {
                        foreach ($warehouses as $warehouse) {
                            echo '$(\'#attrTable\').show().append(\'<tr class="attr"><td><input type="hidden" name="attr_name[]" value="\' + attrs[i] + \'"><span>\' + attrs[i] + \'</span></td><td class="code text-center"><input type="hidden" name="attr_warehouse[]" value="' . $warehouse->id . '"><span>' . $warehouse->name . '</span></td><td class="price text-right"><input type="hidden" name="attr_price[]" value="0"><span>0</span></td><td class="text-center"><i class="fa fa-times delAttr text-danger" style="cursor:pointer;"></i></td></tr>\');';
                        }
                    } else { ?>
                        $('#attrTable').show().append('<tr class="attr"><td><input type="hidden" name="attr_name[]" value="' + attrs[i] + '"><span>' + attrs[i] + '</span></td><td class="code text-center"><input type="hidden" name="attr_warehouse[]" value=""><span></span></td><td class="price text-right"><input type="hidden" name="attr_price[]" value="0"><span>0</span></td><td class="text-center"><i class="fa fa-times delAttr text-danger" style="cursor:pointer;"></i></td></tr>');
                    <?php } ?>
                }
            }
        });
        $(document).on('click', '.delAttr', function () {
            $(this).closest("tr").remove();
        });
        $(document).on('click', '.attr-remove-all', function () {
            $('#attrTable tbody').empty();
            $('#attrTable').hide();
        });
        var row, warehouses = <?= json_encode($warehouses); ?>;
        $(document).on('click', '.attr td:not(:last-child)', function () {
            row = $(this).closest("tr");
            $('#aModalLabel').text(row.children().eq(0).find('span').text());
            $('#awarehouse').select2("val", (row.children().eq(1).find('input').val()));
            $('#aprice').val(row.children().eq(2).find('span').text());
            $('#aModal').appendTo('body').modal('show');
        });

        $(document).on('click', '#updateAttr', function () {
            var wh = $('#awarehouse').val(), wh_name;
            $.each(warehouses, function () {
                if (this.id == wh) {
                    wh_name = this.name;
                }
            });
            row.children().eq(1).html('<input type="hidden" name="attr_warehouse[]" value="' + wh + '"><input type="hidden" name="attr_wh_name[]" value="' + wh_name + '"><span>' + wh_name + '</span>');
            row.children().eq(2).html('<input type="hidden" name="attr_price[]" value="' + $('#aprice').val() + '"><span>' + currencyFormat($('#aprice').val()) + '</span>');
            $('#aModal').modal('hide');
        });
    });

    <?php if ($product) { ?>
    $(document).ready(function () {
        var t = "<?=$product->type?>";
        if (t !== 'standard') {
            $('.standard').slideUp();
            $('#cost').attr('required', 'required');
            $('#track_quantity').iCheck('uncheck');
            $('form[data-toggle="validator"]').bootstrapValidator('addField', 'cost');
        } else {
            $('.standard').slideDown();
            $('#track_quantity').iCheck('check');
            $('#cost').removeAttr('required');
            $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'cost');
        }
        if (t !== 'digital') {
            $('.digital').slideUp();
            $('#file_link').removeAttr('required');
            $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'file_link');
        } else {
            $('.digital').slideDown();
            $('#file_link').attr('required', 'required');
            $('form[data-toggle="validator"]').bootstrapValidator('addField', 'file_link');
        }
        if (t !== 'combo') {
            $('.combo').slideUp();
        } else {
            $('.combo').slideDown();
        }
        $("#code").parent('.form-group').addClass("has-error");
        $("#code").focus();
        $.ajax({
            type: "get", async: false,
            url: "<?= admin_url('products/getSubCategories') ?>/" + <?= $product->category_id ?>,
            dataType: "json",
            success: function (scdata) {
                if (scdata != null) {
                    $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_subcategory') ?>").select2({
                        placeholder: "<?= lang('select_category_to_load') ?>",
                        data: scdata
                    });
                } else {
                    $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('no_subcategory') ?>").select2({
                        placeholder: "<?= lang('no_subcategory') ?>",
                        data: [{id: '', text: '<?= lang('no_subcategory') ?>'}]
                    });
                }
            }
        });
        <?php if ($product->supplier1) { ?>
        select_supplier('supplier1', "<?= $product->supplier1; ?>");
        $('#supplier_price').val("<?= $product->supplier1price == 0 ? '' : $this->sma->formatDecimal($product->supplier1price); ?>");
        <?php } ?>
        <?php if ($product->supplier2) { ?>
        $('#addSupplier').click();
        select_supplier('supplier_2', "<?= $product->supplier2; ?>");
        $('#supplier_2_price').val("<?= $product->supplier2price == 0 ? '' : $this->sma->formatDecimal($product->supplier2price); ?>");
        <?php } ?>
        <?php if ($product->supplier3) { ?>
        $('#addSupplier').click();
        select_supplier('supplier_3', "<?= $product->supplier3; ?>");
        $('#supplier_3_price').val("<?= $product->supplier3price == 0 ? '' : $this->sma->formatDecimal($product->supplier3price); ?>");
        <?php } ?>
        <?php if ($product->supplier4) { ?>
        $('#addSupplier').click();
        select_supplier('supplier_4', "<?= $product->supplier4; ?>");
        $('#supplier_4_price').val("<?= $product->supplier4price == 0 ? '' : $this->sma->formatDecimal($product->supplier4price); ?>");
        <?php } ?>
        <?php if ($product->supplier5) { ?>
        $('#addSupplier').click();
        select_supplier('supplier_5', "<?= $product->supplier5; ?>");
        $('#supplier_5_price').val("<?= $product->supplier5price == 0 ? '' : $this->sma->formatDecimal($product->supplier5price); ?>");
        <?php } ?>
        function select_supplier(id, v) {
            $('#' + id).val(v).select2({
                minimumInputLength: 1,
                data: [],
                initSelection: function (element, callback) {
                    $.ajax({
                        type: "get", async: false,
                        url: "<?= admin_url('suppliers/getSupplier') ?>/" + $(element).val(),
                        dataType: "json",
                        success: function (data) {
                            callback(data[0]);
                        }
                    });
                },
                ajax: {
                    url: site.base_url + "suppliers/suggestions",
                    dataType: 'json',
                    quietMillis: 15,
                    data: function (term, page) {
                        return {
                            term: term,
                            limit: 10
                        };
                    },
                    results: function (data, page) {
                        if (data.results != null) {
                            return {results: data.results};
                        } else {
                            return {results: [{id: '', text: 'No Match Found'}]};
                        }
                    }
                }
            });
        }

        var whs = $('.wh');
        $.each(whs, function () {
            $(this).val($('#r' + $(this).attr('id')).text());
        });
    });
    <?php } ?>

    $(document).ready(function() {
        $('#unit').change(function(e) {
            var v = $(this).val();
            if (v) {
                $.ajax({
                    type: "get",
                    async: false,
                    url: "<?= admin_url('products/getSubUnits') ?>/" + v,
                    dataType: "json",
                    success: function (data) {
                        $('#default_sale_unit').select2("destroy").empty().select2({minimumResultsForSearch: 7});
                        $('#default_purchase_unit').select2("destroy").empty().select2({minimumResultsForSearch: 7});
                        $.each(data, function () {
                            $("<option />", {value: this.id, text: this.name+' ('+this.code+')'}).appendTo($('#default_sale_unit'));
                            $("<option />", {value: this.id, text: this.name+' ('+this.code+')'}).appendTo($('#default_purchase_unit'));
                        });
                        $('#default_sale_unit').select2('val', v);
                        $('#default_purchase_unit').select2('val', v);
                    },
                    error: function () {
                        bootbox.alert('<?= lang('ajax_error') ?>');
                    }
                });
            } else {
                $('#default_sale_unit').select2("destroy").empty();
                $('#default_purchase_unit').select2("destroy").empty();
                $("<option />", {value: '', text: '<?= lang('select_unit_first') ?>'}).appendTo($('#default_sale_unit'));
                $("<option />", {value: '', text: '<?= lang('select_unit_first') ?>'}).appendTo($('#default_purchase_unit'));
                $('#default_sale_unit').select2({minimumResultsForSearch: 7}).select2('val', '');
                $('#default_purchase_unit').select2({minimumResultsForSearch: 7}).select2('val', '');
            }
        });
    });
</script>

<div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="aModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="aModalLabel"><?= lang('add_product_manually') ?></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="awarehouse" class="col-sm-4 control-label"><?= lang('warehouse') ?></label>
                        <div class="col-sm-8">
                            <?php
                            $wh[''] = '';
                            foreach ($warehouses as $warehouse) {
                                $wh[$warehouse->id] = $warehouse->name;
                            }
                            echo form_dropdown('warehouse', $wh, '', 'id="awarehouse" class="form-control" style="width:100%;"');
                            ?>
                        </div>
                    </div>
                    <input type="hidden" id="aquantity" value="0">
                    <div class="form-group">
                        <label for="aprice" class="col-sm-4 control-label"><?= lang('price_addition') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control modern-input" id="aprice">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="updateAttr"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>
