<?php

##
# ROUTING
##

return [
    [
        'pattern' => 'news/(:any)',
        'action' => function($any) {
            if ($any == 'json') {
                $options = [
                    'title'       => 'Neues aus dem Fundevogel',
                    'description' => 'Alle Neuigkeiten rund um den Fundevogel, die Kinder- und Jugendbuchhandlung in Freiburg.',
                    'feedurl'     => site()->url() . '/news/json/',
                    'link'        => 'news',
                    'snippet'     => 'feed/json',
                ];

                return kirby()->collection('news')->limit(12)->feed($options);
            }

            if ($any == 'rss') {
                $options = [
                    'title'       => 'Neues aus dem Fundevogel',
                    'description' => 'Alle Neuigkeiten rund um den Fundevogel, die Kinder- und Jugendbuchhandlung in Freiburg.',
                    'url'         => site()->url(),
                    'feedurl'     => site()->url() . '/news/rss/',
                    'link'        => 'news',
                    'snippet'     => 'feed/rss',
                ];

                return kirby()->collection('news')->limit(12)->feed($options);
            }

            $identifiers = [];

            foreach (kirby()->collection('news')->limit(page()->perpage()->int()) as $article) {
                $identifiers[] = $article->slug();
            }

            if (in_array($any, $identifiers) === true) {
                return go('/#' . $any);
            }

            return go('/');
        }
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
      }
    ],
    [
        'pattern' => 'sitemap',
        'action' => function() {
            return go('sitemap.xml', 301);
        }
    ],
    [
        'pattern' => 'news/json',
        'method' => 'GET',
        'action'  => function () {
            $options = [
                'title'       => 'Neues aus dem Fundevogel',
                'description' => 'Alle Neuigkeiten rund um den Fundevogel, die Kinder- und Jugendbuchhandlung in Freiburg.',
                'feedurl'     => site()->url() . '/news/json/',
                'link'        => 'news',
                'snippet'     => 'feed/json',
            ];

            return kirby()->collection('news')->limit(12)->feed($options);
        }
    ],
    [
        'pattern' => 'news/rss',
        'method' => 'GET',
        'action'  => function () {
            $options = [
                'title'       => 'Neues aus dem Fundevogel',
                'description' => 'Alle Neuigkeiten rund um den Fundevogel, die Kinder- und Jugendbuchhandlung in Freiburg.',
                'feedurl'     => site()->url() . '/news/rss/',
                'link'        => 'news',
                'snippet'     => 'feed/rss',
            ];

            return kirby()->collection('news')->limit(12)->feed($options);
        }
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
        }
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
        }
    ],
];
