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
        # Fullscreen sizes
        'full-width' => ['width' => 768],
        'full-height' => ['width' => null, 'height' => 640],

        # Generic cover
        'cover' => ['width' => 460],
        'cover.blurry' => ['width' => 460, 'blur' => true],
        'cover.460' => ['width' => 460],
        'cover.400' => ['width' => 400],
        'cover.340' => ['width' => 340],
        'cover.280' => ['width' => 280],

        # News
        # Hero image
        'news.hero' => ['width' => 960],
        'news.hero.blurry' => ['width' => 960, 'blur' => true],
        'news.hero.960' => ['width' => 960],
        'news.hero.768' => ['width' => 768],
        'news.hero.640' => ['width' => 640],
        'news.hero.480' => ['width' => 480],
        'news.hero.320' => ['width' => 320],
        'news.hero.240' => ['width' => 240],
        # Article thumbnail
        'news.article.image' => ['width' => 224, 'crop' => true],
        'news.article.image.blurry' => ['width' => 224, 'crop' => true, 'blur' => true],
        'news.article.image.224' => ['width' => 224, 'crop' => true],
        'news.article.image.192' => ['width' => 192, 'crop' => true],
        'news.article.image.128' => ['width' => 128, 'crop' => true],

        # Fundevogel
        # Slideshow image
        'about.slides' => ['width' => 460, 'height' => 400, 'crop' => true],
        'about.slides.blurry' => ['width' => 460, 'height' => 400, 'crop' => true, 'blur' => true],
        'about.slides.460' => ['width' => 460, 'height' => 460, 'crop' => true],
        'about.slides.400' => ['width' => 400, 'height' => 400, 'crop' => true],
        'about.slides.340' => ['width' => 340, 'height' => 340, 'crop' => true],
        'about.slides.280' => ['width' => 280, 'height' => 280, 'crop' => true],
        # Team avatar images
        'about.team' => ['width' => 120, 'height' => 120, 'crop' => true],
        'about.team.blurry' => ['width' => 120, 'height' => 120, 'crop' => true, 'blur' => true],
        'about.team.120' => ['width' => 120, 'height' => 120, 'crop' => true],

        # Assortment
        # Navigation images
        'assortment.navigation' => ['width' => 374, 'height' => 280, 'crop' => true,],
        'assortment.navigation.blurry' => ['width' => 374, 'height' => 280, 'crop' => true, 'blur' => true],
        'assortment.navigation.416' => ['width' => 416, 'height' => 312, 'crop' => true,],
        'assortment.navigation.374' => ['width' => 374, 'height' => 280, 'crop' => true,],
        'assortment.navigation.320' => ['width' => 320, 'height' => 240, 'crop' => true,],
        'assortment.navigation.272' => ['width' => 272, 'height' => 204, 'crop' => true,],
        'assortment.navigation.192' => ['width' => 192, 'height' => 144, 'crop' => true,],
        'assortment.navigation.132' => ['width' => 132, 'height' => 99, 'crop' => true,],

        # Lesetipps
        # Reading list cover images
        'lesetipps.pdf' => ['width' => 200, 'quality' => 100],
        'lesetipps.pdf.blurry' => ['width' => 200, 'quality' => 100, 'blur' => true],
        'lesetipps.pdf.200' => ['width' => 200, 'quality' => 100],
        'lesetipps.pdf.160' => ['width' => 160, 'quality' => 100],
        'lesetipps.pdf.128' => ['width' => 128, 'quality' => 100],
        # Cover images
        'lesetipps.article.cover-normal' => ['width' => 300],
        'lesetipps.article.cover-normal.blurry' => ['width' => 300, 'blur' => true],
        'lesetipps.article.cover-normal.300' => ['width' => 300],
        'lesetipps.article.cover-normal.240' => ['width' => 240],
        'lesetipps.article.cover-normal.160' => ['width' => 160],
        'lesetipps.article.cover-square' => ['width' => 300, 'crop' => true],
        'lesetipps.article.cover-square.blurry' => ['width' => 300, 'crop' => true, 'blur' => true],
        'lesetipps.article.cover-square.300' => ['width' => 300, 'crop' => true],
        'lesetipps.article.cover-square.240' => ['width' => 240, 'crop' => true],
        'lesetipps.article.cover-square.160' => ['width' => 160, 'crop' => true],

        # Calendar
        # Gallery slide images
        'calendar.single.gallery' => ['width' => 320],
        'calendar.single.gallery.blurry' => ['width' => 320, 'blur' => true],
        'calendar.single.gallery.320' => ['width' => 320],
        'calendar.single.gallery.280' => ['width' => 280],
        'calendar.single.gallery.220' => ['width' => 220],
        'calendar.single.gallery.160' => ['width' => 160],
    ],

    'sizes' => [
        'cover' => [460, 400, 340, 280],
        'news.hero' => [960, 768, 640, 480, 320, 240],
        'news.article.image' => [224, 192, 128],
        'about.slides' => [460, 400, 340, 280],
        'about.team' => [120],
        'assortment.navigation' => [416, 374, 320, 272, 192, 132],
        'lesetipps.pdf' => [200, 160, 128],
        'lesetipps.article.cover-normal' => [300, 240, 160],
        'lesetipps.article.cover-square' => [300, 240, 160],
        'calendar.single.gallery' => [320, 280, 220, 160],
    ]
];
