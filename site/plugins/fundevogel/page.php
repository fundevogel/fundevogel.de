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
    'moreLink' => function($classes = '') {
        $link = Html::tag('a', '→ ' . t('Weiterlesen'), [
            'href' => $this->url(),
            'class' => $classes,
        ]);

        return $link;
    },
];
