<?php
    $preset = $preset ?? 'cover';
    $imageURLs = [];
    $imageCaptions = [];

    foreach ($images as $image) {
        $orientation = $image->orientation() === 'landscape' ? 'full-width' : 'full-height';
        $imageURLs[] = $image->thumb($orientation)->url();

        $imageCaptions[] = $image->caption()->isNotEmpty()
            ? $image->caption()->html()
            : $caption
        ;
    }
?>
<figure class="js-lightbox rounded-lg relative" data-images="<?= A::join($imageURLs, ';') ?>" data-captions="<?= A::join($imageCaptions, ';') ?>">
    <span class="-top-2 -right-2 xs:-top-5 xs:-right-5 absolute z-30">
        <?= useSVG('Mehr anzeigen', 'w-10 h-10 p-2 text-white fill-current bg-red-medium rounded-full', 'plus') ?>
    </span>
    <div class="group overflow-hidden rounded-lg relative cursor-pointer">
        <?= $images->first()->createImage('rounded-lg transition-all', $preset, true, true) ?>
        <figcaption class="big-caption sketch group-hover:-translate-y-full">
            <?= $caption ?>
        </figcaption>
    </div>
</figure>
