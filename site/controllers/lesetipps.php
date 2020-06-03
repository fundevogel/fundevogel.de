<?php

return function ($kirby, $page) {
    $perPage   = $page->perpage()->int();
    $lesetipps = $page->children()
                      ->listed()
                      ->flip();

    if ($tag = param('kategorie')) {
        $perPage = 2;
        $lesetipps = $lesetipps->filterBy('categories', rawurldecode($tag), ',');
    }

    if ($tag = param('thema')) {
        $perPage = 2;
        $lesetipps = $lesetipps->filterBy('tags', rawurldecode($tag), ',');
    }

    $lesetipps = $lesetipps->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $lesetipps->pagination();

    $fields = [
        $page->content('de')->pdf_spring(),
        $page->content('de')->pdf_autumn(),
    ];

    return compact(
        'fields',
        'perPage',
        'lesetipps',
        'pagination'
    );
};
