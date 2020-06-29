<?php

Kirby::plugin('fundevogel/methods', [
    'tags' => [
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
        ]
    ],
    'fileMethods' => [
        'getCover' => function ($classes = '') {
            // Try using default cover, otherwise use global fallback image
            // (1) Default cover image
            $default = $this->coverImage()->toFile();
            // (2) Fallback cover image
            $fallback = site()->fallback()->toFile();
            $cover = $default !== null
                ? $default
                : $fallback
            ;

            $image = $cover->thumb('lesetipps.pdf');

            return Html::img($image->url(), [
                'class' => $classes,
                'title' => $this->titleAttribute(),
                'alt' => $this->altAttribute(),
                'width' => $image->width(),
                'height' => $image->height(),
            ]);
        }
    ],
    'pageMethods' => [
        'isTranslated' => function (string $language): bool {
            // Nice try!
            if ($language === kirby()->defaultLanguage()->code()) {
                return true;
            }

            // Check if translation file for given language exists
            if (!$this->translation($language)->exists()) {
                return false;
            }

            // Check if `text` on current page matches `text` in given language
            // if ($this->content(kirby()->defaultLanguage()->code())->text() == $this->content($language)->text()) {
            //     return false;
            // }

            return true;
        },
        'hasTranslations' => function () {
            $count = 0;

            foreach (kirby()->languages() as $language) {
                if (!$this->isTranslated($language->code())) {
                    continue;
                }

                $count++;
            }

            return $count > 1;
        },
        'moreLink' => function($class = '') {
            $link = Html::tag('a', '→ ' . t('Weiterlesen'), [
                'href' => $this->url(),
                'class' => $class,
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
    ],
    'pagesMethods' => [
        'onlyTranslated' => function (string $language) {
            return $this->filter(function ($page) use ($language) {
                if ($page->isTranslated($language)) {
                    return $page;
                }
            });
        }
    ]
]);
