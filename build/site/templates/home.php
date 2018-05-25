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
  <?php if ($pagination->hasPrevPage()) : ?>
  <a class="btn left bg--primary" href="<?= $pagination->prevPageURL() ?>" rel="prev" title="<?= l::get('home_frueheres--title') ?>">
    <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
    <span class="btn--text show-600-up"><?= l::get('home_frueheres') ?></span>
  </a>
  <?php else : ?>
  <span class="btn left bg--primary is-disabled"></span>
  <?php
    endif;
    if ($pagination->hasNextPage()) :
  ?>
  <a class="btn right bg--primary load-more-target" href="<?= $pagination->nextPageURL() ?>" rel="next" title="<?= l::get('home_aelteres--title') ?>">
    <span class="btn--text show-600-up"><?= l::get('home_aelteres') ?></span>
    <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
  </a>
  <?php else : ?>
  <span class="btn right bg--primary is-disabled"></span>
  <?php endif ?>

  <button class="btn bg--primary load-more" type="button" title="<?= l::get('home_mehr-anzeigen--title') ?>">
    <span class="btn--text"><?= l::get('home_mehr-anzeigen') ?></span>
  </button>
</nav>

<?php snippet('footer') ?>
