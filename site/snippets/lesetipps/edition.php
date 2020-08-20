<?php
    $caption = $isArchive === true
        ? implode(' ', [t($edition->edition()->value()), $edition->year()])
        : t($edition->edition()->value())
    ;
?>

<a class="<?php e($isArchive === false, 'last:ml-4 xs:last:ml-6 sm:last:ml-10 ') ?> group table relative" href="<?= $edition->url() ?>" target="_blank">
    <figure class="rounded-lg">
        <?= $edition->getFront('rounded-t-lg') ?>
        <figcaption class="small-caption is-pdf"><?= $caption ?></figcaption>
    </figure>
    <div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-red-medium transition-all z-25">
        <div class="h-full flex flex-col justify-center items-center">
            <?= useSVG('Download', 'w-12 h-12 text-white fill-current', 'download') ?>
            <span class="font-normal text-lg sm:text-xl text-white">Download</span>
        </div>
    </div>
</a>
