<?php snippet('header') ?>

<section class="wrap">
  <?= $page->text()->kt() ?>
  <?php snippet('templates/news.hero') ?>
</section>

<hr>

<section class="list">
   <h2><?= t('home_ueberschrift-liste') ?></h2>
  <?php foreach($news as $article) snippet('templates/news.article', compact('article')) ?>
</section>

<?php snippet('templates/news.prevnext') ?>

<?php snippet('footer') ?>
