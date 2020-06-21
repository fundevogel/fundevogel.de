<?php snippet('header') ?>

<article class="mb-16">
    <?php if ($total === 0 || $pagination->page() === 1) : ?>
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
    <?php endif ?>
    <?php snippet('lesetipps/browse.form') ?>
    <?php if ($total > 0) : ?>
    <hr>
    <section class="container">
        <h2 class="mb-12 text-center"><?= tp('Deine Suche ergab XY Treffer', ['count' => $total]) ?></h2>
        <?php snippet('lesetipps/articles', ['lesetipps' => $results]) ?>
    </section>
    <?php endif ?>
</article>

<?php if ($total > 0) : ?>
<?php snippet('lesetipps/pagination') ?>
<?php endif ?>

<?php snippet('footer') ?>
