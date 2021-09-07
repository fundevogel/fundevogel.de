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
<hr>
<section class="container">
    <h2 class="mb-0 text-center"><?= t('Alle Empfehlungslisten') ?></h2>
    <?php
        $count = 0;
        foreach ($kirby->collection('bibliolists/editions')->groupBy('year')->flip() as $year => $editions) :
    ?>
    <div class="mt-16 flex flex-col lg:flex-row">
        <div class="mt-12<?php e($count % 2 == 0, ' lg:ml-12', ' lg:mr-12') ?> flex-none flex justify-center<?php e($count % 2 == 0, ' lg:order-last', ' lg:order-first') ?>">
            <?php
                foreach ($editions as $edition) :
                $pdf = $edition->pdf();
            ?>
            <div class="last:ml-4 xs:last:ml-6 sm:last:ml-10 group table relative">
                <figure class="rounded-lg">
                    <?= $edition->getFront('rounded-t-lg') ?>
                    <figcaption class="small-caption is-pdf"><?= t($edition->edition()->value()) ?></figcaption>
                </figure>
                <div class="inset-0 w-full h-full flex flex-col absolute opacity-0 group-hover:opacity-100 rounded-lg bg-red-light transition-all z-25">
                    <?php if ($edition->hasChildren()) : ?>
                        <a
                            class="flex-1 flex flex-col justify-center items-center font-normal text-center text-white hover:bg-red-medium rounded-t-lg transition-all"
                            href="<?= $pdf->url() ?>" download="<?= $pdf->filename() ?>"
                        >
                            <?= useSVG('Download', 'w-8 lg:w-10 h-auto text-white fill-current') ?>
                            <span class="md:text-lg"><?= t('Download') ?></span>
                            <span class="mt-1 text-xs md:text-sm"><?= t('als PDF') ?> &middot; <?= $pdf->niceSize() ?></span>
                        </a>
                        <a
                            class="flex-1 flex flex-col justify-center items-center font-normal text-center text-white hover:bg-red-medium rounded-b-lg transition-all"
                            href="<?= $edition->url() ?>"
                        >
                            <?= useSVG('Browser', 'w-8 lg:w-10 h-auto text-white fill-current') ?>
                            <span class="md:text-lg"><?= t('Online') ?></span>
                            <span class="mt-1 text-xs md:text-sm"><?= t('im Browser anzeigen') ?></span>
                        </a>
                    <?php else : ?>
                    <a href="<?= $pdf->url() ?>" download="<?= $pdf->filename() ?>">
                        <?php snippet('components/shared/gradient-overlay', ['data' => $pdf]) ?>
                    </a>
                    <?php endif ?>
                </div>
            </div>
            <?php endforeach ?>
        </div>
        <div class="flex-1 mt-8 lg:mt-0 flex flex-col justify-center">
            <h3 class="text-6xl text-center"><?= $year ?></h3>
            <?= $page->children()->find($year)->text()->kt() ?>
        </div>
    </div>
    <?php e($year != $kirby->collection('bibliolists/volumes')->first()->title()->value(), '<hr class="max-w-sm">') ?>
    <?php
        $count++;
        endforeach;
    ?>
</section>

<?php snippet('blocks/info', ['block' => $page]) ?>

<?php snippet('footer') ?>
