<?php

return function ($page, $kirby) {
    $categories = $kirby->collection('assortment');

    # Gather gallery images
    $images = new Files();

    # (1) Add 'assortment' cover image
    $images->add($page->cover()->toFile());

    # (2) Add 'assortment.single' cover images
    foreach ($kirby->collection('assortment') as $category) {
        $images->add($category->cover()->toFile());
    }

    return [
        'categories' => $categories,
        'images' => $images,
        'caption' => $page->caption()->html(),
    ];
};
