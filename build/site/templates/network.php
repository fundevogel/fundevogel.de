<?php snippet('header') ?>

<header>
  <div class="wrap">
    <div class="one-half--wide">
      <?= $page->text()->kt() ?>
    </div>
    <div class="one-half--wide teaser">
      <p class="motto large-down">
        <?= $page->motto()->html() ?>
      </p>
      <?php snippet('cover/coverimage') ?>
    </div>
  </div>
  <div class="wrap motto center show-large-up">
    <?= $page->motto()->kt() ?>
  </div>
</header>
<hr>
<section class="list wrap">
  <h2><?= l::get('netzwerk_ueberschrift-liste') ?>:</h2>
  <?php snippet('partials/cards', $partners) ?>
</section>

<?php snippet('footer') ?>
