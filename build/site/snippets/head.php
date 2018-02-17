<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel="preload" href="/assets/fonts/Dosis-Light-supersubset.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/assets/fonts/CabinSketch-Bold-ultrasubset.woff2" as="font" type="font/woff2" crossorigin>

  <!-- SEO -->
  <?php snippet('partials/seo') ?>

  <!-- CSS -->
  <style><?= (new Asset('assets/styles/main.css'))->content() ?></style>

  <!-- hreflang Tags -->
  <?php foreach($site->languages() as $language) : ?>
    <?php if ($language == $site->language()) continue; ?>
    <link rel="alternate" hreflang="<?= html($language->code()) ?>" href="<?= $page->url($language->code()) ?>" />
  <?php endforeach ?>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= url('favicon.ico') ?>">

  <!-- Fallback CSS -->
  <noscript><?= css('assets/styles/main.css') ?></noscript>

  <!-- Font loading -->
  <script integrity="sha256-sv4jGGVCDUykONZVQdABKFT3hKgodDeF9539pQiKBKw="><?= (new Asset('assets/font-loading.js'))->content() ?></script>
</head>
