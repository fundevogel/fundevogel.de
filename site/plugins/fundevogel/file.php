<?php

return [
    'createImage' => function (string $classes = '', string $preset = 'cover', bool $isLightbox = false, bool $noLazy = false, array $extra = []) {
        $image = $this->thumb($preset);
        $blurry = $this->thumb($preset . '.blurry');
        $source = $noLazy === false ? $blurry->url() : $image->url();
        $alt = $this->altAttribute();
        $title = $this->source()->isEmpty()
            ? $this->titleAttribute()
            : $this->titleAttribute() . ' - ' . $this->source()
        ;

        $attributes = A::update([
            'class' => $classes,
            'title' => $title,
            'alt' => $alt,
            'width' => $image->width(),
            'height' => $image->height(),
        ], $extra);

        if ($noLazy === false) {
            $attributes = A::update($attributes, [
                'class' => A::join([$classes, 'lazyload animation-blur-in'], ' '),
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
            'tag' => Html::img($source, $attributes),
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

        return $cover->createImage($classes, 'lesetipps.pdf');
    }
];
