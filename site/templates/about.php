<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none flex justify-center items-center">
            <figure class="js-lightbox lg:ml-12 rounded-lg relative" data-images="<?= A::join($imageURLs, ';') ?>" data-captions="<?= A::join($imageCaptions, ';') ?>">
                <span class="-top-2 -right-2 xs:-top-5 xs:-right-5 absolute z-30">
                    <?= useSVG('Mehr anzeigen', 'w-10 h-10 p-2 text-white fill-current bg-red-medium rounded-full', 'plus') ?>
                </span>
                <div class="group overflow-hidden rounded-lg relative cursor-pointer">
                    <?= $images->first()->createImage('rounded-lg transition-all', 'about.cover', true) ?>
                    <figcaption class="big-caption sketch group-hover:-translate-y-full">
                        <?= $caption ?>
                    </figcaption>
                </div>
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

<?php snippet('footer') ?>
