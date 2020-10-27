<?php

return [
    'createImage' => function (string $classes = '', string $preset = 'cover', bool $isLightbox = false, bool $noLazy = false, array $extra = []) {
        $image = $this->thumb($preset);
        $blurry = $this->thumb($preset . '.blurry');
        $source = $noLazy === false ? $blurry->url() : $image->url();
        $title = $this->titleAttribute();
        $alt = $this->source()->isEmpty()
            ? $this->altAttribute()
            : A::join([$this->altAttribute(), t('Bildquelle') . ': ' . $this->source()], ' - ')
        ;

        $attributes = [
            'class' => $classes,
            'title' => $title,
            'alt' => $alt,
            'width' => $image->width(),
            'height' => $image->height(),
            'loading' => 'eager',
            'decoding' => 'async',
        ];

        if ($noLazy === false) {
            $lazyclass = in_array($preset, option('thumbs.blurry', []))
                ? 'lazyload blur-up'
                : 'lazyload'
            ;

            $attributes = A::update($attributes, [
                'class' => A::join([$classes, $lazyclass], ' '),
                'loading' => 'lazy',
                'data-src' => $image->url(),
                'data-sizes' => 'auto',
                'data-aspectratio' => '',
            ]);
        }

        if ($isLightbox) {
            $orientation = $this->orientation() === 'landscape' ? 'full-width' : 'full-height';
            $attributes = A::update($attributes, [
                'data-bp' => $this->thumb($orientation)->url(),
                'data-caption' => $title,
            ]);
        }

        return snippet('webPicture', [
            'src' => $this,
            'tag' => Html::img($source, A::update($attributes, $extra)),
            'sizes' => option('thumbs.sizes')[$preset],
            'preset' => $preset,
            'noLazy' => $noLazy,
        ]);
    },
    'getFront' => function ($classes = '') {
        // Try using default cover, otherwise use global fallback image
        // (1) Default cover image
        $default = $this->coverImage()->toFile();
        // (2) Fallback cover image
        $fallback = site()->fallback()->toFile();
        $cover = $default !== null
            ? $default
            : $fallback
        ;

        return $cover->createImage($classes, 'lesetipps.pdf', false, true);
    },
];
