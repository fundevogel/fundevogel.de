<?php

return [
    'getFront' => function ($classes = '') {
        // Try using default cover, otherwise use global fallback image
        // (1) Default cover image
        $default = $this->coverImage()->toFile();
        // (2) Fallback cover image
        $fallback = page('lesetipps')->fallback()->toFile();
        $cover = $default !== null
            ? $default
            : $fallback
        ;

        return $cover->createImage($classes, 'lesetipps.pdf', false, true);
    },
];
