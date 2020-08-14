<div class="flex flex-wrap">
    <?php foreach (page('unser-sortiment')->children()->listed()->sortBy('title', 'asc')->onlyTranslated() as $category) : ?>
    <?php if ($category->hasCover()) : ?>
    <div class="w-1/2 xl:w-1/3 flex justify-center text-shadow leading-none">
        <figure class="group mx-2 md:mx-4 mb-4 md:mb-8 lg:mb-12 inline-block relative<?php e($category->isOpen(), ' cursor-default') ?>"<?php e($category->isOpen(), ' title="' . t('Du bist hier') . '"') ?>>
            <?php e(!$category->isOpen(), '<a href="' . $category->url() . '">') ?>
                <?php if ($category->isOpen()) : ?>
                <div class="absolute inset-0 bg-orange-medium opacity-50"></div>
                <?php endif ?>
                <?= $category->getCover()->createImage('rounded-lg shadow-cover', 'assortment.navigation') ?>
                <figcaption class="py-1 xs:py-2 left-0 right-0 bottom-3 sketch text-lg xs:text-2xl md:text-5xl text-white text-center<?php e($category->isOpen(), ' bg-orange-medium ',  ' bg-red-light group-hover:bg-red-medium ') ?>absolute select-none transition-all"><?= $category->title()->html() ?></figcaption>
            <?php e(!$category->isOpen(), '</a>') ?>
        </figure>
    </div>
    <?php
        endif;
        endforeach;
    ?>
</div>
