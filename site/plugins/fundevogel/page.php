<?php

return [
    'hasCover' => function (): bool {
        return $this->cover()->isNotEmpty();
    },
    'getCover' => function () {
        $page = $this;

        if ($this->intendedTemplate() == 'lesetipps.article') {
            if ($this->books()->isEmpty()) {
                return site()->fallback()->toFile();
            }

            $page = $this->books()->toPages()->first();
        }

        $cover = $page->hasCover()
            ? $page->cover()->toFile()
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

        # These fields may be updated
        $refresh = [
            'isAudiobook',
        ];

        foreach ($dataArray as $key => $value) {
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

            # (3) .. `participants` if the `author` field and either
            # `illustrator`, `translator` or `narrator` are filled
            $hasIllustrator = $this->illustrator()->isNotEmpty();
            $hasTranslator = $this->translator()->isNotEmpty();
            $hasNarrator = $this->narrator()->isNotEmpty();

            if ($key === 'participants') {
                if (($hasAuthor && $hasIllustrator) || ($hasAuthor && $hasTranslator) || ($hasAuthor && $hasNarrator)) {
                    continue;
                }
            }

            # (4) .. `page_count` if the book is an audiobook
            if ($key === 'page_count' && $dataArray['isAudiobook'] === true) {
                continue;
            }

            $updateArray[$key] = $value;
        }

        $this->update($updateArray);
    },
];
