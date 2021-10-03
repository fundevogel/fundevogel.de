<?php

return function ($kirby, $site) {
    $books = $kirby->collection('books/all');

    return $books->filter(function($book) use ($kirby) {
        foreach ($kirby->collection('lesetipps') as $lesetipp) {
            if ($lesetipp->book()->toPages()->has($book)) {
                return $book;
            }
        }
    });
};
