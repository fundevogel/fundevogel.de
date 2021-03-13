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
    ],
    'quote' => [
        'attr' => [
            'author',
            'color',
            'border',
        ],
        'html' => function($tag) {
            $html = '';

            # Reset blockquote styles
            $html .= '<blockquote class="p-0 border-0">';

            # Determine base color
            $color = 'red';

            if ($tag->color === 'orange') {
                $color = $tag->color;
            }

            # Insert content
            $html .= '<p class="content">'. $tag->value .'</p>';

            # Add author
            if ($tag->author != '') {
                $html .= '<footer>';
                $html .= useSVG(t('quote'), 'inline w-6 h-6 -mt-1 mr-1 text-' . $color . '-medium fill-current', 'message-filled');
                $html .= '<span class="text-sm text-' . $color . '-medium not-italic font-normal">' . $tag->author . '</span>';
                $html .= '</footer>';
            }

            $html .= '</blockquote>';

            return $html;
        },
    ],
];
