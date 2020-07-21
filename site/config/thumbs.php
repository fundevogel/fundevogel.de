<?php

##
# THUMBNAILS
##

return [
    # General thumbnail settings
    'driver' => 'im',
    'quality' => 85,
    'interlace' => true,

    # Thumbnail presets
    'presets' => [
        'cover' => ['width' => 460],
        'full-width' => ['width' => 768],
        'full-height' => ['width' => null, 'height' => 640],
        'news.hero' => ['width' => 960],
        'news.article.image' => ['width' => 224, 'crop' => true],
        'news.article.image.blurred' => ['width' => 224, 'crop' => true, 'blur' => true],
        'about.slides' => ['width' => 460, 'height' => 400, 'crop' => true],
        'lesetipps.article.cover-normal' => ['width' => 300],
        'lesetipps.article.cover-square' => ['width' => 300, 'height' => 300, 'crop' => true],
        'assortment.navigation' => ['width' => 416, 'height' => 312, 'crop' => true,],
        'assortment.navigation.blurred' => ['width' => 416, 'height' => 312, 'crop' => true, 'blur' => true],
        'calendar.single.gallery' => ['width' => 320],
        'lesetipps.pdf' => ['width' => 200, 'quality' => 100],
        'contact.map' => ['width' => 460],
    ],
];
