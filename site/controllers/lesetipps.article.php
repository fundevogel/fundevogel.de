<?php

return function ($page) {
    $book = $page->book()->toPage();

    $data = [
        'data' => $page,
        'verdict' => $page->verdict(),
        'useTaxonomy' => true,
        'useDetails' => true,
    ];

    return compact('book', 'data');
};
