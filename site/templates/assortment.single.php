<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none text-center">
            <?php snippet('cover') ?>
        </div>
    </div>
</header>
<?php if ($page->blocks()->isNotEmpty()) : ?>
<hr>
<?= $page->blocks()->toBlocks() ?>
<?php endif ?>
<?php if ($favorites->isNotEmpty()) : ?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG(t('Auswahl unserer Lieblinge'), 'title-icon', 'book-closed-filled') ?>
        </div>
        <h2 class="title"><?= t('Auswahl unserer Lieblinge') ?></h2>
        <div class="js-slider mb-10 overflow-hidden">
            <div class="flex">
                <?php
                    foreach ($favorites as $favorite) :

                    $book = $favorite->book()->toPage();
                    $title = $favorite->title()->isNotEmpty()
                        ? $favorite->title()->html()
                        : $book->title()->html()
                    ;

                    $text = $favorite->text()->isNotEmpty()
                        ? $favorite->text()->kt()
                        : $book->description()->kt()
                    ;
                ?>
                <div class="min-w-full relative">
                    <div class="container">
                        <div class="flex flex-col lg:flex-row">
                            <?php if ($image = $book->cover()->toFile()) : ?>
                            <div class="flex-none flex justify-center">
                                <div class="flex items-center mb-10 lg:mb-0">
                                    <a class="group relative rounded-lg" href="<?= $book->shop() ?>" target="_blank">
                                        <?php if ($book->isSeries()->bool()) : ?>
                                        <span class="badge bg-red-medium absolute top-4 -left-6 z-10">
                                            <?= t('Serie') ?>
                                        </span>
                                        <?php endif ?>
                                        <?= $image->createImage('rounded-lg', 'lesetipps.article.cover-normal', false, true) ?>
                                        <?php snippet('components/gradient-overlay', ['data' => $book]) ?>
                                    </a>
                                </div>
                            </div>
                            <?php endif ?>
                            <div class="md:ml-16 flex-1 flex flex-col justify-center">
                                <div class="mb-6">
                                    <h3 class="lg:text-2xl text-orange-medium"><?= $title ?></h3>
                                    <div class="lg:text-lg">
                                        <?= $text ?>
                                    </div>
                                </div>
                                <?php
                                    if ($favorite->quote()->isNotEmpty()) {
                                        echo kirbytag([
                                            'quote'  => $favorite->quote()->html(),
                                            'author'  => $favorite->person()->html(),
                                            'color' => 'orange',
                                        ]);
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="js-controls mt-12 mb-px flex justify-center">
                <?php
                    foreach ($favorites as $favorite) :

                    $book = $favorite->book()->toPage();
                    $title = $favorite->title()->isNotEmpty()
                        ? $favorite->title()->html()
                        : $book->title()->html()
                    ;
                ?>
                <span
                    class="js-tippy mx-1 inline-block w-4 h-4 bg-red-light hover:bg-red-medium rounded-full cursor-pointer transition-all"
                    title="<?= $title ?>"
                    data-tippy-placement="bottom"
                    data-tippy-theme="fundevogel red"
                ></span>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
<section class="container">
    <?= $page->parent()->conclusion()->kt() ?>
</section>
<?php endif ?>
<hr>
<footer>
    <?php snippet('assortment/navigation') ?>
</footer>

<?php snippet('footer') ?>
