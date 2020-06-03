<?php

return function ($page) {
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
                      ->flip();

    // Applying pagination
    $perPage   = $page->perpage()->int();
    $lesetipps = $lesetipps->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $lesetipps->pagination();

    return compact(
        'editions',
        'perPage',
        'lesetipps',
        'pagination',
    );
};
