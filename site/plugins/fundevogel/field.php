<?php

return [
    'addToStructure' => function (Kirby\Cms\Field $field, array $entry): void
    {
        $value = $field->yaml();

        if (isset($entry[0]) && is_array($entry[0])) {
            array_push($value, ...$entry);
        } else {
            array_push($value, $entry);
        }

        $field->parent()->update([
            $field->key() => Yaml::encode($value)
        ]);
    },
    'toPhone' => function (Kirby\Cms\Field $field): string
    {
        return preg_replace('![^0-9\+]+!', '', $field->value());
    },
    'time2local' => function (Kirby\Cms\Field $field, bool $hasExtension = false): string
    {
        $langCode = kirby()->language();

        # French
        if ($langCode == 'fr') {
            return $field->toDate('G') . 'h' . $field->toDate('i');
        }

        # English
        if ($langCode == 'en') {
            return $field->toDate('g:ia');
        }

        # German (default language)
        $time = $field->toDate('G:i');

        return $hasExtension
            ? $time . ' Uhr'
            : $time
        ;
    },
    'toContent' => function (Kirby\Cms\Field $field): string
    {
        # Add class to paragraph & list elements
        # See https://forum.getkirby.com/t/add-classes-to-textarea-field-output/14060/5

        $from = [
            '/<p>/',
            '/<ul>/',
            '/<ol>/',
        ];

        $to = [
            '<p class="content">',
            '<ul class="list">',
            '<ol class="list">',
        ];

        return Str::replace(preg_replace($from, $to, $field->value()), ' class="invisible"', '');
    },
];
