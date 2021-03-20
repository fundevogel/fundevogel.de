<?php
    # Provide defaults
    if (!isset($caption)) {
        $caption = 'Download';

        if (is_a($data, 'BookPage')) {
            $caption = t('Zum Shop');
        }
    }

    if (!isset($icon)) {
        $icon = 'download';

        if (is_a($data, 'BookPage')) {
            $icon = 'cart';
        }
    }

    if (!isset($details)) {
        $details = '';

        if (is_a($data, 'BookPage')) {
            $details = ' &middot; ' . $data->price() . ' €';

            if ($data->age()->isNotEmpty()) {
                $details = $data->age() . $details;
            } else {
                if ($data->isAudiobook()) {
                    $details = A::join([$data->duration(), t('Minuten'), $details], ' ');
                } else {
                    $details = A::join([$data->pageCount(), t('Seiten'), $details], ' ');
                }
            }
        }

        if (is_a($data, 'Kirby\Cms\File')) {
            $details = $data->niceSize();

            if ($data->type() === 'image') {
                $details .= ' - ' . $data->width() . ' x ' . $data->height();
            }
        }
    }
?>

<div class="inset-0 w-full h-full absolute opacity-0 group-hover:opacity-100 rounded-lg bg-gradient-to-tr from-red-medium to-orange-medium transition-all z-25">
    <div class="h-full flex flex-col justify-center items-center font-normal text-center text-white">
        <?= useSVG($caption, 'w-10 md:w-12 h-auto text-white fill-current', $icon) ?>
        <span class="text-lg lg:text-xl xl:text-2xl"><?= $caption ?></span>
        <span class="mt-1 text-xs xl:text-sm"><?= $details ?></span>
    </div>
</div>
