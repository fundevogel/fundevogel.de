<?php

use Kirby\Cms\Field;

return [
    'addToStructure' => function (Field $field, array $entry): void {
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
];
