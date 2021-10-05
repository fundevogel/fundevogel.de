<?php

return [
    'link' => [
        # Default attributes:
        # - class
        # - lang
        # - rel
        # - role
        # - target
        # - text
        # - title
        'attr' => A::merge(Kirby\Text\KirbyTag::$types['link']['attr'], [
            'color',
        ]),
        'html' => function($tag) {
            # Check if target is Wikipedia article
            if (Str::startsWith($tag->value, 'wiki')) {
                # Determine article name
                $article = $tag->text;

                if (Str::contains($tag->value, '=')) {
                    $article = Str::split($tag->value, '=')[1];
                }

                # Determine `title` attribute
                if (empty($tag->title) === true) {
                    $tag->title = sprintf('\'%s\' @ Wikipedia', $article);
                }

                $lang = empty($tag->lang) === false ? $tag->lang : 'de';

                # Set `href` attribute
                $tag->value = Str::replace('https://' . $lang . '.wikipedia.org/wiki/' . $article, ' ', '_');

            # .. otherwise, default Kirby stuff
            } else {
                if (empty($tag->lang) === false) {
                    $tag->value = Url::to($tag->value, $tag->lang);
                }
            }

            # Check if URL is external
            if (Url::stripPath(Url::to($tag->value)) !== Url::stripPath(site()->url())) {
                $tag->target = 'blank';
            }

            # Determine attributes
            # (1) Kirby defaults
            $attributes = [
                'rel'    => $tag->rel,
                'class'  => $tag->class,
                'role'   => $tag->role,
                'title'  => $tag->title,
                'target' => $tag->target,

                # (2) Prevent Barba preloading
                'data-barba-prevent' => 'true',
            ];

            # (2) Add tooltips if `title` attribute present
            if (empty($tag->title) === false) {
                # Determine base color
                if (in_array($tag->color, ['red', 'orange']) === false) {
                    $tag->color = 'red';
                }

                # Add proper classes & theme
                $attributes = A::merge($attributes, [
                    'class' => Str::replace('js-tippy font-normal text-%s-medium hover:text-%s-dark', '%s', $tag->color),
                    'data-tippy-theme' => 'fundevogel ' . $tag->color,
                ]);
            }

            return Html::a($tag->value, $tag->text, $attributes);
        },
    ],
    'date' => [
        'html' => function($tag) {
            if ($tag->value === 'created') {
                return $tag->parent()->toLocalDate('createdAt');
            }

            return $tag->parent()->toLocalDate('modified');
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
    'pubkey' => [
        'attr' => [
            'fingerprint',
            'text',
        ],
        'html' => function($tag): string
        {
            if ($pgpKey = site()->file($tag->value . '.asc')) {
                if ($tag->fingerprint) {
                    return chunk_split($pgpKey->content()->fingerprint(), 4, ' ');
                }

                return kirbytag([
                    'link' => $pgpKey->url(),
                    'class' => 'js-tippy outline-none',
                    'text' => $tag->text ?? $pgpKey->title(),
                    'title' => $pgpKey->content()->type() . ' (' . $pgpKey->algorithm() . ') - ' . $pgpKey->length() . 'bit',
                ]);
            }

            return '';
        },
    ],
];
