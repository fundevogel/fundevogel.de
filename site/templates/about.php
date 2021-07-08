<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none flex justify-center items-center">
            <div class="lg:ml-12">
                <?php snippet('components/caption-gallery', compact('images', 'caption', 'preset')) ?>
            </div>
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
