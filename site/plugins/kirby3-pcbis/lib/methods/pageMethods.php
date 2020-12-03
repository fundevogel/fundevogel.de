<?php

return [
    'isTranslated' => function (string $language): bool {
        // Check if translation file for given language exists
        return $this->translation($language)->exists();
    },
    'hasTranslatedSiblings' => function (): bool {
        if ($this->hasPrevListed() && $this->prevListed()->isTranslated(kirby()->languageCode())) {
            return true;
        }

        if ($this->hasNextListed() && $this->nextListed()->isTranslated(kirby()->languageCode())) {
            return true;
        }

        return false;
    },
    'prevTranslated' => function () {
        return $this->prevAll()->listed()->onlyTranslated()->last();
    },
    'nextTranslated' => function () {
        return $this->nextAll()->listed()->onlyTranslated()->first();
    },
    'hasTranslations' => function (): bool {
        $languages = kirby()->languages()->not(kirby()->defaultLanguage()->code());

        foreach ($languages as $language) {
            if ($this->translation($language)->exists()) {
                return true;
            }
        }

        return false;
    },
    'updateBook' => function (bool $forceRefresh = false, array $refresh = []) {
        $data = loadBook($this->isbn()->value(), $forceRefresh);

        $updateArray = [];

        foreach ($data as $key => $value) {
            # Don't update ..
            # (1) .. fields that are filled and not explicitly eligible for refreshing
            if ($this->$key()->isNotEmpty() && !in_array($key, $refresh)) {
                continue;
            }

            # (2) .. `book_subtitle` if the `author` field is filled
            $hasAuthor = $this->author()->isNotEmpty();

            if ($key === 'book_subtitle' && $hasAuthor) {
                continue;
            }

            $updateArray[$key] = $value;
        }

        # Only request shop URL if its field is currently empty
        if ($this->shop()->isEmpty() && !in_array('shop', $refresh)) {
            $updateArray['shop'] = getShopLink($this->isbn()->value());
        }

        try {
            $this->update($updateArray);

            return true;
        } catch (\Exception $e) {}

        return false;
    },
    'toBook' => function (bool $forceRefresh = false) {
        return pcbis()->load($this->isbn()->value(), $forceRefresh);
    },
    'ola' => function (int $quantity = 1) {
        return pcbis()->ola($this->isbn()->value(), $quantity);
    },
];
