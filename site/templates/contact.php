<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1 text-center">
                <div class="mb-4">
                    <?= $page->kontaktinfos()->kt() ?>
                </div>
                <div>
                    <?= $page->oeffnungszeiten()->kt() ?>
                </div>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php if ($page->hasCover()) : ?>
                <figure class="js-lightbox group inline-block lg:ml-12 shadow-cover rounded-lg overflow-hidden relative">
                    <a href="<?= $page->getCover()->url() ?>" data-caption="<?= $page->getCover()->caption()->html() ?>">
                        <?= $page->getCover()->createImage('group-hover:opacity-75 rounded-lg transition-all', 'contact.map') ?>
                        <figcaption class="transform py-2 group-hover:-translate-y-full text-5xl text-white text-shadow absolute w-full sketch bg-red-medium select-none transition-all"><?= $page->getCover()->caption()->html() ?></figcaption>
                    </a>
                </figure>
                <?php endif ?>
            </div>
        </div>
    </header>
    <aside class="wave">
        <?= useSeparator('orange-light', 'top-reversed') ?>
        <div class="pt-12 pb-8 lg:pb-4 bg-orange-light">
            <div class="container xl:px-8">
                <div class="text-center">
                    <?= useSVG(t('Kontakt-Überschrift'), 'wave-icon', 'map-filled') ?>
                </div>
                <h2 class="wave-title"><?= t('Kontakt-Überschrift') ?></h2>
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
</article>

<?php snippet('footer') ?>
