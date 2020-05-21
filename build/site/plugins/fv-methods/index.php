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
        'moreLink' => function($class = '') {
            $link = Html::tag('a', '→ ' . t('lesetipps_weiterlesen'), [
                'href' => $this->url(),
                'class' => $class,
            ]);

            return $link;
        },
    ],
    'siteMethods' => [
        'useSVG' => function ($title, $classes = '', $file = '') {
            if ($file === '') {
                $file = str_replace('-', '', $title);
                $file = strtolower($file);
            }

            return '<svg class="' . $classes . '" title="' . $title . '" role="img"><use xlink:href="/assets/images/icons.svg#' . $file . '"></use></svg>';
        },
        'useSeparator' => function($color = 'orange-light', $position = 'top') {
            $margin = Str::contains($position, 'top') === true ? '-mb-px' : '-mt-px';

            return '<div class="w-full"><svg class="w-full h-auto ' . $margin . ' fill-current text-' . $color .'" role="img"><use xlink:href="/assets/images/icons.svg#' . $position . '"></use></svg></div>';
        }
    ]
]);
