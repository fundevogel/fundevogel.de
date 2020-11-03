<?php

##
# THUMBNAILS
##

return [
    # General thumbnail settings
    'driver' => 'colorist',
    'quality' => [
        'jpg' => 85,
        'webp' => 80,
        'avif' => 40,
    ],

    # AVIF support
    'avif' => [
        'news.hero',
        'cover',
        'about.cover',
        'assortment.navigation',
        'calendar.single.preview',
        'calendar.single.gallery',
    ],

    # Blur up effect
    'blurry' => [
        'news.article.image',
        'lesetipps.article.cover-normal',
        'lesetipps.article.cover-square',
        'calendar.single.preview',
        'calendar.single.gallery',
    ],

    # Thumbnail presets
    'presets' => [
        # Fullscreen sizes
        'full-width' => ['width' => 768],
        'full-height' => ['width' => null, 'height' => 640],

        # Generic cover
        'cover' => ['width' => 460],
        'cover.460' => ['width' => 460],
        'cover.420' => ['width' => 420],
        'cover.340' => ['width' => 340],
        'cover.260' => ['width' => 260],

        # News
        # Hero image
        'news.hero' => ['width' => 1152],
        'news.hero.1152' => ['width' => 1152],
        'news.hero.960' => ['width' => 960],
        'news.hero.768' => ['width' => 768],
        'news.hero.640' => ['width' => 640],
        'news.hero.480' => ['width' => 480],
        'news.hero.320' => ['width' => 320],
        'news.hero.240' => ['width' => 240],
        # Article thumbnail
        'news.article.image' => ['width' => 224, 'crop' => true],
        'news.article.image.blurry' => ['width' => 224, 'crop' => true, 'quality' => 10, 'blur' => true],
        'news.article.image.224' => ['width' => 224, 'crop' => true],
        'news.article.image.192' => ['width' => 192, 'crop' => true],
        'news.article.image.160' => ['width' => 160, 'crop' => true],
        'news.article.image.96' => ['width' => 96, 'crop' => true],

        # Fundevogel
        'about.cover' => ['width' => 460, 'height' => 400, 'crop' => true],
        'about.cover.460' => ['width' => 460, 'height' => 400, 'crop' => true],
        'about.cover.420' => ['width' => 420, 'height' => 360, 'crop' => true],
        'about.cover.340' => ['width' => 340, 'height' => 294, 'crop' => true],
        'about.cover.260' => ['width' => 260, 'height' => 224, 'crop' => true],
        # Team avatar images
        'about.team' => ['width' => 120, 'height' => 120, 'crop' => true],
        'about.team.blurry' => ['width' => 120, 'height' => 120, 'crop' => true, 'quality' => 10, 'blur' => true],
        'about.team.120' => ['width' => 120, 'height' => 120, 'crop' => true],

        # Assortment
        # Navigation images
        'assortment.navigation' => ['width' => 440, 'height' => 320, 'crop' => true,],
        'assortment.navigation.440' => ['width' => 440, 'height' => 320, 'crop' => true,],
        'assortment.navigation.400' => ['width' => 400, 'height' => 300, 'crop' => true,],
        'assortment.navigation.346' => ['width' => 346, 'height' => 250, 'crop' => true,],
        'assortment.navigation.282' => ['width' => 282, 'height' => 204, 'crop' => true,],
        'assortment.navigation.228' => ['width' => 228, 'height' => 166, 'crop' => true,],
        'assortment.navigation.202' => ['width' => 202, 'height' => 146, 'crop' => true,],

        # Lesetipps
        # Reading list cover images
        'lesetipps.pdf' => ['width' => 215, 'quality' => 90],
        'lesetipps.pdf.215' => ['width' => 215, 'quality' => 90],
        'lesetipps.pdf.196' => ['width' => 196, 'quality' => 90],
        'lesetipps.pdf.120' => ['width' => 120, 'quality' => 90],
        # Cover images
        'lesetipps.article.cover-normal' => ['width' => 300],
        'lesetipps.article.cover-normal.blurry' => ['width' => 300, 'quality' => 10, 'blur' => true],
        'lesetipps.article.cover-normal.300' => ['width' => 300],
        'lesetipps.article.cover-normal.240' => ['width' => 240],
        'lesetipps.article.cover-normal.160' => ['width' => 160],
        'lesetipps.article.cover-square' => ['width' => 300, 'crop' => true],
        'lesetipps.article.cover-square.blurry' => ['width' => 300, 'crop' => true, 'quality' => 10, 'blur' => true],
        'lesetipps.article.cover-square.300' => ['width' => 300, 'crop' => true],
        'lesetipps.article.cover-square.240' => ['width' => 240, 'crop' => true],
        'lesetipps.article.cover-square.160' => ['width' => 160, 'crop' => true],
        # Lesepeter mascot image
        'lesepeter.mascot' => ['width' => 150],
        'lesepeter.mascot.150' => ['width' => 150],
        'lesepeter.mascot.112' => ['width' => 112],

        # Calendar
        # Annual event thumbnail images
        'calendar.single.preview' => ['width' => 160, 'crop' => true],
        'calendar.single.preview.blurry' => ['width' => 160, 'crop' => true, 'quality' => 10, 'blur' => true],
        'calendar.single.preview.160' => ['width' => 160, 'crop' => true],
        # Gallery slide images
        'calendar.single.gallery' => ['width' => 312],
        'calendar.single.gallery.blurry' => ['width' => 312, 'quality' => 10, 'blur' => true],
        'calendar.single.gallery.312' => ['width' => 312],
        'calendar.single.gallery.288' => ['width' => 288],
        'calendar.single.gallery.200' => ['width' => 200],
        'calendar.single.gallery.120' => ['width' => 120],

        # Contact
        # Press images grid
        'contact.press.grid' => ['width' => 768, 'height' => 768, 'crop' => true],
        'contact.press.grid.768' => ['width' => 768, 'height' => 768, 'crop' => true],
    ],

    'sizes' => [
        'cover' => [460, 420, 340, 260],
        'news.hero' => [1152, 960, 768, 640, 480, 320, 240],
        'news.article.image' => [224, 192, 160, 96],
        'about.cover' => [460, 420, 340, 260],
        'about.team' => [120],
        'assortment.navigation' => [440, 400, 346, 282, 228, 202],
        'lesetipps.pdf' => [215, 196, 120],
        'lesetipps.article.cover-normal' => [300, 240, 160],
        'lesetipps.article.cover-square' => [300, 240, 160],
        'lesepeter.mascot' => [150, 112],
        'calendar.single.preview' => [160],
        'calendar.single.gallery' => [312, 288, 200, 120],
        'contact.press.grid' => [768],
    ]
];
