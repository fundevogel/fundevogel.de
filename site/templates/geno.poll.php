<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <a class="lg:ml-12 inline-block group relative" href="<?= $file->url() ?>" target="_blank">
                    <?php if ($page->hasCover()) : ?>
                    <figure class="inline-block shadow-cover rounded-lg">
                        <?= $page->getCover()->createImage('rounded-t-lg') ?>
                        <figcaption class="py-2 text-xs text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= $page->getCover()->caption()->html() ?></figcaption>
                    </figure>
                    <?php endif ?>
                    <div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-red-medium transition-all z-25">
                        <div class="h-full flex flex-col justify-center items-center">
                            <?= useSVG('Download', 'w-12 h-12 text-white fill-current', 'download') ?>
                            <span class="font-normal text-lg sm:text-xl text-white">Formular zum Ausdrucken</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </header>
    <hr>
    <section class="container">
        <?= $page->details()->kt() ?>
    </section>
    <hr class="max-w-sm">
    <section class="container">
        <?php if ($form->success()) : ?>
        <h2 class="text-center">Vielen Dank für die Teilnahme!</h2>
        <!-- TODO: Replace with blocks/info -->
        <div class="mt-12 card is-dashed">
            <h3 class="mb-4 underline"><?= t('So geht es weiter') ?></h3>
            <?= $page->whatsnext()->kt() ?>
        </div>
        <?php else : ?>
        <h2><?= t('Unsere Fragen an Sie') ?></h2>
        <?php snippet('geno/poll') ?>
        <?php endif ?>
    </section>
</article>

<?php snippet('footer') ?>
