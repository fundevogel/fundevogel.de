<?php
    # Available variables
    # 'heading'
    # 'icon'
    # 'images'

    # Setup default values
    if (!isset($heading)) {
        $heading = '';
    }

    if (is_a($heading, 'Kirby\Cms\Field')) {
        $heading = $heading->html();
    }

    $heading = $heading != '' ? $heading : t('Eindrücke');

    if (!isset($icon)) {
        $icon = '';
    }

    if (is_a($icon, 'Kirby\Cms\Field')) {
        $icon = $icon->value();
    }

    $icon = $icon != '' ? $icon : 'camera-filled';
?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <?php if ($heading === false) : ?>
        <div class="text-center">
            <?= useSVG($heading, 'title-icon', $icon) ?>
        </div>
        <h2 class="title"><?= $heading ?></h2>
        <?php endif ?>
        <div class="container">
            <div class="js-masonry js-lightbox">
                <?php foreach ($images as $image) : ?>
                    <div>
                        <div class="table rounded-lg group overflow-hidden">
                            <?= $image->createImage('rounded-lg transition-transform duration-350 transform group-hover:scale-110 cursor-pointer', 'calendar.single.gallery', true) ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
