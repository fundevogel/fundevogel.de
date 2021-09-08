<?php snippet('header') ?>

<section class="container">
    <?php $count = 1; foreach ($books as $book) : ?>
    <article class="mt-12 flex flex-col lg:flex-row">
        <div class="flex-none flex justify-center items-center">
            <a class="group relative rounded-lg" href="<?php e($book->isAvailable()->bool() && $book->shop()->isNotEmpty(), $book->shop(), 'mailto:' . $site->mail()) ?>" target="_blank">
                <?php if ($book->isSeries()->bool()) : ?>
                <span class="badge bg-red-medium absolute top-4 -left-6 z-10">
                    <?= t('Serie') ?>
                </span>
                <?php endif ?>
                <?= $book->getBookCover('rounded-lg') ?>
                <?php snippet('components/shared/gradient-overlay', ['data' => $book]) ?>
            </a>
        </div>
        <div class="md:ml-10 flex-1 flex flex-col justify-center">
            <span class="font-medium text-xs"><?= $book->author() ?></span>
            <h3><?= $book->title() ?></h3>
            <p class="content">
                <?= $book->text() ?>
            </p>
        </div>
    </article>
    <?php
        e($count != $books->count(), '<hr class="max-w-sm">');
        $count++; endforeach;
    ?>
</section>

<footer class="mt-16">
    <div class="container">
        <nav class="mb-12 flex sketch text-4xl lg:text-5xl select-none">
            <?php if ($page->hasPrevListed()) : ?>
            <a
                class="h-20 flex-1 flex justify-around items-center text-white text-shadow rounded-l-lg bg-red-light hover:bg-red-medium transition-all outline-none"
                href="<?= $page->prevListed()->url() ?>"
                title="<?= $page->prevListed()->title() ?>"
                rel="next"
            >
                <?= useSVG(t('Nächster Lesetipp'), 'w-auto h-10 fill-current', 'arrow-left') ?>
                <span class="hidden md:inline"><?= $page->prevListed()->title() ?></span>
            </a>
            <?php else : ?>
            <span class="h-20 flex-1 rounded-l-lg bg-red-light opacity-75 cursor-not-allowed" title="<?= t('Hier geht es nicht weiter!') ?>"></span>
            <?php
                endif;
                if ($page->hasNextListed()) :
            ?>
            <a
                class="h-20 flex-1 flex justify-around items-center text-white text-shadow rounded-r-lg bg-red-light hover:bg-red-medium transition-all outline-none"
                href="<?= $page->nextListed()->url() ?>"
                title="<?= $page->nextListed()->title() ?>"
                rel="prev"
            >
                <span class="hidden md:inline"><?= $page->nextListed()->title() ?></span>
                <?= useSVG(t('Letzter Lesetipp'), 'w-auto h-10 fill-current', 'arrow-right') ?>
            </a>
            <?php else : ?>
            <span class="h-20 flex-1 rounded-r-lg bg-red-light opacity-75 cursor-not-allowed" title="<?= t('Hier geht es nicht weiter!') ?>"></span>
            <?php endif ?>
        </nav>
    </div>
</footer>

<?php snippet('footer') ?>
