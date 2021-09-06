<?php

return function ($page) {
    # Defining PDF editions
    $files = $page->files()->filterBy('template', 'pdf')->flip()->group(function($file) {
        if (Str::contains($file->filename(), 'herbst')) {
            return 'autumn';
        }

        return 'spring';
    });

    $editions = [
        $files->spring()->first(),
        $files->autumn()->first(),
    ];

    return compact('editions');
};
