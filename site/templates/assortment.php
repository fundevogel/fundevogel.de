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
    <section class="container xl:px-8">
        <h2 class="mb-12 text-center"><?= t('Alle Kategorien im Überblick') ?></h2>
        <?php snippet('assortment/navigation') ?>
    </section>
</article>

<?php snippet('footer') ?>
