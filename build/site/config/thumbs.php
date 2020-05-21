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
        'news.hero' => ['width' => 960],
        'news.article.full' => ['width' => 1024],
        'news.article.image' => ['width' => 224, 'crop' => true],
        'news.article.image.placeholder' => ['width' => 224, 'crop' => true, 'blur' => true],
        'fundevogel.slides' => ['width' => 460, 'height' => 400, 'crop' => true],
        'lesetipps.article.cover' => ['width' => 300],
        'lesetipps.article.cover.placeholder' => ['width' => 300, 'blur' => true],
        'lesetipps.pdf' => ['width' => 155, 'height' => 235, 'crop' => true],
        'contact.map' => ['width' => 460],
    ],
];
