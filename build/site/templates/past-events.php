<?php snippet('header') ?>

  <section class="list">
    <h2><?= $page->subtitle()->html() ?></h2>
    <?php foreach ($events as $event) { snippet('partials/event', compact('event', 'last')); } ?>
  </section>
  <nav class="wrap post-nav center sketch">
    <a class="btn bg--primary" href="<?= page('kalender')->url() ?>" title="<?= l::get('kalender_kommende-veranstaltungen--title') ?>">
      <span class="btn--text show-600-up"><?= l::get('kalender_kommende-veranstaltungen') ?></span>
      <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
    </a>
  </nav>

<?php snippet('footer') ?>
