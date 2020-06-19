<?php

##
# PRODUCTION SETTINGS
##

return [
    # Deactivate debug mode
    'debug' => false,

    # Activate Caching
    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => function ($page) {
                # .. except for our form
                return $page->intendedTemplate() !== 'geno.poll';
            }
        ]
    ],
];
