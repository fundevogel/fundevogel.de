<?php

Kirby::plugin('fundevogel/methods', [
    'tags' => [
        'short' => [
            'attr' => [
                'desc',
                'color',
            ],
            'html' => function($tag) {
                if ($tag->color === 'orange') {
                    return '<abbr class="js-tippy font-normal text-orange-medium hover:text-orange-dark border-b-2 border-dashed border-orange-medium hover:border-orange-dark cursor-help" title="' . $tag->desc . '" data-tippy-theme="fundevogel orange">' . $tag->value . '</abbr>';
                }
                return '<abbr class="js-tippy font-normal text-red-medium hover:text-red-dark border-b-2 border-dashed border-red-medium hover:border-red-dark cursor-help" title="' . $tag->desc . '" data-tippy-theme="fundevogel red">' . $tag->value . '</abbr>';
            }
        ]
    ],
    'fileMethods' => [
        'getCover' => function ($classes = '') {
            // Try using real cover, otherwise use global fallback image
            // (1) Real cover image
            $fileCover = $this->coverImage()->toFile();
            // (2) Fallback cover image
            $fallback = site()->fallback()->toFile();
            $cover = $fileCover !== null
                ? $fileCover
                : $fallback
            ;

            $image = $cover->thumb('lesetipps.pdf');

            return Html::img($image->url(), [
                'class' => $classes,
                'title' => $this->titleAttribute(),
                'alt' => $this->altAttribute(),
                'width' => $image->width(),
                'height' => $image->height(),
            ]);
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
        'useSVG' => function ($title, $classes = '', $file = '', $customAttribute = '') {
            if ($file === '') {
                $file = str_replace('-', '', $title);
                $file = strtolower($file);
            }

            return '<svg class="' . $classes . '" title="' . $title . '" role="img"' . r($customAttribute !== '', ' ' . $customAttribute) . '><use xlink:href="/assets/images/icons.svg#' . $file . '"></use></svg>';
        },
        'useSeparator' => function($color = 'orange-light', $position = 'top') {
            $margin = Str::contains($position, 'top') === true ? '-mb-px' : '-mt-px';

            return '<div class="w-full"><svg class="w-full h-auto ' . $margin . ' fill-current text-' . $color .'" role="img"><use xlink:href="/assets/images/icons.svg#' . $position . '"></use></svg></div>';
        }
    ]
]);
