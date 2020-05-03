<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col md:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
            <figure class="">
                <div class="gallery">
                    <?php foreach ($page->images() as $image) : ?>
                        <?php
                            $thumb = $image->thumb('fundevogel.slides');
                        ?>
                        <a href="<?= $image->url() ?>"<?php e(@$lightgallery, ' data-lightgallery') ?>>
                            <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
                        </a>
                    <?php endforeach ?>
                </div>
                <figcaption class="sketch bg-red-medium">
                    <?= $page->caption()->html() ?>
                </figcaption>
            </figure>
            </div>
        </div>
    </header>
    <hr>
    <section class="container">
        <?= $page->about_us()->kt() ?>
    </section>
    <hr>
    <section class="container">
        <div class="flex flex-col md:flex-row">
            <div class="mb-6 md:mb-0 flex-1">
                <?= $page->left()->kt() ?>
            </div>
            <div class="flex-1 md:ml-10">
                <?= $page->right()->kt() ?>
            </div>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
