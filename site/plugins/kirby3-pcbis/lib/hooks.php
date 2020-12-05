<?php

return [
    'page.create:after' => function ($page) {
        $templates = [
            'book.audio',
            'book.default',
            'book.ebook',
        ];

        if (in_array((string) $page->intendedTemplate(), $templates)) {
            $page->changeStatus('listed');

            janitor('downloadCover', $page, $page->id());
        }
    },
];
