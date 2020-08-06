<aside class="wave">
    <?= useSeparator('orange-light', 'top') ?>
    <div class="inner">
        <div class="container">
            <div class="text-center">
                <?= useSVG($data->heading()->html(), 'wave-icon', 'heart-filled') ?>
            </div>
            <h2 class="wave-title"><?= $data->heading()->html() ?></h2>
            <?php if ($data->show_columns()->bool()) : ?>
            <div class="flex flex-col md:flex-row">
                <div class="mb-6 md:mb-0 flex-1">
                    <?= $data->text_left()->kt() ?>
                </div>
                <div class="flex-1 md:ml-10">
                <?= $data->text_right()->kt() ?>
                </div>
            </div>
            <?php else : ?>
            <?= $data->text_full()->kt() ?>
            <?php endif ?>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom') ?>
</aside>
