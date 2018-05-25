<?php snippet('header') ?>

  <header class="wrap">
    <div class="one-half--wide">
      <?= $page->text()->kirbytext() ?>
    </div>
    <div class="one-half--wide teaser">
      <?php snippet('cover/coverimage') ?>
    </div>
  </header>
  <hr>
  <section class="list">
    <h2 class="center"><?= l::get('kalender_ueberschrift-liste') ?></h2>
    <?php foreach ($events as $event) { snippet('partials/event', compact('event', 'last')); } ?>
  </section>

<?php snippet('footer') ?>
