<?php snippet('header') ?>

<article class="mb-16">
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
        <h2 class="mb-12 text-center"><?= t('Alle Empfehlungslisten') ?></h2>
        <div class="js-masonry">
            <?php
                foreach ($editions as $edition) :
                $caption = implode(' ', [t($edition->edition()->value()), $edition->year()]);
            ?>

                <div class="flex justify-center">
                    <?php snippet('lesetipps/edition', compact('edition', 'caption')) ?>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    <?php snippet('blocks/info', ['data' => $page]) ?>
</article>

<?php snippet('footer') ?>
