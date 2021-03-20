<?php snippet('header') ?>

<header class="container">
    <time datetime="<?= $page->date()->toDate('Y-m-d') ?>"><?= $page->date()->toDate('d.m.Y') ?></time>
    <h2><?= $page->title()->html() ?></h2>
    <?php if ($page->hasAward()) snippet('lesetipps/award/intro') ?>
    <?= $page->text()->kt() ?>
</header>
<?php if ($page->isAdvanced()->bool()) : ?>
<?= $page->blocks()->toBlocks() ?>
<?php else : ?>
<?php snippet('components/book-wave', $data) ?>
<?php if ($page->conclusion()->isNotEmpty()) : ?>
<section class="container">
    <?= $page->conclusion()->kt() ?>
</section>
<?php endif ?>
<?php endif ?>
<?php if ($page->hasAward()) : ?>
<aside class="container">
    <div class="mt-12 card is-dashed">
        <?php snippet('lesetipps/award/' . $page->getAward()['identifier']) ?>
    </div>
</aside>
<?php endif ?>
<?php if ($page->hasTranslatedSiblings()) : ?>
<footer class="mt-16">
    <?php snippet('lesetipps/prevnext') ?>
</footer>
<?php endif ?>

<?php snippet('footer') ?>
