<?php

return function ($kirby, $page) {
    // Defining PDF editions
    $files = $page->files()
                  ->flip()
                  ->filterBy('extension', 'pdf')
                  ->group(function($file) {
        if (Str::contains($file->filename(), 'herbst')) {
            return 'autumn';
        }

        return 'spring';
    });

    $editions = [
        $files->spring()->first(),
        $files->autumn()->first(),
    ];

    // Defining recommendations
    $lesetipps = $page->children()
                      ->listed()
                      ->onlyTranslated($kirby->language()->code())
                      ->flip();

    // Check parameters
    $parameter = false;

    if ($category = param('Kategorie')) {
        // Listing by category
        $perPage = 2;
        $lesetipps = $lesetipps->filterBy('categories', rawurldecode($category), ',');
        $parameter = 'Kategorie';
    } elseif ($topic = param('Thema')) {
        // Listing by tag
        $perPage = 2;
        $lesetipps = $lesetipps->filterBy('topics', rawurldecode($topic), ',');
        $parameter = 'Thema';
    }

    // Applying pagination
    $perPage   = $page->perpage()->int();
    $lesetipps = $lesetipps->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $lesetipps->pagination();

    return compact(
        'editions',
        'perPage',
        'lesetipps',
        'pagination',
        'parameter',
    );
};
