<?php if ($data->books()->isNotEmpty()) : ?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top') ?>
    <div class="inner">
        <div class="text-center">
            <?= useSVG($data->heading()->html(), 'wave-icon', 'star') ?>
        </div>
        <h2 class="wave-title"><?= $data->heading()->html() ?></h2>
        <div class="js-slider swiper-container mb-10">
            <div class="swiper-wrapper">
                <?php
                    foreach ($data->books()->toStructure() as $book) :
                    $bookTitle = $book->book_subtitle()->isNotEmpty()
                        ? $book->book_title()->html() . '. ' . $book->book_subtitle()->html()
                        : $book->book_title()->html()
                    ;

                    if ($image = $book->book_cover()->toFile()) :
                ?>
                <div class="swiper-slide">
                    <div class="container">
                        <div class="flex flex-col lg:flex-row">
                            <div class="flex-none flex justify-center">
                                <div class="flex items-center mb-10 lg:mb-0">
                                    <?= $image->createImage('rounded-lg', 'lesetipps.article.cover-normal') ?>
                                </div>
                            </div>
                            <div class="md:ml-16 flex-1 flex flex-col justify-center">
                                <div class="mb-6">
                                    <span class="text-xs font-medium"><?= $book->author()->html() ?></span>
                                    <h3 class="lg:text-2xl text-orange-medium"><?= $bookTitle ?></h3>
                                    <div class="lg:text-lg">
                                        <?= $book->text()->kt() ?>
                                    </div>
                                </div>
                                <?php if ($book->quote()->isNotEmpty()) : ?>
                                <blockquote class="m-0 p-0 border-0 border-orange-medium">
                                    <?= $book->quote()->kt() ?>
                                    <?php if ($book->person()->isNotEmpty()) : ?>
                                    <cite>
                                        <?= useSVG(t('quote'), 'inline w-6 h-6 -mt-1 mr-1 text-orange-medium fill-current', 'message-filled') ?>
                                        <span class="text-sm text-orange-medium not-italic font-normal"><?= $book->person()->html() ?></span>
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
            <div class="js-controls swiper-controls">
                <?php foreach ($data->books()->toStructure() as $book) : ?>
                <span
                    class="js-tippy mx-1 inline-block w-4 h-4 bg-red-light hover:bg-red-medium rounded-full cursor-pointer transition-all"
                    title="<?= $book->book_title()->html() ?>"
                    data-tippy-placement="bottom"
                    data-tippy-theme="fundevogel red"
                ></span>
                <?php
                    endforeach
                ?>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom') ?>
</aside>
<?php endif ?>
