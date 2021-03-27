<?php

return function ($page) {
    $layouts = $page->layouts()->toLayouts();

    $book = $page->book()->toPage();

    $data = [
        'data' => $page,
        'verdict' => $page->verdict(),
        'useTaxonomy' => true,
        'useDetails' => true,
    ];

    return compact('layouts', 'book', 'data');
};
