<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="preload" href="/assets/fonts/Dosis-Light-supersubset.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/CabinSketch-Bold-ultrasubset.woff2" as="font" type="font/woff2" crossorigin>

  <?= $page->metaTags() ?>

  <!-- CSS -->
  <?php $css = option('debug') === true ? 'main.css' : 'main.min.css'; ?>
  <style><?= (new Asset('assets/styles/' . $css))->read() ?></style>
  <noscript><?= css('assets/styles/' . $css) ?></noscript>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
  <?php snippet('favicons') ?>

  <!-- Font loading -->
  <script integrity="sha256-sv4jGGVCDUykONZVQdABKFT3hKgodDeF9539pQiKBKw="><?= (new Asset('assets/font-loading.js'))->read() ?></script>

  <!-- dev only -->
  <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@700&display=swap" rel="stylesheet">

  <!-- JS -->
  <?php $js = option('debug') ? 'main.js' : 'main.min.js'; ?>
  <?= js('assets/scripts/' . $js, ['defer' => true]) ?>
</head>
