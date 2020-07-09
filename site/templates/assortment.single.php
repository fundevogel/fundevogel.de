<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php snippet('cover') ?>
            </div>
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
                <?= useSVG(t('Auswahl unserer Lieblinge'), 'wave-icon', 'book-closed-filled') ?>
            </div>
            <h2 class="wave-title"><?= t('Auswahl unserer Lieblinge') ?></h2>
            <div class="js-slider mb-10">
                <?php
                    foreach ($favorites as $favorite) :
                    $favoriteTitle = $favorite->title()->isNotEmpty()
                        ? $favorite->title()->html()
                        : $favorite->book_title()->html()
                    ;

                    if ($image = $favorite->book_cover()->toFile()) :
                    $titleAttribute = $image->titleAttribute()->html();
                    $altAttribute = $image->altAttribute()->html();

                    $cover = $image->thumb('lesetipps.article.cover-normal');
                    // $blurry = $image->thumb('lesetipps.category.cover.placeholder');
                ?>
                <div class="">
                    <div class="container">
                        <div class="flex flex-col lg:flex-row">
                            <div class="flex-none flex justify-center">
                                <div class="flex items-center mb-10 lg:mb-0">
                                    <div class="relative">
                                        <?php if ($favorite->isSeries()->bool()) : ?>
                                        <span class="absolute px-3 py-1 font-bold font-small-caps text-sm text-white text-shadow tracking-wide bg-orange-medium rounded-lg select-none" style="left: -1.5rem; top: 1rem">
                                            <?= t('Serie') ?>
                                        </span>
                                        <?php endif ?>
                                        <img
                                            class="rounded-lg shadow-cover"
                                            src="<?= $cover->url() ?>"
                                            title="<?= $titleAttribute ?>"
                                            alt="<?= $altAttribute ?>"
                                            width="<?= $cover->width() ?>"
                                            height="<?= $cover->height() ?>"
                                        >
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
            <div class="js-controls mb-px flex justify-center">
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
                <?php
                    endforeach
                ?>
            </div>
        </div>
        <?= useSeparator('orange-light', 'bottom-reversed') ?>
    </aside>
    <section class="container">
        <?= $page->parent()->conclusion()->kt() ?>
    </section>
    <?php endif ?>
    <hr>
    <section class="container xl:px-8">
        <h2 class="mb-12 text-center"><?= t('Sortiment-Überschrift') ?></h2>
        <?php snippet('assortment/navigation') ?>
    </section>
</article>

<?php snippet('footer') ?>
