<?php

return [
    'kirbytext:after' => function ($text)
    {
        # Modify 'author' inside `blockquote` elements for consistent styling
        $text = preg_replace_callback('#<footer>(.*?)</footer>#', function ($matches) {
            $html = '';

            # Create updated `cite` tag
            $html .= '<footer>';
            $html .= useSVG(t('quote'), 'inline w-6 h-6 -mt-1 mr-1 text-red-medium fill-current', 'message-filled');
            $html .= '<span class="text-sm text-red-medium not-italic font-normal">' . $matches[1] . '</span>';
            $html .= '</footer>';

            return $html;
        }, $text);


        # Add class to paragraph & list elements
        # See https://forum.getkirby.com/t/add-classes-to-textarea-field-output/14060/5

        $from = [];
        $from[0] = '/<p>/';
        $from[1] = '/<ul>/';
        $from[2] = '/<ol>/';

        $to = [];
        $to[0] = '<p class="content">';
        $to[1] = '<ul class="list">';
        $to[2] = '<ol class="list">';

        return preg_replace($from, $to, $text);
    },
];
