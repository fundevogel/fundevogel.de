<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mt-12 flex-none text-center">
            <figure class="group inline-block lg:ml-12 shadow-cover rounded-lg overflow-hidden relative">
                <div class="js-lightbox js-slider cursor-pointer">
                    <?php
                        foreach ($page->images() as $image) :
                        $caption = $image->altAttribute()->isNotEmpty() ? $image->altAttribute() : $page->caption();
                    ?>
                    <?= $image->createImage('group-hover:opacity-75 rounded-lg transition-all', 'about.slides', false, true, ['data-caption' => $caption]) ?>
                    <?php endforeach ?>
                </div>
                <figcaption class="transform py-2 group-hover:-translate-y-full text-5xl text-white text-shadow absolute w-full sketch bg-red-medium select-none transition-all">
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
    <hr class="max-w-sm">
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
