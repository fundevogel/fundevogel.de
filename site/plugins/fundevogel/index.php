<?php

# Generic functions
require_once __DIR__ . '/functions.php';

# Kirby plugins
Kirby::plugin('fundevogel/methods', [
    # Methods
    'fieldMethods' => require_once __DIR__ . '/field.php',
    'fileMethods'  => require_once __DIR__ . '/file.php',
    'pageMethods'  => require_once __DIR__ . '/page.php',
    'tags'         => require_once __DIR__ . '/tags.php',

    # Templates
    'snippets' => [
        'webPicture' => __DIR__ . '/snippets/webPicture.php',
    ],
]);
