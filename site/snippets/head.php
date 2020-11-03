<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/Dosis-Light.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/Dosis-Bold.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php if (!option('debug')) : ?>
    <?php
        # Production = Minified inline CSS
        $cssPath = $kirby->root('assets') . '/styles/main.min.css';
        $css = F::read($cssPath);
    ?>
    <style nonce="<?= $page->nonce('css') ?>"><?= $css ?></style>

    <?php else : ?>

    <?php
        # Development = Unminified CSS file
        $cssPath = '/assets/styles/main.css';
        $css = Bnomei\Fingerprint::css($cssPath, [
            'nonce' => $page->nonce('css'),
            'integrity' => true,
        ]);

        echo $css;
    ?>
    <?php endif ?>

    <!-- JS -->
    <?php
        $jsFile = option('debug') ? 'main.js' : 'main.min.js';
        $jsPath = '/assets/scripts/' . $jsFile;

        echo Bnomei\Fingerprint::js($jsPath, [
            'nonce' => $page->nonce('js'),
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
