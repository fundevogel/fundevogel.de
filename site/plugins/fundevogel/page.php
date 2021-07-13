<?php

return [
    'hasCover' => function (): bool {
        return $this->cover()->isNotEmpty();
    },
    'getCover' => function () {
        $page = $this;

        if ($this->intendedTemplate() == 'lesetipps.article') {
            if ($this->books()->isEmpty()) {
                return page('lesetipps')->fallback()->toFile();
            }

            $page = $this->books()->toPages()->first();
        }

        $cover = $page->hasCover()
            ? $page->cover()->toFile()
            : page('lesetipps')->fallback()->toFile()
        ;

        if (!$page->cover()->exists()) {
            $cover = $page->images()->first();
        }

        return $cover;
    },
    'moreLink' => function($classes = '') {
        $link = Html::tag('a', '→ ' . t('Weiterlesen'), [
            'href' => $this->url(),
            'class' => $classes,
        ]);

        return $link;
    },
    'getPageTitle' => function () {
        if ($this->intendedTemplate() == 'lesetipps.article') {
            return page('lesetipps')->title()->html();
        } elseif ($this->intendedTemplate() == 'calendar.archive') {
            # TODO: Translation!
            return t('Kalenderarchiv');
        } elseif ($this->isHomePage()) {
            return 'Fundevogel';
        }

        return $this->title()->html();
    },
    'toLocalDate' => function (string $type): string
    {
        # French & English
        $format = 'd/m/Y';

        # German
        if (kirby()->language() == 'de') {
            $format = 'd.m.Y';
        }

        return date($format, $this->$type());
    }
];
