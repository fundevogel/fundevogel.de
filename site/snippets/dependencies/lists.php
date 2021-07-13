<section class="container">
    <?= $page->software()->kt() ?>
    <hr class="max-w-sm">
    <div class="flex flex-col md:flex-row">
        <div class="mb-6 md:mb-0 flex-1">
            <?php snippet('dependencies/shared/list', ['field' => 'phpData']) ?>
        </div>
        <div class="flex-1 md:ml-10">
            <?php snippet('dependencies/shared/list', ['field' => 'pkgData']) ?>
        </div>
    </div>
</section>
