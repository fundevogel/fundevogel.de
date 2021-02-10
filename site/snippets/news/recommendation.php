<div class="flex flex-col justify-center">
    <?php if ($article->books()->isNotEmpty()) : ?>
        <aside class="wave">
            <?= useSeparator('orange-light', 'top-reversed') ?>
            <div class="inner">
                <div class="text-center">
                    <?= useSVG(t('Unsere Bücher des Monats'), 'title-icon', 'book-closed-filled') ?>
                </div>
                <h2 class="title">
                    <?= t('Unsere Bücher des Monats') ?>
                    <span class="block"><?= t($article->month()->value()) ?></span>
                </h2>

                <div class="js-slider mb-10 overflow-hidden">
                    <div class="flex">
                        <?php
                            foreach ($article->books()->toStructure() as $favorite) :

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
                                                <?php
                                                    $details = ' &middot; ' . $book->price() . ' €';

                                                    if ($book->age()->isNotEmpty()) {
                                                        $details = $book->age() . $details;
                                                    } else {
                                                        if ($book->isAudiobook()) {
                                                            $details = A::join([$book->duration(), t('Minuten'), $details], ' ');
                                                        } else {
                                                            $details = A::join([$book->pageCount(), t('Seiten'), $details], ' ');
                                                        }
                                                    }

                                                    snippet('download', [
                                                        'file' => $image,
                                                        'details' => $details,
                                                        'caption' => t('Zum Shop'),
                                                        'icon' => 'cart'
                                                    ])
                                                ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <div class="js-controls mt-12 mb-px flex justify-center">
                        <?php
                            foreach ($article->books()->toStructure() as $favorite) :

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
    <?php endif ?>
</div>
