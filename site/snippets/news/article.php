<div class="<?php e(count($images = $article->images()->filterBy('extension', 'not in', ['avif', 'webp'])) < 3, 'container') ?>">
    <div class="flex flex-col <?php e(count($images) < 3, 'lg:flex-row ') ?> justify-center">
        <?php if ($images) : ?>
        <?php if (count($images) > 2) : ?>
        <aside class="wave mt-12 mb-0">
        <?= useSeparator('orange-light', 'top') ?>
        <div class="inner">
        <div class="container">
        <?php endif ?>

        <div class="js-lightbox <?php e(count($images) < 3, 'lg:mt-10 mb-8 lg:mb-0 ') ?><?php e(count($images) < 3, 'lg:ml-12 lg:flex lg:flex-col ') ?>flex-none text-center">
            <?php foreach ($images as $image) : ?>
            <?php
                $id = $article->uid();
                if ($image) :
            ?>
            <div class="<?php e(count($images) > 2, 'm-2 xs:sm-4 ') ?>inline-block <?php e(count($images) === 2, 'last:ml-6 lg:last:ml-0 lg:last:mt-6 ') ?>rounded-lg group overflow-hidden select-none">
                <?= $image->createImage('h-auto' . r(count($images) === 1, ' w-40 ', ' w-24 xs:w-40 ') . 'sm:w-48 xl:w-56 rounded-lg transition-transform duration-350 transform group-hover:scale-110 cursor-pointer', 'news.article.image', true) ?>
            </div>
            <?php endif ?>
            <?php endforeach ?>
        </div>

        <?php if (count($images) > 2) : ?>
        </div>
        </div>
        <?= useSeparator('orange-light', 'bottom') ?>
        </aside>
        <?php endif ?>
        <?php endif ?>

        <div class="flex-initial <?php e(count($images) < 3, 'lg:order-first ', 'order-first ') ?>flex justify-center">
            <div class="<?php e(count($images) > 2, 'container') ?>">
                <time datetime="<?= $article->date()->toDate('Y-m-d') ?>">
                    <?= $article->date()->toDate('d.m.Y') ?>
                    <?php e($article->subtitle()->isNotEmpty(), '&mdash; ' . $article->subtitle()->html()) ?>
                </time>
                <h3><?= $article->title()->html() ?></h3>
                <?= $article->text()->kt() ?>
            </div>
        </div>
    </div>
</div>
