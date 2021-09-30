<?php

# Generic functions
require_once __DIR__ . '/functions.php';

# Models
require_once __DIR__ . '/models.php';


# Kirby plugins
Kirby::plugin('fundevogel/fv', [
    # Blueprints
    'blueprints' => [
        'blocks/books' => __DIR__ . '/blueprints/books.yml',
        'blocks/hr'    => __DIR__ . '/blueprints/hr.yml',
    ],

    # Hooks
    'hooks'        => require_once __DIR__ . '/hooks.php',

    # Methods
    'fieldMethods' => require_once __DIR__ . '/field.php',
    'fileMethods'  => require_once __DIR__ . '/file.php',
    'pageMethods'  => require_once __DIR__ . '/page.php',

    # Tags
    'tags'         => require_once __DIR__ . '/tags.php',

    # Templates
    'snippets' => [
        'blocks/books'  => __DIR__ . '/snippets/books.php',
        'blocks/hr'     => __DIR__ . '/snippets/hr.php',
        'webPicture'    => __DIR__ . '/snippets/webPicture.php',
    ],

    'components' => [
        'file::version' => __DIR__ . '/components.php',
    ],
]);
