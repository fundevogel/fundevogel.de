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
        <?= $page->details()->kt() ?>
    </section>
    <hr class="max-w-sm">
    <section class="container xl:px-8">
        <h2 class="mb-12 text-center"><?= t('Sortiment-Überschrift') ?></h2>
        <?php snippet('assortment/navigation') ?>
    </section>
</article>

<?php snippet('footer') ?>
