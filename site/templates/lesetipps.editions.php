<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 lg:ml-12 flex-none flex justify-center">
            <?php foreach ($editions as $edition) : ?>
            <?php snippet('lesetipps/edition', compact('edition')) ?>
            <?php endforeach ?>
        </div>
    </div>
</header>
<hr>

<?php snippet('footer') ?>
