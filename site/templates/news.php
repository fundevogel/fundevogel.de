<?php snippet('header') ?>

<header class="container">
    <?= $page->text()->kt() ?>
    <?php if ($page->hasCover()) : ?>
    <div class="mt-6">
        <?php snippet('news/hero') ?>
    </div>
    <?php endif ?>
</header>
<hr>
<section class="js-list">
    <h2 class="mb-12 text-center"><?= t('Neues aus dem Fundevogel') ?></h2>
    <?php foreach($news as $article) : ?>
    <article class="js-article animation-fade-in">
        <?php snippet(Str::replace($article->intendedTemplate(), '.', '/'), compact('article')) ?>
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

<?php snippet('footer') ?>
