<?php

# Load helper functions
require_once __DIR__ . '/functions.php';

# Load page & file models
require_once __DIR__ . '/models.php';


# Initialize plugin
Kirby::plugin('fundevogel/fv', [
    # Blueprints
    # See https://getkirby.com/docs/reference/plugins/extensions/blueprints
    'blueprints' => [
        'blocks/books' => __DIR__ . '/blueprints/books.yml',
        'blocks/hr'    => __DIR__ . '/blueprints/hr.yml',
    ],

    # Hooks
    # See https://getkirby.com/docs/reference/plugins/extensions/hooks
    'hooks'        => require_once __DIR__ . '/hooks.php',

    # Methods
    'fieldMethods' => require_once __DIR__ . '/field.php',
    'fileMethods'  => require_once __DIR__ . '/file.php',
    'pageMethods'  => require_once __DIR__ . '/page.php',

    # Page models
    # See https://getkirby.com/docs/reference/plugins/extensions/page-models
    'pageModels' => [
        'calendar.event'  => 'iCalPage',
        'calendar.events' => 'iCalPage',
    ],

    # KirbyTags
    # See https://getkirby.com/docs/reference/plugins/extensions/kirbytags
    'tags'         => require_once __DIR__ . '/tags.php',

    # Snippets
    # See https://getkirby.com/docs/reference/plugins/extensions/snippets
    'snippets' => [
        'blocks/books'  => __DIR__ . '/snippets/books.php',
        'blocks/hr'     => __DIR__ . '/snippets/hr.php',
        'webPicture'    => __DIR__ . '/snippets/webPicture.php',
    ],
]);
