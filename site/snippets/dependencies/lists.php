<section class="container">
    <h2 class="mb-12 text-center"><?= t('Verwendete Software') ?></h2>
    <div class="flex flex-col md:flex-row">
        <div class="mb-6 md:mb-0 flex-1">
            <?php snippet('dependencies/shared/list', ['title' => 'Composer (PHP)', 'data' => $phpData]) ?>
        </div>
        <div class="flex-1 md:ml-10">
            <?php snippet('dependencies/shared/list', ['title' => 'JavaScript & TypeScript', 'data' => $pkgData]) ?>
        </div>
    </div>
</section>
