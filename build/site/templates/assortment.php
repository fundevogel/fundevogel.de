<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php snippet('cover') ?>
            </div>
        </div>
    </header>
    <hr>
    <section class="container xl:px-8">
    <h2 class="mb-12 text-center"><?= t('kategorien_ueberschrift-liste') ?></h2>
        <div class="flex flex-wrap">
            <?php
                foreach ($page->children() as $category) :
            ?>
            <?php
                if ($image = $category->cover()->toFile()) :
                $titleAttribute = $image->titleAttribute()->html();
                $altAttribute = $image->altAttribute()->html();

                $cover = $image->thumb('lesetipps.category.cover');
                $blurry = $image->thumb('lesetipps.category.cover.placeholder');
            ?>
            <div class="w-1/2 xl:w-1/3 flex justify-center">
                <figure class="group mx-2 md:mx-4 mb-4 md:mb-8 lg:mb-12 inline-block relative">
                    <a class="" href="<?= $category->url() ?>">
                        <img
                            class="rounded-lg shadow-cover"
                            src="<?= $blurry->url() ?>"
                            data-layzr="<?= $cover->url() ?>"
                            title="<?= $titleAttribute ?>"
                            alt="<?= $altAttribute ?>"
                            width="<?= $cover->width() ?>"
                            height="<?= $cover->height() ?>"
                        >
                        <figcaption class="py-2 left-0 right-0 sketch text-2xl md:text-5xl text-white text-center text-shadow absolute bg-red-light group-hover:bg-red-medium select-none transition-all" style="bottom: 1rem"><?= $category->title()->html() ?></figcaption>
                    </a>
                </figure>
            </div>
            <?php
                endif
            ?>
            <?php
                endforeach
            ?>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
