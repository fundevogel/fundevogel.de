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
    }
];
