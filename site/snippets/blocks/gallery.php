<?php if ($data->gallery()->isNotEmpty()) : ?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG(t('Eindrücke'), 'wave-icon', 'camera-filled') ?>
        </div>
        <h2 class="wave-title"><?= t('Eindrücke') ?></h2>
        <div class="js-lightbox mb-10 flex items-center">
            <div class="js-slider swiper-container">
                <div class="swiper-wrapper swiper-wrapper-gallery">
                    <?php foreach ($data->gallery()->toFiles() as $image) : ?>
                    <div class="swiper-slide">
                        <div class="">
                            <?= $image->createImage('mx-6 rounded-lg shadow-cover cursor-pointer', 'calendar.single.gallery', true) ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
<?php endif ?>

<?php if ($data->horizontal_line()->bool()) : ?>
<hr class="max-w-sm">
<?php endif ?>
