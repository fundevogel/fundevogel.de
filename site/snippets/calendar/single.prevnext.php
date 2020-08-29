<div class="container">
    <nav class="flex sketch text-5xl select-none">
        <?php
            foreach ($siblings as $sibling) :
            $isFirst = $sibling === $siblings->first();
            $isLast = $sibling === $siblings->last();
        ?>
        <a class="h-20 flex-1 flex justify-around items-center text-white text-shadow <?php e($isFirst, 'rounded-l-lg ', 'rounded-r-lg ') ?>bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $sibling->url() ?>" rel="<?php e($isFirst, 'prev', 'next') ?>" title="<?= $sibling->title()->html() ?>">
            <?php if ($isFirst) : ?>
                <?= useSVG($sibling->title()->html(), 'w-auto h-10 fill-current', 'arrow-left') ?>
            <?php endif ?>
            <span class="hidden md:inline"><?= $sibling->handle()->html() ?></span>
            <?php if ($isLast) : ?>
                <?= useSVG($sibling->title()->html(), 'w-auto h-10 fill-current', 'arrow-right') ?>
            <?php endif ?>
        </a>
        <?php endforeach ?>
    </nav>
</div>
