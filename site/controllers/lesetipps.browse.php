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
        $fields = [
            'title', 'text',
            'verdict', 'conclusion',
            'book_title', 'book_subtitle',
            'author', 'illustrator',
            'translator', 'participants',
            'publisher', 'isbn',
            'categories', 'topics',
        ];

        $results = $lesetipps->flip()->search($query, implode('|', $fields));
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
            'Verlag' => 'publisher',
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

    // Order will be used in frontend
    $fields = [
        'Kategorie' => $categories,
        'Thema' => $topics,
        'Lesealter' => $ages,
        'Verlag' => $publishers,
    ];

    // Applying pagination
    $perPage = $page->perpage()->int();
    $results = $results->paginate(($perPage >= 1) ? $perPage : 5);
    $pagination = $results->pagination();

    // Counting results
    $total = $results->count();

    return compact(
        'query',
        'perPage',
        'total',
        'results',
        'pagination',
        'fields',
    );
};
