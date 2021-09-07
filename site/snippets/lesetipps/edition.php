<?php $isDossier = $page->intendedTemplate() == 'contact.press'; ?>

<a class="last:ml-4 xs:last:ml-6 sm:last:ml-10 group table relative" href="<?= $edition->url() ?>" download="<?= $edition->filename() ?>">
    <figure class="rounded-lg">
        <?= $edition->getFront(r($isDossier, 'rounded-lg', 'rounded-t-lg')) ?>
        <?php if (!$isDossier) : ?>
        <figcaption class="small-caption is-pdf"><?= t($edition->edition()->value()) ?></figcaption>
        <?php endif ?>
    </figure>
    <?php snippet('components/shared/gradient-overlay', ['data' => $edition]) ?>
</a>
