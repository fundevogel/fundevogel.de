<?php

return [
    'createImage' => function (string $classes = '', string $preset = 'cover', bool $isBlurry = false) {
        $cover = $this->thumb($preset);
        $blurry = $this->thumb($preset . '.blurred');

        $url = $isBlurry
            ? $blurry->url()
            : $cover->url()
        ;

        $attributes = [
            'class' => $classes,
            'title' => $this->titleAttribute(),
            'alt' => $this->altAttribute(),
            'width' => $cover->width(),
            'height' => $cover->height(),
        ];

        if ($this->source()->isNotEmpty()) {
            $attributes = A::update($attributes, [
                'title' => $this->titleAttribute() . ' - ' . $this->source(),
            ]);
        }

        if ($isBlurry) {
            $attributes = A::append($attributes, [
                'data-layzr' => $cover->url(),
            ]);
        }

        return Html::img($url, $attributes);
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
