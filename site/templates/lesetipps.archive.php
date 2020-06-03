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
        <h2 class="mb-12 text-center"><?= t('Alle Empfehlungslisten') ?>:</h2>
        <div class="flex flex-wrap">
            <?php foreach ($editions as $edition) : ?>
            <div class="w-1/2 sm:w-1/3 lg:w-1/4 mb-6 md:mb-10 text-center">
                <figure class="w-40 md:w-auto inline-block shadow-cover rounded-lg">
                    <a class="" href="<?= $edition->url() ?>" target="_blank">
                        <?= $edition->getCover('rounded-t-lg') ?>
                    </a>
                    <figcaption class="py-1 text-sm text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= implode(' ', [$edition->edition(), $edition->year()]) ?></figcaption>
                </figure>
            </div>
            <?php endforeach ?>
        </div>
    </section>
    <section class="container">
        <div class="mt-12 card is-dashed">
            <h3 class="mb-6 underline"><?= t('nuetzliche-infos') ?></h3>
            <?= $page->details()->kt() ?>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
