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

    // $lang = $kirby->language()->code();

    // $archive = [
    //     'de' => 'Archiv',
    //     'en' => 'archive',
    //     'fr' => 'télécharger'
    // ];

    // $text = str::replace(
    //     $page->text()->kt(),
    //     $archive[$lang],
    //     '<a class="modal-toggle" data-toggle="archive" href="#">' . $archive[$lang] . '</a>'
    // );

    $articlesByTag =

    $fields = [
        $page->content('de')->pdf_spring(),
        $page->content('de')->pdf_autumn(),
    ];

    return compact(
        // 'text',
        'fields',
        'perPage',
        'lesetipps',
        'pagination'
    );
};
