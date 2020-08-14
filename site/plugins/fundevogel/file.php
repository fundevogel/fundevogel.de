<?php

return [
    'createImage' => function (string $classes = '', string $preset = 'cover', bool $isLightbox = false, array $extra = []) {
        $image = $this->thumb($preset);
        $blurry = $this->thumb($preset . '.blurry');
        $alt = $this->altAttribute();
        $title = $this->source()->isEmpty()
            ? $this->titleAttribute()
            : $this->titleAttribute() . ' - ' . $this->source()
        ;

        $attributes = A::append([
            'data-src' => $image->url(),
            'class' => 'lazyload ' . $classes,
            'title' => $title,
            'alt' => $alt,
            'width' => $image->width(),
            'height' => $image->height(),
            'loading' => 'lazy',
            'data-sizes' => 'auto',
        ], $extra);

        if ($isLightbox) {
            $orientation = $this->orientation() === 'landscape' ? 'full-width' : 'full-height';
            $attributes = A::append($attributes, [
                'data-bp' => $this->thumb($orientation)->url(),
                'data-caption' => $title,
            ]);
        }

        return snippet('webPicture', [
            'src' => $this,
            'tag' => Html::img($blurry->url(), $attributes),
            'sizes' => option('thumbs.sizes')[$preset],
            'preset' => $preset,
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

        return $cover->createImage($classes, 'lesetipps.pdf');
    }
];
