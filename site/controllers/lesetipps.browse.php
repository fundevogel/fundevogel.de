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
        $results = $lesetipps->flip()
                             ->search($query, 'title|text|verdict|conclusion|categories|topics|isbn|autor|participants|verlag');
    }

    // When applied, filter search results
    if (count(params()) > 0) {
        if ($results->isEmpty()) {
            $results = $lesetipps;
        }

        $parameters = [
            'Thema' => 'topics',
            'Kategorie' => 'categories',
            'Lesealter' => 'alter',
        ];

        foreach ($parameters as $parameter => $field) {
            if ($argument = param($parameter)) {
                $results = $results->filterBy($field, rawurldecode($argument), ',');
            }
        }
    }

    // All categories
    $allCategories = page('unser-sortiment')->children()
                                            ->listed()
                                            ->filterBy('intendedTemplate', 'assortment.single')
                                            ->pluck('title', null, true);

    // All ages
    $allAges = page('lesetipps')->children()
                                ->listed()
                                ->filterBy('intendedTemplate', 'lesetipps.article')
                                ->pluck('alter', null, true);

    $categories = [];
    $ages = [];

    // Flattening arrays
    foreach ($allCategories as $category) {
        $categories[] = $category->value();
    }

    foreach ($allAges as $age) {
        $ages[] = $age->value();
    }

    // Sorting ages in order to make sure
    // mid-text ages are taken into consideration
    natsort($ages);

    $topics = page('lesetipps')
        ->children()
        ->listed()
        ->pluck('topics', ',', true);

    sort($topics);

    $fields = [
        'Kategorie' => $categories,
        'Lesealter' => $ages,
        'Thema' => $topics,
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
