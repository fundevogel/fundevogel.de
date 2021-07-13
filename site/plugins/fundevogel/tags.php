<?php

return [
    'date' => [
        'html' => function($tag) {
            if ($tag->value === 'created') {
                return $tag->parent()->toLocalDate('createdAt');
            }

            return $tag->parent()->toLocalDate('modified');
        },
    ],
    'wiki' => [
        'attr' => [
            'title',
            'color',
        ],
        'html' => function($tag) {
            # Determine base color
            $color = in_array($tag->color, ['red', 'orange']) === true
                ? $tag->color
                : 'red'
            ;

            # Determine base color
            $title = empty($tag->title)
                ? $tag->value
                : $tag->title
            ;

            # Build Wikipedia URL
            $url = 'https://de.wikipedia.org/wiki/' . $title;

            return Html::a($url, $tag->value, [
                'class' => sprintf('js-tippy font-normal text-%s-medium hover:text-%s-dark', $color, $color, $color, $color),
                'data-tippy-theme' => 'fundevogel ' . $color,
                'title' => sprintf('%s auf Wikipedia', $title),
                'target' => '_blank',
            ]);
        },
    ],
    'short' => [
        'attr' => [
            'desc',
            'color',
        ],
        'html' => function($tag) {
            # Determine base color
            $color = in_array($tag->color, ['red', 'orange']) === true
                ? $tag->color
                : 'red'
            ;

            return Html::tag('abbr', $tag->value, [
                'class' => sprintf('js-tippy font-normal text-%s-medium hover:text-%s-dark border-b-2 border-dashed border-%s-medium hover:border-%s-dark cursor-help', $color, $color, $color, $color),
                'data-tippy-theme' => 'fundevogel ' . $color,
                'title' => $tag->desc,
            ]);
        },
    ],
    'quote' => [
        'attr' => [
            'author',
            'color',
            'border',
        ],
        'html' => function($tag) {
            # Determine base color
            $color = in_array($tag->color, ['red', 'orange']) === true
                ? $tag->color
                : 'red'
            ;

            $data = [
                'text' => $tag->value,
                'author' => $tag->author,
                'color' => $color,
            ];

            return snippet('components/quote', $data, true);
        },
    ],
];
