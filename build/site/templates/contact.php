<?php snippet('header') ?>

<section class="wrap center">
  <div class="one-half">
    <?= $page->kontaktinfos()->kt() ?>
    <?= $page->oeffnungszeiten()->kt() ?>
  </div>
  <div class="one-half">
    <?php snippet('partials/map') ?>
  </div>
</section>
<hr>
<section class="list wrap">
  <h2><?= l::get('kontakt_ueberschrift-liste') ?></h2>
  <div class="one-third">
    <div class="center">
      <?= $bike->content() ?>
    </div>
    <?= $page->bike()->kt() ?>
  </div>
  <div class="one-third">
    <div class="center">
      <?= $car->content() ?>
    </div>
    <?= $page->auto()->kt() ?>
  </div>
  <div class="one-third">
    <div class="center">
      <?= $tram->content() ?>
    </div>
    <?= $page->tram()->kt() ?>
  </div>
</section>

<?php snippet('footer') ?>
