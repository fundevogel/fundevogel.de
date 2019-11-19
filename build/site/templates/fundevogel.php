<?php snippet('header') ?>

<header class="wrap">
  <div class="one-half--wide">
    <?= $page->text()->kt() ?>
  </div>
  <div class="one-half--wide teaser">
    <?php snippet('templates/fundevogel/lightgallery') ?>
  </div>
</header>
<hr>
<section class="wrap">
  <?= $page->about_us()->kt() ?>
</section>
<hr>
<section class="wrap">
  <div class="one-half">
    <?= $page->left()->kt() ?>
  </div>
  <div class="one-half">
    <?= $page->right()->kt() ?>
  </div>
</section>

<?php snippet('footer') ?>
