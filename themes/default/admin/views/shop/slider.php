<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .slider-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 24px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }
    .slider-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .slider-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        font-size: 13px;
        color: #2563eb;
        background: #eff6ff;
        padding: 4px 12px;
        border-radius: 20px;
    }
</style>

<div class="box">
    <div class="box-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
        <h2 class="blue" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px;">
            <span style="width: 34px; height: 34px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-sliders"></i>
            </span>
            <?= lang('slider_settings'); ?>
        </h2>
    </div>
    <div class="box-content" style="padding: 24px; background: #f8fafc;">
        <div class="row">
            <div class="col-lg-12">

                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 18px; margin-bottom: 22px; display: flex; align-items: center; gap: 12px;">
                    <i class="fa fa-info-circle text-primary" style="font-size: 18px;"></i>
                    <span style="color: #475569; font-size: 13px;"><?= lang('update_info'); ?> - Configure hasta 5 diapositivas para el carrusel principal de la tienda en línea.</span>
                </div>

                <?php $attrib = ['data-toggle' => 'validator', 'role' => 'form'];
                echo admin_form_open_multipart('shop_settings/slider', $attrib);
                ?>

                <?php for ($i = 1; $i <= 5; $i++) { 
                    $idx = $i - 1;
                    $current_img = isset($slider_settings[$idx]->image) ? $slider_settings[$idx]->image : '';
                    $current_link = isset($slider_settings[$idx]->link) ? $slider_settings[$idx]->link : '';
                    $current_cap = isset($slider_settings[$idx]->caption) ? $slider_settings[$idx]->caption : '';
                ?>
                <div class="slider-card">
                    <div class="slider-card-header">
                        <span class="slider-badge">
                            <i class="fa fa-picture-o"></i> Diapositiva <?= $i ?>
                        </span>
                        <?php if (!empty($current_img)) { ?>
                            <span class="text-muted" style="font-size: 12px;">
                                <i class="fa fa-check-circle text-success"></i> Imagen actual: <strong><?= $current_img ?></strong>
                            </span>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="image<?= $i ?>"><?= lang('image', 'image' . $i); ?></label>
                                <input id="image<?= $i ?>" type="file" data-browse-label="<?= lang('browse'); ?>" name="image<?= $i ?>" data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="link<?= $i ?>"><?= lang('link', 'link' . $i); ?></label>
                                <?= form_input('link' . $i, set_value('link' . $i, $current_link), 'class="form-control" id="link' . $i . '" placeholder="https://..."'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="modern-label" for="caption<?= $i ?>"><?= lang('caption', 'caption' . $i); ?></label>
                                <?= form_input('caption' . $i, set_value('caption' . $i, $current_cap), 'class="form-control" id="caption' . $i . '" placeholder="Título o descripción breve"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div style="margin-top: 15px; margin-bottom: 25px;">
                    <?= form_submit('update', lang('update'), 'class="btn btn-primary" style="padding: 11px 28px; font-weight: 700; border-radius: 8px;"'); ?>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
