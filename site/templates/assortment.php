<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none flex justify-center items-center">
            <div class="lg:ml-12">
                <?php snippet('components/caption-gallery', compact('images', 'caption')) ?>
            </div>
        </div>
    </div>
</header>
<hr>
<section class="container">
    <?= $page->details()->kt() ?>
</section>
<hr>
<section class="container">
    <h2 class="mb-0 text-center"><?= t('Sortiment-Überschrift') ?></h2>
    <?php snippet('assortment/overview') ?>
</section>

<?php snippet('footer') ?>
