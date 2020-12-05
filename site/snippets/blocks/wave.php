<aside class="wave">
    <?= useSeparator('orange-light', 'top') ?>
    <div class="inner">
        <div class="container">
            <div class="text-center">
                <?= useSVG($block->heading()->html(), 'title-icon', 'heart-filled') ?>
            </div>
            <h2 class="title"><?= $block->heading()->html() ?></h2>
            <?php if ($block->show_columns()->bool()) : ?>
            <div class="flex flex-col md:flex-row">
                <div class="mb-6 md:mb-0 flex-1">
                    <?= $block->text_left()->kt() ?>
                </div>
                <div class="flex-1 md:ml-10">
                <?= $block->text_right()->kt() ?>
                </div>
            </div>
            <?php else : ?>
            <?= $block->text_full()->kt() ?>
            <?php endif ?>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom') ?>
</aside>
