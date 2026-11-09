<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="page-contents">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

<?php
$in_stock = ($product->type != 'standard' || (!empty($warehouse) && $warehouse->quantity > 0) || $Settings->overselling);
$is_promo = ($product->promotion && $product->promo_price > 0);
$regular_price = (isset($product->special_price) && !empty($product->special_price)) ? $product->special_price : $product->price;
$current_price = $is_promo ? $product->promo_price : $regular_price;
$discount_pct = 0;
if ($is_promo && $regular_price > 0 && $regular_price > $product->promo_price) {
    $discount_pct = round((($regular_price - $product->promo_price) / $regular_price) * 100);
}
$clean_phone = preg_replace('/[^0-9]/', '', $shop_settings->phone ?? '');
$wa_url = 'https://api.whatsapp.com/send?phone=' . $clean_phone . '&text=' . urlencode('Hola, me interesa comprar el producto: ' . $product->name . ' (Código: ' . $product->code . ') - ' . site_url('product/' . $product->slug));
?>

<!-- ================= MODERN PDP BREADCRUMB ================= -->
<ol class="breadcrumb pdp-breadcrumb">
    <li><a href="<?= site_url(); ?>"><i class="fa fa-home"></i> <?= lang('home'); ?></a></li>
    <li><a href="<?= shop_url('products'); ?>"><?= lang('products'); ?></a></li>
    <?php if ($category) { ?>
        <li><a href="<?= site_url('category/' . $category->slug); ?>"><?= htmlspecialchars($category->name); ?></a></li>
    <?php } ?>
    <li class="active"><?= htmlspecialchars($product->name); ?></li>
</ol>

