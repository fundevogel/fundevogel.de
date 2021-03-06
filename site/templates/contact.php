<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <div class="mb-8">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mb-4 text-center">
                <?= snippet('contact/contact-details') ?>
            </div>
            <div class="text-center">
                <?php snippet('contact/opening-hours') ?>
            </div>
        </div>
        <div class="mt-12 flex-none text-center">
            <?php if ($page->hasCover()) : ?>
            <figure class="js-lightbox group inline-block lg:ml-12 rounded-lg overflow-hidden relative cursor-pointer">
                <?= $page->getCover()->createImage('rounded-lg transition-all', 'cover', true, true) ?>
                <figcaption class="big-caption sketch group-hover:-translate-y-full"><?= $page->getCover()->caption()->html() ?></figcaption>
            </figure>
            <?php endif ?>
        </div>
    </div>
</header>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="container xl:px-8">
            <div class="text-center">
                <?= useSVG(t('Kontakt-Überschrift'), 'title-icon', 'map-filled') ?>
            </div>
            <h2 class="title text-orange-medium"><?= t('Kontakt-Überschrift') ?></h2>
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-2/5 lg:mr-12 mb-6">
                    <h3 class="mb-2 text-center text-orange-medium"><?= t('Mit dem Fahrrad') ?></h3>
                    <?= $page->bike()->kt() ?>
                </div>
                <div class="flex-1 flex flex-col">
                    <div class="mb-4">
                        <h3 class="mb-2 text-center text-orange-medium"><?= t('Über den Asphalt') ?></h3>
                        <?= $page->car()->kt() ?>
                    </div>
                    <div class="mb-6">
                        <h3 class="mb-2 text-center text-orange-medium"><?= t('Auf der Schiene') ?></h3>
                        <?= $page->tram()->kt() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>

<?php snippet('footer') ?>
