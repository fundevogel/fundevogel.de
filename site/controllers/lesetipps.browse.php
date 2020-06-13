<?php

return function ($page) {
    // Defining default recommendations
    $lesetipps = $page->siblings()
                      ->listed()
                      ->filterBy('intendedTemplate', 'lesetipps.article');

    // Empty collection
    $results = new Collection();

    // List search results
    if ($query = get('q')) {
        $fields = [
            'title', 'text',
            'verdict', 'conclusion',
            'book_title', 'book_subtitle',
            'author', 'illustrator',
            'translator', 'participants',
            'publisher', 'isbn',
            'categories', 'topics',
        ];
        $results = $lesetipps->flip()
                             ->search($query, implode('|', $fields));
    }

    // When applied, filter search results
    if (count(params()) > 0) {
        if ($results->isEmpty()) {
            $results = $lesetipps;
        }

        $parameters = [
            'Kategorie' => 'categories',
            'Thema' => 'topics',
            'Lesealter' => 'age',
        ];

        foreach ($parameters as $parameter => $field) {
            if ($argument = param($parameter)) {
                $results = $results->filterBy($field, rawurldecode($argument), ',');
            }
        }
    }

    // All ages
    $allAges = page('lesetipps')->children()
                                ->listed()
                                ->filterBy('intendedTemplate', 'lesetipps.article')
                                ->pluck('age', null, true);

    // Flattening array
    $ages = [];

    foreach ($allAges as $age) {
        $ages[] = $age->value();
    }

    // Sorting ages in order to make sure
    // mid-text ages are taken into consideration
    natsort($ages);

    $categories = page('lesetipps')
        ->children()
        ->listed()
        ->pluck('categories', ',', true);

    sort($categories);

    $topics = page('lesetipps')
        ->children()
        ->listed()
        ->pluck('topics', ',', true);

    sort($topics);

    $publishers = page('lesetipps')
        ->children()
        ->listed()
        ->pluck('publisher', null, true);

    natcasesort($publishers);

    $fields = [
        'Kategorie' => $categories,
        'Thema' => $topics,
        'Lesealter' => $ages,
        'Verlag' => $publishers,
    ];

    // Applying pagination
    $perPage = $page->perpage()->int();
    $total = $results->count();
    $results = $results->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $results->pagination();

    return compact(
        'query',
        'perPage',
        'total',
        'results',
        'pagination',
        'fields',
    );
};
