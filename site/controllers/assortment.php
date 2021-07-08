<?php

return function ($page) {
    # Gather gallery images
    $images = new Files();

    # (1) Add 'assortment' cover image
    $images->add($page->cover()->toFile());

    # (2) Add 'assortment.single' cover images
    foreach ($page->children()->listed()->filterBy('intendedTemplate', 'assortment.single') as $child) {
        $images->add($child->cover()->toFile());
    }

    return [
        'images' => $images,
        'caption' => $page->caption()->html(),
    ];
};
