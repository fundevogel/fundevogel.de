<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <!-- Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Cabin+Sketch:700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Dosis:300,500,700' rel='stylesheet' type='text/css'>
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css' rel='stylesheet' type='text/css'>


  <!-- SEO -->
  <title><?php if($page->isHomePage()) : ?><?= seo('title', array(), true); ?><?php else : ?><?= seo('title', array(), true); ?> | <?= $site->title()->html() ?><?php endif ?></title>
  <?= seo('description'); ?>
  <link rel="canonical" href="<?= $page->url() ?>">

  <!-- Facebook -->
  <meta property="og:locale" content="<?= $site->language()->locale() ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php if($page->isHomePage()) : ?><?= seo('title', array(), true); ?><?php else : ?><?= seo('title', array(), true); ?> | <?= $site->title()->html() ?><?php endif ?>">
  <meta property="og:description" content="<?= seo('description', array(), true); ?>">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:site_name" content="<?= $site->title()->html() ?>">

  <!-- Twitter -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?php if($page->isHomePage()) : ?><?= seo('title', array(), true); ?><?php else : ?><?= seo('title', array(), true); ?> | <?= $site->title()->html() ?><?php endif ?>">

  <!-- Miscellaneous -->
  <link rel="shortcut icon" href="<?= url() ?>/favicon.ico" />

  <?php foreach($site->languages() as $language): ?>
    <?php if($language == $site->language()) continue; ?>
      <link rel="alternate" hreflang="<?= html($language->code()) ?>" href="<?= $page->url($language->code()) ?>" />
  <?php endforeach ?>

  <?= css('assets/styles/main.css') ?>

</head>
