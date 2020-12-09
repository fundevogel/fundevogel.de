<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none text-center">
            <?php snippet('cover') ?>
        </div>
    </div>
</header>
<hr>
<section class="container">
    <?= $page->details()->kt() ?>
</section>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="container">
            <div class="flex flex-col lg:flex-row">
                <div class="flex-none flex justify-center">
                    <div class="flex items-center mb-10 lg:mb-0">
                        <?php snippet('lesetipps/edition', ['edition' => $dossier]) ?>
                    </div>
                </div>
                <div class="md:ml-16 flex-1 flex flex-col justify-center">
                    <div class="mb-6">
                        <span class="text-xs font-medium"><?= t('Unsere Pressemappe') ?></span>
                        <h3 class="lg:text-2xl text-orange-medium"><?= t('Presse-Überschrift') ?></h3>
                        <?= $page->press_kit()->kt() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
<?php if ($page->blocks()->isNotEmpty()) : ?>
<?= $page->blocks()->toBlocks() ?>
<hr>
<?php endif ?><?php if ($grid) : ?>
<section>
    <div class="text-center">
        <?= useSVG($page->subtitle()->html(), 'title-icon', 'camera-filled') ?>
    </div>
    <h2 class="title"><?= $page->subtitle()->html() ?></h2>
    <div class="container">
        <ul class="grid">
            <?php foreach ($grid as $image) : ?>
            <li class="bg-orange-medium relative overflow-hidden rounded-lg">
                <a class="group h-40 block rounded-lg" href="<?= $image->url() ?>" download="<?= $image->url() ?>">
                    <figure class="rounded-lg">
                        <?= $image->createImage('rounded-lg', 'contact.press.grid', false, true) ?>
                        <figcaption class="absolute inset-0 flex items-center justify-center text-center bg-black bg-opacity-40 rounded-lg">
                            <span class="max-w-75 font-normal text-sm text-white text-shadow"><?= $image->caption()->html() ?></span>
                        </figcaption>
                    </figure>
                    <?php snippet('download', ['file' => $image]) ?>
                </a>
            </li>
            <?php endforeach ?>
        </ul>
    </div>
</section>
<?php endif ?>

<?php snippet('footer') ?>
