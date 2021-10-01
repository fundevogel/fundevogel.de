<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none text-center">
            <?php if ($page == page('unser-netzwerk')) : ?>
            <p class="max-w-md mb-10 font-bold font-small-caps text-center text-red-medium inline-block lg:hidden">
                <?= $page->motto()->html() ?>
            </p>
            <?php endif ?>
            <?php snippet('cover') ?>
        </div>
    </div>
    <?php if ($page == page('unser-netzwerk')) : ?>
    <div class="mt-12 text-center">
        <p class="max-w-md font-bold font-small-caps text-red-medium hidden lg:inline-block">
            <?= $page->motto()->html() ?>
        </p>
    </div>
    <?php endif ?>
</header>
<hr>
<section class="container">
    <h2 class="mb-12 text-center"><?= t(Str::ucfirst($identifier) . '-Überschrift') ?></h2>
    <div class="js-masonry">
        <?php foreach($cards as $card) : ?>
        <div class="card is-dashed">
            <?= $card->entry()->kt() ?>
        </div>
        <?php endforeach ?>
    </div>
</section>

<?php snippet('footer') ?>
