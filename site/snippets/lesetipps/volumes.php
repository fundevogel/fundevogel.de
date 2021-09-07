<?php
    $count = 0;
    foreach ($page->children()->unlisted()->flip() as $volume) :
?>
<div class="mt-16 flex flex-col lg:flex-row">
    <div class="mt-12<?php e($count % 2 == 0, ' lg:ml-12', ' lg:mr-12') ?> flex-none flex justify-center<?php e($count % 2 == 0, ' lg:order-last', ' lg:order-first') ?>">
        <?php foreach ($volume->files()->filterBy('template', 'pdf') as $edition) : ?>
        <a class="last:ml-4 xs:last:ml-6 sm:last:ml-10 group table relative" href="<?= $edition->url() ?>" download="<?= $edition->filename() ?>">
            <figure class="rounded-lg">
                <?= $edition->getFront('rounded-t-lg') ?>
                <figcaption class="small-caption is-pdf"><?= t($edition->edition()->value()) ?></figcaption>
            </figure>
            <?php // TODO: insert condition ?>
            <?php if (1 == 1) : ?>
            <div class="inset-0 w-full h-full flex flex-col absolute opacity-0 group-hover:opacity-100 rounded-lg bg-red-light transition-all z-25">
                <div class="flex-1 flex flex-col justify-center items-center font-normal text-center text-white hover:bg-red-medium rounded-t-lg transition-all">
                    <?= useSVG('Download', 'w-6 md:w-8 h-auto text-white fill-current') ?>
                    <span class="text-lg lg:text-xl">Download</span>
                    <span class="mt-1 text-xs lg:text-sm"><?= t('als PDF') ?> (<?= $edition->niceSize() ?>)</span>
                </div>
                <div class="flex-1 flex flex-col justify-center items-center font-normal text-center text-white hover:bg-red-medium rounded-b-lg transition-all">
                    <?= useSVG('Browser', 'w-6 md:w-8 h-auto text-white fill-current') ?>
                    <span class="text-lg xl:text-xl">Online</span>
                    <span class="mt-1 text-xs xl:text-sm"><?= t('im Browser anzeigen') ?></span>
                </div>
            </div>
            <?php else : ?>
            <?php snippet('components/shared/gradient-overlay', ['data' => $edition]) ?>
            <?php endif ?>
        </a>
        <?php endforeach ?>
    </div>
    <div class="flex-1 mt-8 lg:mt-0 flex flex-col justify-center">
        <h3 class="text-6xl text-center"><?= $volume->title()->html() ?></h3>
        <?= $volume->text()->kt() ?>
    </div>
</div>
<?php e($volume !== $page->children()->unlisted()->flip()->last(), '<hr class="max-w-sm">') ?>
<?php
    $count++;
    endforeach;
?>
