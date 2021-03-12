<?php

return [
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
    'getDownloadDetails' => function () {
        $details = $this->niceSize();

        if ($this->type() === 'image') {
            $details .= ' - ' . $this->width() . ' x ' . $this->height();
        }

        return $details;
    },
];
