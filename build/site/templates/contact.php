<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->kontaktinfos()->kt() ?>
                <?= $page->oeffnungszeiten()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-0 flex-none text-center">
                <div class="lightgallery">
                    <figure class="group inline-block lg:ml-12 shadow-cover rounded-lg overflow-hidden relative" data-lightgallery data-src="<?= $image->url() ?>" data-sub-html="<?= $image->caption()->html() ?>">
                        <img class="group-hover:opacity-75 rounded-t-lg transition-all" src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
                        <figcaption class="transform py-2 group-hover:-translate-y-full text-5xl absolute w-full sketch bg-red-medium transition-all"><?= $image->caption()->html() ?></figcaption>
                    </figure>
                </div>
                <noscript>
                    <a href="<?= $image->url() ?>">
                        <figure class="">
                            <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
                            <figcaption class="sketch bg-red-medium"><?= $image->caption()->html() ?></figcaption>
                        </figure>
                    </a>
                </noscript>
            </div>
        </div>
    </header>
    <aside class="my-16 overflow-hidden">
        <?= $site->useSeparator('orange-light', 'top-reversed') ?>
        <div class="pt-12 pb-8 lg:pb-4 bg-orange-light">
            <div class="container xl:px-0">
                <h2 class="mb-12 text-5xl text-center text-orange-medium"><?= t('kontakt_ueberschrift-liste') ?></h2>
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-2/5 lg:mr-12 mb-6">
                        <div class="mb-2 flex flex-col items-center">
                            <?= $site->useSVG('Fahrrad', 'w-16 h-16', 'bike') ?>
                            <h3 class="my-3 text-orange-medium">Mit dem Fahrrad</h3>
                        </div>
                        <?= $page->bike()->kt() ?>
                    </div>
                    <div class="flex-1 flex flex-col">
                        <div class="mb-4">
                            <div class="mb-2 flex flex-col items-center">
                                <?= $site->useSVG('Auto', 'w-16 h-16', 'car') ?>
                                <h3 class="my-3 text-orange-medium">Über den Asphalt</h3>
                            </div>
                            <?= $page->auto()->kt() ?>
                        </div>
                        <div class="mb-6">
                            <div class="mb-2 flex flex-col items-center">
                                <?= $site->useSVG('Bahn', 'w-16 h-16', 'tram') ?>
                                <h3 class="my-3 text-orange-medium">Auf der Schiene</h3>
                            </div>
                            <?= $page->tram()->kt() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $site->useSeparator('orange-light', 'bottom-reversed') ?>
    </aside>
</article>

<?php snippet('footer') ?>

article
mb-16

flex flex-col lg:flex-row
flex-1
pt-6 lg:pt-12 flex-none text-center




lesetipps
flex flex-col lg:flex-row
flex-none flex justify-center
mb-6 md:mb-0
flex-1 md:ml-10
md:mr-10
lg:text-lg

section h2
mb-12 text-center





figure (normal figcaption)
inline-block lg:first:ml-12 last:ml-12 shadow-cover rounded-lg
rounded-t-lg
py-1 text-sm text-center bg-red-medium rounded-b-lg
