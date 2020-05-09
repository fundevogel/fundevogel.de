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
        'news.hero' => ['width' => 960],
        'news.article.full' => ['width' => 1024],
        'news.article.image' => ['width' => 224, 'crop' => true],
        'fundevogel.slides' => ['width' => 460, 'height' => 400, 'crop' => true],
        'lesetipps.article.cover' => ['width' => 300],
        'lesetipps.pdf' => ['width' => 155, 'height' => 235, 'crop' => true],
        'contact.map' => ['width' => 460],
    ],
];
