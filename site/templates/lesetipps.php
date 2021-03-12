<?php snippet('header') ?>

<?php if ($pagination->page() === 1 || count($lesetipps) === 0) : ?>
<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 lg:ml-12 flex-none flex justify-center">
            <?php
                foreach ($editions as $edition) :
                $caption = t($edition->edition()->value());
            ?>
            <?php snippet('lesetipps/edition', compact('edition', 'caption')) ?>
            <?php endforeach ?>
        </div>
    </div>
</header>
<hr>
<?php endif ?>
<section class="container">
    <?php if (param($parameter)) : ?>

    <h2 class="mb-12 flex flex-col items-center">
        <span class="mb-8 font-bold font-small-caps"><?= tp('Alle XY Lesetipps:' . $parameter, ['count' => $total]) ?>:</span>
        <a class="py-2 px-4 sketch text-5xl text-white hover:text-white bg-red-light hover:bg-red-medium hover:line-through rounded-lg outline-none" href="<?= $page->url() ?>">
            <?= rawurldecode(param($parameter)) ?>
        </a>
    </h2>
    <?php else : ?>
    <h2 class="mb-12 text-center"><?= t('Alle Lesetipps') ?></h2>
    <?php endif ?>
    <?php if ($total > 0) : ?>
    <?php snippet('lesetipps/articles', compact('lesetipps')) ?>
    <?php else : ?>
    <p class="italic text-center"><?= t('Keine Lesetipps') ?></p>
    <?php endif ?>
</section>
<footer class="mt-16">
    <?php snippet('lesetipps/pagination') ?>
<footer>

<?php snippet('footer') ?>
