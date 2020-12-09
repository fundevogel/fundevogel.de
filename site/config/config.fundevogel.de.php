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
        ]
    ],
];
