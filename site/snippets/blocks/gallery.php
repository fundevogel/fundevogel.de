<?php
    if ($block->gallery()->isNotEmpty()) :
    $gallery = $block->gallery()->toFiles();
?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG(t('Eindrücke'), 'title-icon', 'camera-filled') ?>
        </div>
        <h2 class="title"><?= t('Eindrücke') ?></h2>
        <div class="container">
            <div class="js-masonry js-lightbox">
                <?php foreach ($gallery as $image) : ?>
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
<?php endif ?>

<?php if ($block->horizontal_line()->bool()) : ?>
<hr class="max-w-sm">
<?php endif ?>
