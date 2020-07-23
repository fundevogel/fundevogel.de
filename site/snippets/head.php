<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'none'; connect-src 'self'; font-src 'self'; img-src 'self'; script-src 'self' 'unsafe-eval' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; base-uri 'none'; frame-ancestors 'none'; form-action 'self'; manifest-src 'self'">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/Dosis-Light.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php
        $cssFile = option('debug') === true ? 'main.css' : 'main.min.css';
        $cssPath = 'assets/styles/' . $cssFile;

        echo Bnomei\Fingerprint::css($cssPath, ['integrity' => true])
    ?>

    <!-- JS -->
    <?php
        $jsFile = option('debug') ? 'main.js' : 'main.min.js';
        $jsPath = 'assets/scripts/' . $jsFile;

        echo Bnomei\Fingerprint::js($jsPath, ['defer' => true, 'integrity' => true]);
    ?>

    <!-- Metadata -->
    <?= $page->metaTags() ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
    <?php snippet('favicons') ?>
</head>
