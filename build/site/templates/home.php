<?php snippet('header') ?>

<section class="wrap">
  <?= $page->text()->kt() ?>
  <?php snippet('cover/hero') ?>
</section>
<hr>
<section id="infinite-scroll" class="list" data-page="<?= $page->url() ?>" data-limit="<?= $limit ?>">
  <h2><?= l::get('home_ueberschrift-liste') ?></h2>
  <?php foreach($posts as $post) { snippet('partials/post', compact('post', 'last')); } ?>
</section>
<nav class="wrap post-nav">
  <button id="load-more" class="btn bg--primary" type="button" title="<?= l::get('home_mehr-anzeigen--title') ?>" data-more="<?= l::get('home_mehr-anzeigen--ende') ?>">
    <span class="btn--text"><?= l::get('home_mehr-anzeigen') ?></span>
  </button>
</nav>

<?php snippet('footer') ?>
