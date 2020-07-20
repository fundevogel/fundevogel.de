<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="preload" href="/assets/fonts/Dosis-Light.subset.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/CabinSketch.subset.woff2" as="font" type="font/woff2" crossorigin>

  <?= $page->metaTags() ?>

  <!-- CSS -->
  <?php $css = option('debug') === true ? 'main.css' : 'main.min.css'; ?>
  <style><?= (new Asset('assets/styles/' . $css))->read() ?></style>
  <noscript><?= css('assets/styles/' . $css) ?></noscript>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
  <?php snippet('favicons') ?>

  <!-- JS -->
  <?php $js = option('debug') ? 'main.js' : 'main.min.js'; ?>
  <?= js('assets/scripts/' . $js, ['defer' => true]) ?>
</head>
