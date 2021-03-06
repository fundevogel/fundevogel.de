<?php

return [
    'onlyTranslated' => function (string $language = null) {
        if ($language === null) {
            $language = kirby()->language()->code();
        }

        return $this->filter(function ($page) use ($language) {
            if ($page->isTranslated($language)) {
                return $page;
            }
        });
    },
    'filterBooks' => function ($field, $value) {
        return $this->filter(function ($page) use ($field, $value) {
            $books = $page->books()->toPages()->filterBy($field, $value, ',');

            if ($books->isNotEmpty()) {
                return $page;
            }
        });
    },
];
