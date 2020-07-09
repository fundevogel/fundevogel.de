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
