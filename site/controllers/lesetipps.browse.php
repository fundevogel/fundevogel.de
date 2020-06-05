<?php

return function ($page) {
    // Defining default recommendations
    $lesetipps = $page->siblings()
                      ->listed()
                      ->filterBy('intendedTemplate', 'lesetipps.article');

    // Empty collection
    $results = new Collection();

    // Listing search results
    if ($query = get('q')) {
        $results = $lesetipps->flip()
                             ->search($query, 'title|text|verdict|conclusion|isbn|autor|participants|verlag');
    }

    // Applying pagination
    $perPage = $page->perpage()->int();
    $results = $results->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $results->pagination();

    return compact(
        'query',
        'perPage',
        'results',
        'pagination',
    );
};
