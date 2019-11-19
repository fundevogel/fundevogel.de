<!DOCTYPE html>
<html class="no-js" lang="<?= $kirby->language() ?>">

  <?php snippet('head') ?>

  <body class="<?= $page->uid() ?>">
    <header id="top" class="site-header" role="banner">

      <div class="header-nav fixed-to-top bg--primary">
        <button data-nav-toggle="#nav-menu" class="nav-toggle" type="button">
          <span><?= t('menue') ?></span>
        </button>
        <?php snippet('navigation/nav-menu') ?>
        <?php snippet('navigation/lang-menu') ?>
      </div>

      <div class="wrap">
        <div class="show-medium-up">
          <img class="logo" src="<?= (new Asset('assets/images/logo.png'))->url() ?>" title="Lieber barfuß als ohne Buch" alt="Fundevogel-Logo" width="175" height="135" />
        </div>
        <div class="hgroup">
          <h1 class="site-title sketch">
            <?php
              if ($page->isChildOf('lesetipps')) {
                  echo page('lesetipps')->title()->html();
              } elseif ($page->slug() == 'vergangene-veranstaltungen') {
                  echo page('kalender')->title()->html();
              } elseif ($page->isHomePage()) {
                  echo 'Fundevogel';
              } else {
                  echo $page->title()->html();
              }
            ?>
          </h1>
          <?php if ($page->isHomePage()) : ?>
            <h3 class="site-subtitle sketch hide-on-small"><?= t('home_untertitel') ?></h3>
          <?php endif ?>
        </div>
      </div>
    </header>
    <main class="site-content" role="main">
