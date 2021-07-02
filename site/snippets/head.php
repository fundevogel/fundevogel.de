<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/Dosis-Light.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/Dosis-Bold.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?= loadCSS() ?>

    <!-- JS -->
    <?= loadJS() ?>

    <!-- Metadata -->
    <?= $page->metaTags() ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
    <?php snippet('favicons') ?>
</head>