<!-- ================= MAIN PRODUCT CARD SHOWCASE ================= -->
<div class="pdp-card">
    <div class="row">
        <!-- Columna Izquierda: Galería Multimedia -->
        <div class="col-md-6 col-sm-12">
            <div class="photo-slider pdp-gallery-wrap">
                <div class="carousel slide article-slide" id="photo-carousel">
                    <div class="carousel-inner cont-slider">
                        <div class="item active">
                            <a href="#" data-toggle="modal" data-target="#lightbox">
                                <img src="<?= base_url('assets/uploads/' . $product->image); ?>" alt="<?= htmlspecialchars($product->name); ?>" class="img-responsive pdp-main-img"/>
                            </a>
                        </div>
                        <?php
                        if (!empty($images)) {
                            foreach ($images as $ph) {
                                echo '<div class="item"><a href="#" data-toggle="modal" data-target="#lightbox"><img class="img-responsive pdp-main-img" src="' . base_url('assets/uploads/' . $ph->photo) . '" alt="' . htmlspecialchars($ph->photo) . '" /></a></div>';
                            }
                        }
                        ?>
                    </div>

                    <?php if (!empty($images)) { ?>
                    <ol class="carousel-indicators">
                        <li class="active" data-slide-to="0" data-target="#photo-carousel">
                            <img class="img-thumbnail" alt="" src="<?= base_url('assets/uploads/thumbs/' . $product->image); ?>">
                        </li>
                        <?php
                        $r = 1;
                        foreach ($images as $ph) {
                            echo '<li class="" data-slide-to="' . $r . '" data-target="#photo-carousel"><img class="img-thumbnail" alt="" src="' . base_url('assets/uploads/thumbs/' . $ph->photo) . '"></li>';
                            $r++;
                        }
                        ?>
                    </ol>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Modern Buy Box -->
        <div class="col-md-6 col-sm-12">
            <div class="pdp-buybox">
                <!-- Meta tags top -->
                <div class="pdp-meta-top">
                    <?php if ($category) { ?>
                        <a href="<?= site_url('category/' . $category->slug); ?>" class="pdp-badge-cat">
                            <i class="fa fa-folder-open-o"></i> <?= htmlspecialchars($category->name); ?>
                        </a>
                    <?php } ?>
                    <?php if ($brand) { ?>
                        <a href="<?= site_url('brand/' . $brand->slug); ?>" class="pdp-badge-brand">
                            <i class="fa fa-tag"></i> <?= htmlspecialchars($brand->name); ?>
                        </a>
                    <?php } ?>
                    <span class="pdp-badge-sku">
                        <i class="fa fa-barcode"></i> Ref: <?= htmlspecialchars($product->code); ?>
                    </span>
                </div>

                <!-- Título del producto -->
                <h1 class="pdp-title"><?= htmlspecialchars($product->name); ?></h1>

                <?php if (!empty($product->second_name)) { ?>
                    <div class="pdp-subtitle">
                        <?= htmlspecialchars($product->second_name); ?>
                    </div>
                <?php } ?>

                <!-- Caja de Precio -->
                <?php if (!$shop_settings->hide_price) { ?>
                <div class="pdp-price-box">
                    <span class="pdp-current-price">
                        <?= $this->sma->convertMoney($current_price); ?>
                    </span>
                    <?php if ($is_promo) { ?>
                        <span class="pdp-old-price">
                            <?= $this->sma->convertMoney($regular_price); ?>
                        </span>
                        <?php if ($discount_pct > 0) { ?>
                            <span class="pdp-discount-pill">
                                -<?= $discount_pct; ?>% OFF
                            </span>
                        <?php } ?>
                    <?php } ?>
                </div>
                <?php } ?>

                <!-- Estado del Stock -->
                <div>
                    <?php if ($in_stock) { ?>
                        <span class="pdp-stock-status in-stock">
                            <i class="fa fa-check-circle"></i> En Stock &bull; Envío y retiro inmediato
                        </span>
                    <?php } else { ?>
                        <span class="pdp-stock-status out-of-stock">
                            <i class="fa fa-times-circle"></i> Agotado actualmente
                        </span>
                    <?php } ?>
                </div>

                <!-- Formulario de Compra -->
                <?php if (!$shop_settings->hide_price) { ?>
                    <?php if ($in_stock) { ?>
                        <?= form_open('cart/add/' . $product->id, 'class="validate" style="margin-top: 10px;"'); ?>
                        
                        <!-- Variantes si existen -->
                        <?php if ($variants) { ?>
                            <div class="form-group">
                                <label class="pdp-variant-label">Seleccionar Opción / Medida:</label>
                                <?php
                                foreach ($variants as $variant) {
                                    $opts[$variant->id] = $variant->name . ($variant->price > 0 ? ' (+' . $this->sma->convertMoney($variant->price, true, false) . ')' : ($variant->price == 0 ? '' : ' (+' . $this->sma->convertMoney($variant->price, true, false) . ')'));
                                }
                                echo form_dropdown('option', $opts, '', 'class="form-control selectpicker mobile-device" required="required" style="height: 42px; border-radius: 8px;"');
                                ?>
                            </div>
                        <?php } ?>

                        <!-- Control de Cantidad y Botón de Carrito -->
                        <div class="form-group pdp-actions-row">
                            <div class="input-group">
                                <span class="input-group-addon pointer btn-minus"><i class="fa fa-minus"></i></span>
                                <input type="text" name="quantity" class="form-control text-center quantity-input" value="1" required="required">
                                <span class="input-group-addon pointer btn-plus"><i class="fa fa-plus"></i></span>
                            </div>

                            <button type="submit" class="btn btn-pdp-cart">
                                <i class="fa fa-shopping-cart"></i> <?= lang('add_to_cart'); ?>
                            </button>

                            <button type="button" class="btn add-to-wishlist" data-id="<?= $product->id; ?>" title="<?= lang('add_to_wishlist'); ?>">
                                <i class="fa fa-heart-o"></i>
                            </button>
                        </div>
                        <?= form_close(); ?>

                        <!-- Botón Directo WhatsApp -->
                        <?php if (!empty($clean_phone)) { ?>
                            <a href="<?= $wa_url; ?>" target="_blank" class="btn-pdp-wa">
                                <i class="fa fa-whatsapp" style="font-size: 18px;"></i> Comprar o Consultar por WhatsApp
                            </a>
                        <?php } ?>

                    <?php } else { ?>
                        <div class="alert alert-warning" style="border-radius: 10px; margin-top: 10px;">
                            <i class="fa fa-exclamation-triangle"></i> <?= lang('item_out_of_stock'); ?>
                        </div>
                    <?php } ?>
                <?php } ?>

                <!-- Franja de Confianza en el Buy Box -->
                <div class="pdp-features-strip">
                    <div class="pdp-feature-item">
                        <i class="fa fa-shield"></i>
                        <span>Embalaje protegido</span>
                    </div>
                    <div class="pdp-feature-item">
                        <i class="fa fa-truck"></i>
                        <span>Envíos asegurados</span>
                    </div>
                    <div class="pdp-feature-item">
                        <i class="fa fa-credit-card"></i>
                        <span>Pagos verificados</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ================= TABS DE INFORMACIÓN DEL PRODUCTO ================= -->
<div class="pdp-tabs-wrap" style="margin-bottom: 40px;">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#tab-desc" aria-controls="tab-desc" role="tab" data-toggle="tab">
                <i class="fa fa-file-text-o"></i> <?= lang('product_details'); ?>
            </a>
        </li>
        <li role="presentation">
            <a href="#tab-specs" aria-controls="tab-specs" role="tab" data-toggle="tab">
                <i class="fa fa-list"></i> Ficha Técnica
            </a>
        </li>
        <li role="presentation">
            <a href="#tab-shipping" aria-controls="tab-shipping" role="tab" data-toggle="tab">
                <i class="fa fa-truck"></i> Envío y Garantía
            </a>
        </li>
    </ul>

    <div class="tab-content" style="margin-top: 16px;">
        <!-- Tab 1: Descripción -->
        <div role="tabpanel" class="tab-pane active" id="tab-desc">
            <div class="pdp-tab-card">
                <?php if (!empty($product->product_details) || !empty($product->details)) { ?>
                    <?= $product->product_details ?: $product->details; ?>
                <?php } else { ?>
                    <p class="text-muted">Este producto no cuenta con descripción adicional por el momento.</p>
                <?php } ?>
            </div>
        </div>

        <!-- Tab 2: Ficha Técnica -->
        <div role="tabpanel" class="tab-pane" id="tab-specs">
            <div class="pdp-tab-card" style="padding: 0; overflow: hidden;">
                <table class="table table-striped table-bordered dfTable table-right-left" style="margin: 0; border: none;">
                    <tbody>
                        <tr>
                            <td width="35%"><?= lang('name'); ?></td>
                            <td><?= htmlspecialchars($product->name); ?></td>
                        </tr>
                        <tr>
                            <td><?= lang('code'); ?></td>
                            <td><?= htmlspecialchars($product->code); ?></td>
                        </tr>
                        <?php if ($brand) { ?>
                        <tr>
                            <td><?= lang('brand'); ?></td>
                            <td><?= htmlspecialchars($brand->name); ?></td>
                        </tr>
                        <?php } ?>
                        <?php if ($category) { ?>
                        <tr>
                            <td><?= lang('category'); ?></td>
                            <td><?= htmlspecialchars($category->name); ?></td>
                        </tr>
                        <?php } ?>
                        <?php if ($unit) { ?>
                        <tr>
                            <td><?= lang('unit'); ?></td>
                            <td><?= htmlspecialchars($unit->name . ' (' . $unit->code . ')'); ?></td>
                        </tr>
                        <?php } ?>
                        <?php if ($product->cf1 || $product->cf2 || $product->cf3 || $product->cf4 || $product->cf5 || $product->cf6) {
                            for ($cfi = 1; $cfi <= 6; $cfi++) {
                                $cfKey = 'cf' . $cfi;
                                if (!empty($product->$cfKey)) {
                                    echo '<tr><td>' . lang('pcf' . $cfi) . '</td><td>' . htmlspecialchars($product->$cfKey) . '</td></tr>';
                                }
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tab 3: Envíos y Garantía -->
        <div role="tabpanel" class="tab-pane" id="tab-shipping">
            <div class="pdp-tab-card">
                <h4 class="pdp-policy-heading">Políticas de Embalaje y Despacho</h4>
                <p>En <strong><?= htmlspecialchars($shop_settings->shop_name); ?></strong> cada pieza es tratada con el mayor cuidado. Contamos con protocolos especiales de embalaje con materiales amortiguadores para evitar cualquier tipo de daño o rotura durante el transporte.</p>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-4">
                        <div class="pdp-policy-box">
                            <i class="fa fa-shield text-primary" style="font-size: 28px; margin-bottom: 8px;"></i>
                            <h5 style="font-weight: 700; margin: 0 0 4px 0;">Protección Total</h5>
                            <small class="text-muted">Empaque de alta resistencia</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="pdp-policy-box">
                            <i class="fa fa-clock-o text-primary" style="font-size: 28px; margin-bottom: 8px;"></i>
                            <h5 style="font-weight: 700; margin: 0 0 4px 0;">Despacho Oportuno</h5>
                            <small class="text-muted">Procesamiento inmediato</small>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="pdp-policy-box">
                            <i class="fa fa-whatsapp text-success" style="font-size: 28px; margin-bottom: 8px;"></i>
                            <h5 style="font-weight: 700; margin: 0 0 4px 0;">Seguimiento Directo</h5>
                            <small class="text-muted">Confirmación por WhatsApp</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="featured-products">
    <div class="row">
        <?php
        if (!empty($other_products)) {
            ?>
            <div class="col-xs-12">
                <h3 class="margin-top-no text-size-lg">
                    <?= lang('other_products'); ?>
                </h3>
            </div>
            <div class="row">
            <div class="col-xs-12">
                <?php
                foreach ($other_products as $fp) {
                    ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="product" style="z-index: 1;">
                            <div class="details" style="transition: all 100ms ease-out 0s;">
                                <?php
                                if ($fp->promotion) {
                                    ?>
                                    <span class="badge badge-right theme"><?= lang('promo'); ?></span>
                                    <?php
                                } ?>
                                <img src="<?= base_url('assets/uploads/' . $fp->image); ?>" alt="">
                                <?php if (!$shop_settings->hide_price) {
                                    ?>
                                <div class="image_overlay"></div>
                                <div class="btn add-to-cart" data-id="<?= $fp->id; ?>"><i class="fa fa-shopping-cart"></i> <?= lang('add_to_cart'); ?></div>
                                <?php
                                } ?>
                                <div class="stats-container">
                                    <?php if (!$shop_settings->hide_price) {
                                    ?>
                                    <span class="product_price">
                                        <?php
                                        if ($fp->promotion) {
                                            echo '<del class="text-red">' . $this->sma->convertMoney(isset($fp->special_price) && !empty($fp->special_price) ? $fp->special_price : $fp->price) . '</del><br>';
                                            echo $this->sma->convertMoney($fp->promo_price);
                                        } else {
                                            echo $this->sma->convertMoney(isset($fp->special_price) && !empty($fp->special_price) ? $fp->special_price : $fp->price);
                                        } ?>
                                    </span>
                                    <?php
                                } ?>
                                    <span class="product_name">
                                        <a href="<?= site_url('product/' . $fp->slug); ?>"><?= $fp->name; ?></a>
                                    </span>
                                    <a href="<?= site_url('category/' . $fp->category_slug); ?>" class="link"><?= $fp->category_name; ?></a>
                                    <?php
                                    if ($fp->brand_name) {
                                        ?>
                                        <span class="link">-</span>
                                        <a href="<?= site_url('brand/' . $fp->brand_slug); ?>" class="link"><?= $fp->brand_name; ?></a>
                                        <?php
                                    } ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
    </div>
</div>
</section>

<div id="lightbox" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-middle">
        <div class="modal-content">
            <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>
