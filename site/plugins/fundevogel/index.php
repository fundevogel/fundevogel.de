<?php

# Generic functions
require_once 'functions.php';

# Kirby plugins
Kirby::plugin('fundevogel/methods', [
    'blueprints' => [
        'pages/book.default' => __DIR__ . '/blueprints/pages/book.yml',
        'pages/book.audio'   => __DIR__ . '/blueprints/pages/audiobook.yml',
        'pages/book.ebook'   => __DIR__ . '/blueprints/pages/ebook.yml',
        'pages/books'        => __DIR__ . '/blueprints/pages/books.yml',
        'sections/books'     => __DIR__ . '/blueprints/sections/books.yml',
        'tabs/books'         => __DIR__ . '/blueprints/tabs/books.yml',
    ],
    'fileMethods' => require_once __DIR__ . '/file.php',
    'pageMethods' => require_once __DIR__ . '/page.php',
    'pagesMethods' => require_once __DIR__ . '/pages.php',
    'snippets' => [
        'webPicture' => __DIR__ . '/snippets/webPicture.php',
    ],
    'tags' => require_once 'tags.php',
]);
