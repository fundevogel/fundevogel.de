<?php if ($data->gallery()->isNotEmpty()) : ?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG(t('Eindrücke'), 'wave-icon', 'camera-filled') ?>
        </div>
        <h2 class="wave-title"><?= t('Eindrücke') ?></h2>
        <div class="js-slider mb-10 flex items-center">
            <?php foreach ($data->gallery()->toFiles() as $image) : ?>
            <div class="js-lightbox mx-6">
                <?= $image->createImage('rounded-lg shadow-cover cursor-pointer', 'calendar.single.gallery', true, true) ?>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
<?php endif ?>

<?php if ($data->horizontal_line()->bool()) : ?>
<hr class="max-w-sm">
<?php endif ?>
