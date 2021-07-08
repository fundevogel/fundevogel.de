<?php
    $count = 0;
    foreach ($categories as $category) :
?>
<div class="mt-16 flex flex-col lg:flex-row">
    <?php if ($category->hasCover()) : ?>
    <div class="flex-none text-center <?php e($count % 2 == 0, 'lg:order-last', 'lg:order-first') ?>">
        <a class="" href="<?= $category->url()?>">
            <figure class="group inline-block <?php e($count % 2 == 0, 'lg:ml-12', 'lg:mr-12') ?> rounded-lg overflow-hidden">
                <?= $category->getCover()->createImage('rounded-lg transition-transform duration-350 transform group-hover:scale-110', 'assortment.navigation', false, true) ?>
            </figure>
        </a>
    </div>
    <?php endif ?>
    <div class="flex-1 mt-8 lg:mt-0 flex flex-col justify-center">
        <h3><?= $category->title()->html() ?></h3>
        <?= $category->short()->kt() ?>
        <?= $category->moreLink('link font-bold font-small-caps text-sm outline-none') ?>
    </div>
</div>
<?php e($category !== $categories->last(), '<hr class="max-w-sm">') ?>
<?php
    $count++;
    endforeach;
?>
