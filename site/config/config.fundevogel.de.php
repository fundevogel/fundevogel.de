<?php

##
# PRODUCTION SETTINGS
##

return [
    # Deactivate debug mode
    'debug' => false,

    # Set environment
    'environment' => 'production',

    # Activate Caching
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => function ($page) {
                return in_array($page->intendedTemplate(), ['contact']) === true;
            }
        ]
    ],
];
