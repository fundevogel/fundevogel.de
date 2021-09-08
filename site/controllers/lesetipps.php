<?php

return function ($kirby, $page) {
    # Defining PDF editions
    $files = $kirby->collection('bibliolists/files')->flip()->group(function($file) {
        if (Str::contains($file->filename(), 'herbst')) {
            return 'autumn';
        }

        return 'spring';
    });

    $editions = [
        $files->spring()->first(),
        $files->autumn()->first(),
    ];

    # Defining recommendations
    $lesetipps = $kirby->collection('lesetipps')->onlyTranslated($kirby->language()->code());

    # Check parameters
    $parameter = false;

    if ($category = param('Kategorie')) {
        # Listing by category
        $lesetipps = $lesetipps->filterBooks('categories', rawurldecode($category));
        $parameter = 'Kategorie';

    } elseif ($topic = param('Thema')) {
        # Listing by tag
        $lesetipps = $lesetipps->filterBooks('topics', rawurldecode($topic));
        $parameter = 'Thema';
    }

    # Counting results
    $total = $lesetipps->count();

    # Applying pagination
    $perPage   = $page->perpage()->int();
    $lesetipps = $lesetipps->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $lesetipps->pagination();

    return compact(
        'editions',
        'perPage',
        'total',
        'lesetipps',
        'pagination',
        'parameter',
    );
};
