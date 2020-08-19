<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php
        $cssFile = option('debug') === true ? 'main.css' : 'main.min.css';
        $cssPath = 'assets/styles/' . $cssFile;
        $css = (new Asset($cssPath))->read();
    ?>
    <style nonce="<?= $page->nonce($css) ?>"><?= $css ?></style>

    <!-- JS -->
    <?php
        $jsFile = option('debug') ? 'main.js' : 'main.min.js';
        $jsPath = 'assets/scripts/' . $jsFile;
        $js = (new Asset($jsPath))->read();

        echo Bnomei\Fingerprint::js($jsPath, [
            'nonce' => $page->nonce($js),
            'defer' => true,
            'integrity' => true
        ]);
    ?>

    <!-- Metadata -->
    <?= $page->metaTags() ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
    <?php snippet('favicons') ?>
</head>
