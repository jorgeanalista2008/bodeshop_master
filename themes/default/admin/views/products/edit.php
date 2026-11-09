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
    .current-image-preview {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px;
        background: #f8fafc;
        text-align: center;
        margin-bottom: 14px;
    }
    .current-image-preview img {
        max-height: 140px;
        border-radius: 6px;
        margin: 0 auto;
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'products');
        });
        $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_category_to_load') ?>").select2({
            placeholder: "<?= lang('select_category_to_load') ?>", data: [
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
    <div class="header-action-bar">
        <div class="header-title-box">
            <h1><i class="fa fa-edit text-primary"></i> <?= lang('edit_product'); ?>: <?= $product->name ?></h1>
            <p><?= lang('update_info'); ?> &bull; ID #<?= $product->id ?></p>
        </div>
        <div class="header-buttons">
            <a href="<?= admin_url('products/view/' . $product->id); ?>" class="btn btn-default" style="border-radius: 6px; margin-right: 8px;">
                <i class="fa fa-eye"></i> <?= lang('view'); ?> Ficha
            </a>
            <a href="<?= admin_url('products'); ?>" class="btn btn-default" style="border-radius: 6px;">
                <i class="fa fa-arrow-left"></i> Volver a Lista
            </a>
        </div>
    </div>

    <?php
    $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
    echo admin_form_open_multipart('products/edit/' . $product->id, $attrib)
    ?>

    <div class="row">
        <!-- COLUMNA PRINCIPAL (8 COLS) -->
        <div class="col-md-8">
            <!-- 1. INFORMACIÓN GENERAL -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-cube"></i> 1. Información General del Producto</h3>
                </div>
                <div class="modern-card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="type"><?= lang('product_type', 'type') ?> *</label>
                                <?php
                                $opts = ['standard' => lang('standard'), 'combo' => lang('combo'), 'digital' => lang('digital'), 'service' => lang('service')];
                                echo form_dropdown('type', $opts, (isset($_POST['type']) ? $_POST['type'] : ($product ? $product->type : '')), 'class="form-control modern-input" id="type" required="required"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group all">
                                <label class="modern-label" for="name"><?= lang('product_name', 'name') ?> *</label>
                                <?= form_input('name', (isset($_POST['name']) ? $_POST['name'] : ($product ? $product->name : '')), 'class="form-control modern-input gen_slug" id="name" required="required"'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group all">
                                <label class="modern-label" for="code"><?= lang('product_code', 'code') ?> *</label>
                                <?= form_input('code', (isset($_POST['code']) ? $_POST['code'] : ($product ? $product->code : '')), 'class="form-control modern-input" id="code" required="required"') ?>
                                <span class="help-block" style="margin-bottom: 0; font-size: 11px;"><?= lang('you_scan_your_barcode_too') ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group all">
                                <label class="modern-label" for="barcode_symbology"><?= lang('barcode_symbology', 'barcode_symbology') ?> *</label>
                                <?php
                                $bs = ['code25' => 'Code25', 'code39' => 'Code39', 'code128' => 'Code128', 'ean8' => 'EAN8', 'ean13' => 'EAN13', 'upca' => 'UPC-A', 'upce' => 'UPC-E'];
                                echo form_dropdown('barcode_symbology', $bs, (isset($_POST['barcode_symbology']) ? $_POST['barcode_symbology'] : ($product ? $product->barcode_symbology : 'code128')), 'class="form-control select" id="barcode_symbology" required="required" style="width:100%;"');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group all">
                                <label class="modern-label" for="slug"><?= lang('slug', 'slug'); ?> *</label>
                                <?= form_input('slug', set_value('slug', ($product ? $product->slug : '')), 'class="form-control modern-input tip" id="slug" required="required"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group all">
                                <label class="modern-label" for="second_name"><?= lang('second_name', 'second_name'); ?></label>
                                <?= form_input('second_name', set_value('second_name', ($product ? $product->second_name : '')), 'class="form-control modern-input tip" id="second_name"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group standard_combo">
                                <label class="modern-label" for="weight"><?= lang('weight', 'weight'); ?></label>
                                <?= form_input('weight', set_value('weight', ($product ? $product->weight : '')), 'class="form-control modern-input tip" id="weight"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. PRECIOS, COSTOS E IMPUESTOS -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-dollar"></i> 2. Precios, Costos e Impuestos</h3>
                    <div id="live-margin-display" class="profit-badge">Margen: 0%</div>
                </div>
                <div class="modern-card-body">
                    <div class="row">
                        <div class="col-md-6 standard">
                            <div class="form-group">
                                <label class="modern-label" for="cost"><?= lang('product_cost', 'cost') ?> *</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <?= form_input('cost', (isset($_POST['cost']) ? $_POST['cost'] : ($product ? $this->sma->formatDecimal($product->cost) : '')), 'class="form-control modern-input tip" id="cost" required="required"') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 all">
                            <div class="form-group">
                                <label class="modern-label" for="price"><?= lang('product_price', 'price') ?> *</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <?= form_input('price', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control modern-input tip" id="price" required="required"') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($Settings->tax1) { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group all">
                                    <label class="modern-label" for="tax_rate"><?= lang('product_tax', 'tax_rate') ?></label>
                                    <?php
                                    $tr[''] = '';
                                    foreach ($tax_rates as $tax) {
                                        $tr[$tax->id] = $tax->name;
                                    }
                                    echo form_dropdown('tax_rate', $tr, (isset($_POST['tax_rate']) ? $_POST['tax_rate'] : ($product ? $product->tax_rate : $Settings->default_tax_rate)), 'class="form-control select" id="tax_rate" style="width:100%"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group all">
                                    <label class="modern-label" for="tax_method"><?= lang('tax_method', 'tax_method') ?></label>
                                    <?php
                                    $tm = ['0' => lang('inclusive'), '1' => lang('exclusive')];
                                    echo form_dropdown('tax_method', $tm, (isset($_POST['tax_method']) ? $_POST['tax_method'] : ($product ? $product->tax_method : '')), 'class="form-control select" id="tax_method" style="width:100%"');
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Rango de Precios Mosqueda -->
                    <div class="form-group standard" style="border-top: 1px dashed #e2e8f0; padding-top: 14px; margin-top: 10px;">
                        <label class="modern-label"><b>Rango de Precios por Volumen</b></label>
                        <div class="row">
                            <div class="col-xs-4">
                                <label style="font-size: 11px; color: #64748b;">Desde (Cant. Inicial)</label>
                                <?= form_input('i', ($_POST['i'] ?? ($product ? $product->i : '')), 'class="form-control modern-input" id="i"'); ?>
                            </div>
                            <div class="col-xs-4">
                                <label style="font-size: 11px; color: #64748b;">Hasta (Cant. Final)</label>
                                <?= form_input('f', ($_POST['f'] ?? ($product ? $product->f : '')), 'class="form-control modern-input" id="f"'); ?>
                            </div>
                            <div class="col-xs-4">
                                <label style="font-size: 11px; color: #64748b;">Precio Especial</label>
                                <?= form_input('n', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control modern-input tip" id="price_range"') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. INVENTARIO, UNIDADES Y CLASIFICACIÓN -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-tags"></i> 3. Categorización e Inventario</h3>
                </div>
                <div class="modern-card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group all">
                                <label class="modern-label" for="category"><?= lang('category', 'category') ?> *</label>
                                <?php
                                $cat[''] = '';
                                foreach ($categories as $category) {
                                    $cat[$category->id] = $category->name;
                                }
                                echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ($product ? $product->category_id : '')), 'class="form-control select" id="category" required="required" style="width:100%"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group all">
                                <label class="modern-label" for="subcategory"><?= lang('subcategory', 'subcategory') ?></label>
                                <div class="controls" id="subcat_data">
                                    <?php echo form_input('subcategory', ($product ? $product->subcategory_id : ''), 'class="form-control" id="subcategory"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group all">
                                <label class="modern-label" for="brand"><?= lang('brand', 'brand') ?></label>
                                <?php
                                $br[''] = '';
                                foreach ($brands as $brand) {
                                    $br[$brand->id] = $brand->name;
                                }
                                echo form_dropdown('brand', $br, (isset($_POST['brand']) ? $_POST['brand'] : ($product ? $product->brand : '')), 'class="form-control select" id="brand" style="width:100%"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 standard">
                            <div class="form-group">
                                <label class="modern-label" for="unit"><?= lang('product_unit', 'unit'); ?> *</label>
                                <?php
                                $pu[''] = lang('select') . ' ' . lang('unit');
                                foreach ($base_units as $bu) {
                                    $pu[$bu->id] = $bu->name . ' (' . $bu->code . ')';
                                }
                                echo form_dropdown('unit', $pu, set_value('unit', $product->unit), 'class="form-control tip" required="required" id="unit" style="width:100%;"');
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row standard">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="default_sale_unit"><?= lang('default_sale_unit', 'default_sale_unit'); ?></label>
                                <?php
                                $uopts[''] = lang('select') . ' ' . lang('unit');
                                foreach ($subunits as $sunit) {
                                    $uopts[$sunit->id] = $sunit->name . ' (' . $sunit->code . ')';
                                }
                                echo form_dropdown('default_sale_unit', $uopts, $product->sale_unit, 'class="form-control" id="default_sale_unit" style="width:100%;"');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="default_purchase_unit"><?= lang('default_purchase_unit', 'default_purchase_unit'); ?></label>
                                <?= form_dropdown('default_purchase_unit', $uopts, $product->purchase_unit, 'class="form-control" id="default_purchase_unit" style="width:100%;"'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="alert_quantity"><?= lang('alert_quantity', 'alert_quantity') ?></label>
                                <div class="input-group">
                                    <?= form_input('alert_quantity', (isset($_POST['alert_quantity']) ? $_POST['alert_quantity'] : ($product ? $this->sma->formatDecimal($product->alert_quantity) : '')), 'class="form-control modern-input tip" id="alert_quantity"') ?>
                                    <span class="input-group-addon" title="Rastrear Inventario">
                                        <input type="checkbox" name="track_quantity" id="inlineCheckbox1" value="1" <?= ($product ? (!empty($product->track_quantity) ? 'checked="checked"' : '') : 'checked="checked"') ?>>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. VARIANTES, PROVEEDORES Y ALMACENES -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-random"></i> 4. Variantes, Almacenes y Proveedores</h3>
                </div>
                <div class="modern-card-body">
                    <!-- Existencias en Almacén Actuales -->
                    <div class="standard">
                        <?php if (!empty($warehouses) || !empty($warehouses_products)) { ?>
                            <div class="well well-sm" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <p style="font-weight: 700; color: #1e293b; margin-bottom: 8px;"><i class="fa fa-building-o"></i> <?= lang('warehouse_quantity') ?></p>
                                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                                    <?php if (!empty($warehouses_products)) {
                                        foreach ($warehouses_products as $wh_pr) { ?>
                                            <div style="background: #ffffff; padding: 6px 12px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px;">
                                                <b><?= $wh_pr->name ?>:</b>
                                                <input type="hidden" value="<?= $this->sma->formatDecimal($wh_pr->quantity) ?>" id="vwh_qty_<?= $wh_pr->id ?>">
                                                <span class="badge" style="background: #2563eb;"><?= $this->sma->formatQuantity($wh_pr->quantity) ?></span>
                                                <?= $wh_pr->rack ? ' (' . $wh_pr->rack . ')' : '' ?>
                                            </div>
                                    <?php } } ?>
                                </div>
                            </div>
                        <?php } ?>

                        <!-- Variantes Existentes -->
                        <?php if ($product_variants) { ?>
                            <h4 style="font-size: 14px; font-weight: 700; color: #1e293b; margin-top: 15px;"><?= lang('update_variants'); ?></h4>
                            <table class="table table-bordered table-striped" style="border-radius: 6px; overflow: hidden;">
                                <thead style="background: #f8fafc;">
                                    <tr>
                                        <th class="col-xs-8"><?= lang('name') ?></th>
                                        <th class="col-xs-4"><?= lang('price_addition') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($product_variants as $pv) { ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="variant_id_<?= $pv->id ?>" value="<?= $pv->id ?>">
                                                <input type="text" name="variant_name_<?= $pv->id ?>" value="<?= $pv->name ?>" class="form-control modern-input">
                                            </td>
                                            <td>
                                                <input type="text" name="variant_price_<?= $pv->id ?>" value="<?= $pv->price ?>" class="form-control modern-input text-right">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>

                        <!-- Checkbox para Añadir Más Variantes -->
                        <div class="switch-option" style="margin-top: 15px;">
                            <input type="checkbox" class="checkbox" name="attributes" id="attributes" <?= $this->input->post('attributes') ? 'checked="checked"' : ''; ?>>
                            <label for="attributes"><?= lang('add_more_variants'); ?> <span style="font-weight: 400; color: #64748b;">(<?= lang('eg_sizes_colors'); ?>)</span></label>
                        </div>

                        <div id="attr-con" <?= $this->input->post('attributes') ? '' : 'style="display:none;"'; ?>>
                            <div class="input-group" style="margin-bottom: 12px;">
                                <?= form_input('attributesInput', '', 'class="form-control select-tags" id="attributesInput" placeholder="' . $this->lang->line('enter_attributes') . '"'); ?>
                                <span class="input-group-addon" style="padding: 2px 8px;">
                                    <a href="#" id="addAttributes" class="text-primary"><i class="fa fa-2x fa-plus-circle" id="addIcon"></i></a>
                                </span>
                            </div>

                            <table id="attrTable" class="table table-bordered table-striped" style="border-radius: 6px; overflow: hidden;">
                                <thead style="background: #f8fafc;">
                                    <tr>
                                        <th><?= lang('name') ?></th>
                                        <th><?= lang('warehouse') ?></th>
                                        <th><?= lang('quantity') ?></th>
                                        <th><?= lang('price_addition') ?></th>
                                        <th><i class="fa fa-times attr-remove-all" style="cursor:pointer;" title="Eliminar todas"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($this->input->post('attributes')) {
                                        $a = sizeof($_POST['attr_name']);
                                        for ($r = 0; $r <= $a; $r++) {
                                            if (isset($_POST['attr_name'][$r]) && (isset($_POST['attr_warehouse'][$r]) || isset($_POST['attr_quantity'][$r]))) {
                                                echo '<tr class="attr">
                                                <td><input type="hidden" name="attr_name[]" value="' . $_POST['attr_name'][$r] . '"><span>' . $_POST['attr_name'][$r] . '</span></td>
                                                <td class="code text-center"><input type="hidden" name="attr_warehouse[]" value="' . (isset($_POST['attr_warehouse'][$r]) ? $_POST['attr_warehouse'][$r] : '') . '"><input type="hidden" name="attr_wh_name[]" value="' . (isset($_POST['attr_wh_name'][$r]) ? $_POST['attr_wh_name'][$r] : '') . '"><span>' . (isset($_POST['attr_wh_name'][$r]) ? $_POST['attr_wh_name'][$r] : '') . '</span></td>
                                                <td class="quantity text-center"><input type="hidden" name="attr_quantity[]" value="' . $_POST['attr_quantity'][$r] . '"><span>' . $_POST['attr_quantity'][$r] . '</span></td>
                                                <td class="price text-right"><input type="hidden" name="attr_price[]" value="' . $_POST['attr_price'][$r] . '"><span>' . $_POST['attr_price'][$r] . '</span></td><td class="text-center"><i class="fa fa-times delAttr" style="cursor:pointer;"></i></td>
                                            </tr>';
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Proveedores -->
                        <div style="border-top: 1px solid #e2e8f0; padding-top: 16px; margin-top: 16px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <label class="modern-label" style="margin: 0;"><?= lang('supplier', 'supplier') ?></label>
                                <button type="button" class="btn btn-primary btn-xs" id="addSupplier" style="border-radius: 4px;">
                                    <i class="fa fa-plus"></i> Añadir Proveedor
                                </button>
                            </div>
                            <div class="row" id="supplier-con">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <?= form_input('supplier', (isset($_POST['supplier']) ? $_POST['supplier'] : ''), 'class="form-control ' . ($product ? '' : 'suppliers') . '" id="' . ($product && !empty($product->supplier1) ? 'supplier1' : 'supplier') . '" placeholder="' . lang('select') . ' ' . lang('supplier') . '" style="width:100%;"'); ?>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?= form_input('supplier_part_no', (isset($_POST['supplier_part_no']) ? $_POST['supplier_part_no'] : ''), 'class="form-control modern-input tip" id="supplier_part_no" placeholder="' . lang('supplier_part_no') . '"'); ?>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?= form_input('supplier_price', (isset($_POST['supplier_price']) ? $_POST['supplier_price'] : ''), 'class="form-control modern-input tip" id="supplier_price" placeholder="' . lang('supplier_price') . '"'); ?>
                                    </div>
                                </div>
                            </div>
                            <div id="ex-suppliers"></div>
                        </div>
                    </div>

                    <!-- COMBO PRODUCTS SECTION -->
                    <div class="combo" style="display:none;">
                        <div class="form-group">
                            <label class="modern-label"><?= lang('add_product', 'add_item') . ' (' . lang('not_with_variants') . ')'; ?></label>
                            <?php echo form_input('add_item', '', 'class="form-control modern-input ttip" id="add_item" placeholder="' . $this->lang->line('add_item') . '"'); ?>
                        </div>
                        <table id="prTable" class="table table-striped table-bordered">
                            <thead>
                                <tr style="background: #f8fafc;">
                                    <th><?= lang('product'); ?></th>
                                    <th style="width: 120px;"><?= lang('quantity'); ?></th>
                                    <th style="width: 140px;"><?= lang('unit_price'); ?></th>
                                    <th style="width: 40px; text-align: center;"><i class="fa fa-trash-o"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <!-- DIGITAL FILE SECTION -->
                    <div class="digital" style="display:none;">
                        <div class="form-group digital">
                            <label class="modern-label"><?= lang('digital_file', 'digital_file') ?></label>
                            <input id="digital_file" type="file" name="digital_file" class="form-control file">
                        </div>
                        <div class="form-group digital">
                            <label class="modern-label"><?= lang('file_link', 'file_link'); ?></label>
                            <?= form_input('file_link', ($product ? $product->file : ''), 'class="form-control modern-input" id="file_link"'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. DESCRIPCIONES Y NOTAS -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-file-text-o"></i> 5. Descripciones y Notas</h3>
                </div>
                <div class="modern-card-body">
                    <div class="form-group all">
                        <label class="modern-label" for="details"><?= lang('product_details_for_invoice', 'details') ?></label>
                        <?= form_textarea('details', (isset($_POST['details']) ? $_POST['details'] : ($product ? $product->details : '')), 'class="form-control" id="details" rows="3"'); ?>
                    </div>
                    <div class="form-group all">
                        <label class="modern-label" for="product_details"><?= lang('product_details', 'product_details') ?></label>
                        <?= form_textarea('product_details', (isset($_POST['product_details']) ? $_POST['product_details'] : ($product ? $product->product_details : '')), 'class="form-control" id="product_details" rows="5"'); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- COLUMNA LATERAL (4 COLS) -->
        <div class="col-md-4">
            <!-- 6. IMÁGENES Y MULTIMEDIA -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-image"></i> Multimedia</h3>
                </div>
                <div class="modern-card-body">
                    <?php if ($product && $product->image) { ?>
                        <div class="current-image-preview">
                            <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 6px;">
                                Imagen Actual
                            </span>
                            <img src="<?= base_url() ?>assets/uploads/<?= $product->image ?>" alt="<?= $product->name ?>" class="img-responsive">
                        </div>
                    <?php } ?>

                    <div class="form-group all">
                        <label class="modern-label" for="product_image">Sustituir <?= lang('product_image', 'product_image') ?></label>
                        <input id="product_image" type="file" name="product_image" accept="image/*" class="form-control file">
                    </div>

                    <div class="form-group all">
                        <label class="modern-label" for="images"><?= lang('product_gallery_images', 'images') ?></label>
                        <input id="images" type="file" name="userfile[]" multiple="true" accept="image/*" class="form-control file">
                    </div>
                    <div id="img-details"></div>
                </div>
            </div>

            <!-- 7. PROMOCIONES Y VISIBILIDAD -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-sliders"></i> Opciones y Visibilidad</h3>
                </div>
                <div class="modern-card-body">
                    <!-- Promoción Switch -->
                    <div class="switch-option">
                        <input type="checkbox" class="checkbox" value="1" name="promotion" id="promotion" <?= ($this->input->post('promotion') || ($product && $product->promotion)) ? 'checked="checked"' : ''; ?>>
                        <label for="promotion"><?= lang('promotion'); ?></label>
                    </div>

                    <div id="promo" <?= ($product && $product->promotion) ? '' : 'style="display:none;"'; ?>>
                        <div class="well well-sm" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px;">
                            <div class="form-group">
                                <label class="modern-label"><?= lang('promo_price', 'promo_price'); ?></label>
                                <?= form_input('promo_price', set_value('promo_price', ($product && $product->promo_price) ? $this->sma->formatDecimal($product->promo_price) : ''), 'class="form-control modern-input tip" id="promo_price"'); ?>
                            </div>
                            <div class="form-group">
                                <label class="modern-label"><?= lang('start_date', 'start_date'); ?></label>
                                <?= form_input('start_date', set_value('start_date', ($product && $product->start_date) ? $this->sma->hrsd($product->start_date) : ''), 'class="form-control modern-input tip date" id="start_date"'); ?>
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label class="modern-label"><?= lang('end_date', 'end_date'); ?></label>
                                <?= form_input('end_date', set_value('end_date', ($product && $product->end_date) ? $this->sma->hrsd($product->end_date) : ''), 'class="form-control modern-input tip date" id="end_date"'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="switch-option">
                        <input name="featured" type="checkbox" class="checkbox" id="featured" value="1" <?= empty($product->featured) ? '' : 'checked="checked"' ?>/>
                        <label for="featured"><?= lang('featured') ?></label>
                    </div>

                    <div class="switch-option">
                        <input name="hide_pos" type="checkbox" class="checkbox" id="hide_pos" value="1" <?= empty($product->hide_pos) ? '' : 'checked="checked"' ?>/>
                        <label for="hide_pos"><?= lang('hide_in_pos') ?></label>
                    </div>

                    <div class="switch-option">
                        <input name="hide" type="checkbox" class="checkbox" id="hide" value="1" <?= empty($product->hide) ? '' : 'checked="checked"' ?>/>
                        <label for="hide"><?= lang('hide_in_shop') ?></label>
                    </div>

                    <?php if ($Settings->invoice_view == 2) { ?>
                        <div class="form-group" style="margin-top: 15px;">
                            <label class="modern-label"><?= lang('hsn_code', 'hsn_code'); ?></label>
                            <?= form_input('hsn_code', set_value('hsn_code', ($product ? $product->hsn_code : '')), 'class="form-control modern-input" id="hsn_code"'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- 8. CAMPOS PERSONALIZADOS -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h3><i class="fa fa-list-alt"></i> Campos Personalizados</h3>
                </div>
                <div class="modern-card-body">
                    <div class="form-group">
                        <label class="modern-label"><?= lang('pcf1', 'cf1') ?></label>
                        <?= form_input('cf1', (isset($_POST['cf1']) ? $_POST['cf1'] : ($product ? $product->cf1 : '')), 'class="form-control modern-input tip" id="cf1"') ?>
                    </div>
                    <div class="form-group">
                        <label class="modern-label"><?= lang('pcf2', 'cf2') ?></label>
                        <?= form_input('cf2', (isset($_POST['cf2']) ? $_POST['cf2'] : ($product ? $product->cf2 : '')), 'class="form-control modern-input tip" id="cf2"') ?>
                    </div>
                    <div class="form-group">
                        <label class="modern-label"><?= lang('pcf3', 'cf3') ?></label>
                        <?= form_input('cf3', (isset($_POST['cf3']) ? $_POST['cf3'] : ($product ? $product->cf3 : '')), 'class="form-control modern-input tip" id="cf3"') ?>
                    </div>
                    <div class="form-group">
                        <label class="modern-label"><?= lang('pcf4', 'cf4') ?></label>
                        <?= form_input('cf4', (isset($_POST['cf4']) ? $_POST['cf4'] : ($product ? $product->cf4 : '')), 'class="form-control modern-input tip" id="cf4"') ?>
                    </div>
                    <div class="form-group">
                        <label class="modern-label"><?= lang('pcf5', 'cf5') ?></label>
                        <?= form_input('cf5', (isset($_POST['cf5']) ? $_POST['cf5'] : ($product ? $product->cf5 : '')), 'class="form-control modern-input tip" id="cf5"') ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="modern-label"><?= lang('pcf6', 'cf6') ?></label>
                        <?= form_input('cf6', (isset($_POST['cf6']) ? $_POST['cf6'] : ($product ? $product->cf6 : '')), 'class="form-control modern-input tip" id="cf6"') ?>
                    </div>
                </div>
            </div>

            <!-- BOTÓN GUARDAR STICKY -->
            <div class="sticky-submit-box">
                <div class="modern-card" style="border: 2px solid #3b82f6; background: #eff6ff;">
                    <div class="modern-card-body" style="padding: 18px; text-align: center;">
                        <p style="font-weight: 600; font-size: 13px; color: #1e40af; margin-bottom: 12px;">
                            <i class="fa fa-info-circle"></i> Editando producto #<?= $product->id ?>
                        </p>
                        <?php echo form_submit('edit_product', 'Actualizar Producto', 'class="btn btn-primary btn-block btn-lg" style="font-weight: 700; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);"'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= form_close(); ?>
</div>

<script type="text/javascript">
    // Script interactivo para cálculo de margen en tiempo real
    $(document).ready(function() {
        function updateProfitMargin() {
            var cost = parseFloat($('#cost').val()) || 0;
            var price = parseFloat($('#price').val()) || 0;
            var badge = $('#live-margin-display');

            if (price > 0) {
                var margin = ((price - cost) / price) * 100;
                var profit = price - cost;
                badge.text('Margen: ' + margin.toFixed(1) + '% (+$' + profit.toFixed(2) + ')');

                if (margin >= 20) {
                    badge.removeClass('negative').addClass('positive');
                } else if (margin > 0) {
                    badge.removeClass('positive negative');
                } else {
                    badge.removeClass('positive').addClass('negative');
                }
            } else {
                badge.text('Margen: 0%').removeClass('positive negative');
            }
        }

        $('#cost, #price').on('input change', updateProfitMargin);
        updateProfitMargin();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.gen_slug').change(function(e) {
            getSlug($(this).val(), 'products');
        });
        $("#subcategory").select2("destroy").empty().attr("placeholder", "<?= lang('select_category_to_load') ?>").select2({
            placeholder: "<?= lang('select_category_to_load') ?>", data: [
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
<div class="box"> 
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i><?= lang('edit_product'); ?></h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext"><?php echo lang('update_info'); ?></p>
                <?php
                $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('products/edit/' . $product->id, $attrib)
                ?>
                <div class="col-md-5">
                    <div class="form-group">
                        <?= lang('product_type', 'type') ?>
                        <?php
                        $opts = ['standard' => lang('standard'), 'combo' => lang('combo'), 'digital' => lang('digital'), 'service' => lang('service')];
                        echo form_dropdown('type', $opts, (isset($_POST['type']) ? $_POST['type'] : ($product ? $product->type : '')), 'class="form-control" id="type" required="required"');
                        ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('product_name', 'name') ?>
                        <?= form_input('name', (isset($_POST['name']) ? $_POST['name'] : ($product ? $product->name : '')), 'class="form-control gen_slug" id="name" required="required"'); ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('product_code', 'code') ?>
                        <?= form_input('code', (isset($_POST['code']) ? $_POST['code'] : ($product ? $product->code : '')), 'class="form-control" id="code"  required="required"') ?>
                        <span class="help-block"><?= lang('you_scan_your_barcode_too') ?></span>
                    </div>

                    <div class="form-group all">
                        <?= lang('slug', 'slug'); ?>
                        <?= form_input('slug', set_value('slug', ($product ? $product->slug : '')), 'class="form-control tip" id="slug" required="required"'); ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('second_name', 'second_name'); ?>
                        <?= form_input('second_name', set_value('second_name', ($product ? $product->second_name : '')), 'class="form-control tip" id="second_name"'); ?>
                    </div>

                    <div class="form-group standard_combo">
                        <?= lang('weight', 'weight'); ?>
                        <?= form_input('weight', set_value('weight', ($product ? $product->weight : '')), 'class="form-control tip" id="weight"'); ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('barcode_symbology', 'barcode_symbology') ?>
                        <?php
                        $bs = ['code25' => 'Code25', 'code39' => 'Code39', 'code128' => 'Code128', 'ean8' => 'EAN8', 'ean13' => 'EAN13', 'upca' => 'UPC-A', 'upce' => 'UPC-E'];
                        echo form_dropdown('barcode_symbology', $bs, (isset($_POST['barcode_symbology']) ? $_POST['barcode_symbology'] : ($product ? $product->barcode_symbology : 'code128')), 'class="form-control select" id="barcode_symbology" required="required" style="width:100%;"');
                        ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('brand', 'brand') ?>
                        <?php
                        $br[''] = '';
                        foreach ($brands as $brand) {
                            $br[$brand->id] = $brand->name;
                        }
                        echo form_dropdown('brand', $br, (isset($_POST['brand']) ? $_POST['brand'] : ($product ? $product->brand : '')), 'class="form-control select" id="brand" placeholder="' . lang('select') . ' ' . lang('brand') . '" style="width:100%"')
                        ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('category', 'category') ?>
                        <?php
                        $cat[''] = '';
                        foreach ($categories as $category) {
                            $cat[$category->id] = $category->name;
                        }
                        echo form_dropdown('category', $cat, (isset($_POST['category']) ? $_POST['category'] : ($product ? $product->category_id : '')), 'class="form-control select" id="category" placeholder="' . lang('select') . ' ' . lang('category') . '" required="required" style="width:100%"')
                        ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('subcategory', 'subcategory') ?>
                        <div class="controls" id="subcat_data"> <?php
                            echo form_input('subcategory', ($product ? $product->subcategory_id : ''), 'class="form-control" id="subcategory"  placeholder="' . lang('select_category_to_load') . '"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group standard">
                        <?= lang('product_unit', 'unit'); ?>
                        <?php
                        $pu[''] = lang('select') . ' ' . lang('unit');
                        foreach ($base_units as $bu) {
                            $pu[$bu->id] = $bu->name . ' (' . $bu->code . ')';
                        }
                        ?>
                        <?= form_dropdown('unit', $pu, set_value('unit', $product->unit), 'class="form-control tip" required="required" id="unit" style="width:100%;"'); ?>
                    </div>
                    <div class="form-group standard">
                        <?= lang('default_sale_unit', 'default_sale_unit'); ?>
                        <?php
                        $uopts[''] = lang('select') . ' ' . lang('unit');
                        foreach ($subunits as $sunit) {
                            $uopts[$sunit->id] = $sunit->name . ' (' . $sunit->code . ')';
                        }
                        ?>
                        <?= form_dropdown('default_sale_unit', $uopts, $product->sale_unit, 'class="form-control" id="default_sale_unit" style="width:100%;"'); ?>
                    </div>
                    <div class="form-group standard">
                        <?= lang('default_purchase_unit', 'default_purchase_unit'); ?>
                        <?= form_dropdown('default_purchase_unit', $uopts, $product->purchase_unit, 'class="form-control" id="default_purchase_unit" style="width:100%;"'); ?>
                    </div>
                    <div class="form-group standard">
                        <?= lang('product_cost', 'cost') ?>
                        <?= form_input('cost', (isset($_POST['cost']) ? $_POST['cost'] : ($product ? $this->sma->formatDecimal($product->cost) : '')), 'class="form-control tip" id="cost" required="required"') ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('product_price', 'price') ?>
                        <?= form_input('price', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" class="checkbox" value="1" name="promotion" id="promotion" <?= $this->input->post('promotion') ? 'checked="checked"' : ''; ?>>
                        <label for="promotion" class="padding05">
                            <?= lang('promotion'); ?>
                        </label>
                    </div>

                    <div id="promo"<?= $product->promotion ? '' : ' style="display:none;"'; ?>>
                        <div class="well well-sm">
                            <div class="form-group">
                                <?= lang('promo_price', 'promo_price'); ?>
                                <?= form_input('promo_price', set_value('promo_price', $product->promo_price ? $this->sma->formatDecimal($product->promo_price) : ''), 'class="form-control tip" id="promo_price"'); ?>
                            </div>
                            <div class="form-group">
                                <?= lang('start_date', 'start_date'); ?>
                                <?= form_input('start_date', set_value('start_date', $product->start_date ? $this->sma->hrsd($product->start_date) : ''), 'class="form-control tip date" id="start_date"'); ?>
                            </div>
                            <div class="form-group">
                                <?= lang('end_date', 'end_date'); ?>
                                <?= form_input('end_date', set_value('end_date', $product->end_date ? $this->sma->hrsd($product->end_date) : ''), 'class="form-control tip date" id="end_date"'); ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($Settings->invoice_view == 2) {
                            ?>
                        <div class="form-group">
                            <?= lang('hsn_code', 'hsn_code'); ?>
                            <?= form_input('hsn_code', set_value('hsn_code', ($product ? $product->hsn_code : '')), 'class="form-control" id="hsn_code"'); ?>
                        </div>
                    <?php
                        } ?>

                    <?php if ($Settings->tax1) {
                            ?>
                        <div class="form-group all">
                            <?= lang('product_tax', 'tax_rate') ?>
                            <?php
                            $tr[''] = '';
                            foreach ($tax_rates as $tax) {
                                $tr[$tax->id] = $tax->name;
                            }
                            echo form_dropdown('tax_rate', $tr, (isset($_POST['tax_rate']) ? $_POST['tax_rate'] : ($product ? $product->tax_rate : $Settings->default_tax_rate)), 'class="form-control select" id="tax_rate" placeholder="' . lang('select') . ' ' . lang('product_tax') . '" style="width:100%"')
                            ?>
                        </div>
                        <div class="form-group all">
                            <?= lang('tax_method', 'tax_method') ?>
                            <?php
                            $tm = ['0' => lang('inclusive'), '1' => lang('exclusive')];
                            echo form_dropdown('tax_method', $tm, (isset($_POST['tax_method']) ? $_POST['tax_method'] : ($product ? $product->tax_method : '')), 'class="form-control select" id="tax_method" placeholder="' . lang('select') . ' ' . lang('tax_method') . '" style="width:100%"')
                            ?>
                        </div>
                    <?php
                        } ?>
                    <div class="form-group standard">
                        <?= lang('alert_quantity', 'alert_quantity') ?>
                        <div
                            class="input-group"> <?= form_input('alert_quantity', (isset($_POST['alert_quantity']) ? $_POST['alert_quantity'] : ($product ? $this->sma->formatDecimal($product->alert_quantity) : '')), 'class="form-control tip" id="alert_quantity"') ?>
                            <span class="input-group-addon">
                            <input type="checkbox" name="track_quantity" id="inlineCheckbox1"
                                   value="1" <?= ($product ? (!empty($product->track_quantity) ? 'checked="checked"' : '') : 'checked="checked"') ?>>
                        </span>
                        </div>
                    </div>

                    <div class="form-group all">
                        <?= lang('product_image', 'product_image') ?>
                        <input id="product_image" type="file" data-browse-label="<?= lang('browse'); ?>" name="product_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>

                    <div class="form-group all">
                        <?= lang('product_gallery_images', 'images') ?>
                        <input id="images" type="file" data-browse-label="<?= lang('browse'); ?>" name="userfile[]" multiple="true" data-show-upload="false"
                               data-show-preview="false" class="form-control file" accept="image/*">
                    </div>
                    <div id="img-details"></div>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <div class="standard">
                        <div>
                            <?php
                            if (!empty($warehouses) || !empty($warehouses_products)) {
                                echo '<div class="row"><div class="col-md-12"><div class="well">';
                                echo '<p><strong>' . lang('warehouse_quantity') . '</strong></p>';
                                if (!empty($warehouses_products)) {
                                    foreach ($warehouses_products as $wh_pr) {
                                        echo '<span class="bold text-info">' . $wh_pr->name . ': <input type="hidden" value="' . $this->sma->formatDecimal($wh_pr->quantity) . '" id="vwh_qty_' . $wh_pr->id . '"><span class="padding05" id="rwh_qty_' . $wh_pr->id . '">' . $this->sma->formatQuantity($wh_pr->quantity) . '</span>' . ($wh_pr->rack ? ' (<span class="padding05" id="rrack_' . $wh_pr->id . '">' . $wh_pr->rack . '</span>)' : '') . '</span><br>';
                                    }
                                }
                                echo '<div class="clearfix"></div></div></div></div>';
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div>

                        <div id="attrs"></div>
                        <div class="well well-sm">
                            <?php
                            if ($product_options) {
                                ?>
                            <table class="table table-bordered table-condensed table-striped"
                                   style="<?= $this->input->post('attributes') || $product_options ? '' : 'display:none;'; ?> margin-top: 10px;">
                                <thead>
                                <tr class="active">
                                    <th><?= lang('name') ?></th>
                                    <th><?= lang('warehouse') ?></th>
                                    <th><?= lang('quantity') ?></th>
                                    <th><?= lang('price_addition') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($product_options as $option) {
                                    echo '<tr><td class="col-xs-3"><input type="hidden" name="attr_id[]" value="' . $option->id . '"><span>' . $option->name . '</span></td><td class="code text-center col-xs-3"><span>' . $option->wh_name . '</span></td><td class="quantity text-center col-xs-2"><span>' . $this->sma->formatQuantity($option->wh_qty) . '</span></td><td class="price text-right col-xs-2">' . $this->sma->formatMoney($option->price) . '</td></tr>';
                                } ?>
                            </tbody>
                            </table>
                            <?php
                            }
                            if ($product_variants) {
                                ?>
                                <h3 class="bold"><?=lang('update_variants'); ?></h3>
                                <table class="table table-bordered table-condensed table-striped" style="margin-top: 10px;">
                                <thead>
                                <tr class="active">
                                    <th class="col-xs-8"><?= lang('name') ?></th>
                                    <th class="col-xs-4"><?= lang('price_addition') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($product_variants as $pv) {
                                    echo '<tr><td class="col-xs-3"><input type="hidden" name="variant_id_' . $pv->id . '" value="' . $pv->id . '"><input type="text" name="variant_name_' . $pv->id . '" value="' . $pv->name . '" class="form-control"></td><td class="price text-right col-xs-2"><input type="text" name="variant_price_' . $pv->id . '" value="' . $pv->price . '" class="form-control"></td></tr>';
                                } ?>
                                </tbody>
                                </table>
                                <?php
                            }
                            ?>
                            <div class="form-group">
                                <input type="checkbox" class="checkbox" name="attributes" id="attributes" <?= $this->input->post('attributes') ? 'checked="checked"' : ''; ?>>
                                <label for="attributes" class="padding05"><?= lang('add_more_variants'); ?></label>
                                <?= lang('eg_sizes_colors'); ?>
                            </div>

                            <div id="attr-con" <?= $this->input->post('attributes') ? '' : 'style="display:none;"'; ?>>
                                <div class="form-group" id="ui" style="margin-bottom: 0;">
                                    <div class="input-group">
                                        <?php
                                        echo form_input('attributesInput', '', 'class="form-control select-tags" id="attributesInput" placeholder="' . $this->lang->line('enter_attributes') . '"'); ?>
                                        <div class="input-group-addon" style="padding: 2px 5px;">
                                            <a href="#" id="addAttributes">
                                                <i class="fa fa-2x fa-plus-circle" id="addIcon"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="table-responsive">
                                    <table id="attrTable" class="table table-bordered table-condensed table-striped" style="margin-bottom: 0; margin-top: 10px;">
                                        <thead>
                                            <tr class="active">
                                                <th><?= lang('name') ?></th>
                                                <th><?= lang('warehouse') ?></th>
                                                <th><?= lang('quantity') ?></th>
                                                <th><?= lang('price_addition') ?></th>
                                                <th><i class="fa fa-times attr-remove-all"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody><?php
                                            if ($this->input->post('attributes')) {
                                                $a = sizeof($_POST['attr_name']);
                                                for ($r = 0; $r <= $a; $r++) {
                                                    if (isset($_POST['attr_name'][$r]) && (isset($_POST['attr_warehouse'][$r]) || isset($_POST['attr_quantity'][$r]))) {
                                                        echo '<tr class="attr">
                                                        <td><input type="hidden" name="attr_name[]" value="' . $_POST['attr_name'][$r] . '"><span>' . $_POST['attr_name'][$r] . '</span></td>
                                                        <td class="code text-center"><input type="hidden" name="attr_warehouse[]" value="' . (isset($_POST['attr_warehouse'][$r]) ? $_POST['attr_warehouse'][$r] : '') . '"><input type="hidden" name="attr_wh_name[]" value="' . (isset($_POST['attr_wh_name'][$r]) ? $_POST['attr_wh_name'][$r] : '') . '"><span>' . (isset($_POST['attr_wh_name'][$r]) ? $_POST['attr_wh_name'][$r] : '') . '</span></td>
                                                        <td class="quantity text-center"><input type="hidden" name="attr_quantity[]" value="' . $_POST['attr_quantity'][$r] . '"><span>' . $_POST['attr_quantity'][$r] . '</span></td>
                                                        <td class="price text-right"><input type="hidden" name="attr_price[]" value="' . $_POST['attr_price'][$r] . '"><span>' . $_POST['attr_price'][$r] . '</span></span></td><td class="text-center"><i class="fa fa-times delAttr"></i></td>
                                                    </tr>';
                                                    }
                                                }
                                            }
                                        ?></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="combo" style="display:none;">

                        <div class="form-group">
                            <?= lang('add_product', 'add_item') . ' (' . lang('not_with_variants') . ')'; ?>
                            <?php echo form_input('add_item', '', 'class="form-control ttip" id="add_item" data-placement="top" data-trigger="focus" data-bv-notEmpty-message="' . lang('please_add_items_below') . '" placeholder="' . $this->lang->line('add_item') . '"'); ?>
                        </div>
                        <div class="control-group table-group">
                            <label class="table-label" for="combo"><?= lang('combo_products'); ?></label>
                            <!--<div class="row"><div class="ccol-md-10 col-sm-10 col-xs-10"><label class="table-label" for="combo"><?= lang('combo_products'); ?></label></div>
                            <div class="ccol-md-2 col-sm-2 col-xs-2"><div class="form-group no-help-block" style="margin-bottom: 0;"><input type="text" name="combo" id="combo" value="" data-bv-notEmpty-message="" class="form-control" /></div></div></div>-->
                            <div class="controls table-controls">
                                <table id="prTable"
                                       class="table items table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th class="col-md-5 col-sm-5 col-xs-5"><?= lang('product') . ' (' . lang('code') . ' - ' . lang('name') . ')'; ?></th>
                                        <th class="col-md-2 col-sm-2 col-xs-2"><?= lang('quantity'); ?></th>
                                        <th class="col-md-3 col-sm-3 col-xs-3"><?= lang('unit_price'); ?></th>
                                        <th class="col-md-1 col-sm-1 col-xs-1 text-center">
                                            <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="digital" style="display:none;">
                        <?php
                        if (filter_var($product->file, FILTER_VALIDATE_URL) === false) {
                            $file      = $product->file;
                            $file_link = '';
                        } else {
                            $file_link = $product->file;
                            $file      = '';
                        }
                        ?>
                        <div class="form-group digital">
                            <?= lang('digital_file', 'digital_file') ?>
                            <input id="digital_file" type="file" data-browse-label="<?= lang('browse'); ?>" name="digital_file" data-show-upload="false"
                                   data-show-preview="false" class="form-control file">
                        </div>
                        <div class="form-group digital">
                            <?= lang('file_link', 'file_link'); ?>
                            <?= form_input('file_link', $file_link, 'class="form-control" id="file_link"'); ?>
                        </div>
                    </div>

                    <div class="form-group standard">
                        <div class="form-group">
                            <?= lang('supplier', 'supplier') ?>
                            <button type="button" class="btn btn-primary btn-xs" id="addSupplier"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="row" id="supplier-con">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <?php
                                    echo form_input('supplier', (isset($_POST['supplier']) ? $_POST['supplier'] : ''), 'class="form-control ' . ($product ? '' : 'suppliers') . '" id="' . ($product && !empty($product->supplier1) ? 'supplier1' : 'supplier') . '" placeholder="' . lang('select') . ' ' . lang('supplier') . '" style="width:100%;"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <?= form_input('supplier_part_no', (isset($_POST['supplier_part_no']) ? $_POST['supplier_part_no'] : ''), 'class="form-control tip" id="supplier_part_no" placeholder="' . lang('supplier_part_no') . '"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <?= form_input('supplier_price', (isset($_POST['supplier_price']) ? $_POST['supplier_price'] : ''), 'class="form-control tip" id="supplier_price" placeholder="' . lang('supplier_price') . '"'); ?>
                                </div>
                            </div>
                        </div>
                        <div id="ex-suppliers"></div>
                    </div>


          <!-- Cambios mosqueda -->
                  
                    <div class="form-group standard">
                        <div class="form-group">
                          <b> Rango de precios      </b>                       
                        </div>
                        <div class="row" id="supplier-con">                           
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('i', ($_POST['i'] ?? ($product ? $product->i : '')), 'class="form-control id="i" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('f', ($_POST['f'] ?? ($product ? $product->f : '')), 'class="form-control id="f" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('n', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                                </div>
                            </div>
                        </div>
                        <!-- Jorge 
                    
                        <div class="row" id="supplier-con">                           
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('i2', ($_POST['i2'] ?? ($product ? $product->i2 : '')), 'class="form-control id="i" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('f2', ($_POST['f2'] ?? ($product ? $product->f2 : '')), 'class="form-control id="f" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('n2', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="supplier-con">                           
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('i2', ($_POST['i2'] ?? ($product ? $product->i2 : '')), 'class="form-control id="i" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('f2', ($_POST['f2'] ?? ($product ? $product->f2 : '')), 'class="form-control id="f" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('n2', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="supplier-con">                           
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('i2', ($_POST['i2'] ?? ($product ? $product->i2 : '')), 'class="form-control id="i" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('f2', ($_POST['f2'] ?? ($product ? $product->f2 : '')), 'class="form-control id="f" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('n2', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="supplier-con">                           
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('i2', ($_POST['i2'] ?? ($product ? $product->i2 : '')), 'class="form-control id="i" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('f2', ($_POST['f2'] ?? ($product ? $product->f2 : '')), 'class="form-control id="f" required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                <?= form_input('n2', (isset($_POST['price']) ? $_POST['price'] : ($product ? $this->sma->formatDecimal($product->price) : '')), 'class="form-control tip" id="price" required="required"') ?>
                                </div>
                            </div>
                        </div>
                       
                         Jorge -->
                        <div id="ex-suppliers"></div>
                    </div>

                </div>

                <div class="col-md-12">

                    <div class="form-group">
                        <input name="featured" type="checkbox" class="checkbox" id="featured" value="1" <?= empty($product->featured) ? '' : 'checked="checked"' ?>/>
                        <label for="featured" class="padding05"><?= lang('featured') ?></label>
                    </div>
                    <div class="form-group">
                        <input name="hide_pos" type="checkbox" class="checkbox" id="hide_pos" value="1" <?= empty($product->hide_pos) ? '' : 'checked="checked"' ?>/>
                        <label for="hide_pos" class="padding05"><?= lang('hide_in_pos') ?></label>
                    </div>
                    <div class="form-group">
                        <input name="hide" type="checkbox" class="checkbox" id="hide" value="1" <?= empty($product->hide) ? '' : 'checked="checked"' ?>/>
                        <label for="hide" class="padding05"><?= lang('hide_in_shop') ?></label>
                    </div>
                    <div class="form-group">
                        <input name="cf" type="checkbox" class="checkbox" id="extras" value="" checked="checked"/><label
                            for="extras" class="padding05"><?= lang('custom_fields') ?></label>
                    </div>
                    <div class="row" id="extras-con">

                        <div class="col-md-4">
                            <div class="form-group all">
                                <?= lang('pcf1', 'cf1') ?>
                                <?= form_input('cf1', (isset($_POST['cf1']) ? $_POST['cf1'] : ($product ? $product->cf1 : '')), 'class="form-control tip" id="cf1"') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <?= lang('pcf2', 'cf2') ?>
                                <?= form_input('cf2', (isset($_POST['cf2']) ? $_POST['cf2'] : ($product ? $product->cf2 : '')), 'class="form-control tip" id="cf2"') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <?= lang('pcf3', 'cf3') ?>
                                <?= form_input('cf3', (isset($_POST['cf3']) ? $_POST['cf3'] : ($product ? $product->cf3 : '')), 'class="form-control tip" id="cf3"') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <?= lang('pcf4', 'cf4') ?>
                                <?= form_input('cf4', (isset($_POST['cf4']) ? $_POST['cf4'] : ($product ? $product->cf4 : '')), 'class="form-control tip" id="cf4"') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <?= lang('pcf5', 'cf5') ?>
                                <?= form_input('cf5', (isset($_POST['cf5']) ? $_POST['cf5'] : ($product ? $product->cf5 : '')), 'class="form-control tip" id="cf5"') ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <?= lang('pcf6', 'cf6') ?>
                                <?= form_input('cf6', (isset($_POST['cf6']) ? $_POST['cf6'] : ($product ? $product->cf6 : '')), 'class="form-control tip" id="cf6"') ?>
                            </div>
                        </div>


                    </div>


                    <div class="form-group all">
                        <?= lang('product_details', 'product_details') ?>
                        <?= form_textarea('product_details', (isset($_POST['product_details']) ? $_POST['product_details'] : ($product ? $product->product_details : '')), 'class="form-control" id="details"'); ?>
                    </div>
                    <div class="form-group all">
                        <?= lang('product_details_for_invoice', 'details') ?>
                        <?= form_textarea('details', (isset($_POST['details']) ? $_POST['details'] : ($product ? $product->details : '')), 'class="form-control" id="details"'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo form_submit('edit_product', $this->lang->line('edit_product'), 'class="btn btn-primary"'); ?>
                    </div>

                </div>
                <?= form_close(); ?>

            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('form[data-toggle="validator"]').bootstrapValidator({ excluded: [':disabled'] });
        var audio_success = new Audio('<?= $assets ?>sounds/sound2.mp3');
        var audio_error = new Audio('<?= $assets ?>sounds/sound3.mp3');
        var items = {};
        <?php
        if ($combo_items) {
            echo '
                var ci = ' . json_encode($combo_items) . ';
                $.each(ci, function() { add_product_item(this); });
                ';
        }
        ?>
        <?=isset($_POST['cf']) ? '$("#extras").iCheck("check");' : '' ?>
        $('#extras').on('ifChecked', function () {
            $('#extras-con').slideDown();
        });
        $('#extras').on('ifUnchecked', function () {
            $('#extras-con').slideUp();
        });

        <?= isset($_POST['promotion']) || $product->promotion ? '$("#promotion").iCheck("check");' : '' ?>
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

        //$('#cost').removeAttr('required');
        $('#type').change(function () {
            var t = $(this).val();
            if (t !== 'standard') {
                $('.standard').slideUp();
                $('#unit').attr('disabled', true);
                $('#cost').attr('disabled', true);
            } else {
                $('.standard').slideDown();
                $('#unit').attr('disabled', false);
                $('#cost').attr('disabled', false);
            }
            if (t !== 'digital') {
                $('.digital').slideUp();
            } else {
                $('.digital').slideDown();
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

        $("#add_item").autocomplete({
            source: '<?= admin_url('products/suggestions'); ?>',
            minLength: 1,
            autoFocus: false,
            delay: 5,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    //audio_error.play();
                    bootbox.alert('<?= lang('no_product_found') ?>', function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    //audio_error.play();
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
                        $('#add_item').removeAttr('required');
                        $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'add_item');
                    }
                } else {
                    //audio_error.play();
                    bootbox.alert('<?= lang('no_product_found') ?>');
                }
            }
        });
        $('#add_item').removeAttr('required');
        $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'add_item');

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

            $("#prTable tbody").empty();
            $.each(items, function () {
                var row_no = this.id;
                var newTr = $('<tr id="row_' + row_no + '" class="item_' + this.id + '"></tr>');
                tr_html = '<td><input name="combo_item_id[]" type="hidden" value="' + this.id + '"><input name="combo_item_name[]" type="hidden" value="' + this.name + '"><input name="combo_item_code[]" type="hidden" value="' + this.code + '"><span id="name_' + row_no + '">' + this.code + ' - ' + this.name + '</span></td>';
                tr_html += '<td><input class="form-control text-center rquantity" name="combo_item_quantity[]" type="text" value="' + formatQuantity2(this.qty) + '" data-id="' + row_no + '" data-item="' + this.id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
                tr_html += '<td><input class="form-control text-center rprice" name="combo_item_price[]" type="text" value="' + formatDecimal(this.price) + '" data-id="' + row_no + '" data-item="' + this.id + '" id="combo_item_price_' + row_no + '" onClick="this.select();"></td>';
                tr_html += '<td class="text-center"><i class="fa fa-times tip del" id="' + row_no + '" title="Remove" style="cursor:pointer;"></i></td>';
                newTr.html(tr_html);
                newTr.prependTo("#prTable");
            });
            $('.item_' + item_id).addClass('warning');
            //audio_success.play();
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

        var _URL = window.URL || window.webkitURL;
        $("input#images").on('change.bs.fileinput', function () {
            var ele = document.getElementById($(this).attr('id'));
            var result = ele.files;
            $('#img-details').empty();
            for (var x = 0; x < result.length; x++) {
                var fle = result[x];
                for (var i = 0; i <= result.length; i++) {
                    var img = new Image();
                    img.onload = (function (value) {
                        return function () {
                            ctx[value].drawImage(result[value], 0, 0);
                        }
                    })(i);

                    img.src = 'images/' + result[i];
                }
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
                    $('#attrTable').show().append('<tr class="attr"><td><input type="hidden" name="attr_name[]" value="' + attrs[i] + '"><span>' + attrs[i] + '</span></td><td class="code text-center"><input type="hidden" name="attr_warehouse[]" value=""><span></span></td><td class="quantity text-center"><input type="hidden" name="attr_quantity[]" value="0"><span></span></td><td class="price text-right"><input type="hidden" name="attr_price[]" value="0"><span>0</span></span></td><td class="text-center"><i class="fa fa-times delAttr"></i></td></tr>');
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
            $('#aquantity').val(row.children().eq(2).find('span').text());
            $('#aprice').val(row.children().eq(3).find('span').text());
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
            row.children().eq(2).html('<input type="hidden" name="attr_quantity[]" value="' + ($('#aquantity').val() ? $('#aquantity').val() : 0) + '"><span>' + $('#aquantity').val() + '</span>');
            row.children().eq(3).html('<input type="hidden" name="attr_price[]" value="' + $('#aprice').val() + '"><span>' + currencyFormat($('#aprice').val()) + '</span>');

            $('#aModal').modal('hide');
        });
    });

    <?php if ($product) {
            ?>
    $(document).ready(function () {
        $('#enable_wh').click(function () {
            var whs = $('.wh');
            $.each(whs, function () {
                $(this).val($('#v' + $(this).attr('id')).val());
            });
            $('#warehouse_quantity').val(1);
            $('.wh').attr('disabled', false);
            $('#show_wh_edit').slideDown();
        });
        $('#disable_wh').click(function () {
            $('#warehouse_quantity').val(0);
            $('#show_wh_edit').slideUp();
        });
        $('#show_wh_edit').hide();
        $('.wh').attr('disabled', true);
        var t = "<?=$product->type?>";
        if (t !== 'standard') {
            $('.standard').slideUp();
            $('#unit').attr('disabled', true);
            $('#cost').attr('disabled', true);
        } else {
            $('.standard').slideDown();
            $('#unit').attr('disabled', false);
            $('#cost').attr('disabled', false);
        }
        if (t !== 'digital') {
            $('.digital').slideUp();
        } else {
            $('.digital').slideDown();
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
        $('#add_item').removeAttr('required');
        $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'add_item');
        //$("#code").parent('.form-group').addClass("has-error");
        //$("#code").focus();
        $("#product_image").parent('.form-group').addClass("text-warning");
        $("#images").parent('.form-group').addClass("text-warning");
        $.ajax({
            type: "get", async: false,
            url: "<?= admin_url('products/getSubCategories') ?>/" + <?= $product->category_id ?>,
            dataType: "json",
            success: function (scdata) {
                if (scdata != null) {
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
            }
        });
        <?php if ($product->supplier1) {
                ?>
        select_supplier('supplier1', "<?= $product->supplier1; ?>");
        $('#supplier_price').val("<?= $this->sma->formatDecimal($product->supplier1price); ?>");
        $('#supplier_part_no').val("<?= $product->supplier1_part_no; ?>");
        <?php
            } else {
                ?>
            $('#supplier1').addClass('rsupplier');
        <?php
            } ?>
        <?php if ($product->supplier2) {
                ?>
        $('#addSupplier').click();
        select_supplier('supplier_2', "<?= $product->supplier2; ?>");
        $('#supplier_2_price').val("<?= $this->sma->formatDecimal($product->supplier2price); ?>");
        $('#supplier_2_part_no').val("<?= $product->supplier2_part_no; ?>");
        <?php
            } ?>
        <?php if ($product->supplier3) {
                ?>
        $('#addSupplier').click();
        select_supplier('supplier_3', "<?= $product->supplier3; ?>");
        $('#supplier_3_price').val("<?= $this->sma->formatDecimal($product->supplier3price); ?>");
        $('#supplier_3_part_no').val("<?= $product->supplier3_part_no; ?>");
        <?php
            } ?>
        <?php if ($product->supplier4) {
                ?>
        $('#addSupplier').click();
        select_supplier('supplier_4', "<?= $product->supplier4; ?>");
        $('#supplier_4_price').val("<?= $this->sma->formatDecimal($product->supplier4price); ?>");
        $('#supplier_4_part_no').val("<?= $product->supplier4_part_no; ?>");
        <?php
            } ?>
        <?php if ($product->supplier5) {
                ?>
        $('#addSupplier').click();
        select_supplier('supplier_5', "<?= $product->supplier5; ?>");
        $('#supplier_5_price').val("<?= $this->sma->formatDecimal($product->supplier5price); ?>");
        $('#supplier_5_part_no').val("<?= $product->supplier5_part_no; ?>");
        <?php
            } ?>
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
    });
    <?php
        } ?>
    $(document).ready(function () {
        $('#enable_wh').trigger('click');
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
        $('#digital_file').removeAttr('required');
        $('form[data-toggle="validator"]').bootstrapValidator('removeField', 'digital_file');
    });
</script>

<div class="modal" id="aModal" tabindex="-1" role="dialog" aria-labelledby="aModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
                            class="fa fa-2x">&times;</i></span><span class="sr-only">Close</span></button>
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
                            echo form_dropdown('warehouse', $wh, '', 'id="awarehouse" class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aquantity" class="col-sm-4 control-label"><?= lang('quantity') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="aquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aprice" class="col-sm-4 control-label"><?= lang('price') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="aprice">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateAttr"><?= lang('submit') ?></button>
            </div>
        </div>
    </div>
</div>
