<?php

##
# GLOBAL SETTINGS
##

return [
    ##
    # INCLUDES
    ##
    'hooks' => require 'hooks.php',
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

    # Custom panel settings
    'panel' => [
        'css' => 'panel.css',
    ],

    # Typography settings
    # See https://getkirby.com/docs/reference/system/options/smartypants
    'smartypants' => true,


    ##
    # PLUGIN OPTIONS
    ##

    # Adding hash to {css,js} files for cache busting via https://github.com/bnomei/kirby3-fingerprint
    'bnomei.fingerprint.hash' => function ($file) {
        $url = null;
        $fileroot = is_a($file, 'Kirby\Cms\File') || is_a($file, 'Kirby\Cms\FileVersion')
            ? $file->root()
            : kirby()->roots()->index() . DIRECTORY_SEPARATOR . ltrim(str_replace(kirby()->site()->url(), '', $file), '/');

        if (\Kirby\Toolkit\F::exists($fileroot)) {
            $filename = implode('.', [
                \Kirby\Toolkit\F::name($fileroot),
                \filemtime($fileroot),
                \Kirby\Toolkit\F::extension($fileroot)
            ]);

            if (is_a($file, 'Kirby\Cms\File') || is_a($file, 'Kirby\Cms\FileVersion')) {
                $url = str_replace($file->filename(), $filename, $file->url());
            } else {
                $dirname = str_replace(kirby()->roots()->index(), '', \dirname($fileroot));
                $url = ($dirname === '.')
                    ? $filename
                    : ($dirname . '/' . $filename);
            }
        } else {
            $url = $file;
        }

        return \url($url);
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
