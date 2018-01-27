<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <!-- Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Cabin+Sketch:700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Dosis:300,500,700' rel='stylesheet' type='text/css'>

  <?php snippet('seo') ?>

  <?= css('assets/styles/main.css') ?>

  <!-- hreflang Tags -->
  <?php foreach($site->languages() as $language): ?>
    <?php if ($language == $site->language()) continue; ?>
    <link rel="alternate" hreflang="<?= html($language->code()) ?>" href="<?= $page->url($language->code()) ?>" />
  <?php endforeach ?>

  <!-- Miscellaneous -->
  <link rel="shortcut icon" href="<?= url('favicon.png') ?>">
</head>
