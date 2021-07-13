<aside class="wave">
    <?= useSeparator('orange-light', 'top') ?>
    <div class="inner">
        <div class="container">
            <div class="text-center">
                <?= useSVG('', 'title-icon', 'heart-filled') ?>
            </div>
            <h2 class="title text-orange-medium"><?= t('Dankeschön') ?>!</h2>
            <?= $page->thanks()->kt() ?>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom') ?>
</aside>
