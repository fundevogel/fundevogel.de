<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'none'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self'; connect-src 'self'; font-src 'self';"> -->

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/Dosis-Light.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php
        $cssFile = option('debug') === true ? 'main.css' : 'main.min.css';
        $cssPath = 'assets/styles/' . $cssFile;

        // echo Bnomei\Fingerprint::css($cssPath, ['integrity' => true])
    ?>
    <style><?= (new Asset($cssPath))->read() ?></style>

    <!-- JS -->
    <?php
        $jsFile = option('debug') ? 'main.js' : 'main.min.js';
        $jsPath = 'assets/scripts/' . $jsFile;

        echo js($jsPath, [
            'defer' => true,
        ]);

        // echo Bnomei\Fingerprint::js($jsPath, [
        //     'defer' => true,
        //     'integrity' => true,
        // ]);
    ?>

    <!-- Metadata -->
    <?= $page->metaTags() ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
    <?php snippet('favicons') ?>
</head>
