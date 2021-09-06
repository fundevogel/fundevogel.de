<?php
    $count = 0;
    foreach ($page->children()->unlisted()->flip() as $volume) :
?>
<div class="mt-16 flex flex-col lg:flex-row">
    <div class="mt-12<?php e($count % 2 == 0, ' lg:ml-12', ' lg:mr-12') ?> flex-none flex justify-center<?php e($count % 2 == 0, ' lg:order-last', ' lg:order-first') ?>">
        <?php foreach ($volume->files()->filterBy('template', 'pdf') as $edition) : ?>
        <?php snippet('lesetipps/edition', compact('edition')) ?>
        <?php endforeach ?>
    </div>
    <div class="flex-1 mt-8 lg:mt-0 flex flex-col justify-center">
        <h3><a class="link" href="<?= $volume->url() ?>"><?= $volume->title()->html() ?></a></h3>
        <?= $volume->text()->kt() ?>
        <?= $volume->moreLink('link font-bold font-small-caps text-sm outline-none') ?>
    </div>
</div>
<?php e($volume !== $page->children()->unlisted()->last(), '<hr class="max-w-sm">') ?>
<?php
    $count++;
    endforeach;
?>
