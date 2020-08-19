<?php snippet('header') ?>

<article class="mb-16">
    <?php if ($pagination->page() === 1 || count($lesetipps) === 0) : ?>
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mt-12 lg:ml-12 flex-none flex justify-center">
                <?php foreach ($editions as $edition) : ?>
                <a class="last:ml-10 group table relative" href="<?= $edition->url() ?>" target="_blank">
                    <figure class="w-24 xs:w-40 sm:w-auto rounded-lg">
                        <?= $edition->getFront('rounded-t-lg') ?>
                        <figcaption class="py-1 sm:py-2 text-xs sm:text-sm text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= t($edition->edition()->value()) ?></figcaption>
                    </figure>
                    <div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-red-medium transition-all z-25">
                        <div class="h-full flex flex-col justify-center items-center">
                            <?= useSVG('Download', 'w-12 h-12 text-white fill-current', 'download') ?>
                            <span class="font-normal text-lg sm:text-xl text-white">Download</span>
                        </div>
                    </div>
                </a>
                <?php endforeach ?>
            </div>
        </div>
    </header>
    <hr>
    <?php endif ?>
    <section class="container">
        <?php if (param($parameter)) : ?>
        <h2 class="mb-12 flex flex-col items-center">
            <span class="mb-8 font-bold font-small-caps"><?= t('Alle Lesetipps:' . $parameter) ?>:</span>
            <a class="py-2 px-4 sketch text-6xl text-white hover:text-white bg-red-light hover:bg-red-medium hover:line-through rounded-lg outline-none" href="<?= $page->url() ?>">
                <?= rawurldecode(param($parameter)) ?>
            </a>
        </h2>
        <?php else : ?>
        <h2 class="mb-12 text-center"><?= t('Alle Lesetipps') ?></h2>
        <?php endif ?>
        <?php if (count($lesetipps) === 0) : ?>
        <p class="italic text-center"><?= t('Keine Lesetipps') ?></p>
        <?php else : ?>
        <?php snippet('lesetipps/articles', ['lesetipps' => $lesetipps]) ?>
        <?php endif ?>
    </section>
</article>

<?php snippet('lesetipps/pagination') ?>

<?php snippet('footer') ?>
