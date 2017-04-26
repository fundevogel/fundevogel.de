<!DOCTYPE html>
<html class="no-js" lang="<?= $site->language() ?>">
  <head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>

    <link href='https://fonts.googleapis.com/css?family=Cabin+Sketch:700|Dosis:300,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?= url() ?>/favicon.ico" />

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
