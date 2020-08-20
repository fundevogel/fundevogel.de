<?php

return function ($page) {
    // Defining default reading tips
    $lesetipps = $page
        ->siblings()
        ->listed()
        ->filterBy('intendedTemplate', 'lesetipps.article');

    // Empty collection
    $results = new Collection();

    // List search results
    if ($query = get('q')) {
        $results = $lesetipps->flip()->search($query, ['words' => true]);
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
            'Auszeichnung' => 'award',
        ];

        foreach ($parameters as $parameter => $field) {
            if ($argument = param($parameter)) {
                $results = $results->filterBy($field, rawurldecode($argument), ',');
            }
        }
    }

    // Collect filter attributes across all reading tips
    $categories = $lesetipps->pluck('categories', ',', true);
    sort($categories);

    $topics = $lesetipps->pluck('topics', ',', true);
    sort($topics);

    $ages = $lesetipps->pluck('age', ',', true);
    natsort($ages);

    $publishers = $lesetipps->pluck('publisher', ',', true);
    natcasesort($publishers);

    $awards = $lesetipps->pluck('award', ',', true);
    sort($awards);

    // Order will be used in frontend
    $fields = [
        'Kategorie' => $categories,
        'Thema' => $topics,
        'Lesealter' => $ages,
        'Auszeichnung' => $awards,
    ];

    // Counting results
    $total = $results->count();

    // Applying pagination
    $perPage = $page->perpage()->int();
    $results = $results->flip()->paginate(($perPage >= 1) ? $perPage : 5);
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
