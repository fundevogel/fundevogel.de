<div class="container">
    <nav class="mb-12 flex sketch text-5xl select-none">
        <?php if ($page->hasNextListed()): ?>
        <a class="h-20 flex-1 flex justify-around items-center text-white rounded-l-lg bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $page->nextListed()->url() ?>" rel="next" title="<?= $page->nextListed()->title()->html() ?>">
            <?= $site->useSVG(t('lesetipp_naechster-lesetipp'), 'w-auto h-10 fill-current', 'arrow-left') ?>
            <span class="hidden md:inline"><?= t('lesetipp_naechster-lesetipp') ?></span>
        </a>
        <?php else : ?>
        <span class="h-20 flex-1 rounded-l-lg bg-red-light opacity-75 cursor-not-allowed"></span>
        <?php
            endif;
            if ($page->hasPrevListed()) :
        ?>
        <a class="h-20 flex-1 flex justify-around items-center text-white rounded-r-lg bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $page->prevListed()->url() ?>" rel="prev" title="<?= $page->prevListed()->title()->html() ?>">
            <span class="hidden md:inline"><?= t('lesetipp_letzter-lesetipp') ?></span>
            <?= $site->useSVG(t('lesetipp_letzter-lesetipp'), 'w-auto h-10 fill-current', 'arrow-right') ?>
        </a>
        <?php else : ?>
        <span class="h-20 flex-1 rounded-r-lg bg-red-light opacity-75 cursor-not-allowed"></span>
        <?php endif ?>
    </nav>
  </div>
