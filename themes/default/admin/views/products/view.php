<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
// Compute key metrics
$margin = ($product->price > 0 && $product->cost >= 0) ? round((($product->price - $product->cost) / $product->price) * 100, 1) : 0;
$total_qty = 0;
if (!empty($warehouses)) {
    foreach ($warehouses as $wh) {
        $total_qty += (float)$wh->quantity;
    }
}
$is_alert = ($product->alert_quantity > 0 && $total_qty <= $product->alert_quantity);
$is_out_of_stock = ($total_qty <= 0);
?>
<style type="text/css" media="screen">
    /* Modern UI/UX Styles for Product View */
    .pv-container {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }
    
    /* Modern Nav Tabs */
    .nav-tabs#myTab {
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 24px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .nav-tabs#myTab > li > a {
        border: 1px solid transparent !important;
        border-radius: 8px 8px 0 0 !important;
        font-weight: 600;
        font-size: 13px;
        color: #64748b;
        padding: 10px 18px;
        background: #f8fafc;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .nav-tabs#myTab > li > a:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
    .nav-tabs#myTab > li.active > a,
    .nav-tabs#myTab > li.active > a:focus,
    .nav-tabs#myTab > li.active > a:hover {
        background: #ffffff !important;
        color: #2563eb !important;
        border: 1px solid #e2e8f0 !important;
        border-bottom-color: #ffffff !important;
        box-shadow: 0 -2px 0 0 #2563eb inset;
    }

    /* Product Header Card */
    .pv-header-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .pv-header-title {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .pv-header-title h2 {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }
    .pv-badge {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 9999px;
        letter-spacing: 0.5px;
    }
    .pv-badge.type { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .pv-badge.views { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }

    /* KPI Summary Row */
    .pv-kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .pv-kpi-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .pv-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08);
    }
    .pv-kpi-info h4 {
        margin: 0 0 4px 0;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        font-weight: 700;
        color: #64748b;
    }
    .pv-kpi-info .pv-kpi-val {
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    .pv-kpi-info .pv-kpi-sub {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 4px;
        display: block;
    }
    .pv-kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .pv-kpi-icon.blue { background: #eff6ff; color: #2563eb; }
    .pv-kpi-icon.emerald { background: #ecfdf5; color: #059669; }
    .pv-kpi-icon.indigo { background: #e0e7ff; color: #4338ca; }
    .pv-kpi-icon.amber { background: #fffbeb; color: #d97706; }
    .pv-kpi-icon.red { background: #fef2f2; color: #dc2626; }

    /* Modern Card Box */
    .pv-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .pv-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 14px 20px;
        font-weight: 700;
        font-size: 14px;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .pv-card-body {
        padding: 20px;
    }

    /* Product Image Gallery */
    .pv-main-image-wrap {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        text-align: center;
        padding: 10px;
        margin-bottom: 12px;
    }
    .pv-main-image-wrap img {
        max-height: 280px;
        margin: 0 auto;
        border-radius: 8px;
        transition: transform 0.3s;
    }
    .pv-main-image-wrap img:hover {
        transform: scale(1.03);
    }
    .pv-gallery-thumbs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }
    .pv-gallery-thumbs .gallery-image {
        position: relative;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        overflow: hidden;
    }
    .pv-gallery-thumbs .delimg {
        position: absolute;
        top: 2px;
        right: 2px;
        background: rgba(220, 38, 38, 0.85);
        color: #ffffff;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
    }

    /* Barcode & QR Box */
    .pv-scan-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
        text-align: center;
        margin-top: 16px;
    }
    .pv-scan-box .bc-item {
        margin-bottom: 16px;
    }
    .pv-scan-box img.bcimg {
        max-width: 100%;
        height: auto;
        margin: 0 auto;
    }
    .pv-scan-box .qr-wrap {
        padding: 8px;
        display: inline-block;
        background: #ffffff;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
    }

    /* Attribute Specs Table */
    .pv-specs-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .pv-specs-table tr td {
        padding: 10px 14px;
        font-size: 13px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .pv-specs-table tr td:first-child {
        width: 35%;
        font-weight: 600;
        color: #64748b;
    }
    .pv-specs-table tr td:last-child {
        width: 65%;
        font-weight: 600;
        color: #0f172a;
    }
    .pv-specs-table tr:last-child td {
        border-bottom: none;
    }

    /* Modern Buttons */
    .btn-pv-action {
        font-weight: 600;
        font-size: 13px;
        border-radius: 8px;
        padding: 9px 18px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.15s;
    }
    .btn-pv-primary { background: #2563eb; color: #ffffff !important; border: 1px solid #2563eb; }
    .btn-pv-primary:hover { background: #1d4ed8; color: #ffffff !important; }
    .btn-pv-default { background: #f8fafc; color: #334155 !important; border: 1px solid #cbd5e1; }
    .btn-pv-default:hover { background: #f1f5f9; }
    .btn-pv-danger { background: #fee2e2; color: #b91c1c !important; border: 1px solid #fecaca; }
    .btn-pv-danger:hover { background: #fecaca; }
    .btn-pv-warning { background: #fef3c7; color: #92400e !important; border: 1px solid #fde68a; }
    .btn-pv-warning:hover { background: #fde68a; }

    /* Sticky/Convenient Bottom Actions Toolbar */
    .pv-actions-bar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 10px;
        margin-bottom: 30px;
    }
</style>

<div class="pv-container">

<?php if ($Owner || $Admin) { ?>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#details" class="tab-grey"><i class="fa fa-cube"></i> <?= lang('product_details') ?></a></li>
        <li class=""><a href="#chart" class="tab-grey"><i class="fa fa-line-chart"></i> <?= lang('chart') ?></a></li>
        <li class=""><a href="#sales" class="tab-grey"><i class="fa fa-shopping-cart"></i> <?= lang('sales') ?></a></li>
        <li class=""><a href="#quotes" class="tab-grey"><i class="fa fa-file-text-o"></i> <?= lang('quotes') ?></a></li>
        <?php if ($product->type == 'standard') { ?>
            <li class=""><a href="#purchases" class="tab-grey"><i class="fa fa-truck"></i> <?= lang('purchases') ?></a></li>
            <li class=""><a href="#transfers" class="tab-grey"><i class="fa fa-exchange"></i> <?= lang('transfers') ?></a></li>
            <li class=""><a href="#damages" class="tab-grey"><i class="fa fa-sliders"></i> <?= lang('quantity_adjustments') ?></a></li>
        <?php } ?>
    </ul>

    <div class="tab-content">
        <div id="details" class="tab-pane fade in active">
<?php } ?>

        <!-- Product Header Bar -->
        <div class="pv-header-card">
            <div class="pv-header-title">
                <i class="fa fa-cube" style="color: #2563eb; font-size: 24px;"></i>
                <h2><?= $product->name; ?></h2>
                <span class="pv-badge type"><?= lang($product->type); ?></span>
                <?php if (SHOP && $product->hide != 1) { ?>
                    <span class="pv-badge views"><i class="fa fa-eye"></i> <?= lang('shop_views') . ': ' . $product->views; ?></span>
                <?php } ?>
            </div>

            <div class="pv-header-actions" style="display: flex; gap: 8px; flex-wrap: wrap;">
                <?php if ($Owner || $Admin || $GP['products-edit']) { ?>
                    <a href="<?= admin_url('products/edit/' . $product->id) ?>" class="btn-pv-action btn-pv-warning">
                        <i class="fa fa-edit"></i> <?= lang('edit') ?>
                    </a>
                <?php } ?>
                <a href="<?= admin_url('products/print_barcodes/' . $product->id) ?>" class="btn-pv-action btn-pv-default">
                    <i class="fa fa-print"></i> <?= lang('print_barcode_label') ?>
                </a>
                <a href="<?= admin_url('products/pdf/' . $product->id) ?>" class="btn-pv-action btn-pv-default">
                    <i class="fa fa-download"></i> <?= lang('pdf') ?>
                </a>
            </div>
        </div>

        <!-- KPI Summary Cards -->
        <div class="pv-kpi-grid">
            <div class="pv-kpi-card">
                <div class="pv-kpi-info">
                    <h4><?= lang('price'); ?> Venta</h4>
                    <div class="pv-kpi-val" style="color: #2563eb;"><?= $this->sma->formatMoney($product->price); ?></div>
                    <?php if ($product->promotion) { ?>
                        <span class="pv-kpi-sub" style="color: #059669; font-weight: 700;">Promo: <?= $this->sma->formatMoney($product->promo_price); ?></span>
                    <?php } else { ?>
                        <span class="pv-kpi-sub"><?= $tax_rate ? $tax_rate->name : 'Sin Impuesto'; ?></span>
                    <?php } ?>
                </div>
                <div class="pv-kpi-icon blue">
                    <i class="fa fa-tag"></i>
                </div>
            </div>

            <?php if ($Owner || $Admin || $this->session->userdata('show_cost')) { ?>
            <div class="pv-kpi-card">
                <div class="pv-kpi-info">
                    <h4><?= lang('cost'); ?> Compra</h4>
                    <div class="pv-kpi-val" style="color: #475569;"><?= $this->sma->formatMoney($product->cost); ?></div>
                    <span class="pv-kpi-sub">Costo base unitario</span>
                </div>
                <div class="pv-kpi-icon indigo">
                    <i class="fa fa-money"></i>
                </div>
            </div>

            <div class="pv-kpi-card">
                <div class="pv-kpi-info">
                    <h4>Margen de Ganancia</h4>
                    <div class="pv-kpi-val" style="color: <?= $margin >= 20 ? '#059669' : ($margin > 0 ? '#d97706' : '#dc2626') ?>;">
                        +<?= $margin; ?>%
                    </div>
                    <span class="pv-kpi-sub"><?= $this->sma->formatMoney($product->price - $product->cost); ?> / unidad</span>
                </div>
                <div class="pv-kpi-icon emerald">
                    <i class="fa fa-percent"></i>
                </div>
            </div>
            <?php } ?>

            <div class="pv-kpi-card">
                <div class="pv-kpi-info">
                    <h4>Stock Global</h4>
                    <div class="pv-kpi-val" style="color: <?= $is_out_of_stock ? '#dc2626' : ($is_alert ? '#d97706' : '#059669') ?>;">
                        <?= $this->sma->formatQuantity($total_qty); ?>
                    </div>
                    <span class="pv-kpi-sub">
                        <?= $is_out_of_stock ? 'Agotado' : ($is_alert ? 'Alerta Stock Mínimo' : 'En Existencia'); ?>
                    </span>
                </div>
                <div class="pv-kpi-icon <?= $is_out_of_stock ? 'red' : ($is_alert ? 'amber' : 'emerald') ?>">
                    <i class="fa fa-cubes"></i>
                </div>
            </div>
        </div>

        <!-- Two Columns Layout -->
        <div class="row">
            <!-- Left Column: Visuals & Scanning -->
            <div class="col-md-4 col-sm-5">
                <div class="pv-card">
                    <div class="pv-card-header">
                        <i class="fa fa-picture-o text-primary"></i> <?= lang('image'); ?> y Galería
                    </div>
                    <div class="pv-card-body">
                        <div class="pv-main-image-wrap">
                            <a data-toggle="lightbox" href="<?= base_url() ?>assets/uploads/<?= $product->image ?>">
                                <img src="<?= base_url() ?>assets/uploads/<?= $product->image ?>" alt="<?= $product->name ?>" class="img-responsive"/>
                            </a>
                        </div>

                        <?php if (!empty($images)) { ?>
                            <div class="pv-gallery-thumbs" id="multiimages">
                                <a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="<?= base_url() ?>assets/uploads/<?= $product->image ?>">
                                    <img src="<?= base_url() ?>assets/uploads/thumbs/<?= $product->image ?>" alt="<?= $product->image ?>" style="width: 50px; height: 50px; object-fit: cover;" />
                                </a>
                                <?php foreach ($images as $ph) { ?>
                                    <div class="gallery-image">
                                        <a class="img-thumbnail" data-toggle="lightbox" data-gallery="multiimages" data-parent="#multiimages" href="<?= base_url() ?>assets/uploads/<?= $ph->photo ?>">
                                            <img src="<?= base_url() ?>assets/uploads/thumbs/<?= $ph->photo ?>" alt="<?= $ph->photo ?>" style="width: 50px; height: 50px; object-fit: cover;" />
                                        </a>
                                        <?php if ($Owner || $Admin || $GP['products-edit']) { ?>
                                            <a href="#" class="delimg" data-item-id="<?= $ph->id ?>" title="Eliminar foto"><i class="fa fa-times"></i></a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <!-- Barcode & QR Code Section -->
                        <div class="pv-scan-box">
                            <div class="bc-item">
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 6px;">
                                    Código de Barras (<?= $product->barcode_symbology; ?>)
                                </span>
                                <img src="<?= admin_url('misc/barcode/' . $product->code . '/' . $product->barcode_symbology . '/74/0'); ?>" alt="<?= $product->code; ?>" class="bcimg" />
                                <div style="font-family: monospace; font-size: 13px; font-weight: 700; margin-top: 4px; color: #0f172a;">
                                    <?= $product->code; ?>
                                </div>
                            </div>

                            <div style="border-top: 1px dashed #e2e8f0; padding-top: 14px; margin-top: 10px;">
                                <span style="font-size: 11px; text-transform: uppercase; font-weight: 700; color: #64748b; display: block; margin-bottom: 8px;">
                                    Acceso Rápido Móvil (QR)
                                </span>
                                <div class="qr-wrap">
                                    <?= $this->sma->qrcode('link', urlencode(admin_url('products/view/' . $product->id)), 2); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Specs & Inventory Breakdown -->
            <div class="col-md-8 col-sm-7">
                <!-- Specifications Card -->
                <div class="pv-card">
                    <div class="pv-card-header">
                        <i class="fa fa-info-circle text-primary"></i> <?= lang('product_details'); ?> y Especificaciones
                    </div>
                    <div class="pv-card-body" style="padding: 0;">
                        <table class="pv-specs-table">
                            <tbody>
                                <tr>
                                    <td><?= lang('code'); ?> SKU</td>
                                    <td><span style="font-family: monospace; background: #f1f5f9; padding: 3px 8px; border-radius: 4px; font-size: 13px;"><?= $product->code; ?></span></td>
                                </tr>
                                <tr>
                                    <td><?= lang('brand'); ?></td>
                                    <td><?= $brand ? $brand->name : '<span class="text-muted">N/A</span>'; ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang('category'); ?></td>
                                    <td>
                                        <span class="label label-info" style="font-size: 12px; font-weight: 600;"><?= $category ? $category->name : 'N/A'; ?></span>
                                        <?php if ($product->subcategory_id && $subcategory) { ?>
                                            <span style="color: #94a3b8; margin: 0 4px;">&gt;</span>
                                            <span class="label label-default" style="font-size: 12px; font-weight: 600;"><?= $subcategory->name; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?= lang('unit'); ?></td>
                                    <td><?= $unit ? $unit->name . ' (' . $unit->code . ')' : '<span class="text-muted">N/A</span>'; ?></td>
                                </tr>
                                <?php if ($product->tax_rate) { ?>
                                <tr>
                                    <td><?= lang('tax_rate'); ?></td>
                                    <td><?= $tax_rate ? $tax_rate->name : ''; ?> (<?= $product->tax_method == 0 ? lang('inclusive') : lang('exclusive'); ?>)</td>
                                </tr>
                                <?php } ?>
                                <?php if ($product->alert_quantity != 0) { ?>
                                <tr>
                                    <td><?= lang('alert_quantity'); ?> (Mínimo)</td>
                                    <td><span class="badge" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; font-weight: 700;"><?= $this->sma->formatQuantity($product->alert_quantity); ?></span></td>
                                </tr>
                                <?php } ?>
                                <?php if ($variants) { ?>
                                <tr>
                                    <td><?= lang('product_variants'); ?></td>
                                    <td>
                                        <?php foreach ($variants as $variant) {
                                            echo '<span class="label label-primary" style="margin-right: 4px; display: inline-block;">' . $variant->name . '</span> ';
                                        } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Warehouse Quantities Breakdown -->
                <?php if ((!$Supplier || !$Customer) && !empty($warehouses) && $product->type == 'standard') { ?>
                <div class="pv-card">
                    <div class="pv-card-header">
                        <i class="fa fa-building-o text-primary"></i> <?= lang('warehouse_quantity'); ?>
                    </div>
                    <div class="pv-card-body" style="padding: 0;">
                        <table class="table table-bordered table-striped" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background: #f8fafc; font-size: 11px; text-transform: uppercase; color: #64748b;">
                                    <th><?= lang('warehouse_name') ?></th>
                                    <th style="text-align: center;"><?= lang('quantity') ?></th>
                                    <th><?= lang('rack') ?></th>
                                    <?php if ($Owner || $Admin) { ?><th style="text-align: right;"><?= lang('avg_cost'); ?></th><?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($warehouses as $warehouse) { ?>
                                    <tr>
                                        <td style="font-weight: 600; color: #1e293b;"><?= $warehouse->name . ' (' . $warehouse->code . ')'; ?></td>
                                        <td style="text-align: center;">
                                            <span class="badge" style="background: <?= $warehouse->quantity > 0 ? '#dcfce7; color: #15803d;' : '#fee2e2; color: #b91c1c;' ?> font-weight: 700;">
                                                <?= $this->sma->formatQuantity($warehouse->quantity); ?>
                                            </span>
                                        </td>
                                        <td><?= $warehouse->rack ? $warehouse->rack : '<span class="text-muted">-</span>'; ?></td>
                                        <?php if ($Owner || $Admin) { ?>
                                            <td style="text-align: right; font-weight: 600; color: #475569;"><?= $warehouse->avg_cost ? $this->sma->formatMoney($warehouse->avg_cost) : '-'; ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>

                <!-- Product Variants in Warehouses -->
                <?php if (!empty($options)) { ?>
                <div class="pv-card">
                    <div class="pv-card-header">
                        <i class="fa fa-tags text-primary"></i> <?= lang('product_variants_quantity'); ?>
                    </div>
                    <div class="pv-card-body" style="padding: 0;">
                        <table class="table table-bordered table-striped" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background: #f8fafc; font-size: 11px; text-transform: uppercase; color: #64748b;">
                                    <th><?= lang('warehouse_name') ?></th>
                                    <th><?= lang('product_variant'); ?></th>
                                    <th style="text-align: center;"><?= lang('quantity') ?></th>
                                    <?php if ($Owner || $Admin) { ?>
                                        <th style="text-align: right;"><?= lang('cost') ?></th>
                                        <th style="text-align: right;"><?= lang('price') ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($options as $option) {
                                    if ($option->wh_qty != 0) { ?>
                                    <tr>
                                        <td><?= $option->wh_name; ?></td>
                                        <td><span class="label label-primary"><?= $option->name; ?></span></td>
                                        <td style="text-align: center; font-weight: 700;"><?= $this->sma->formatQuantity($option->wh_qty); ?></td>
                                        <?php if ($Owner || $Admin) { ?>
                                            <td style="text-align: right;"><?= $this->sma->formatMoney($option->cost); ?></td>
                                            <td style="text-align: right; font-weight: 700; color: #2563eb;"><?= $this->sma->formatMoney($option->price); ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>

                <!-- Combo Items -->
                <?php if ($product->type == 'combo' && !empty($combo_items)) { ?>
                <div class="pv-card">
                    <div class="pv-card-header">
                        <i class="fa fa-th-large text-primary"></i> <?= lang('combo_items') ?>
                    </div>
                    <div class="pv-card-body" style="padding: 0;">
                        <table class="table table-bordered table-striped" style="margin-bottom: 0;">
                            <thead>
                                <tr style="background: #f8fafc; font-size: 11px; text-transform: uppercase; color: #64748b;">
                                    <th><?= lang('product_name') ?></th>
                                    <th style="text-align: center;"><?= lang('quantity') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($combo_items as $combo_item) { ?>
                                    <tr>
                                        <td style="font-weight: 600;"><?= $combo_item->name . ' (' . $combo_item->code . ')'; ?></td>
                                        <td style="text-align: center; font-weight: 700;"><?= $this->sma->formatQuantity($combo_item->qty); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>

                <!-- Custom Fields -->
                <?php if ($product->cf1 || $product->cf2 || $product->cf3 || $product->cf4 || $product->cf5 || $product->cf6) { ?>
                <div class="pv-card">
                    <div class="pv-card-header">
                        <i class="fa fa-list text-primary"></i> <?= lang('custom_fields'); ?>
                    </div>
                    <div class="pv-card-body" style="padding: 0;">
                        <table class="pv-specs-table">
                            <tbody>
                                <?php if ($product->cf1) { echo '<tr><td>' . lang('pcf1') . '</td><td>' . $product->cf1 . '</td></tr>'; } ?>
                                <?php if ($product->cf2) { echo '<tr><td>' . lang('pcf2') . '</td><td>' . $product->cf2 . '</td></tr>'; } ?>
                                <?php if ($product->cf3) { echo '<tr><td>' . lang('pcf3') . '</td><td>' . $product->cf3 . '</td></tr>'; } ?>
                                <?php if ($product->cf4) { echo '<tr><td>' . lang('pcf4') . '</td><td>' . $product->cf4 . '</td></tr>'; } ?>
                                <?php if ($product->cf5) { echo '<tr><td>' . lang('pcf5') . '</td><td>' . $product->cf5 . '</td></tr>'; } ?>
                                <?php if ($product->cf6) { echo '<tr><td>' . lang('pcf6') . '</td><td>' . $product->cf6 . '</td></tr>'; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Product Notes & Descriptions -->
        <?php if ($product->details || $product->product_details) { ?>
        <div class="row" style="margin-top: 10px;">
            <?php if ($product->details) { ?>
            <div class="<?= $product->product_details ? 'col-sm-6' : 'col-sm-12' ?>">
                <div class="pv-card">
                    <div class="pv-card-header" style="background: #f0fdf4; border-color: #bbf7d0; color: #166534;">
                        <i class="fa fa-file-text-o"></i> <?= lang('product_details_for_invoice'); ?>
                    </div>
                    <div class="pv-card-body" style="color: #334155; line-height: 1.6;">
                        <?= $product->details; ?>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if ($product->product_details) { ?>
            <div class="<?= $product->details ? 'col-sm-6' : 'col-sm-12' ?>">
                <div class="pv-card">
                    <div class="pv-card-header" style="background: #eff6ff; border-color: #bfdbfe; color: #1e40af;">
                        <i class="fa fa-align-left"></i> <?= lang('product_details'); ?>
                    </div>
                    <div class="pv-card-body" style="color: #334155; line-height: 1.6;">
                        <?= $product->product_details; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>

        <!-- Bottom Action Bar -->
        <?php if (!$Supplier || !$Customer) { ?>
        <div class="pv-actions-bar">
            <div style="font-weight: 600; color: #64748b; font-size: 13px;">
                <i class="fa fa-cogs"></i> Acciones del Producto
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="<?= admin_url('products/print_barcodes/' . $product->id) ?>" class="btn-pv-action btn-pv-default">
                    <i class="fa fa-print"></i> <?= lang('print_barcode_label') ?>
                </a>
                <a href="<?= admin_url('products/pdf/' . $product->id) ?>" class="btn-pv-action btn-pv-default">
                    <i class="fa fa-download"></i> <?= lang('pdf') ?>
                </a>
                <?php if ($Owner || $Admin || $GP['products-edit']) { ?>
                    <a href="<?= admin_url('products/edit/' . $product->id) ?>" class="btn-pv-action btn-pv-warning">
                        <i class="fa fa-edit"></i> <?= lang('edit') ?>
                    </a>
                <?php } ?>
                <?php if ($Owner || $Admin || $GP['products-delete']) { ?>
                    <a href="#" class="btn-pv-action btn-pv-danger bpo" title="<b><?= lang('delete_product') ?></b>"
                        data-content="<div style='width:150px;'><p><?= lang('r_u_sure') ?></p><a class='btn btn-danger' href='<?= admin_url('products/delete/' . $product->id) ?>'><?= lang('i_m_sure') ?></a> <button class='btn bpo-close'><?= lang('no') ?></button></div>"
                        data-html="true" data-placement="top">
                        <i class="fa fa-trash-o"></i> <?= lang('delete') ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

<?php if ($Owner || $Admin) { ?>
    </div>
<div id="chart" class="tab-pane fade">
        <script src="<?= $assets; ?>js/hc/highcharts.js"></script>
        <script type="text/javascript">
            $(function () {
                Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                        stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
                    };
                });
                <?php if ($sold) {
                                                ?>
                var sold_chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'soldchart',
                        type: 'line',
                        width: <?= $purchased ? "($('#details').width()-160)/2" : "$('#details').width()-100"; ?>
                    },
                    credits: {enabled: false},
                    title: {text: ''},
                    xAxis: {
                        categories: [<?php
                    foreach ($sold as $r) {
                        $month = explode('-', $r->month);
                        echo "'" . lang('cal_' . strtolower($month[1])) . ' ' . $month[0] . "', ";
                    } ?>]
                    },
                    yAxis: {min: 0, title: ""},
                    legend: {enabled: false},
                    tooltip: {
                        shared: true,
                        followPointer: true,
                        formatter: function () {
                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;min-width:150px;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
                            $.each(this.points, function () {
                                if (this.series.name == '<?= lang('amount'); ?>') {
                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                    currencyFormat(this.y) + '</b></td></tr>';
                                } else {
                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                    formatQuantity(this.y) + '</b></td></tr>';
                                }
                            });
                            s += '</table></div>';
                            return s;
                        },
                        useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                        style: {fontSize: '14px', padding: '0', color: '#000000'}
                    },
                    series: [{
                        type: 'spline',
                        name: '<?= lang('sold'); ?>',
                        data: [<?php
                        foreach ($sold as $r) {
                            $month = explode('-', $r->month);
                            echo "['" . lang('cal_' . strtolower($month[1])) . ' ' . $month[0] . "', " . $r->sold . '],';
                            // echo "['".lang('cal_'.strtolower($r->month))."', ".$r->sold."],";
                        } ?>]
                    }, {
                        type: 'spline',
                        name: '<?= lang('amount'); ?>',
                        data: [<?php
                        foreach ($sold as $r) {
                            $month = explode('-', $r->month);
                            echo "['" . lang('cal_' . strtolower($month[1])) . ' ' . $month[0] . "', " . $r->amount . '],';
                            // echo "['".lang('cal_'.strtolower($r->month))."', ".$r->amount."],";
                        } ?>]
                    }]
                });
                $(window).resize(function () {
                    sold_chart.setSize($('#soldchart').width(), 450);
                });
                <?php
                                            }
                                            if ($purchased) {
                                                ?>
                var purchased_chart = new Highcharts.Chart({
                    chart: {renderTo: 'purchasedchart', type: 'line', width: ($('#details').width() - 160) / 2},
                    credits: {enabled: false},
                    title: {text: ''},
                    xAxis: {
                        categories: [<?php
        foreach ($purchased as $r) {
            $month = explode('-', $r->month);
            echo "'" . lang('cal_' . strtolower($month[1])) . ' ' . $month[0] . "', ";
        } ?>]
                    },
                    yAxis: {min: 0, title: ""},
                    legend: {enabled: false},
                    tooltip: {
                        shared: true,
                        followPointer: true,
                        formatter: function () {
                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;min-width:150px;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
                            $.each(this.points, function () {
                                if (this.series.name == '<?= lang('amount'); ?>') {
                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                    currencyFormat(this.y) + '</b></td></tr>';
                                } else {
                                    s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                    formatQuantity(this.y) + '</b></td></tr>';
                                }
                            });
                            s += '</table></div>';
                            return s;
                        },
                        useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                        style: {fontSize: '14px', padding: '0', color: '#000000'}
                    },
                    series: [{
                        type: 'spline',
                        name: '<?= lang('purchased'); ?>',
                        data: [<?php
            foreach ($purchased as $r) {
                $month = explode('-', $r->month);
                echo "['" . lang('cal_' . strtolower($month[1])) . ' ' . $month[0] . "', " . $r->purchased . '],';
                // echo "['".lang('cal_'.strtolower($r->month))."', ".$r->purchased."],";
            } ?>]
                    }, {
                        type: 'spline',
                        name: '<?= lang('amount'); ?>',
                        data: [<?php
            foreach ($purchased as $r) {
                $month = explode('-', $r->month);
                echo "['" . lang('cal_' . strtolower($month[1])) . ' ' . $month[0] . "', " . $r->amount . '],';
                // echo "['".lang('cal_'.strtolower($r->month))."', ".$r->amount."],";
            } ?>]
                    }]
                });
                $(window).resize(function () {
                    purchased_chart.setSize($('#purchasedchart').width(), 450);
                });
                <?php
                                            } ?>

            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o nb"></i><?= lang('chart'); ?></h2>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-sm-<?= $purchased ? '6' : '12'; ?>">
                                <div class="box" style="border-top: 1px solid #dbdee0;">
                                    <div class="box-header">
                                        <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i><?= lang('sold'); ?>
                                        </h2>
                                    </div>
                                    <div class="box-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="soldchart" style="width:100%; height:450px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($purchased) {
                                                ?>
                                <div class="col-sm-6">
                                    <div class="box" style="border-top: 1px solid #dbdee0;">
                                        <div class="box-header">
                                            <h2 class="blue"><i
                                                    class="fa-fw fa fa-bar-chart-o"></i><?= lang('purchased'); ?></h2>
                                        </div>
                                        <div class="box-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="purchasedchart" style="width:100%; height:450px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sales" class="tab-pane fade">
        <?php $warehouse_id = null; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                oTable = $('#SlRData').dataTable({
                    "aaSorting": [[0, "desc"]],
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
                    "iDisplayLength": <?= $Settings->rows_per_page ?>,
                    'bProcessing': true, 'bServerSide': true,
                    'sAjaxSource': '<?= admin_url('reports/getSalesReport/?v=1&product=' . $product->id) ?>',
                    'fnServerData': function (sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "<?= $this->security->get_csrf_token_name() ?>",
                            "value": "<?= $this->security->get_csrf_hash() ?>"
                        });
                        $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
                    },
                    'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                        nRow.id = aData[9];
                        nRow.className = (aData[5] > 0) ? "invoice_link2" : "invoice_link2 warning";
                        return nRow;
                    },
                    "aoColumns": [{"mRender": fld}, null, null, null, {
                        "bSearchable": false,
                        "mRender": pqFormat
                    }, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": row_status}],
                    "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        var gtotal = 0, paid = 0, balance = 0;
                        for (var i = 0; i < aaData.length; i++) {
                            gtotal += parseFloat(aaData[aiDisplay[i]][5]);
                            paid += parseFloat(aaData[aiDisplay[i]][6]);
                            balance += parseFloat(aaData[aiDisplay[i]][7]);
                        }
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[5].innerHTML = currencyFormat(parseFloat(gtotal));
                        nCells[6].innerHTML = currencyFormat(parseFloat(paid));
                        nCells[7].innerHTML = currencyFormat(parseFloat(balance));
                    }
                }).fnSetFilteringDelay().dtFilter([
                    {column_number: 0, filter_default_label: "[<?=lang('date'); ?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                    {column_number: 1, filter_default_label: "[<?=lang('reference_no'); ?>]", filter_type: "text", data: []},
                    {column_number: 2, filter_default_label: "[<?=lang('biller'); ?>]", filter_type: "text", data: []},
                    {column_number: 3, filter_default_label: "[<?=lang('customer'); ?>]", filter_type: "text", data: []},
                    {column_number: 8, filter_default_label: "[<?=lang('payment_status'); ?>]", filter_type: "text", data: []},
                ], "footer");
            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-heart nb"></i><?= $product->name . ' ' . lang('sales'); ?></h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a href="#" id="xls" class="tip" title="<?= lang('download_xls') ?>">
                                <i class="icon fa fa-file-excel-o"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="image" class="tip image" title="<?= lang('save_image') ?>">
                                <i class="icon fa fa-file-picture-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('list_results'); ?></p>

                        <div class="table-responsive">
                            <table id="SlRData" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th><?= lang('date'); ?></th>
                                    <th><?= lang('reference_no'); ?></th>
                                    <th><?= lang('biller'); ?></th>
                                    <th><?= lang('customer'); ?></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('paid'); ?></th>
                                    <th><?= lang('balance'); ?></th>
                                    <th><?= lang('payment_status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="9"
                                        class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                                </tbody>
                                <tfoot class="dtFilter">
                                <tr class="active">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('paid'); ?></th>
                                    <th><?= lang('balance'); ?></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="quotes" class="tab-pane fade">
        <script type="text/javascript">
            $(document).ready(function () {
                oTable = $('#QuRData').dataTable({
                    "aaSorting": [[0, "desc"]],
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
                    "iDisplayLength": <?= $Settings->rows_per_page ?>,
                    'bProcessing': true, 'bServerSide': true,
                    'sAjaxSource': '<?= admin_url('reports/getQuotesReport/?v=1&product=' . $product->id) ?>',
                    'fnServerData': function (sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "<?= $this->security->get_csrf_token_name() ?>",
                            "value": "<?= $this->security->get_csrf_hash() ?>"
                        });
                        $.ajax({ 'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback });
                    },
                    'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                        var oSettings = oTable.fnSettings();
                        nRow.id = aData[7];
                        nRow.className = "quote_link2";
                        return nRow;
                    },
                    "aoColumns": [{"mRender": fld}, null, null, null, {
                        "bSearchable": false,
                        "mRender": pqFormat
                    }, {"mRender": currencyFormat}, {"mRender": row_status}],
                }).fnSetFilteringDelay().dtFilter([
                    {column_number: 0, filter_default_label: "[<?=lang('date'); ?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                    {column_number: 1, filter_default_label: "[<?=lang('reference_no'); ?>]", filter_type: "text", data: []},
                    {column_number: 2, filter_default_label: "[<?=lang('biller'); ?>]", filter_type: "text", data: []},
                    {column_number: 3, filter_default_label: "[<?=lang('customer'); ?>]", filter_type: "text", data: []},
                    {column_number: 5, filter_default_label: "[<?=lang('grand_total'); ?>]", filter_type: "text", data: []},
                    {column_number: 6, filter_default_label: "[<?=lang('status'); ?>]", filter_type: "text", data: []},
                ], "footer");
            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-heart-o nb"></i><?= $product->name . ' ' . lang('quotes'); ?>
                </h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a href="#" id="pdf1" class="tip" title="<?= lang('download_pdf') ?>">
                                <i class="icon fa fa-file-pdf-o"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="xls1" class="tip" title="<?= lang('download_xls') ?>">
                                <i class="icon fa fa-file-excel-o"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="image1" class="tip image" title="<?= lang('save_image') ?>">
                                <i class="icon fa fa-file-picture-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('list_results'); ?></p>

                        <div class="table-responsive">
                            <table id="QuRData" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th><?= lang('date'); ?></th>
                                    <th><?= lang('reference_no'); ?></th>
                                    <th><?= lang('biller'); ?></th>
                                    <th><?= lang('customer'); ?></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="7"
                                        class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                                </tbody>
                                <tfoot class="dtFilter">
                                <tr class="active">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="purchases" class="tab-pane fade">
        <script type="text/javascript">
            $(document).ready(function () {
                oTable = $('#PoRData').dataTable({
                    "aaSorting": [[0, "desc"]],
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
                    "iDisplayLength": <?= $Settings->rows_per_page ?>,
                    'bProcessing': true, 'bServerSide': true,
                    'sAjaxSource': '<?= admin_url('reports/getPurchasesReport/?v=1&product=' . $product->id) ?>',
                    'fnServerData': function (sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "<?= $this->security->get_csrf_token_name() ?>",
                            "value": "<?= $this->security->get_csrf_hash() ?>"
                        });
                        $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
                    },
                    'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                        nRow.id = aData[9];
                        nRow.className = (aData[5] > 0) ? "purchase_link2" : "purchase_link2 warning";
                        return nRow;
                    },
                    "aoColumns": [{"mRender": fld}, null, null, null, {
                        "bSearchable": false,
                        "mRender": pqFormat
                    }, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": row_status}],
                    "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        var gtotal = 0, paid = 0, balance = 0;
                        for (var i = 0; i < aaData.length; i++) {
                            gtotal += parseFloat(aaData[aiDisplay[i]][5]);
                            paid += parseFloat(aaData[aiDisplay[i]][6]);
                            balance += parseFloat(aaData[aiDisplay[i]][7]);
                        }
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[5].innerHTML = currencyFormat(parseFloat(gtotal));
                        nCells[6].innerHTML = currencyFormat(parseFloat(paid));
                        nCells[7].innerHTML = currencyFormat(parseFloat(balance));
                    }
                }).fnSetFilteringDelay().dtFilter([
                    {column_number: 0, filter_default_label: "[<?=lang('date'); ?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                    {column_number: 1, filter_default_label: "[<?=lang('reference_no'); ?>]", filter_type: "text", data: []},
                    {column_number: 2, filter_default_label: "[<?=lang('warehouse'); ?>]", filter_type: "text", data: []},
                    {column_number: 3, filter_default_label: "[<?=lang('supplier'); ?>]", filter_type: "text", data: []},
                    {column_number: 8, filter_default_label: "[<?=lang('status'); ?>]", filter_type: "text", data: []},
                ], "footer");
            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-star nb"></i><?= $product->name . ' ' . lang('purchases'); ?>
                </h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a href="#" id="pdf2" class="tip" title="<?= lang('download_pdf') ?>">
                                <i class="icon fa fa-file-pdf-o"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="xls2" class="tip" title="<?= lang('download_xls') ?>">
                                <i class="icon fa fa-file-excel-o"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" id="image2" class="tip image" title="<?= lang('save_image') ?>">
                                <i class="icon fa fa-file-picture-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('list_results'); ?></p>

                        <div class="table-responsive">
                            <table id="PoRData" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th><?= lang('date'); ?></th>
                                    <th><?= lang('reference_no'); ?></th>
                                    <th><?= lang('warehouse'); ?></th>
                                    <th><?= lang('supplier'); ?></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('paid'); ?></th>
                                    <th><?= lang('balance'); ?></th>
                                    <th><?= lang('status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="9"
                                        class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                                </tbody>
                                <tfoot class="dtFilter">
                                <tr class="active">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('paid'); ?></th>
                                    <th><?= lang('balance'); ?></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="transfers" class="tab-pane fade">
        <script type="text/javascript">
            $(document).ready(function () {
                oTable = $('#TrRData').dataTable({
                    "aaSorting": [[0, "desc"]],
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
                    "iDisplayLength": <?= $Settings->rows_per_page ?>,
                    'bProcessing': true, 'bServerSide': true,
                    'sAjaxSource': '<?= admin_url('reports/getTransfersReport/?v=1&product=' . $product->id) ?>',
                    'fnServerData': function (sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "<?= $this->security->get_csrf_token_name() ?>",
                            "value": "<?= $this->security->get_csrf_hash() ?>"
                        });
                        $.ajax({ 'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback });
                    },
                    'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                        var oSettings = oTable.fnSettings();
                        nRow.id = aData[7];
                        nRow.className = "transfer_link2";
                        return nRow;
                    },
                    "fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
                        var gtotal = 0;
                        for (var i = 0; i < aaData.length; i++) {
                            gtotal += parseFloat(aaData[aiDisplay[i]][5]);;
                        }
                        var nCells = nRow.getElementsByTagName('th');
                        nCells[5].innerHTML = currencyFormat(formatMoney(gtotal));
                    },
                    "aoColumns": [{"mRender": fld}, null, {
                        "bSearchable": false,
                        "mRender": pqFormat
                    }, null, null, {"mRender": currencyFormat}, {"mRender": row_status}],
                }).fnSetFilteringDelay().dtFilter([
                    {column_number: 0, filter_default_label: "[<?=lang('date'); ?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                    {column_number: 1, filter_default_label: "[<?=lang('reference_no'); ?>]", filter_type: "text", data: []},
                    {
                        column_number: 3,
                        filter_default_label: "[<?=lang('warehouse') . ' (' . lang('from') . ')'; ?>]",
                        filter_type: "text", data: []
                    },
                    {
                        column_number: 4,
                        filter_default_label: "[<?=lang('warehouse') . ' (' . lang('to') . ')'; ?>]",
                        filter_type: "text", data: []
                    },
                    {column_number: 5, filter_default_label: "[<?=lang('grand_total'); ?>]", filter_type: "text", data: []},
                    {column_number: 6, filter_default_label: "[<?=lang('status'); ?>]", filter_type: "text", data: []},
                ], "footer");
            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-star-o nb"></i><?= $product->name . ' ' . lang('transfers'); ?>
                </h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown"><a href="#" id="pdf3" class="tip" title="<?= lang('download_pdf') ?>"><i
                                    class="icon fa fa-file-pdf-o"></i></a></li>
                        <li class="dropdown"><a href="#" id="xls3" class="tip" title="<?= lang('download_xls') ?>"><i
                                    class="icon fa fa-file-excel-o"></i></a></li>
                        <li class="dropdown"><a href="#" id="image3" class="tip image"
                                                title="<?= lang('save_image') ?>"><i
                                    class="icon fa fa-file-picture-o"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?php echo lang('list_results'); ?></p>

                        <div class="table-responsive">
                            <table id="TrRData" class="table table-bordered table-hover table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th><?= lang('date'); ?></th>
                                    <th><?= lang('reference_no'); ?></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th><?= lang('warehouse') . ' (' . lang('from') . ')'; ?></th>
                                    <th><?= lang('warehouse') . ' (' . lang('to') . ')'; ?></th>
                                    <th><?= lang('grand_total'); ?></th>
                                    <th><?= lang('status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="7"
                                        class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                                </tbody>
                                <tfoot class="dtFilter">
                                <tr class="active">
                                    <th></th>
                                    <th></th>
                                    <th><?= lang('product_qty'); ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="damages" class="tab-pane fade">
        <script>
            $(document).ready(function () {
                oTable = $('#dmpData').dataTable({
                    "aaSorting": [[0, "desc"]],
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "<?= lang('all') ?>"]],
                    "iDisplayLength": <?= $Settings->rows_per_page ?>,
                    'bProcessing': true, 'bServerSide': true,
                    'sAjaxSource': '<?= admin_url('reports/getAdjustmentReport/?v=1&product=' . $product->id); ?>',
                    'fnServerData': function (sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "<?= $this->security->get_csrf_token_name() ?>",
                            "value": "<?= $this->security->get_csrf_hash() ?>"
                        });
                        $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
                    },
                    "aoColumns": [{"mRender": fld}, null, null, null, {"mRender": decode_html}, {"bSortable": false, "mRender": pqFormat}],
                    'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                        nRow.id = aData[6];
                        nRow.className = "adjustment_link2";
                        return nRow;
                    },
                }).fnSetFilteringDelay().dtFilter([
                    {column_number: 0, filter_default_label: "[<?=lang('date'); ?> (yyyy-mm-dd)]", filter_type: "text", data: []},
                    {column_number: 1, filter_default_label: "[<?=lang('reference_no'); ?>]", filter_type: "text", data: []},
                    {column_number: 2, filter_default_label: "[<?=lang('warehouse'); ?>]", filter_type: "text", data: []},
                    {column_number: 3, filter_default_label: "[<?=lang('created_by'); ?>]", filter_type: "text", data: []},
                    {column_number: 4, filter_default_label: "[<?=lang(' note'); ?>]", filter_type: "text", data: []},
                ], "footer");
            });
        </script>
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-filter"></i><?= lang('adjustments_report'); ?><?php
                    if ($this->input->post('start_date')) {
                        echo 'From ' . $this->input->post('start_date') . ' to ' . $this->input->post('end_date');
                    } ?>
                </h2>
                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a href="#" class="toggle_up tip" title="<?= lang('hide_form') ?>">
                                <i class="icon fa fa-toggle-up"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="toggle_down tip" title="<?= lang('show_form') ?>">
                                <i class="icon fa fa-toggle-down"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext"><?= lang('list_results'); ?></p>

                        <div class="table-responsive">
                            <table id="dmpData" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th class="col-xs-2"><?= lang('date'); ?></th>
                                    <th class="col-xs-2"><?= lang('reference_no'); ?></th>
                                    <th class="col-xs-2"><?= lang('warehouse'); ?></th>
                                    <th class="col-xs-1"><?= lang('created_by'); ?></th>
                                    <th><?= lang('note'); ?></th>
                                    <th class="col-xs-2"><?= lang('products'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="8" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>
                                </tr>
                                </tbody>
                                <tfoot class="dtFilter">
                                <tr class="active">
                                    <th></th><th></th><th></th><th></th><th></th>
                                    <th><?= lang('products'); ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <script type="text/javascript" src="<?= $assets ?>js/html2canvas.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#pdf').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getSalesReport/pdf/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#xls').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getSalesReport/0/xls/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#pdf1').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getQuotesReport/pdf/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#xls1').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getQuotesReport/0/xls/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#pdf2').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getPurchasesReport/pdf/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#xls2').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getPurchasesReport/0/xls/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#pdf3').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getTransfersReport/pdf/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#xls3').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getTransfersReport/0/xls/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#pdf4').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('products/getadjustments/pdf/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#xls4').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('products/getadjustments/0/xls/?v=1&product=' . $product->id)?>";
                return false;
            });
            $('#pdf5').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getAdjustmentReport/pdf/?v=1' . $v)?>";
                return false;
            });
            $('#xls5').click(function (event) {
                event.preventDefault();
                window.location.href = "<?=admin_url('reports/getAdjustmentReport/0/xls/?v=1' . $v)?>";
                return false;
            });
            $('.image').click(function (event) {
                var box = $(this).closest('.box');
                event.preventDefault();
                html2canvas(box, {
                    onrendered: function (canvas) {
                        openImg(canvas.toDataURL());
                    }
                });
                return false;
            });
        });
    </script>
<?php
                                        } ?>
