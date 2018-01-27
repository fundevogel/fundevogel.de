<?php snippet('header') ?>

<header class="wrap">
  <div class="one-half--wide">
    <?= $page->text()->kt() ?>
  </div>
  <div class="one-half--wide teaser">
    <?php snippet('cover/coverimage') ?>
  </div>
</header>
<hr>
<section class="list wrap">
  <h2><?= l::get('service_ueberschrift-liste') ?>:</h2>
  <?php snippet('partials/cards', $services) ?>
</section>

<?php snippet('footer') ?>
