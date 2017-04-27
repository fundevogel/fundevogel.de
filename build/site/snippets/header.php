<!DOCTYPE html>
<html class="no-js" lang="<?= $site->language() ?>">
  <head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Cabin+Sketch:700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dosis:300,500,700' rel='stylesheet' type='text/css'>

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
  <body class="<?= $page->slug() ?>">
    <!--[if IE]>
      <div class="alert alert-warning">
        <p>Sie nutzen einen <strong>veralteten</strong> Browser. Bitte laden Sie einen <a href="http://browsehappy.com/">aktuellen Browser</a> herunter.</p>
      </div>
    <![endif]-->
    <header class="site-header" role="banner">

      <div class="header-nav fixed-to-top bg--primary">
        <button data-nav-toggle="#nav-menu" class="nav-toggle" type="button">
          <span>Menü</span>
        </button>
        <nav id="nav-menu" class="nav-menu">
          <?php snippet('nav-menu') ?>
        </nav>
        <!-- <nav class="lang-menu">
          <?php snippet('lang-menu') ?>
        </nav> -->
      </div>

      <div class="wrap">
        <div class="show-medium-up">
          <img class="logo" src="<?= (new Asset('assets/images/rabe.png'))->url() ?>" title="Lieber barfuß als ohne Buch" alt="Fundevogel-Logo" width="175" height="135" />
        </div>
        <div class="hgroup">
          <h1 class="site-title sketch">
            <?php if($page->isChildOf('lesetipps')) : ?>
              Lesetipps
            <?php elseif($page->isChildOf('kalender')) : ?>
              Kalender
            <?php else : ?>
              <?= $page->title()->html() ?>
            <?php endif ?>
          </h1>
          <?php if ($page->isHomePage()) : ?>
            <h3 class="site-subtitle sketch hide-on-small">Kinder- und Jugendbuchhandlung</h3>
          <?php endif ?>
        </div>
      </div>
    </header>
    <main class="site-content" role="main">
