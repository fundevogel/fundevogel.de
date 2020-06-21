<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php snippet('cover') ?>
            </div>
        </div>
    </header>
    <hr>
    <section class="container">
        <?= $page->details()->kt() ?>
    </section>
    <aside class="wave">
        <?= $site->useSeparator('orange-light', 'top-reversed') ?>
        <div class="inner">
            <div class="text-center">
                <?= $site->useSVG(t('Eindrücke'), 'wave-icon', 'camera-filled') ?>
            </div>
            <h2 class="wave-title"><?= t('Eindrücke') ?></h2>
            <div class="js-slider mb-10 flex items-center">
                <?php foreach ($images as $image) : ?>
                <?php
                    $thumb = $image->resize(600);
                ?>
                <div class="js-lightbox mx-6">
                    <a href="<?= $image->url() ?>">
                        <img
                            class="shadow-cover rounded-lg"
                            src="<?= $thumb->url() ?>"
                            title="<?= $image->caption()->html() ?>"
                            alt="<?= $image->alt()->html() ?>"
                            width="<?= $thumb->width() ?>"
                            height="<?= $thumb->height() ?>"
                        >
                    </a>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <?= $site->useSeparator('orange-light', 'bottom-reversed') ?>
    </aside>
    <section class="container">
        <div class="flex flex-col md:flex-row">
            <div class="mb-6 md:mb-0 flex-1">
                <?= $page->left()->kt() ?>
            </div>
            <div class="flex-1 md:ml-10">
                <?= $page->right()->kt() ?>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="mt-12 card is-dashed">
            <h3 class="mb-4 underline"><?= t('Nützliche Infos') ?></h3>
            <?= $page->info()->kt() ?>
        </div>
    </section>

</article>

<?php snippet('calendar/single.prevnext') ?>

<?php snippet('footer') ?>
