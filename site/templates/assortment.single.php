<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
    </header>
    <?php if ($page->builder()->isNotEmpty()) : ?>
    <hr>
    <?php snippet('blocks') ?>
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
                        $favoriteTitle = $favorite->title()->isNotEmpty()
                            ? $favorite->title()->html()
                            : $favorite->book_title()->html()
                        ;

                    if ($image = $favorite->book_cover()->toFile()) :
                ?>
                <div class="min-w-full relative">
                    <div class="container">
                        <div class="flex flex-col lg:flex-row">
                            <div class="flex-none flex justify-center">
                                <div class="flex items-center mb-10 lg:mb-0">
                                    <div class="relative">
                                        <?php if ($favorite->isSeries()->bool()) : ?>
                                        <span class="badge absolute top-4 -left-6">
                                            <?= t('Serie') ?>
                                        </span>
                                        <?php endif ?>
                                        <?= $image->createImage('rounded-lg', 'lesetipps.article.cover-normal') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="md:ml-16 flex-1 flex flex-col justify-center">
                                <div class="mb-6">
                                    <h3 class="lg:text-2xl text-orange-medium"><?= $favoriteTitle ?></h3>
                                    <div class="lg:text-lg">
                                        <?= $favorite->text()->kt() ?>
                                    </div>
                                </div>
                                <?php if ($favorite->quote()->isNotEmpty()) : ?>
                                <blockquote class="m-0 p-0 border-0 border-orange-medium">
                                    <?= $favorite->quote()->kt() ?>
                                    <?php if ($favorite->person()->isNotEmpty()) : ?>
                                    <cite>
                                        <?= useSVG(t('quote'), 'inline w-6 h-6 -mt-1 mr-1 text-orange-medium fill-current', 'message-filled') ?>
                                        <span class="text-sm text-orange-medium not-italic font-normal"><?= $favorite->person()->html() ?></span>
                                    </cite>
                                    <?php endif ?>
                                </blockquote>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    endif;
                    endforeach;
                ?>
            </div>
            <div class="js-controls mt-12 mb-px flex justify-center">
                <?php
                    foreach ($favorites as $favorite) :
                    $favoriteTitle = $favorite->title()->isNotEmpty()
                        ? $favorite->title()->html()
                        : $favorite->book_title()->html()
                    ;
                ?>
                <span
                    class="js-tippy mx-1 inline-block w-4 h-4 bg-red-light hover:bg-red-medium rounded-full cursor-pointer transition-all"
                    title="<?= $favoriteTitle ?>"
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
