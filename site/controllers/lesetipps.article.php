<?php

return function ($site, $page) {
    $award = $page->getAward();
    $entries = $page->entries()->toStructure();

    $books = new Pages();

    foreach ($entries as $entry) {
        $books->add($entry->book()->toPages());
    }

    $hasSlider = count($books) > 1;

    return compact(
        'award',
        'books',
        'entries',
        'hasSlider',
    );
};
