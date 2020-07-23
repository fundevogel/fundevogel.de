<?php if ($data->gallery()->isNotEmpty()) : ?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG(t('Eindrücke'), 'wave-icon', 'camera-filled') ?>
        </div>
        <h2 class="wave-title"><?= t('Eindrücke') ?></h2>
        <div class="js-lightbox js-slider mb-10 flex items-center" data-nonce="<?= $page->nonce('tiny-slider') ?>">
            <?php foreach ($data->gallery()->toFiles() as $image) : ?>
            <?= $image->createImage('mx-6 rounded-lg shadow-cover cursor-pointer', 'calendar.single.gallery', true, true) ?>
            <?php endforeach ?>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
<?php endif ?>

<?php if ($data->horizontal_line()->bool()) : ?>
<hr class="max-w-sm">
<?php endif ?>
