<?php snippet('header') ?>

<article class="mb-16">
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
    <?php if ($page->builder()->isNotEmpty()) : ?>
    <?php snippet('blocks') ?>
    <?php endif ?>
    <section class="container">
        <h2 class="mb-12 text-center"><?= t('Verwendete Software') ?></h2>
        <div class="flex flex-col md:flex-row">
            <div class="mb-6 md:mb-0 flex-1">
                <?php snippet('dependencies/list', ['title' => 'PHP / Composer', 'data' => $phpData]) ?>
            </div>
            <div class="flex-1 md:ml-10">
                <?php snippet('dependencies/list', ['title' => 'JavaScript / Node', 'data' => $pkgData]) ?>
            </div>
        </div>
    </section>
    <hr>
    <section class="container">
        <?= $page->misc()->kt() ?>
    </section>
</article>

<?php snippet('footer') ?>
