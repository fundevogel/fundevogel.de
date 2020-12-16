<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/Dosis-Light.subset.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/Dosis-Bold.subset.woff2" as="font" type="font/woff2" crossorigin>

    <!-- CSS -->
    <?php if (option('environment') == 'production') : ?>
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

    <?php if ($site->coronaMode()->toBool()) : ?>
    <style nonce="<?= $page->nonce('css') ?>">
      .warning {
        padding: 2rem 1rem;
        margin-bottom: 2rem;
        box-shadow: inset 0 2px 3px rgba(175,75,50,.5), inset 0 -2px 3px rgba(175,75,50,.5)
      }

      .warning h2 {
        font-size: 2rem;
        text-shadow: 0 2px 3px rgba(0,0,0,.3);
        font-weight: 700;
        color: #fff;
        margin-bottom: 1rem;
      }
      .warning .text {
        font-size: 1.25rem;
        color: #fff;
        text-shadow: 0 1px 2px rgba(0,0,0,.3);
      }

      .warning .list {
        margin-top: 4rem;
        display: flex;
        justify-content: space-around;        grid-gap: 1rem;
        justify-items: stretch;
      }

      .warning .list > div svg {
        margin-right: 1.5rem;
        color: #fff;
      }

      .warning .list > div a {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .warning .list > div span {
        margin: 0;
        font-size: 1.25rem;
        display: inline-block;
      }

      .warning .list > div span::after {
        height: 2px;
      }

      h2.info-heading {
        margin-bottom: 1rem;
      }

      .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        grid-gap: 1px;
        justify-items: stretch;
        margin-bottom: 2rem;
      }
    </style>
    <?php endif ?>

    <!-- JS -->
    <?php
        $jsFile = option('environment') == 'production' ? 'main.min.js' : 'main.js';
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
