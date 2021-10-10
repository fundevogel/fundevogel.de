<?php

##
# ROUTING
##

return [
    [
        'pattern' => 'aktuelles/(:any)',
        'action' => function($any) {
            if ($any == 'json') {
                $options = [
                    'title'       => 'Neues aus dem Fundevogel',
                    'description' => 'Alle Neuigkeiten rund um den Fundevogel, die Kinder- und Jugendbuchhandlung in Freiburg.',
                    'feedurl'     => site()->url() . '/aktuelles/json/',
                    'link'        => 'aktuelles',
                    'snippet'     => 'feed/json',
                ];

                return kirby()->collection('news')->limit(12)->feed($options);
            }

            if ($any == 'rss') {
                $options = [
                    'title'       => 'Neues aus dem Fundevogel',
                    'description' => 'Alle Neuigkeiten rund um den Fundevogel, die Kinder- und Jugendbuchhandlung in Freiburg.',
                    'url'         => site()->url(),
                    'feedurl'     => site()->url() . '/aktuelles/rss/',
                    'link'        => 'aktuelles',
                    'snippet'     => 'feed/rss',
                ];

                return kirby()->collection('news')->limit(12)->feed($options);
            }

            $identifiers = [];

            foreach (kirby()->collection('news')->limit(page('aktuelles')->perpage()->int()) as $article) {
                $identifiers[] = $article->slug();
            }

            if (in_array($any, $identifiers) === true) {
                return go('/#' . $any);
            }

            return go('/');
        }
    ],
    [
        'pattern' => 'lesetipps/neuerscheinungen/(:num)',
        'action'  => function ($num) {
            return go('lesetipps/neuerscheinungen', 301);
        }
    ],
    [
        'pattern' => 'en/recommendations/novelties/(:num)',
        'action'  => function ($num) {
            return go('en/recommendations/novelties', 301);
        }
    ],
    [
        'pattern' => 'fr/coin-de-livres/nouveautes/(:num)',
        'action'  => function ($num) {
            return go('fr/coin-de-livres/nouveautes', 301);
        }
    ],
    [
        'pattern' => 'kalender/veranstaltungen',
        'action' => function() {
            return go('kalender', 301);
        },
    ],
    [
       'pattern' => 'sitemap.xml',
       'action' => function() {
            $pages = site()->pages()->index();

            # fetch the pages to ignore from the config settings,
            # if nothing is set, we ignore the error page
            $ignore = kirby()->option('sitemap.ignore', 'error');

            $content = snippet('sitemap', compact('pages', 'ignore'), true);

            # return response with correct header type
            return new Kirby\Cms\Response($content, 'application/xml');
        },
    ],
    [
        'pattern' => 'sitemap',
        'action' => function() {
            return go('sitemap.xml', 301);
        },
    ],
    [
        'pattern' => 'news',
        'method' => 'GET',
        'action'  => function () {
            return go('aktuelles', 301);
        },
    ],
    [
        'pattern' => 'news/json',
        'method' => 'GET',
        'action'  => function () {
            return go('aktuelles/json', 301);
        },
    ],
    [
        'pattern' => 'news/rss',
        'method' => 'GET',
        'action'  => function () {
            return go('aktuelles/rss', 301);
        },
    ],
    [
        'pattern' => 'kalender/json',
        'method' => 'GET',
        'action'  => function () {
            $options = [
                'title'       => 'Veranstaltungen vom Fundevogel',
                'description' => 'Alle Veranstaltungen des Fundevogels.',
                'feedurl'     => page('kalender')->url() . '/json',
                'link'        => 'kalender',
                'snippet'     => 'feed/json',
            ];

            return kirby()->collection('events/all')->flip()->limit(12)->feed($options);
        },
    ],
    [
        'pattern' => 'kalender/rss',
        'method' => 'GET',
        'action'  => function () {
            $options = [
                'title'       => 'Veranstaltungen vom Fundevogel',
                'description' => 'Alle Veranstaltungen des Fundevogels.',
                'feedurl'     => page('kalender')->url() . '/rss',
                'link'        => 'kalender',
                'snippet'     => 'feed/rss',
            ];

            return kirby()->collection('events/all')->flip()->limit(12)->feed($options);
        },
    ],
    [
        'pattern' => 'feeds/json',
        'method' => 'GET',
        'action'  => function () {
            $options = [
                'title'       => 'Unsere Lesetipps',
                'description' => 'Wir teilen unsere Lesefreuden mit Euch und berichten von Büchern, die uns besonders inspiriert und begeistert haben.',
                'feedurl'     => site()->url() . '/feeds/json/',
                'link'        => 'lesetipps',
                'snippet'     => 'feed/json',
            ];

            return kirby()->collection('lesetipps')->limit(48)->feed($options);
        },
    ],
    [
        'pattern' => 'feeds/rss',
        'method' => 'GET',
        'action'  => function () {
            $options = [
                'title'       => 'Unsere Lesetipps',
                'description' => 'Wir teilen unsere Lesefreuden mit Euch und berichten von Büchern, die uns besonders inspiriert und begeistert haben.',
                'feedurl'     => site()->url() . '/feeds/rss/',
                'link'        => 'lesetipps',
                'snippet'     => 'feed/rss',
            ];

            return kirby()->collection('lesetipps')->limit(48)->feed($options);
        },
    ],
];
