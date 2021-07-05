<?php snippet('header') ?>
<?php if ($site->coronaMode()->toBool()) : ?>

<section class="warning bg-red-medium text-white">
    <div class="container">
        <div class="text">
            <?= $site->coronaText()->kt() ?>
        </div>
    </div>
    <div class="container">
    <div class="list spread-out">
        <div>
        <a href="tel:+4976125218">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span class="text">0761 / 25218</span>
        </a>
        </div>
        <div>
        <a href="mailto:info@fundevogel.de?subject=Bestellung" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            <span class="text">info@fundevogel.de</span>
        </a>
        </div>
        <div>
        <a href="<?= $site->shop() ?>" title="Shop" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="text">Unser Online-Shop</span>
        </a>
        </div>
        <!-- <div>
        <a href="https://fundevogel.de/lesetipps">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span class="text">Webseite</span>
        </a>
        </div> -->
    </div>
    </div>
</section>
<?php endif ?>

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
    <?php foreach ($news as $article) : ?>
    <article id="<?= $article->slug() ?>" class="js-article animation-fade-in">
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
