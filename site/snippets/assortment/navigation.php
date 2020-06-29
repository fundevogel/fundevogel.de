<div class="flex flex-wrap">
    <?php foreach (page('unser-sortiment')->children()->listed() as $category) : ?>
    <?php
        if ($image = $category->cover()->toFile()) :
        $titleAttribute = $image->titleAttribute()->html();
        $altAttribute = $image->altAttribute()->html();

        $cover = $image->thumb('lesetipps.category.navigation');
        $blurry = $image->thumb('lesetipps.category.navigation.placeholder');
    ?>
    <div class="w-1/2 xl:w-1/3 flex justify-center text-shadow leading-none">
        <figure class="group mx-2 md:mx-4 mb-4 md:mb-8 lg:mb-12 inline-block relative<?php e($category->isOpen(), ' cursor-default') ?>"<?php e($category->isOpen(), ' title="' . t('Du bist hier') . '"') ?>">
            <?php e(!$category->isOpen(), '<a href="' . $category->url() . '">') ?>
                <?php if ($category->isOpen()) : ?>
                <div class="absolute inset-0 bg-orange-medium opacity-50"></div>
                <?php endif ?>
                <img
                    class="rounded-lg shadow-cover"
                    src="<?= $blurry->url() ?>"
                    data-layzr="<?= $cover->url() ?>"
                    title="<?= $titleAttribute ?>"
                    alt="<?= $altAttribute ?>"
                    width="<?= $cover->width() ?>"
                    height="<?= $cover->height() ?>"
                >
                <figcaption class="py-2 left-0 right-0 sketch text-2xl md:text-5xl text-white text-center<?php e($category->isOpen(), ' bg-orange-medium ',  ' bg-red-light group-hover:bg-red-medium ') ?>absolute select-none transition-all" style="bottom: 0.75rem"><?= $category->title()->html() ?></figcaption>
            <?php e(!$category->isOpen(), '</a>') ?>
        </figure>
    </div>
    <?php
        endif;
        endforeach;
    ?>
</div>
