<?php snippet('header') ?>

<section class="wrap">
  <?= $page->text()->kt() ?>
  <?php snippet('cover/hero') ?>
</section>
<hr>
<section class="list">
   <h2><?= l::get('home_ueberschrift-liste') ?></h2> 
  <?php foreach($posts as $post) { snippet('partials/post', compact('post', 'last')); } ?>
</section>
<nav class="wrap post-nav sketch">
  <?php if ($pagination->hasNextPage()) : ?>
  <a class="next-page btn left bg--primary" href="<?= $pagination->nextPageURL() ?>" rel="prev" title="<?= l::get('lesetipps_neuere-lesetipps--title') ?>">
    <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
    <span class="btn--text show-600-up"><?= l::get('lesetipps_neuere-lesetipps') ?></span>
  </a>
  <?php endif ?>
  <button class="btn bg--primary load-more" type="button" title="<?= l::get('home_mehr-anzeigen--title') ?>">
    <span class="btn--text"><?= l::get('home_mehr-anzeigen') ?></span>
  </button>
</nav>

<?php snippet('footer') ?>
