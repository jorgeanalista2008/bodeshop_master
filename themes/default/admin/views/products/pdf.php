<?php defined('BASEPATH') or exit('No direct script access allowed'); ?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?= admin_url() ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product->name) ?> - <?= htmlspecialchars($Settings->site_name) ?></title>
    <style>
        @page {
            margin: 10mm 14mm 10mm 14mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, Helvetica, Arial, sans-serif;
            font-size: 8.5pt;
            color: #374151;
            line-height: 1.4;
            background: #ffffff;
            padding: 0;
            margin: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .header-bg {
            background-color: #f3f4f6;
            border-radius: 4px;
            padding: 12px 14px 8px 14px;
            margin-bottom: 12px;
        }
        .doc-title-main {
            font-size: 22pt;
            font-weight: bold;
            color: #111827;
            text-transform: uppercase;
            line-height: 1.05;
            margin: 0;
            letter-spacing: 0.5px;
        }
        .doc-title-sub {
            font-size: 13pt;
            color: #6b7280;
            font-weight: normal;
            margin: 2px 0 0 0;
        }
        .product-main-name {
            font-size: 14pt;
            font-weight: bold;
            color: #1e3a8a;
            text-transform: uppercase;
            line-height: 1.25;
            margin: 0 0 8px 0;
        }
        .editorial-banner {
            background-color: #e5e7eb;
            color: #1f2937;
            font-weight: bold;
            font-size: 8.5pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 4px 8px;
            margin-top: 12px;
            margin-bottom: 6px;
        }
        .specs-minimal-table {
            width: 100%;
            border-collapse: collapse;
        }
        .specs-minimal-table td {
            padding: 4px 6px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 8.5pt;
            vertical-align: middle;
        }
        .specs-minimal-table td.label-col {
            color: #6b7280;
            width: 44%;
        }
        .specs-minimal-table td.val-col {
            color: #111827;
            width: 56%;
        }
        .bullet-list-table {
            width: 100%;
            border-collapse: collapse;
        }
        .bullet-list-table td {
            padding: 2.5px 4px;
            font-size: 8.5pt;
            color: #374151;
            vertical-align: top;
        }
        .right-box {
            text-align: center;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 8px;
            margin-bottom: 8px;
        }
        img.bcimg {
            max-width: 170px;
            height: 28px;
            display: block;
            margin: 0 auto;
        }
        img.qrimg {
            width: 48px;
            height: 48px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <?php
    // Prepare logo base64
    $logo_base64 = '';
    if (!empty($Settings->logo)) {
        $logo_path = FCPATH . 'assets/uploads/logos/' . $Settings->logo;
        if (file_exists($logo_path)) {
            $type = pathinfo($logo_path, PATHINFO_EXTENSION);
            $data = file_get_contents($logo_path);
            $logo_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
    }

    // Prepare main product image and exact proportional dimensions for Dompdf
    $image_base64 = '';
    $img_w = 210;
    $img_h = 185;
    if (!empty($product->image) && $product->image != 'no_image.png') {
        $img_path = FCPATH . 'assets/uploads/' . $product->image;
        if (file_exists($img_path)) {
            $type = pathinfo($img_path, PATHINFO_EXTENSION);
            $data = file_get_contents($img_path);
            $image_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            $img_size = @getimagesize($img_path);
            if ($img_size && $img_size[0] > 0 && $img_size[1] > 0) {
                $max_w = 210;
                $max_h = 185;
                $scale = min($max_w / $img_size[0], $max_h / $img_size[1], 1.0);
                $img_w = max(1, round($img_size[0] * $scale));
                $img_h = max(1, round($img_size[1] * $scale));
            }
        }
    }
    ?>

    <!-- 1. Header Bar: Logo, Title & Company Details -->
    <div class="header-bg">
        <table style="width: 100%; border: none;">
            <tr>
                <!-- Left: Logo & Company Name -->
                <td style="width: 50%; vertical-align: top;">
                    <?php if ($logo_base64): ?>
                        <img src="<?= $logo_base64 ?>" height="36" style="height: 36px; width: auto; max-width: 180px; display: block; margin-bottom: 4px;" alt="<?= htmlspecialchars($Settings->site_name) ?>">
                    <?php endif; ?>
                    <div style="font-size: 11pt; font-weight: bold; color: #111827;">
                        <?= htmlspecialchars($Settings->site_name) ?>
                    </div>
                </td>
                <!-- Right: Company Contact & Metadata -->
                <td style="width: 50%; vertical-align: top; text-align: right; font-size: 7.5pt; color: #6b7280; line-height: 1.35;">
                    <div>Fecha de Emisión: <strong><?= date('d/m/Y') ?></strong></div>
                    <div>Referencia / ID: <strong><?= htmlspecialchars($product->code) ?></strong></div>
                    <div>Catálogo de Productos y Fichas Técnicas</div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-top: 10px; padding-bottom: 2px;">
                    <div class="doc-title-main">FICHA TÉCNICA</div>
                    <div class="doc-title-sub">de producto</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- 2. Two-Column Editorial Layout (Matching Canva Reference Template) -->
    <table style="width: 100%; border-collapse: collapse; border: none;">
        <tr>
            <!-- ================= LEFT COLUMN (62%): Content, Features & Specs ================= -->
            <td style="width: 62%; vertical-align: top; padding-right: 14px;">
                
                <!-- Product Name Header -->
                <div class="product-main-name">
                    <?= htmlspecialchars($product->name); ?>
                </div>

                <!-- Short Summary / Intro Description -->
                <?php if (!empty($product->details)): ?>
                    <div style="font-size: 8pt; color: #4b5563; line-height: 1.45; margin-bottom: 8px;">
                        <?= $product->details; ?>
                    </div>
                <?php endif; ?>

                <!-- SECTION 1: CARACTERÍSTICAS (Soft Gray Banner) -->
                <div class="editorial-banner">CARACTERÍSTICAS</div>
                <table class="bullet-list-table">
                    <tr>
                        <td style="width: 12px; color: #1e3a8a; font-weight: bold;">&bull;</td>
                        <td><strong>Tipo de Producto:</strong> <?= lang($product->type); ?></td>
                    </tr>
                    <tr>
                        <td style="color: #1e3a8a; font-weight: bold;">&bull;</td>
                        <td><strong>Marca:</strong> <?= $brand ? htmlspecialchars($brand->name) : 'No especificada'; ?></td>
                    </tr>
                    <tr>
                        <td style="color: #1e3a8a; font-weight: bold;">&bull;</td>
                        <td><strong>Categoría:</strong> <?= $category ? htmlspecialchars($category->name) : 'General'; ?></td>
                    </tr>
                    <?php if ($product->subcategory_id && $subcategory): ?>
                        <tr>
                            <td style="color: #1e3a8a; font-weight: bold;">&bull;</td>
                            <td><strong>Subcategoría:</strong> <?= htmlspecialchars($subcategory->name); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td style="color: #1e3a8a; font-weight: bold;">&bull;</td>
                        <td><strong>Unidad de Medida:</strong> <?= $unit ? htmlspecialchars($unit->name . ' (' . $unit->code . ')') : 'Unidad'; ?></td>
                    </tr>
                </table>

                <!-- SECTION 2: ESPECIFICACIONES TÉCNICAS (Soft Gray Banner) -->
                <div class="editorial-banner">ESPECIFICACIONES TÉCNICAS</div>
                <table class="specs-minimal-table">
                    <tr>
                        <td class="label-col">Código del Producto:</td>
                        <td class="val-col"><strong style="color: #1e3a8a;"><?= htmlspecialchars($product->code); ?></strong></td>
                    </tr>
                    <tr>
                        <td class="label-col">Simbología Código de Barras:</td>
                        <td class="val-col"><?= strtoupper($product->barcode_symbology); ?></td>
                    </tr>
                    <tr>
                        <td class="label-col">Precio de Venta:</td>
                        <td class="val-col">
                            <strong style="color: #15803d; font-size: 10.5pt;"><?= $this->sma->formatMoney($product->price); ?></strong>
                        </td>
                    </tr>
                    <?php if (!empty($Owner) || !empty($Admin) || $this->session->userdata('show_cost')): ?>
                        <tr>
                            <td class="label-col">Costo Unitario:</td>
                            <td class="val-col"><?= $this->sma->formatMoney($product->cost); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($product->tax_rate && $tax_rate): ?>
                        <tr>
                            <td class="label-col">Impuesto Aplicable:</td>
                            <td class="val-col"><?= htmlspecialchars($tax_rate->name); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($product->alert_quantity > 0): ?>
                        <tr>
                            <td class="label-col">Alerta de Stock Mínimo:</td>
                            <td class="val-col" style="color: #b91c1c; font-weight: bold;"><?= $this->sma->formatQuantity($product->alert_quantity); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>

                <!-- SECTION 3: DESCRIPCIÓN TÉCNICA DETALLADA (If present) -->
                <?php if (!empty($product->product_details)): ?>
                    <div class="editorial-banner">DETALLES Y DESCRIPCIÓN TÉCNICA</div>
                    <div style="font-size: 8pt; color: #4b5563; line-height: 1.45; padding: 4px 2px;">
                        <?= $product->product_details; ?>
                    </div>
                <?php endif; ?>

                <!-- SECTION 4: ARTÍCULOS EN COMBO (If applicable) -->
                <?php if ($product->type == 'combo' && !empty($combo_items)): ?>
                    <div class="editorial-banner">ARTÍCULOS INCLUIDOS EN EL COMBO</div>
                    <table class="specs-minimal-table">
                        <?php foreach ($combo_items as $item): ?>
                            <tr>
                                <td class="label-col"><?= htmlspecialchars($item->name); ?> (<?= htmlspecialchars($item->code); ?>)</td>
                                <td class="val-col" style="text-align: right; font-weight: bold;"><?= $this->sma->formatQuantity($item->qty); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

            </td>

            <!-- ================= RIGHT COLUMN (38%): Photo, Barcode, QR & Stock ================= -->
            <td style="width: 38%; vertical-align: top;">
                
                <!-- Main Product Photo Card -->
                <div class="right-box" style="padding: 10px; margin-bottom: 10px; min-height: 195px;">
                    <?php if ($image_base64): ?>
                        <img src="<?= $image_base64; ?>" width="<?= $img_w; ?>" height="<?= $img_h; ?>" style="display: block; margin: 0 auto; width: <?= $img_w; ?>px; height: <?= $img_h; ?>px; border-radius: 4px;" alt="<?= htmlspecialchars($product->name); ?>" />
                    <?php else: ?>
                        <div style="width: 140px; height: 120px; line-height: 120px; text-align: center; color: #9ca3af; border: 1.5px dashed #d1d5db; border-radius: 4px; margin: 0 auto; font-size: 8.5pt; font-weight: bold; background-color: #f9fafb;">
                            [ Sin Fotografía ]
                        </div>
                    <?php endif; ?>
                </div>

                <!-- BOX 1: IDENTIFICACIÓN (Barcode Card) -->
                <div class="editorial-banner" style="text-align: center; margin-top: 0;">IDENTIFICACIÓN</div>
                <div class="right-box">
                    <div style="text-align: center; margin-bottom: 3px;">
                        <?= $this->sma->barcode($product->code, $product->barcode_symbology, 28, 0); ?>
                    </div>
                    <div style="font-size: 8.5pt; font-weight: bold; color: #111827; letter-spacing: 1px;">
                        <?= htmlspecialchars($product->code); ?>
                    </div>
                </div>

                <!-- BOX 2: FICHA DIGITAL (QR Code Card) -->
                <div class="editorial-banner" style="text-align: center;">CONSULTA DIGITAL</div>
                <div class="right-box">
                    <div style="text-align: center; margin-bottom: 2px;">
                        <?= $this->sma->qrcode('link', urlencode(admin_url('products/view/' . $product->id)), 2); ?>
                    </div>
                    <div style="font-size: 7pt; color: #6b7280;">Escanear para ver ficha online</div>
                </div>

                <!-- BOX 3: DISPONIBILIDAD (Stock Breakdown) -->
                <div class="editorial-banner" style="text-align: center;">DISPONIBILIDAD</div>
                <div class="right-box" style="padding: 6px;">
                    <?php if ((empty($Supplier) || empty($Customer)) && !empty($warehouses) && $product->type == 'standard'): ?>
                        <table style="width: 100%; font-size: 7.5pt; border-collapse: collapse;">
                            <?php
                            $has_stock = false;
                            foreach ($warehouses as $wh):
                                if ($wh->quantity != 0):
                                    $has_stock = true;
                            ?>
                                <tr>
                                    <td style="text-align: left; padding: 2px 3px; border-bottom: 1px solid #f3f4f6; color: #374151;">
                                        <?= htmlspecialchars($wh->name); ?>
                                    </td>
                                    <td style="text-align: right; padding: 2px 3px; border-bottom: 1px solid #f3f4f6; font-weight: bold; color: #15803d;">
                                        <?= $this->sma->formatQuantity($wh->quantity); ?>
                                    </td>
                                </tr>
                            <?php
                                endif;
                            endforeach;
                            if (!$has_stock): ?>
                                <tr>
                                    <td colspan="2" style="text-align: center; color: #9ca3af; padding: 4px; font-style: italic;">
                                        Sin existencias registradas
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    <?php else: ?>
                        <div style="font-size: 7.5pt; color: #6b7280; text-align: center;">Disponible para consulta comercial</div>
                    <?php endif; ?>
                </div>

                <!-- BOX 4: VARIANTES (if any) -->
                <?php if (!empty($options)): ?>
                    <div class="editorial-banner" style="text-align: center;">VARIANTES</div>
                    <div class="right-box" style="padding: 6px;">
                        <table style="width: 100%; font-size: 7.5pt; border-collapse: collapse;">
                            <?php foreach ($options as $opt): ?>
                                <tr>
                                    <td style="text-align: left; padding: 2px 3px; border-bottom: 1px solid #f3f4f6; color: #374151;">
                                        <?= htmlspecialchars($opt->name); ?>
                                    </td>
                                    <td style="text-align: right; padding: 2px 3px; border-bottom: 1px solid #f3f4f6; font-weight: bold; color: #15803d;">
                                        <?= $this->sma->formatQuantity($opt->wh_qty); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>

            </td>
        </tr>
    </table>

    <!-- 3. Additional Gallery Photos (if any) at bottom -->
    <?php if (!empty($images)): ?>
        <div class="editorial-banner" style="margin-top: 14px;">GALERÍA DE IMÁGENES</div>
        <table style="width: 100%; border: 1px solid #e5e7eb; border-collapse: collapse; margin-top: 4px;">
            <tr>
                <td style="padding: 8px; text-align: center; background-color: #ffffff;">
                    <?php foreach ($images as $ph):
                        $ph_path = FCPATH . 'assets/uploads/' . $ph->photo;
                        if (file_exists($ph_path)):
                            $p_type = pathinfo($ph_path, PATHINFO_EXTENSION);
                            $p_data = file_get_contents($ph_path);
                            $p_base64 = 'data:image/' . $p_type . ';base64,' . base64_encode($p_data);
                    ?>
                        <img src="<?= $p_base64; ?>" height="55" style="height: 55px; width: auto; border: 1px solid #e5e7eb; border-radius: 4px; padding: 2px; margin: 3px; background: #ffffff;" alt="Foto" />
                    <?php endif; endforeach; ?>
                </td>
            </tr>
        </table>
    <?php endif; ?>

    <!-- 4. Footer -->
    <table style="width: 100%; border-top: 1px solid #e5e7eb; margin-top: 16px; padding-top: 6px;">
        <tr>
            <td style="font-size: 7pt; color: #9ca3af;">
                <?= htmlspecialchars($Settings->site_name); ?> &bull; Documento generado electrónicamente el <?= date('d/m/Y H:i'); ?>
            </td>
            <td style="font-size: 7pt; color: #9ca3af; text-align: right;">
                Ficha Técnica Informativa &bull; Información sujeta a disponibilidad
            </td>
        </tr>
    </table>

</body>
</html>