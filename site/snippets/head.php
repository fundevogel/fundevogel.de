<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="preload" href="/assets/fonts/Dosis-Light-supersubset.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/CabinSketch-Bold-ultrasubset.woff2" as="font" type="font/woff2" crossorigin>

  <?= $page->metaTags() ?>

  <!-- CSS -->
  <style><?= (new Asset('assets/styles/main.css'))->read() ?></style>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">
  <?php snippet('generated/favicons') ?>

  <!-- Fallback CSS -->
  <noscript><?= css('assets/styles/main.css') ?></noscript>

  <!-- Font loading -->
  <script integrity="sha256-sv4jGGVCDUykONZVQdABKFT3hKgodDeF9539pQiKBKw="><?= (new Asset('assets/font-loading.js'))->read() ?></script>

  <!-- dev only -->
  <link href="https://fonts.googleapis.com/css2?family=Cabin+Sketch:wght@700&display=swap" rel="stylesheet">

  <?= js('assets/scripts/main.js', ['defer' => true]) ?>
</head>
