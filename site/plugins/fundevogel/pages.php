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
    }
];
