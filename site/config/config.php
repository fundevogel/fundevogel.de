<?php

##
# GLOBAL SETTINGS
##

return [
    ##
    # INCLUDES
    ##
    'routes' => require 'routes.php',
    'thumbs' => require_once 'thumbs.php',
    'bnomei.janitor.jobs' => require_once 'jobs.php',


    ##
    # KIRBY OPTIONS
    ##

    # Set alternative `home` identifier
    'home' => 'news',

    # Enable languages (currently supported are DE, EN & FR)
    'languages' => true,

    # Sitemap settings
    'sitemap.ignore' => ['error'],

    # Typography settings
    # See https://getkirby.com/docs/reference/system/options/smartypants
    'smartypants' => true,

    # Enable API cache for `dependencies`
    'cache.deps' => true,


    ##
    # PLUGIN OPTIONS
    ##

    # Enable auto-linking to `dejure.org` (specific templates only)
    'kirby3-dejure.allowList' => ['default'],

    # Define AVIF conversion options
    'fundevogel.colorist' => [
        'formats' => ['avif', 'webp'],
        'tonemap' => false,
        'speed' => 0,
        'yuv' => '420',
    ],

    # Generate donuts charts as inline SVG
    'fundevogel.donuts.inline' => true,

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

    # Utilize manifest file with hashed assets
    'ready' => function() {
        return [
            'bnomei.fingerprint.query' => kirby()->root('assets') . '/manifest.json',
        ];
    },

    # Customizing MetaTags
    'pedroborges.meta-tags.default' => function ($page, $site) {
        # General
        $seoTitle = $page->isHomePage()
            ? $site->title()
            : $page->seoTitle();
        $seoDescription = $page->seoDescription();
        $delimiter = ' | ';

        return [
            'title' => $seoTitle->isNotEmpty()
                ? $page->isHomePage() ? $seoTitle : $seoTitle . $delimiter . $site->title()
                : $page->title() . $delimiter . $site->title(),
            'meta' => [
                'description' => $seoDescription->isNotEmpty()
                    ? $seoDescription
                    : $page->text()->excerpt(155),
            ],
            'link' => [
                'canonical' => $page->url(),
                # 'icon' => [
                #     ['href' => url('assets/images/icons/favicon-62.png'), 'sizes' => '62x62', 'type' =>'image/png'],
                #     ['href' => url('assets/images/icons/favicon-192.png'), 'sizes' => '192x192', 'type' =>'image/png']
                # ],
                'alternate' => function ($page) {
                    $locales = [];

                    foreach (kirby()->languages() as $language) {
                        if ($language->code() == kirby()->language()) continue;

                        $locales[] = [
                            'hreflang' => $language->code(),
                            'href' => $page->url($language->code())
                        ];
                    }

                    return $locales;
                }
            ],
            'og' => [
                'title' => $seoTitle->isNotEmpty()
                    ? $seoTitle
                    : $page->title(),
                'type' => 'website',
                'site_name' => $site->title(),
                'url' => $page->url()
            ],
            'twitter' => [
                'card' => 'summary',
                # 'site' => $site->twitter(),
                'title' => $seoTitle->isNotEmpty()
                    ? $seoTitle
                    : $page->title(),
                'namespace:image' => function ($page, $site) {
                    $image = $site->homePage()->image();

                    if ($page->hasImages()) {
                        $image = $page->image();
                    }

                    return [
                        'image' => $image->url(),
                        'alt' => $image->altAttribute()
                    ];
                }
            ]
        ];
    },
    'pedroborges.meta-tags.templates' => function ($page, $site) {
        return [
            'lesetipps.article' => [
                'json-ld' => [
                    'Organization' => [
                        'name' => $site->title()->value(),
                        'url' => $site->url(),
                        "contactPoint" => [
                            '@type' => 'ContactPoint',
                            # 'telephone' => $site->phoneNumber()->value(),
                            'contactType' => 'customer service'
                        ]
                    ]
                ]
            ],
        ];
    }
];
