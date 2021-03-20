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
<?php if ($page->blocks()->isNotEmpty()) : ?>
<hr>
<?= $page->blocks()->toBlocks() ?>
<?php endif ?>
<?php if ($favorites->isNotEmpty()) : ?>
<?php snippet('components/book-wave', $data) ?>
<section class="container">
    <?= $page->parent()->conclusion()->kt() ?>
</section>
<?php endif ?>
<hr>
<footer>
    <?php snippet('assortment/navigation') ?>
</footer>

<?php snippet('footer') ?>
