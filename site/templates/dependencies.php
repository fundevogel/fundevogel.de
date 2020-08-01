<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <h2 class="mb-12 text-center"><?= t('Verwendete Software') ?></h2>
        <div class="flex flex-col md:flex-row">
            <div class="mb-6 md:mb-0 flex-1">
                <?php snippet('dependencies/list', ['title' => 'PHP / Composer', 'data' => $phpData]) ?>
            </div>
            <div class="flex-1 md:ml-10">
                <?php snippet('dependencies/list', ['title' => 'JavaScript / Node', 'data' => $pkgData]) ?>
            </div>
        </div>
    </header>
</article>

<?php snippet('footer') ?>
