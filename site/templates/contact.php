<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1 text-center">
                <?= $page->kontaktinfos()->kt() ?>
                <?= $page->oeffnungszeiten()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <figure class="js-lightbox group inline-block lg:ml-12 shadow-cover rounded-lg overflow-hidden relative">
                    <a href="<?= $image->url() ?>" data-caption="<?= $image->caption()->html() ?>">
                        <img
                            class="group-hover:opacity-75 rounded-lg transition-all"
                            src="<?= $thumb->url() ?>"
                            title="<?= $image->caption()->html() ?>"
                            alt="<?= $image->alt()->html() ?>"
                            width="<?= $thumb->width() ?>"
                            height="<?= $thumb->height() ?>"
                        >
                        <figcaption class="transform py-2 group-hover:-translate-y-full text-5xl text-white text-shadow absolute w-full sketch bg-red-medium select-none transition-all"><?= $image->caption()->html() ?></figcaption>
                    </a>
                </figure>
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
                        <h3 class="mb-2 text-center text-orange-medium">Mit dem Fahrrad</h3>
                        <?= $page->bike()->kt() ?>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <div class="mb-4">
                            <h3 class="mb-2 text-center text-orange-medium">Über den Asphalt</h3>
                            <?= $page->auto()->kt() ?>
                        </div>
                        <div class="mb-6">
                            <h3 class="mb-2 text-center text-orange-medium">Auf der Schiene</h3>
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
