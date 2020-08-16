<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mt-12 flex-none text-center">
                <?php snippet('cover') ?>
            </div>
        </div>
    </header>
    <hr>
    <section class="container">
        <h2 class="mb-12 text-center"><?= t('Alle Empfehlungslisten') ?></h2>
        <div class="flex flex-wrap">
            <?php foreach ($editions as $edition) : ?>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 mb-6 md:mb-10 text-center">
                <a class="inline-block group relative" href="<?= $edition->url() ?>" target="_blank">
                    <figure class="w-40 md:w-auto inline-block rounded-lg">
                        <?= $edition->getFront('rounded-t-lg') ?>
                        <figcaption class="py-1 sm:py-2 text-xs sm:text-sm text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= implode(' ', [t($edition->edition()->value()), $edition->year()]) ?></figcaption>
                    </figure>
                    <div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-red-medium transition-all z-25">
                        <div class="h-full flex flex-col justify-center items-center">
                            <?= useSVG('Download', 'w-12 h-12 text-white fill-current', 'download') ?>
                            <span class="font-normal text-lg sm:text-xl text-white">Download</span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach ?>
        </div>
    </section>
    <?php snippet('blocks/info', ['data' => $page]) ?>
</article>

<?php snippet('footer') ?>
