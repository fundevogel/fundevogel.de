<?php

return function ($kirby, $page) {
    # Defining default reading tips
    $lesetipps = $kirby->collection('lesetipps');

    # Empty collection
    $results = new Pages();

    # List search results
    if ($query = get('q')) {
        $results = $lesetipps->search($query, ['words' => true]);
    }

    # When applied, filter search results
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
                $books = $kirby->collection('books/reviewed')->filterBy($field, rawurldecode($argument), ',');

                $results = $results->filter(function($lesetipp) use ($books) {
                    foreach ($books as $book) {
                        if ($lesetipp->books()->toPages()->has($book)) {
                            return $lesetipp;
                        }
                    }
                });
            }
        }
    }

    # Collect filter attributes across all reading tips
    $categories = $kirby->collection('books/reviewed')->pluck('categories', ',', true);
    $topics     = $kirby->collection('books/reviewed')->pluck('topics', ',', true);
    $ages       = $kirby->collection('books/reviewed')->pluck('age', ',', true);
    $awards     = $kirby->collection('books/reviewed')->pluck('award', ',', true);

    # Sort them
    sort($categories);
    sort($topics);
    natsort($ages);
    sort($awards);

    # Order will be used in frontend
    $fields = [
        'Kategorie' => $categories,
        'Thema' => $topics,
        'Lesealter' => $ages,
        'Auszeichnung' => $awards,
    ];

    # Counting results
    $total = $results->count();

    # Applying pagination
    $perPage    = $page->perpage()->int();
    $results    = $results->paginate(($perPage >= 1) ? $perPage : 5);
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
