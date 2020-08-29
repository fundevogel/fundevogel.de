<?php snippet('header') ?>

<article class="mb-16">
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
    <aside class="wave">
        <?= useSeparator('orange-light', 'top-reversed') ?>
        <div class="inner">
            <div class="container max-w-xl">
                <div class="flex flex-col items-center">
                    <?= useSVG(t('Presse-Überschrift'), 'title-icon mb-6', 'file-filled') ?>
                    <h2 class="title"><?= t('Presse-Überschrift') ?></h2>
                    <?php snippet('lesetipps/edition', ['edition' => $dossier, 'caption' => t('Presse-Überschrift')]) ?>
                    <div class="mt-8 text-center">
                        <?= $page->details()->kt() ?>
                    </div>
                </div>
            </div>
        </div>
        <?= useSeparator('orange-light', 'bottom-reversed') ?>
    </aside>
    <?php if ($grid) : ?>
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
</article>

<?php snippet('footer') ?>
