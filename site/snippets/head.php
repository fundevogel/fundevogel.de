<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="preload" href="<?= url('assets/fonts/CabinSketch.subset.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= url('assets/fonts/Dosis-Light.subset.woff2') ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= url('assets/fonts/Dosis-Bold.subset.woff2') ?>" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?= loadCSS() ?>

    <!-- JS -->
    <?= loadJS() ?>

    <!-- Metadata -->
    <?php snippet('metadata') ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
    <?php snippet('favicons') ?>
</head>
