<?php
    if ($data->gallery()->isNotEmpty()) :
    $gallery = $data->gallery()->toFiles();
?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG(t('Eindrücke'), 'wave-icon', 'camera-filled') ?>
        </div>
        <h2 class="wave-title"><?= t('Eindrücke') ?></h2>
        <div class="container">
            <div class="js-masonry js-lightbox">
                <?php foreach ($gallery as $image) : ?>
                <?= $image->createImage('rounded-lg cursor-pointer', 'calendar.single.gallery', true) ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
<?php endif ?>

<?php if ($data->horizontal_line()->bool()) : ?>
<hr class="max-w-sm">
<?php endif ?>
