<?php snippet('header') ?>

<article class="mb-16">
    <?php if ($pagination->page() === 1) : ?>
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mt-6 lg:mt-12 flex-none text-center">
                <?php foreach ($editions as $edition) : ?>
                <figure class="w-40 sm:w-auto inline-block lg:first:ml-12 last:ml-12 shadow-cover rounded-lg">
                    <a class="" href="<?= $edition->url() ?>" target="_blank">
                        <?= $edition->getCover('rounded-t-lg') ?>
                        <figcaption class="py-1 text-sm text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= $edition->edition() ?></figcaption>
                    </a>
                </figure>
                <?php endforeach ?>
            </div>
        </div>
    </header>
    <hr>
    <?php endif ?>
    <section class="container">
        <?php if (param($parameter)) : ?>
        <h2 class="mb-12 flex items-center">
            <span class="mr-10 font-bold font-small-caps"><?= t('Alle Lesetipps:' . $parameter) ?>:</span>
            <a class="py-2 px-4 sketch text-6xl text-white hover:text-white bg-red-light hover:bg-red-medium hover:line-through rounded-lg outline-none" href="<?= $page->url() ?>">
                <?= rawurldecode(param($parameter)) ?>
            </a>
        </h2>
        <?php else : ?>
        <h2 class="mb-12 text-center"><?= t('Alle Lesetipps') ?></h2>
        <?php endif ?>
        <?php snippet('lesetipps/articles', ['lesetipps' => $lesetipps]) ?>
    </section>
</article>

<?php snippet('navigation/pagination') ?>

<?php snippet('footer') ?>
