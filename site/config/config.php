<?php

use Beebmx\KirbyEnv as Dotenv;


# Load credentials & secrets
Dotenv::load(__DIR__ . '/../..');


##
# GLOBAL SETTINGS
##

return [
    ##
    # INCLUDES
    ##
    'routes' => require 'routes.php',
    'thumbs' => require_once 'thumbs.php',

    'hooks' => [
        'page.update:before' => function (\Kirby\Cms\Page $page)
        {
            if (kirby()->collection('events/past')->has($page)) {
                throw new Exception('Vergangene Veranstaltungen sind gesperrt.');
            }
        }
    ],

    ##
    # KIRBY OPTIONS
    ##

    # Set alternative `home` identifier
    'home' => 'news',

    # Enable languages (currently supported are DE, EN & FR)
    'languages' => true,

    # Sitemap settings
    'sitemap.ignore' => [
        'error',
        'kontakt/vielen-dank',
    ],

    # Typography settings
    # See https://getkirby.com/docs/reference/system/options/smartypants
    'smartypants' => true,


    ##
    # PLUGIN OPTIONS
    ##

    # Janitor jobs
    'bnomei.janitor.jobs' => require_once 'jobs.php',

    # Enable auto-linking to `dejure.org` (specific templates only)
    'kirby3-dejure.allowList' => ['default'],

    # Define AVIF conversion options
    'fundevogel.colorist' => [
        'formats' => ['avif', 'webp'],
        'tonemap' => false,
        'speed' => 0,
        'yuv' => '420',
    ],

    # Store redirects as JSON
    'distantnative.retour.config' => __DIR__ . '/settings/redirects.json',

    # Markdown field settings
    # See https://github.com/sylvainjule/kirby-markdown-field
    'community.markdown-field' => [
        'buttons' => [
            'headlines', 'bold', 'italic', 'ul','blockquote',
            'divider',
            'link', 'email', 'pagelink', 'file',
        ],
        'font' => [
            'family'  => 'sans-serif',
            'scaling' => true,
        ],
    ],

    'bnomei.securityheaders' => [
        # Disable CSP rules on the panel,
        # force everywhere else (development as well as production)
        'enabled' => function () {
            # Panel check, borrowed from @bnomei's `security-headers`
            # See https://github.com/steirico/kirby-plugin-custom-add-fields/issues/37
            $isPanel = strpos(
                kirby()->request()->url()->toString(),
                kirby()->urls()->panel
            ) !== false;

            if ($isPanel) {
                return false;
            }

            // return 'force';
            # Disabling CSP for now
            return false;
        },
        # Disable security headers (see `.htaccess`)
        'headers' => [],
        'loader' => function () {
            return kirby()->root('config') . '/settings/csp.json';
        },
    ],

    # Send emails from contact form
    'email' => [
        'transport' => [
            'type' => 'smtp',
            'host' => env('mail_server'),
            'security' => true,
            'port' => 587,
            'auth' => true,
            'username' => env('mail_username'),
            'password' => env('mail_password'),
        ],
    ],

    # Utilize manifest file with hashed assets
    'ready' => function() {
        return [
            'bnomei.fingerprint.query' => kirby()->root('assets') . '/manifest.json',
        ];
    },
];
