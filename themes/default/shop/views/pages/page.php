<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
// Determinar datos e iconos según el slug de la página
$hero_icon = 'fa-file-text-o';
$hero_tag  = 'Información';
$is_location = ($page->slug == 'proyectos' || stripos($page->title, 'ubicaci') !== false || stripos($page->name, 'ubicaci') !== false);
$is_contact  = ($page->slug == $shop_settings->contact_link || stripos($page->title, 'contact') !== false);

if ($is_location) {
    $hero_icon = 'fa-map-marker';
    $hero_tag  = 'Sede Principal & Tienda Física';
} elseif ($page->slug == 'Nosotros' || stripos($page->slug, 'nosotros') !== false) {
    $hero_icon = 'fa-building-o';
    $hero_tag  = 'Nuestra Empresa';
} elseif ($is_contact) {
    $hero_icon = 'fa-envelope-o';
    $hero_tag  = 'Canales de Atención';
} elseif (in_array($page->slug, ['Term', 'Polit'])) {
    $hero_icon = 'fa-shield';
    $hero_tag  = 'Legal & Transparencia';
}

if (empty($pages)) {
    $pages = $this->shop_model->getAllPages();
}
?>

<section class="page-contents shop-cms-page padding-y-lg">
    <div class="container">
        
        <!-- Breadcrumb -->
        <ol class="breadcrumb pdp-breadcrumb">
            <li><a href="<?= site_url(); ?>"><i class="fa fa-home"></i> <?= lang('home'); ?></a></li>
            <li><span>Institucional</span></li>
            <li class="active"><?= htmlspecialchars($page->title); ?></li>
        </ol>

        <!-- Hero Header -->
        <div class="shop-cms-hero">
            <div class="row ml-align-center">
                <div class="col-md-8 col-sm-7">
                    <div class="shop-cms-pill">
                        <i class="fa <?= $hero_icon; ?>"></i> <?= $hero_tag; ?>
                    </div>
                    <h1 class="shop-cms-title"><?= htmlspecialchars($page->title); ?></h1>
                    <?php if (!empty($page->description)) { ?>
                        <p class="shop-cms-subtitle"><?= htmlspecialchars($page->description); ?></p>
                    <?php } else { ?>
                        <p class="shop-cms-subtitle">Cristalería Latinoamericana — Materiales, herrajes, perfiles y soluciones en vidrio.</p>
                    <?php } ?>
                </div>
                <div class="col-md-4 col-sm-5 text-right hidden-xs">
                    <div class="shop-cms-updated">
                        <i class="fa fa-clock-o"></i> Actualizado el <?= $this->sma->hrsd($page->updated_at); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido y Barra Lateral -->
        <div class="row">
            
            <!-- Columna Principal -->
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="shop-cms-card">
                    
                    <!-- Cuerpo del CMS -->
                    <div class="shop-cms-body">
                        <?= $this->sma->decode_html($page->body); ?>
                    </div>

                    <?php if ($is_location) { ?>
                        <!-- ================= ENHANCED LOCATION SECTION ================= -->
                        <div class="shop-location-showcase">
                            <div class="shop-location-header">
                                <h3 class="shop-location-title">
                                    <i class="fa fa-compass text-primary"></i> Visítanos en Nuestra Sede
                                </h3>
                                <p class="text-muted">Te esperamos con asesoría técnica inmediata y todo nuestro inventario disponible.</p>
                            </div>

                            <div class="row shop-location-grid">
                                <div class="col-sm-6 margin-bottom-md">
                                    <div class="shop-info-box">
                                        <div class="shop-info-icon"><i class="fa fa-map-pin"></i></div>
                                        <div class="shop-info-text">
                                            <h5>Dirección Exacta</h5>
                                            <p>Avenida Caracas, entre 3era y 4ta avenida, San Felipe, Estado Yaracuy.</p>
                                            <small class="text-muted"><i class="fa fa-info-circle"></i> Ref: Diagonal a Motos Bera, 2 cuadras más abajo de la Gobernación.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 margin-bottom-md">
                                    <div class="shop-info-box">
                                        <div class="shop-info-icon" style="background: #ecfdf5; color: #059669;"><i class="fa fa-clock-o"></i></div>
                                        <div class="shop-info-text">
                                            <h5>Horario de Atención</h5>
                                            <p><strong>Lunes a Viernes:</strong> 8:00 AM – 5:00 PM</p>
                                            <p><strong>Sábados:</strong> 8:00 AM – 1:00 PM</p>
                                            <small class="text-muted">Domingos: Cerrado</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción Rápida -->
                            <div class="shop-location-actions">
                                <a href="https://www.google.com/maps/search/?api=1&query=Avenida+Caracas+San+Felipe+Yaracuy" target="_blank" class="btn btn-shop-maps">
                                    <i class="fa fa-map-marker"></i> Abrir en Google Maps
                                </a>
                                <a href="https://wa.me/584145681386?text=Hola,%20quisiera%20solicitar%20la%20ubicación%20exacta%20y%20horario%20de%20la%20tienda" target="_blank" class="btn btn-shop-wa">
                                    <i class="fa fa-whatsapp"></i> Pedir Ubicación por WhatsApp
                                </a>
                                <a href="tel:+584125535409" class="btn btn-shop-phone">
                                    <i class="fa fa-phone"></i> Llamar a Tienda
                                </a>
                            </div>

                            <!-- Mapa Interactivo Integrado -->
                            <div class="shop-map-container">
                                <iframe 
                                    src="https://maps.google.com/maps?q=Avenida+Caracas,+San+Felipe,+Yaracuy,+Venezuela&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                                    width="100%" 
                                    height="340" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>

                            <!-- Beneficios en Tienda -->
                            <div class="shop-location-perks">
                                <div class="shop-perk-item">
                                    <i class="fa fa-check-circle text-success"></i>
                                    <span>Retiro inmediato de compras web (Pick-Up)</span>
                                </div>
                                <div class="shop-perk-item">
                                    <i class="fa fa-check-circle text-success"></i>
                                    <span>Asesoría personalizada en medidas y perfiles</span>
                                </div>
                                <div class="shop-perk-item">
                                    <i class="fa fa-check-circle text-success"></i>
                                    <span>Pago en punto, Pago Móvil, Zelle y Efectivo</span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($is_contact) { ?>
                        <!-- ================= ENHANCED CONTACT SECTION ================= -->
                        <div class="shop-contact-showcase">
                            <hr class="margin-y-lg">
                            <div class="text-center margin-bottom-lg">
                                <h4 class="text-bold">¿Cómo prefieres comunicarte?</h4>
                                <p class="text-muted">Nuestros asesores responden tus consultas técnicas y solicitudes de cotización en minutos.</p>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm-4 margin-bottom-md">
                                    <div class="shop-contact-box">
                                        <div class="shop-contact-icon"><i class="fa fa-whatsapp text-success"></i></div>
                                        <h5>WhatsApp Comercial</h5>
                                        <p class="text-muted">+58 414 568 1386</p>
                                        <a href="https://wa.me/584145681386?text=Hola,%20deseo%20hacer%20una%20consulta" target="_blank" class="btn btn-sm btn-success btn-block">Chatear Ahora</a>
                                    </div>
                                </div>
                                <div class="col-sm-4 margin-bottom-md">
                                    <div class="shop-contact-box">
                                        <div class="shop-contact-icon"><i class="fa fa-phone text-primary"></i></div>
                                        <h5>Atención Telefónica</h5>
                                        <p class="text-muted">+58 412 553 5409</p>
                                        <a href="tel:+584125535409" class="btn btn-sm btn-primary btn-block">Llamar</a>
                                    </div>
                                </div>
                                <div class="col-sm-4 margin-bottom-md">
                                    <div class="shop-contact-box">
                                        <div class="shop-contact-icon"><i class="fa fa-envelope text-info"></i></div>
                                        <h5>Correo Electrónico</h5>
                                        <p class="text-muted">Formulario Directo</p>
                                        <button type="button" class="btn btn-sm btn-info btn-block email-modal">Enviar Correo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Footer de la tarjeta -->
                    <div class="shop-cms-card-footer">
                        <div class="row ml-align-center">
                            <div class="col-xs-12 col-sm-6">
                                <span class="text-muted">
                                    <i class="fa fa-shield text-primary"></i> Cristalería Latinoamericana C.A.
                                </span>
                            </div>
                            <div class="col-xs-12 col-sm-6 text-right">
                                <a href="<?= site_url('shop/products'); ?>" class="btn btn-sm btn-shop-outline">
                                    <i class="fa fa-th-large"></i> Ver Catálogo Completo
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Columna Lateral (Sidebar Moderno) -->
            <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="shop-cms-sidebar">
                    
                    <!-- Widget 1: Navegación Institucional -->
                    <div class="shop-sidebar-widget">
                        <h4 class="shop-sidebar-widget-title">
                            <i class="fa fa-bookmark-o text-primary"></i> Páginas de Interés
                        </h4>
                        <ul class="shop-cms-nav list-unstyled">
                            <?php if (!empty($pages)) { ?>
                                <?php foreach ($pages as $p) { 
                                    $p_active = ($p->slug == $page->slug);
                                    $icon_cls = 'fa-file-text-o';
                                    if ($p->slug == 'Nosotros' || stripos($p->slug, 'nosotros') !== false) {
                                        $icon_cls = 'fa-building-o';
                                    } elseif ($p->slug == 'Contacto' || stripos($p->slug, 'contact') !== false) {
                                        $icon_cls = 'fa-envelope-o';
                                    } elseif ($p->slug == 'proyectos' || stripos($p->slug, 'ubica') !== false) {
                                        $icon_cls = 'fa-map-marker';
                                    } elseif ($p->slug == 'Term') {
                                        $icon_cls = 'fa-gavel';
                                    } elseif ($p->slug == 'Polit') {
                                        $icon_cls = 'fa-shield';
                                    }
                                ?>
                                    <li class="<?= $p_active ? 'active' : ''; ?>">
                                        <a href="<?= site_url('page/' . $p->slug); ?>">
                                            <span class="shop-cms-nav-item-content">
                                                <i class="fa <?= $icon_cls; ?>"></i>
                                                <span><?= htmlspecialchars($p->name); ?></span>
                                            </span>
                                            <i class="fa fa-chevron-right shop-cms-nav-arrow"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>

                    <!-- Widget 2: Asesoría Técnica & Cotizaciones -->
                    <div class="shop-sidebar-widget shop-sidebar-highlight">
                        <div class="shop-highlight-badge">
                            <i class="fa fa-bolt"></i> Respuesta Rápida
                        </div>
                        <h4 class="shop-highlight-title">¿Necesitas asesoría o una cotización técnica?</h4>
                        <p class="shop-highlight-desc">Envíanos tu lista de materiales, medidas o requerimientos. Te responderemos de inmediato con la mejor cotización.</p>
                        
                        <a href="https://wa.me/584145681386?text=Hola,%20estoy%20en%20la%20página%20de%20<?= urlencode($page->title); ?>%20y%20quisiera%20asesoría" target="_blank" class="btn btn-shop-login margin-bottom-sm">
                            <i class="fa fa-whatsapp"></i> <span>Chatear por WhatsApp</span>
                        </a>

                        <div class="shop-highlight-contact">
                            <div><i class="fa fa-phone text-muted"></i> +58 412 553 5409</div>
                            <div><i class="fa fa-envelope-o text-muted"></i> info@cristalerialatinoamericana.com</div>
                        </div>
                    </div>

                    <!-- Widget 3: Beneficios y Garantías -->
                    <div class="shop-sidebar-widget">
                        <h4 class="shop-sidebar-widget-title">
                            <i class="fa fa-star text-warning"></i> ¿Por qué elegirnos?
                        </h4>
                        <ul class="shop-benefits-list list-unstyled">
                            <li>
                                <div class="shop-benefit-icon"><i class="fa fa-truck text-primary"></i></div>
                                <div>
                                    <strong>Envíos Nacionales</strong>
                                    <p class="text-muted">Despachos coordinados a todo el territorio nacional.</p>
                                </div>
                            </li>
                            <li>
                                <div class="shop-benefit-icon"><i class="fa fa-cubes text-success"></i></div>
                                <div>
                                    <strong>Marcas Líderes</strong>
                                    <p class="text-muted">Covo, Troen, Suddenbond, Gyplac, Superboard y más.</p>
                                </div>
                            </li>
                            <li>
                                <div class="shop-benefit-icon"><i class="fa fa-user-circle text-info"></i></div>
                                <div>
                                    <strong>Asesoría Especializada</strong>
                                    <p class="text-muted">Especialistas en proyectos de cristalería y perfiles.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
