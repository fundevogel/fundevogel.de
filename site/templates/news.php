<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <?= $page->text()->kt() ?>
        <?php if ($page->hasCover()) : ?>
        <div class="mt-6 text-center">
            <figure class="group inline-block shadow-cover rounded-lg overflow-hidden relative">
                <?= $page->getCover()->createImage('group-hover:opacity-75 rounded-lg transition-all', 'news.hero') ?>
                <figcaption class="transform py-2 group-hover:-translate-y-full text-5xl text-white text-shadow absolute w-full sketch bg-red-medium select-none transition-all"><?= $page->getCover()->caption()->html() ?></figcaption>
            </figure>
        </div>
        <?php endif ?>
    </header>
    <hr>
    <section class="js-list">
        <h2 class="mb-12 text-center"><?= t('Neues aus dem Fundevogel') ?></h2>
        <?php foreach($news as $article) : ?>
            <article class="js-article animation-fade-in">
                <div class="<?php e(count($images = $article->images()) < 3, 'container') ?>">
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
                            <a class="<?php e(count($images) > 2, 'm-4 ') ?>inline-block <?php e(count($images) === 2, 'last:ml-6 lg:last:ml-0 lg:last:mt-6 ') ?>rounded-lg select-none" href="<?= $image->thumb('news.article.full')->url() ?>" data-caption="<?= $image->caption()->html() ?>">
                                <?= $image->createImage('w-24 h-24 xs:w-32 xs:h-32 md:w-48 md:h-48 xl:w-56 xl:h-56 shadow-cover rounded-lg', 'news.article.image', true) ?>
                            </a>
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

                <?php e($article !== $articleLast, '<hr class="max-w-sm">', $nothingLeft) ?>

            </article>
        <?php endforeach ?>
    </section>

    <footer class="container">
        <nav class="js-hide mb-12 flex sketch text-5xl select-none">
            <?php if ($pagination->hasPrevPage()) : ?>
            <a class="h-20 flex-1 flex justify-around items-center text-white rounded-l-lg bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $pagination->prevPageURL() ?>" rel="prev" title="<?= t('Früheres--title') ?>">
                <?= useSVG(t('Früheres'), 'w-auto h-10 fill-current', 'arrow-left') ?>
                <span class="hidden md:inline"><?= t('Früheres') ?></span>
            </a>
            <?php else : ?>
            <span class="h-20 flex-1 rounded-l-lg bg-red-light opacity-75 cursor-not-allowed"></span>
            <?php
                endif;
                if ($pagination->hasNextPage()) :
            ?>
            <a class="js-target h-20 flex-1 flex justify-around items-center text-white rounded-r-lg bg-red-light hover:bg-red-medium transition-all outline-none" href="<?= $pagination->nextPageURL() ?>" rel="next" title="<?= t('Älteres--title') ?>">
                <span class="hidden md:inline"><?= t('Älteres') ?></span>
                <?= useSVG(t('Älteres'), 'w-auto h-10 fill-current', 'arrow-right') ?>
            </a>
            <?php else : ?>
            <span class="h-20 flex-1 rounded-r-lg bg-red-light opacity-75 cursor-not-allowed"></span>
            <?php endif ?>
        </nav>
        <button class="js-more w-full h-20 flex-1 flex justify-around items-center text-white rounded-lg bg-red-light hover:bg-red-medium transition-all outline-none nojs-hidden" type="button" title="<?= t('Frühere Neuigkeiten anzeigen') ?>">
            <span class="sketch text-5xl select-none"><?= t('Frühere Neuigkeiten') ?></span>
        </button>
    </footer>
</article>

<?php snippet('footer') ?>
