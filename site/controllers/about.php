<?php

return function ($page) {
    $caption = $page->caption()->html();
    $images = $page->gallery()->toFiles();

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

    return compact(
        'images',
        'caption',
        'imageURLs',
        'imageCaptions',
    );
};
