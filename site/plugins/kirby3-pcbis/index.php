<?php

# Includes
include __DIR__ . '/lib/functions.php';
include __DIR__ . '/lib/models.php';

# Kirby plugins
Kirby::plugin('fundevogel/kirby3-pcbis', [
    'blueprints' => [
        'fields/shared'      => __DIR__ . '/blueprints/fields/shared.yml',
        'options/book'       => __DIR__ . '/blueprints/options/book.yml',
        'pages/book.default' => __DIR__ . '/blueprints/pages/book.yml',
        'pages/book.audio'   => __DIR__ . '/blueprints/pages/audiobook.yml',
        'pages/book.ebook'   => __DIR__ . '/blueprints/pages/ebook.yml',
        'pages/books'        => __DIR__ . '/blueprints/pages/books.yml',
        'sections/books'     => __DIR__ . '/blueprints/sections/books.yml',
        'sections/shared'    => __DIR__ . '/blueprints/sections/shared.yml',
        'sections/sidebar'   => __DIR__ . '/blueprints/sections/sidebar.yml',
        'tabs/books'         => __DIR__ . '/blueprints/tabs/books.yml',
    ],
    'fileMethods'  => require_once __DIR__ . '/lib/methods/fileMethods.php',
    'hooks'        => require_once __DIR__ . '/lib/hooks.php',
    'pageMethods'  => require_once __DIR__ . '/lib/methods/pageMethods.php',
    'pagesMethods' => require_once __DIR__ . '/lib/methods/pagesMethods.php',
    'pageModels' => [
        'book.audio' => 'BookPage',
        'book.default' => 'BookPage',
        'book.ebook' => 'BookPage',
    ],
]);
