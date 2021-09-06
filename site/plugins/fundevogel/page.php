<?php

return [
    'hasCover' => function (): bool
    {
        return $this->cover()->isNotEmpty();
    },
    'getCover' => function ()
    {
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
    'moreLink' => function($classes = '')
    {
        $link = Html::tag('a', '→ ' . t('Weiterlesen'), [
            'href' => $this->url(),
            'class' => $classes,
        ]);

        return $link;
    },
    'getPageTitle' => function ()
    {
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
    },

    /**
     * SEO & metadata
     */
    'getMetaImage' => function (): Kirby\Cms\File
    {
        # Provide fallback
        $metaImage = $this->meta_image()->toFile() ?? site()->meta_image()->toFile();

        # Use cover (if available)
        if ($this->hasCover()) {
            $metaImage = $this->cover()->toFile();
        }

        # Use cover for reading tips
        if ($this->intendedTemplate() == 'lesetipps.article') {
            $metaImage = $this->book()->toPage()->cover()->toFile();
        }

        return $metaImage;
    },
    'getOpengraphImage' => function (): Kirby\Cms\FileVersion
    {
        # Provide fallback
        $opengraphImage = $this->og_image()->toFile() ?? site()->og_image()->toFile();

        # Use cover (if available)
        if ($this->hasCover()) {
            $opengraphImage = $this->cover()->toFile();
        }

        # Use cover for reading tips
        if ($this->intendedTemplate() == 'lesetipps.article') {
            $opengraphImage = $this->book()->toPage()->cover()->toFile();
        }

        return $opengraphImage->thumb([
            'width'   => 1200,
            'height'  => 630,
            'quality' => 85,
            'crop'    => true,
        ]);
    },
    'getTwittercardImage' => function (): Kirby\Cms\FileVersion
    {
        # Provide fallback
        $twittercardImage = $this->twitter_image()->toFile() ?? site()->twitter_image()->toFile();

        # Use cover (if available)
        if ($this->hasCover()) {
            $twittercardImage = $this->cover()->toFile();
        }

        # Use cover for reading tips
        if ($this->intendedTemplate() == 'lesetipps.article') {
            $twittercardImage = $this->book()->toPage()->cover()->toFile();
        }

        return $twittercardImage->thumb([
            'width'   => 1200,
            'height'  => 675,
            'quality' => 85,
            'crop'    => true,
        ]);
    },
];
