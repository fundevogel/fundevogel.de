<?php

return [
    'hasCover' => function (): bool {
        return $this->cover()->isNotEmpty();
    },
    'getCover' => function () {
        $cover = $this->hasCover()
            ? $this->cover()->toFile()
            : site()->fallback()->toFile()
        ;

        return $cover;
    },
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
    'moreLink' => function($classes = '') {
        $link = Html::tag('a', '→ ' . t('Weiterlesen'), [
            'href' => $this->url(),
            'class' => $classes,
        ]);

        return $link;
    },
    'updateBook' => function (array $dataArray) {
        $updateArray = [];

        foreach ($dataArray as $key => $value) {
            if ($this->$key()->isNotEmpty()) {
                continue;
            }

            # If two out of three fields are filled, and one of them is `author`,
            # don't fill `participants` again, as we did it before already
            if ($key === 'participants') {
                if (($this->author()->isNotEmpty() && $this->illustrator()->isNotEmpty()) || ($this->author()->isNotEmpty() && $this->translator()->isNotEmpty())) {
                    continue;
                }
            }

            $updateArray = A::update($updateArray, [
                $key => $value
            ]);
        }

        $this->update($updateArray);
    },
];
