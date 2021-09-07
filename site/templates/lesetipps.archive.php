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
    <h2 class="mb-0 text-center"><?= t('Alle Empfehlungslisten') ?></h2>
    <?php snippet('lesetipps/volumes') ?>
</section>

<?php snippet('blocks/info', ['block' => $page]) ?>

<?php snippet('footer') ?>
