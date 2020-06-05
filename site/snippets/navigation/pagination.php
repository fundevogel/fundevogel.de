<?php if ($pagination->pages() > 1) : ?>
<div class="container">
    <nav class="w-full mb-12 flex justify-between sketch text-5xl select-none">
        <?php if ($pagination->hasPrevPage()) : ?>
        <a class="h-20 flex-1 flex justify-center items-center bg-red-light rounded-l-lg hover:bg-red-medium text-white transition-all outline-none" href="<?= $pagination->firstPageURL() ?>">
            <?= $site->useSVG(t('lesetipps_neuere-lesetipps'), 'w-auto h-10 fill-current', 'arrow-left') ?>
        </a>
        <?php endif ?>
        <?php foreach ($pagination->range(5) as $r): ?>
            <?php if ($pagination->page() === $r) : ?>
            <span class="h-20 flex-1 hidden md:flex justify-center items-center bg-red-medium text-white text-shadow cursor-not-allowed<?= $pagination->isFirstPage() ? ' rounded-l-lg' : '' ?><?= $pagination->isLastPage() ? ' rounded-r-lg' : '' ?>" aria-current="page">
                <?= $r ?>
            </span>
            <?php else : ?>
            <a class="h-20 flex-1 hidden md:flex justify-center items-center bg-red-light hover:bg-red-medium text-white text-shadow transition-all outline-none" href="<?= $pagination->pageURL($r) ?>">
                <?= $r ?>
            </a>
            <?php endif ?>
        </a>
        <?php endforeach ?>
        <?php if ($pagination->hasNextPage()) : ?>
        <a class="h-20 flex-1 flex justify-center items-center bg-red-light rounded-r-lg hover:bg-red-medium text-white transition-all outline-none" href="<?= $pagination->lastPageURL() ?>"><?= $site->useSVG(t('lesetipps_aeltere-lesetipps'), 'w-auto h-10 fill-current', 'arrow-right') ?></a>
        <?php endif ?>
    </nav>
</div>
<?php endif ?>
