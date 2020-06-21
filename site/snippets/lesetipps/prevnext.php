<div class="container">
    <nav class="mb-12 flex sketch text-5xl select-none">
        <?php
            if ($page->hasNextListed()) :
            $nextTitle = implode(': ', [t('Nächster Lesetipp'), $page->nextListed()->title()->html()]);
        ?>
        <a class="h-20 flex-1 flex justify-around items-center text-white text-shadow rounded-l-lg bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $page->nextListed()->url() ?>" rel="next" title="<?= $nextTitle ?>">
            <?= $site->useSVG(t('Nächster Lesetipp'), 'w-auto h-10 fill-current', 'arrow-left') ?>
            <span class="hidden md:inline"><?= t('Nächster Lesetipp') ?></span>
        </a>
        <?php else : ?>
        <span class="h-20 flex-1 rounded-l-lg bg-red-light opacity-75 cursor-not-allowed" title="<?= t('Hier geht es nicht weiter!') ?>"></span>
        <?php
            endif;
            if ($page->hasPrevListed()) :
                $prevTitle = implode(': ', [t('Letzter Lesetipp'), $page->prevListed()->title()->html()]);
        ?>
        <a class="h-20 flex-1 flex justify-around items-center text-white text-shadow rounded-r-lg bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $page->prevListed()->url() ?>" rel="prev" title="<?= $prevTitle ?>">
            <span class="hidden md:inline"><?= t('Letzter Lesetipp') ?></span>
            <?= $site->useSVG(t('Letzter Lesetipp'), 'w-auto h-10 fill-current', 'arrow-right') ?>
        </a>
        <?php else : ?>
        <span class="h-20 flex-1 rounded-r-lg bg-red-light opacity-75 cursor-not-allowed" title="<?= t('Hier geht es nicht weiter!') ?>"></span>
        <?php endif ?>
    </nav>
</div>
