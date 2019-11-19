<?php

Kirby::plugin('fundevogel/methods', [
    'fileMethods' => [
        'getCover' => function () {
            $seasons = [
                'Frühjahr' => 'fruehjahr',
                'Herbst' => 'herbst',
            ];

            $lesetipps = page('lesetipps');
            $season = $seasons[$this->edition()->toString()];
            $cover = $lesetipps->image(basename($this->root()) . '.jpg');

            // Fallback cover image
            $image = $lesetipps->image($season . '.jpg');

            if ($cover !== null) {
                // Real cover image
                $image = $cover->thumb('lesetipps.pdf');
            }

            return $image;
        }
    ],
    'pageMethods' => [
        'moreLink' => function() {
            $words = 50;
            $excerpt = $this->text()->chopper($words);
            $link = Html::tag('a', '→ ' . t('lesetipps_weiterlesen'), [
                'href' => $this->url()
            ]);

            return $excerpt . $link;
        },
    ],
    'siteMethods' => [
        'useSVG' => function ($title = '', $file = '', $width, $height) {
            return '<svg role="img" title="' . $title . '" width="' . $width . '" height="' . $height . '"><use xlink:href="/assets/images/icons.svg#' . $file . '"></use></svg>';
        }
    ]
]);
