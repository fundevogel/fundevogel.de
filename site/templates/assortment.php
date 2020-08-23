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
    <?= $page->details()->kt() ?>
</section>
<hr>
<footer>
    <?php snippet('assortment/navigation') ?>
</footer>

<?php snippet('footer') ?>
