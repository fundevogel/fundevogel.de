<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php
        $criticalPath = '/assets/styles/critical.css';
        $critical = (new Asset($kirby->root('assets') . $criticalPath))->read();
    ?>
    <style nonce="<?= $page->nonce('css') ?>"><?= $critical ?></style>

    <?php
        $cssFile = option('debug') === true ? 'main.css' : 'main.min.css';
        $cssPath = '/assets/styles/' . $cssFile;
    ?>
    <link id="css" rel="stylesheet" href="<?= $cssPath ?>" type="text/css" media="all">
    <script nonce="<?= $page->nonce('js') ?>">
        document.getElementById('css').addEventListener('load', function () {
            this.media = 'all';
        });
    </script>
    <noscript>
        <?= css($cssPath) ?>
    </noscript>

    <!-- JS -->
    <?php
        $jsFile = option('debug') ? 'main.js' : 'main.min.js';
        $jsPath = '/assets/scripts/' . $jsFile;

        if (option('debug')) {
            echo js($jsPath, ['defer' => true]);
        } else {
            echo Bnomei\Fingerprint::js($jsPath, [
                'nonce' => $page->nonce('js'),
                'defer' => true,
                'integrity' => true
            ]);
        }
    ?>

    <!-- Metadata -->
    <?= $page->metaTags() ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
    <?php snippet('favicons') ?>
</head>
