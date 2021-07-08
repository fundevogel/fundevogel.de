<div class="container xl:px-8">
    <h2 class="mb-12 text-center"><?= t('Sortiment-Überschrift') ?></h2>
    <div class="js-masonry">
        <?php foreach ($kirby->collection('assortment') as $category) : ?>
        <?php if ($category->hasCover()) : ?>
        <div class="flex justify-center">
            <figure class="group table relative<?php e($category->isOpen(), ' cursor-default') ?>"<?php e($category->isOpen(), ' title="' . t('Du bist hier') . '"') ?>>
                <?php e(!$category->isOpen(), '<a href="' . $category->url() . '">') ?>
                    <?php if ($category->isOpen()) : ?>
                    <div class="absolute inset-0 bg-orange-medium rounded-lg opacity-50"></div>
                    <?php endif ?>
                    <?= $category->getCover()->createImage('rounded-lg', 'assortment.navigation', false, true) ?>
                    <figcaption class="sash-caption sketch<?php e($category->isOpen(), ' bg-orange-medium',  ' bg-red-light group-hover:bg-red-medium') ?>"><?= $category->title()->html() ?></figcaption>
                <?php e(!$category->isOpen(), '</a>') ?>
            </figure>
        </div>
        <?php
            endif;
            endforeach;
        ?>
    </div>
</div>
