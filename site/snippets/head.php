<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php if (!option('debug')) : ?>
    <?php
        $criticalPath = $kirby->root('assets') . '/styles/critical.css';
        $critical = F::read($criticalPath);
    ?>
    <!-- 1. Critical CSS -->
    <style nonce="<?= $page->nonce('css') ?>"><?= $critical ?></style>
    <?php endif ?>

    <!-- 2. Async CSS -->
    <?php
        $cssFile = option('debug') ? 'main.css' : 'main.min.css';
        $cssPath = '/assets/styles/' . $cssFile;
        $css = Bnomei\Fingerprint::css($cssPath, [
            'id' => 'css',
            'nonce' => $page->nonce('css'),
            'media' => option('debug') ? 'all' : 'print',
            'integrity' => true,
        ]);

        echo $css;
    ?>
    <?php if (!option('debug')) : ?>
    <script nonce="<?= $page->nonce('js') ?>">
        document.getElementById('css').addEventListener('load', function () {
            this.media = 'all';
        });
    </script>

    <!-- 3. Fallback CSS -->
    <noscript>
        <?php
            echo Bnomei\Fingerprint::css($cssPath, [
                'nonce' => $page->nonce('css'),
                'integrity' => true,
            ]);
        ?>
    </noscript>
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
