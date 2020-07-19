<?php

return [
    'createImage' => function (string $classes = '', string $preset = 'cover', bool $isBlurry = false, bool $isLightbox = false, array $extra = []) {
        $cover = $this->thumb($preset);
        $blurry = $this->thumb($preset . '.blurred');

        $source = $isBlurry ? $blurry->url() : $cover->url();
        $title = $this->source()->isEmpty()
            ? $this->titleAttribute()
            : $this->titleAttribute() . ' - ' . $this->source()
        ;

        $attributes = A::append([
            'class' => $classes,
            'title' => $title,
            'alt' => $this->altAttribute(),
            'width' => $cover->width(),
            'height' => $cover->height(),
        ], $extra);

        if ($isBlurry) {
            $attributes = A::append($attributes, [
                'data-layzr' => $cover->url(),
            ]);
        }

        if ($isLightbox) {
            $attributes = A::append($attributes, [
                'data-bp' => $this->thumb('full')->url(),
                'data-caption' => $title,
            ]);
        }

        return Html::img($source, $attributes);
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

        $image = $cover->thumb('lesetipps.pdf');

        return Html::img($image->url(), [
            'class' => $classes,
            'title' => $this->titleAttribute(),
            'alt' => $this->altAttribute(),
            'width' => $image->width(),
            'height' => $image->height(),
        ]);
    }
];
