<?php

return [
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
];
