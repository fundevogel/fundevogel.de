<?php

##
# PRODUCTION SETTINGS
##

return [
    // Deactivates debug mode
    'debug' => false,

    // Activates Caching
    'cache' => [
        'pages' => [
            'active' => true,
            // 'ignore' => function ($page) {
            //     return $page->title()->value() !== 'Do not cache me';
            // }
        ]
    ],
];
