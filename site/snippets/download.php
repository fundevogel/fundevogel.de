<?php
    if (!isset($details)) {
        $details = $file->niceSize();

        if ($file->type() === 'image') {
            $details .= ' - ' . $file->width() . ' x ' . $file->height();
        }
    }

    $caption = $caption ?? 'Download';
    $icon = $icon ?? 'download';
?>

<div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-gradient-to-tr from-red-medium to-orange-medium transition-all z-25">
    <div class="h-full flex flex-col justify-center items-center font-normal text-center text-white">
        <?= useSVG($caption, 'w-10 md:w-12 h-auto text-white fill-current', $icon) ?>
        <span class=" text-lg lg:text-xl xl:text-2xl "><?= $caption ?></span>
        <span class="mt-1 text-xs xl:text-sm"><?= $details ?></span>
    </div>
</div>
