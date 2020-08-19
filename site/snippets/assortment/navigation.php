<div class="js-masonry">
    <?php foreach (page('unser-sortiment')->children()->listed()->sortBy('title', 'asc')->onlyTranslated() as $category) : ?>
    <?php if ($category->hasCover()) : ?>
    <div class="flex justify-center">
        <figure class="group table relative<?php e($category->isOpen(), ' cursor-default') ?>"<?php e($category->isOpen(), ' title="' . t('Du bist hier') . '"') ?>>
            <?php e(!$category->isOpen(), '<a href="' . $category->url() . '">') ?>
                <?php if ($category->isOpen()) : ?>
                <div class="absolute inset-0 bg-orange-medium opacity-50"></div>
                <?php endif ?>
                <?= $category->getCover()->createImage('rounded-lg', 'assortment.navigation') ?>
                <figcaption class="py-1 md:py-2 left-0 right-0 bottom-3 sketch text-lg sm:text-2xl md:text-3xl xl:text-5xl text-white text-center<?php e($category->isOpen(), ' bg-orange-medium ',  ' bg-red-light group-hover:bg-red-medium ') ?>absolute select-none transition-all"><?= $category->title()->html() ?></figcaption>
            <?php e(!$category->isOpen(), '</a>') ?>
        </figure>
    </div>
    <?php
        endif;
        endforeach;
    ?>
</div>
