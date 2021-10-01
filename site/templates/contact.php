<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <div class="mb-8">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mb-4 text-center">
                <?php snippet('contact/details', ['type' => 'contact']) ?>
            </div>
            <div class="text-center">
                <?php snippet('contact/details', ['type' => 'hours']) ?>
            </div>
        </div>
        <div class="mt-12 flex-none flex justify-center items-center">
            <?php
                if ($page->hasCover()) :
                $images = new Files([$page->cover()->toFile()]);
                $caption = $page->getCover()->caption()->html();
            ?>
            <div class="lg:ml-12">
                <?php snippet('components/caption-gallery', compact('images', 'caption')) ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</header>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="container xl:px-8">
            <div class="text-center">
                <?= useSVG(t('Kontakt-Überschrift'), 'title-icon', 'map-filled') ?>
            </div>
            <h2 class="title text-orange-medium"><?= t('Kontakt-Überschrift') ?></h2>
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-2/5 lg:mr-12 mb-6">
                    <h3 class="mb-2 text-center text-orange-medium"><?= t('Mit dem Fahrrad') ?></h3>
                    <?= $page->bike()->kt() ?>
                </div>
                <div class="flex-1 flex flex-col">
                    <div class="mb-4">
                        <h3 class="mb-2 text-center text-orange-medium"><?= t('Über den Asphalt') ?></h3>
                        <?= $page->car()->kt() ?>
                    </div>
                    <div class="mb-6">
                        <h3 class="mb-2 text-center text-orange-medium"><?= t('Auf der Schiene') ?></h3>
                        <?= $page->tram()->kt() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>

<section class="container">
    <div class="mb-8">
        <?= $page->formText()->kt() ?>
    </div>
    <?php if (!$form->success()) snippet('contact/error', ['form' => $form]) ?>
    <?php snippet('contact/form') ?>
</section>

<?php snippet('footer') ?>
