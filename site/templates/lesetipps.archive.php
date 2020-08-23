<?php snippet('header') ?>

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
    <div class="js-masonry">
        <?php foreach ($editions as $edition) : ?>
            <div class="flex justify-center">
                <?php snippet('lesetipps/edition', ['edition' => $edition, 'isArchive' => true]) ?>
            </div>
        <?php endforeach ?>
    </div>
</section>
<?php snippet('blocks/info', ['data' => $page]) ?>


<?php snippet('footer') ?>
