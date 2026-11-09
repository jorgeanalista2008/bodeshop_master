<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ================= HERO SLIDER & BANNER ================= -->
<?php if (!empty($slider) && !empty($slider[0]->image)) { ?>
<section class="slider-container ml-hero-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="carousel-hero" class="carousel slide ml-hero-carousel" data-ride="carousel" data-interval="5000">
                    <ol class="carousel-indicators">
                        <?php
                        $sr = 0;
                        foreach ($slider as $slide) {
                            if (!empty($slide->image)) {
                                echo '<li data-target="#carousel-hero" data-slide-to="' . $sr . '" class="' . ($sr == 0 ? 'active' : '') . '"></li> ';
                                $sr++;
                            }
                        } ?>
                    </ol>

                    <div class="carousel-inner" role="listbox">
                        <?php
                        $sr = 0;
                        foreach ($slider as $slide) {
                            if (!empty($slide->image)) {
                                echo '<div class="item' . ($sr == 0 ? ' active' : '') . '">';
                                if (!empty($slide->link)) {
                                    echo '<a href="' . $slide->link . '">';
                                }
                                echo '<img src="' . base_url('assets/uploads/' . $slide->image) . '" alt="Cristalería Latinoamericana" class="img-responsive ml-slide-img">';
                                if (!empty($slide->caption)) {
                                    echo '<div class="carousel-caption ml-slide-caption">' . $slide->caption . '</div>';
                                }
                                if (!empty($slide->link)) {
                                    echo '</a>';
                                }
                                echo '</div>';
                                $sr++;
                            }
                        } ?>
                    </div>

                    <a class="left carousel-control ml-carousel-arrow" href="#carousel-hero" role="button" data-slide="prev">
                        <span class="fa fa-angle-left" aria-hidden="true"></span>
                        <span class="sr-only"><?= lang('prev'); ?></span>
                    </a>
                    <a class="right carousel-control ml-carousel-arrow" href="#carousel-hero" role="button" data-slide="next">
                        <span class="fa fa-angle-right" aria-hidden="true"></span>
                        <span class="sr-only"><?= lang('next'); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } else { ?>
<!-- Hero Fallback Banner if no slider configured -->
<section class="ml-hero-banner-wrap">
    <div class="container">
        <div class="ml-hero-custom-banner">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <span class="ml-hero-pill"><i class="fa fa-check-circle"></i> Tienda Oficial & Distribuidor Mayorista</span>
                    <h1 class="ml-hero-title">Todo en Cristales, Perfiles de Aluminio y Herrajes</h1>
                    <p class="ml-hero-subtitle">Materiales de primera calidad para obras, fachadas comerciales, cerramientos y decoración. Ventas al mayor y al detal.</p>
                    <div class="ml-hero-actions">
                        <a href="<?= site_url('shop/products'); ?>" class="btn btn-ml-hero-primary">
                            <i class="fa fa-shopping-bag"></i> Ver Catálogo Completo
                        </a>
                        <a href="https://wa.me/584145681386?text=Hola,%20quisiera%20solicitar%20un%20presupuesto" target="_blank" class="btn btn-ml-hero-outline">
                            <i class="fa fa-whatsapp"></i> Cotizar por WhatsApp
                        </a>
                    </div>
                </div>
                <div class="col-md-4 hidden-sm hidden-xs text-center">
                    <div class="ml-hero-stats-card">
                        <div class="ml-stat-item">
                            <div class="ml-stat-number">+10 Años</div>
                            <div class="ml-stat-label">Liderando en Cristalería</div>
                        </div>
                        <div class="ml-stat-item">
                            <div class="ml-stat-number">100%</div>
                            <div class="ml-stat-label">Envíos Asegurados</div>
                        </div>
                        <div class="ml-stat-item">
                            <div class="ml-stat-number">Directo</div>
                            <div class="ml-stat-label">Precios de Fábrica</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<!-- ================= CATEGORY QUICK DISCOVERY BUBBLES (MERCADO LIBRE STYLE) ================= -->
<section class="ml-categories-section">
    <div class="container">
        <div class="ml-section-header-compact">
            <h3 class="ml-section-title"><i class="fa fa-th-large text-primary"></i> Explora por Categoría</h3>
            <a href="<?= site_url('shop/products'); ?>" class="ml-view-all">Ver todas las categorías <i class="fa fa-angle-right"></i></a>
        </div>

        <div class="ml-category-bubbles-grid">
            <a href="<?= site_url('category/ferreteriaFerre'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-ferreteria">
                    <i class="fa fa-wrench"></i>
                </div>
                <span class="ml-cat-name">Ferretería</span>
                <span class="ml-cat-count">Fijaciones y más</span>
            </a>

            <a href="<?= site_url('category/perfiles-de-aluminio'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-aluminio">
                    <i class="fa fa-cube"></i>
                </div>
                <span class="ml-cat-name">Perfiles Aluminio</span>
                <span class="ml-cat-count">Tubos, rieles, U</span>
            </a>

            <a href="<?= site_url('category/productos-acero-inoxidable'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-acero">
                    <i class="fa fa-shield"></i>
                </div>
                <span class="ml-cat-name">Acero Inoxidable</span>
                <span class="ml-cat-count">Tucanes y clips</span>
            </a>

            <a href="<?= site_url('category/ventanas'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-ventanas">
                    <i class="fa fa-columns"></i>
                </div>
                <span class="ml-cat-name">Ventanas</span>
                <span class="ml-cat-count">Laterales y trancadores</span>
            </a>

            <a href="<?= site_url('category/drywall-y-superboard'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-drywall">
                    <i class="fa fa-home"></i>
                </div>
                <span class="ml-cat-name">Drywall & Techos</span>
                <span class="ml-cat-count">Láminas y perfiles</span>
            </a>

            <a href="<?= site_url('category/luz-led'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-led">
                    <i class="fa fa-lightbulb-o"></i>
                </div>
                <span class="ml-cat-name">Luz LED</span>
                <span class="ml-cat-count">Paneles y lámparas</span>
            </a>

            <a href="<?= site_url('category/vidrio-y-espejos'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-vidrio">
                    <i class="fa fa-diamond"></i>
                </div>
                <span class="ml-cat-name">Vidrios y Espejos</span>
                <span class="ml-cat-count">Cortes a medida</span>
            </a>

            <a href="<?= site_url('category/puertas'); ?>" class="ml-cat-bubble-card">
                <div class="ml-cat-icon-wrap cat-icon-puertas">
                    <i class="fa fa-sign-in"></i>
                </div>
                <span class="ml-cat-name">Puertas</span>
                <span class="ml-cat-count">Variadas & baños</span>
            </a>
        </div>
    </div>
</section>

<!-- ================= VALUE PROPOSITION & TRUST BAR ================= -->
<section class="ml-trust-section">
    <div class="container">
        <div class="ml-trust-card">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="ml-trust-item">
                        <div class="ml-trust-icon-box">
                            <i class="fa fa-shield"></i>
                        </div>
                        <div class="ml-trust-text">
                            <h5 class="ml-trust-title">Embalaje Protegido</h5>
                            <p class="ml-trust-desc">Garantía anti-rotura en cristales</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="ml-trust-item">
                        <div class="ml-trust-icon-box">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="ml-trust-text">
                            <h5 class="ml-trust-title">Envíos a Todo el País</h5>
                            <p class="ml-trust-desc">Despachos rápidos y seguros</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="ml-trust-item">
                        <div class="ml-trust-icon-box">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="ml-trust-text">
                            <h5 class="ml-trust-title">Pagos Flexibles</h5>
                            <p class="ml-trust-desc">Transferencias, Zelle y Pago Móvil</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="ml-trust-item">
                        <div class="ml-trust-icon-box ml-icon-wa">
                            <i class="fa fa-whatsapp"></i>
                        </div>
                        <div class="ml-trust-text">
                            <h5 class="ml-trust-title">Asesoría Inmediata</h5>
                            <p class="ml-trust-desc">Atención técnica en tiempo real</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SECCIÓN 1: PRODUCTOS DESTACADOS / OFERTAS ================= -->
<?php if (!empty($featured_products)) { ?>
<section class="ml-products-section">
    <div class="container">
        <div class="ml-section-header">
            <div>
                <h3 class="ml-section-title">
                    <span class="ml-title-badge"><i class="fa fa-fire text-danger"></i> Tendencias</span>
                    Productos Destacados
                </h3>
                <p class="ml-section-subtitle">Los materiales y productos más buscados por instaladores y profesionales</p>
            </div>
            <a href="<?= site_url('shop/products'); ?>" class="ml-view-all">Ver todo el catálogo <i class="fa fa-angle-right"></i></a>
        </div>

        <div class="row ml-product-grid">
            <?php foreach (array_slice($featured_products, 0, 8) as $fp) { 
                $fp = (object)$fp;
            ?>
                <div class="col-xs-12 col-sm-6 col-md-3 margin-bottom-lg">
                    <div class="ml-card">
                        <?php if ($fp->promotion) { ?>
                            <span class="ml-card-badge-promo"><i class="fa fa-bolt"></i> Oferta</span>
                        <?php } ?>
                        
                        <a href="<?= site_url('product/' . $fp->slug); ?>" class="ml-card-img-wrap">
                            <img src="<?= base_url('assets/uploads/' . (!empty($fp->image) && $fp->image != 'no_image.png' ? $fp->image : 'no_image.png')); ?>" alt="<?= htmlspecialchars($fp->name); ?>" class="ml-card-img">
                        </a>

                        <div class="ml-card-body">
                            <div class="ml-card-meta">
                                <span class="ml-card-cat"><?= $fp->category_name ?? 'Cristalería'; ?></span>
                                <?php if (!empty($fp->brand_name) && $fp->brand_name != 'Generico') { ?>
                                    <span class="ml-card-brand"><?= $fp->brand_name; ?></span>
                                <?php } ?>
                            </div>

                            <h4 class="ml-card-title">
                                <a href="<?= site_url('product/' . $fp->slug); ?>" title="<?= htmlspecialchars($fp->name); ?>">
                                    <?= $fp->name; ?>
                                </a>
                            </h4>

                            <?php if (!$shop_settings->hide_price) { ?>
                                <div class="ml-card-price-row">
                                    <?php if ($fp->promotion && !empty($fp->promo_price)) { 
                                        $orig = isset($fp->special_price) && !empty($fp->special_price) ? $fp->special_price : $fp->price;
                                        $disc = ($orig > 0 && $orig > $fp->promo_price) ? round((($orig - $fp->promo_price) / $orig) * 100) : 0;
                                    ?>
                                        <div class="ml-old-price-wrap">
                                            <del class="ml-card-old-price"><?= $this->sma->convertMoney($orig); ?></del>
                                            <?php if ($disc > 0) { ?><span class="ml-card-disc"><?= $disc; ?>% OFF</span><?php } ?>
                                        </div>
                                        <div class="ml-card-current-price">
                                            <?= $this->sma->convertMoney($fp->promo_price); ?>
                                        </div>
                                    <?php } else { ?>
                                        <div class="ml-card-current-price">
                                            <?= $this->sma->convertMoney(isset($fp->special_price) && !empty($fp->special_price) ? $fp->special_price : $fp->price); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <div class="ml-card-shipping">
                                <i class="fa fa-truck text-success"></i> Envío a todo el país disponible
                            </div>

                            <div class="ml-card-actions">
                                <a href="<?= site_url('product/' . $fp->slug); ?>" class="btn btn-ml-details">
                                    Ver Ficha
                                </a>
                                <?php if (!$shop_settings->hide_price) { ?>
                                    <button class="btn btn-ml-cart add-to-cart" data-id="<?= $fp->id; ?>" title="<?= lang('add_to_cart'); ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<!-- ================= ANUNCIO PROMOCIONAL 1 (BANNER ANCHO MERCADO LIBRE STYLE) ================= -->
<section class="ml-ad-banner-section">
    <div class="container">
        <div class="ml-ad-banner-card ml-ad-aluminio-bg">
            <div class="row ml-align-center">
                <div class="col-md-8 col-sm-8">
                    <span class="ml-ad-tag"><i class="fa fa-star"></i> Fabricación & Distribución</span>
                    <h3 class="ml-ad-title">Perfiles de Aluminio con Acabados de Primera</h3>
                    <p class="ml-ad-desc">Tubos junior, canales en U, esquineros, perfiles para puertas y ventanas. Amplio stock en color negro, blanco y mate.</p>
                    <div class="ml-ad-btns">
                        <a href="<?= site_url('category/perfiles-de-aluminio'); ?>" class="btn btn-ml-ad-primary">
                            Ver Perfiles de Aluminio <i class="fa fa-arrow-right"></i>
                        </a>
                        <a href="https://wa.me/584145681386?text=Hola,%20deseo%20cotizar%20perfiles%20de%20aluminio" target="_blank" class="btn btn-ml-ad-secondary">
                            <i class="fa fa-whatsapp"></i> Asesoría de Medidas
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 hidden-xs text-center">
                    <div class="ml-ad-badge-circle">
                        <span class="ml-badge-circle-num">6m</span>
                        <span class="ml-badge-circle-txt">Barras de 6 Metros</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SECCIÓN 2: PERFILES DE ALUMINIO ================= -->
<?php if (!empty($aluminio_products)) { ?>
<section class="ml-products-section">
    <div class="container">
        <div class="ml-section-header">
            <div>
                <h3 class="ml-section-title">
                    <span class="ml-title-badge" style="background:#e0f2fe; color:#0369a1;"><i class="fa fa-cube"></i> Especialidad</span>
                    Perfiles de Aluminio & Estructuras
                </h3>
                <p class="ml-section-subtitle">Tuberías, marcos, guías y perfiles para vidriería y carpintería metálica</p>
            </div>
            <a href="<?= site_url('category/perfiles-de-aluminio'); ?>" class="ml-view-all">Ver todos los perfiles <i class="fa fa-angle-right"></i></a>
        </div>

        <div class="row ml-product-grid">
            <?php foreach ($aluminio_products as $ap) { ?>
                <div class="col-xs-12 col-sm-6 col-md-3 margin-bottom-lg">
                    <div class="ml-card">
                        <a href="<?= site_url('product/' . $ap->slug); ?>" class="ml-card-img-wrap">
                            <img src="<?= base_url('assets/uploads/' . (!empty($ap->image) && $ap->image != 'no_image.png' ? $ap->image : 'no_image.png')); ?>" alt="<?= htmlspecialchars($ap->name); ?>" class="ml-card-img">
                        </a>

                        <div class="ml-card-body">
                            <div class="ml-card-meta">
                                <span class="ml-card-cat">Perfiles de Aluminio</span>
                                <?php if (!empty($ap->code)) { ?><span class="ml-card-code"><?= $ap->code; ?></span><?php } ?>
                            </div>

                            <h4 class="ml-card-title">
                                <a href="<?= site_url('product/' . $ap->slug); ?>" title="<?= htmlspecialchars($ap->name); ?>">
                                    <?= $ap->name; ?>
                                </a>
                            </h4>

                            <?php if (!$shop_settings->hide_price) { ?>
                                <div class="ml-card-price-row">
                                    <div class="ml-card-current-price">
                                        <?= $this->sma->convertMoney($ap->price); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="ml-card-shipping">
                                <i class="fa fa-check-circle text-primary"></i> Medida estándar 6m de largo
                            </div>

                            <div class="ml-card-actions">
                                <a href="<?= site_url('product/' . $ap->slug); ?>" class="btn btn-ml-details">
                                    Ver Ficha
                                </a>
                                <?php if (!$shop_settings->hide_price) { ?>
                                    <button class="btn btn-ml-cart add-to-cart" data-id="<?= $ap->id; ?>" title="<?= lang('add_to_cart'); ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<!-- ================= ANUNCIOS DOBLES (MERCADO LIBRE STYLE DUAL CARDS) ================= -->
<section class="ml-dual-banners-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 margin-bottom-md">
                <div class="ml-dual-banner ml-banner-acero">
                    <div class="ml-dual-banner-content">
                        <span class="ml-dual-tag">Resistencia & Estilo</span>
                        <h4 class="ml-dual-title">Herrajes en Acero Inoxidable</h4>
                        <p class="ml-dual-desc">Tucanes, clips de sujeción para vidrio y toalleros satinados con la máxima durabilidad ante humedad.</p>
                        <a href="<?= site_url('category/productos-acero-inoxidable'); ?>" class="btn btn-ml-dual-btn">
                            Ver Productos de Acero <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 margin-bottom-md">
                <div class="ml-dual-banner ml-banner-ventanas">
                    <div class="ml-dual-banner-content">
                        <span class="ml-dual-tag">Sistemas de Cierre</span>
                        <h4 class="ml-dual-title">Accesorios para Ventanas</h4>
                        <p class="ml-dual-desc">Trancadores tic-tac, peritas, laterales Ecobel y gomas selladoras para un deslizamiento suave y seguro.</p>
                        <a href="<?= site_url('category/ventanas'); ?>" class="btn btn-ml-dual-btn">
                            Ver Accesorios de Ventanas <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SECCIÓN 3: FERRETERÍA & HERRAMIENTAS ================= -->
<?php if (!empty($ferreteria_products)) { ?>
<section class="ml-products-section">
    <div class="container">
        <div class="ml-section-header">
            <div>
                <h3 class="ml-section-title">
                    <span class="ml-title-badge" style="background:#fef3c7; color:#b45309;"><i class="fa fa-wrench"></i> Herramientas</span>
                    Ferretería, Cintas & Suministros
                </h3>
                <p class="ml-section-subtitle">Insumos para taller, instalación eléctrica y fijación segura</p>
            </div>
            <a href="<?= site_url('category/ferreteriaFerre'); ?>" class="ml-view-all">Ver toda la ferretería <i class="fa fa-angle-right"></i></a>
        </div>

        <div class="row ml-product-grid">
            <?php foreach ($ferreteria_products as $ferp) { ?>
                <div class="col-xs-12 col-sm-6 col-md-3 margin-bottom-lg">
                    <div class="ml-card">
                        <a href="<?= site_url('product/' . $ferp->slug); ?>" class="ml-card-img-wrap">
                            <img src="<?= base_url('assets/uploads/' . (!empty($ferp->image) && $ferp->image != 'no_image.png' ? $ferp->image : 'no_image.png')); ?>" alt="<?= htmlspecialchars($ferp->name); ?>" class="ml-card-img">
                        </a>

                        <div class="ml-card-body">
                            <div class="ml-card-meta">
                                <span class="ml-card-cat">Ferretería</span>
                                <?php if (!empty($ferp->brand_name) && $ferp->brand_name != 'Generico') { ?>
                                    <span class="ml-card-brand"><?= $ferp->brand_name; ?></span>
                                <?php } ?>
                            </div>

                            <h4 class="ml-card-title">
                                <a href="<?= site_url('product/' . $ferp->slug); ?>" title="<?= htmlspecialchars($ferp->name); ?>">
                                    <?= $ferp->name; ?>
                                </a>
                            </h4>

                            <?php if (!$shop_settings->hide_price) { ?>
                                <div class="ml-card-price-row">
                                    <div class="ml-card-current-price">
                                        <?= $this->sma->convertMoney($ferp->price); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="ml-card-shipping">
                                <i class="fa fa-check text-success"></i> Stock disponible para retiro inmediato
                            </div>

                            <div class="ml-card-actions">
                                <a href="<?= site_url('product/' . $ferp->slug); ?>" class="btn btn-ml-details">
                                    Ver Ficha
                                </a>
                                <?php if (!$shop_settings->hide_price) { ?>
                                    <button class="btn btn-ml-cart add-to-cart" data-id="<?= $ferp->id; ?>" title="<?= lang('add_to_cart'); ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<!-- ================= SECCIÓN 4: ACERO INOXIDABLE ================= -->
<?php if (!empty($acero_products)) { ?>
<section class="ml-products-section">
    <div class="container">
        <div class="ml-section-header">
            <div>
                <h3 class="ml-section-title">
                    <span class="ml-title-badge" style="background:#f1f5f9; color:#334155;"><i class="fa fa-shield"></i> Alta Gama</span>
                    Productos en Acero Inoxidable
                </h3>
                <p class="ml-section-subtitle">Soportes, bisagras de pared y accesorios decorativos de alta durabilidad</p>
            </div>
            <a href="<?= site_url('category/productos-acero-inoxidable'); ?>" class="ml-view-all">Ver todo el acero <i class="fa fa-angle-right"></i></a>
        </div>

        <div class="row ml-product-grid">
            <?php foreach ($acero_products as $acp) { ?>
                <div class="col-xs-12 col-sm-6 col-md-3 margin-bottom-lg">
                    <div class="ml-card">
                        <a href="<?= site_url('product/' . $acp->slug); ?>" class="ml-card-img-wrap">
                            <img src="<?= base_url('assets/uploads/' . (!empty($acp->image) && $acp->image != 'no_image.png' ? $acp->image : 'no_image.png')); ?>" alt="<?= htmlspecialchars($acp->name); ?>" class="ml-card-img">
                        </a>

                        <div class="ml-card-body">
                            <div class="ml-card-meta">
                                <span class="ml-card-cat">Acero Inoxidable</span>
                                <?php if (!empty($acp->brand_name) && $acp->brand_name != 'Generico') { ?>
                                    <span class="ml-card-brand"><?= $acp->brand_name; ?></span>
                                <?php } ?>
                            </div>

                            <h4 class="ml-card-title">
                                <a href="<?= site_url('product/' . $acp->slug); ?>" title="<?= htmlspecialchars($acp->name); ?>">
                                    <?= $acp->name; ?>
                                </a>
                            </h4>

                            <?php if (!$shop_settings->hide_price) { ?>
                                <div class="ml-card-price-row">
                                    <div class="ml-card-current-price">
                                        <?= $this->sma->convertMoney($acp->price); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="ml-card-shipping">
                                <i class="fa fa-star text-warning"></i> Acabado satinado / Rose Gold / Negro
                            </div>

                            <div class="ml-card-actions">
                                <a href="<?= site_url('product/' . $acp->slug); ?>" class="btn btn-ml-details">
                                    Ver Ficha
                                </a>
                                <?php if (!$shop_settings->hide_price) { ?>
                                    <button class="btn btn-ml-cart add-to-cart" data-id="<?= $acp->id; ?>" title="<?= lang('add_to_cart'); ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<!-- ================= SECCIÓN 5: MARCAS DESTACADAS / TIENDAS OFICIALES ================= -->
<?php if (!empty($brands)) { ?>
<section class="ml-brands-section">
    <div class="container">
        <div class="ml-section-header">
            <div>
                <h3 class="ml-section-title">
                    <span class="ml-title-badge" style="background:#ede9fe; color:#6d28d9;"><i class="fa fa-check-badge"></i> Garantía</span>
                    Marcas Destacadas & Fabricantes
                </h3>
                <p class="ml-section-subtitle">Trabajamos exclusivamente con las marcas líderes del mercado</p>
            </div>
            <a href="<?= site_url('shop/products'); ?>" class="ml-view-all">Ver todas las marcas <i class="fa fa-angle-right"></i></a>
        </div>

        <div class="ml-brands-grid">
            <?php 
            $shown_brands = 0;
            foreach ($brands as $b) {
                if ($shown_brands >= 8) break;
                if ($b->name == 'Generico') continue;
                $shown_brands++;
            ?>
                <a href="<?= site_url('brand/' . $b->slug); ?>" class="ml-brand-card">
                    <div class="ml-brand-img-wrap">
                        <?php if (!empty($b->image) && file_exists('assets/uploads/' . $b->image)) { ?>
                            <img src="<?= base_url('assets/uploads/' . $b->image); ?>" alt="<?= $b->name; ?>" class="ml-brand-img">
                        <?php } else { ?>
                            <div class="ml-brand-initial"><?= strtoupper(substr($b->name, 0, 2)); ?></div>
                        <?php } ?>
                    </div>
                    <span class="ml-brand-name"><?= $b->name; ?></span>
                    <span class="ml-brand-sub">Ver catálogo <i class="fa fa-chevron-right"></i></span>
                </a>
            <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<!-- ================= BANNER FINAL DE ASISTENCIA TÉCNICA & COTIZACIONES ================= -->
<section class="ml-final-cta-section">
    <div class="container">
        <div class="ml-final-cta-card">
            <div class="row ml-align-center">
                <div class="col-md-8 col-sm-8">
                    <span class="ml-cta-pill"><i class="fa fa-comments"></i> Asesoría Personalizada</span>
                    <h3 class="ml-cta-title">¿Tienes un proyecto en mente o una lista de materiales?</h3>
                    <p class="ml-cta-desc">Envíanos tus medidas, requerimientos o lista de despiece por WhatsApp. Nuestros especialistas te asesorarán y enviarán una cotización inmediata sin compromiso.</p>
                </div>
                <div class="col-md-4 col-sm-4 text-center">
                    <a href="https://wa.me/584145681386?text=Hola,%20tengo%20un%20proyecto%20y%20quisiera%20asesoria%20tecnica" target="_blank" class="btn btn-ml-cta-wa">
                        <i class="fa fa-whatsapp"></i> Chatear con un Asesor
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Botón flotante WhatsApp -->
<div class="container-boton">
    <a href="https://wa.me/584145681386?text=Hola,%20tengo%20una%20consulta%20sobre%20sus%20productos:" target="_blank" title="Chatear por WhatsApp">
        <img class="boton" src="<?= base_url('assets/images/w.png'); ?>" alt="WhatsApp">
    </a>
</div>
