<?php snippet('header') ?>

<header class="container">
    <div class="flex">
        <div class="flex-1">
            <?= $page->intro()->kt() ?>
        </div>
        <div class="mt-12 ml-12 flex-none hidden md:flex justify-center">
            <div class="">
                <?php snippet('lesetipps/edition', ['edition' => $page->pdf()]) ?>
            </div>
        </div>
    </div>
</header>
<hr>
<section class="container">
    <h2 class="mb-12 text-center"><?= t('Alle Kategorien') ?></h2>
    <div class="flex flex-wrap">
    <?php foreach ($chapters as $chapter) : ?>
    <h3 class="m-0 <?php e($chapter == $chapters->last() && $chapter->isOdd(), 'w-full', 'w-1/2') ?> sketch text-4xl lg:text-5xl select-none">
        <a
            class="mx-1 my-1 h-20 flex justify-center items-center text-white text-shadow rounded-lg bg-red-light hover:bg-red-medium transition-all outline-none"
            href="<?= $chapter->url() ?>"
            title="<?= $chapter->title() ?>"
        >
            <?= $chapter->title() ?>
        </a>
    </h3>
    <?php endforeach ?>
    </div>
</section>

<?php snippet('footer') ?>
