<?php snippet('header') ?>

<?php if ($pagination->page() == 1) : ?>
<header class="wrap">
  <div class="one-half--wide">
    <?= $page->text()->kt() ?>
  </div>
  <div class="one-half--wide recommendations center">
    <?php snippet('templates/lesetipps.editions') ?>
  </div>
</header>
<hr>
<?php endif ?>

<section class="list">
  <h2><?= t('lesetipps_ueberschrift-liste') ?></h2>
  <?php
    $count = 1;
    foreach ($lesetipps as $lesetipp) {
      snippet('templates/lesetipps.preview', compact('lesetipp'));
      e($count < $perPage, '<hr>');
      $count++;
    }
  ?>
</section>

<?php snippet('navigation/pagination') ?>

<?php snippet('footer') ?>

<?php snippet('templates/lesetipps.modal') ?>
