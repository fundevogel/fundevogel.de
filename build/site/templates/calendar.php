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
      <?php foreach ($events as $key => $event) : ?>
      <?php snippet('event-teaser', array('event' => $event)); ?>
      <?php $count++; ?>
      <?php if($last > $count) echo '<hr>' ?>
      <?php endforeach ?>
  </section>
  <nav class="wrap post-nav center">
    <a class="btn bg--primary" href="<?= page('vergangene-veranstaltungen')->url() ?>" title="<?= l::get('kalender_vergangene-veranstaltungen--title') ?>">
      <span class="btn--text show-small-up"><?= l::get('kalender_vergangene-veranstaltungen') ?></span>
      <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
    </a>
  </nav>

<?php snippet('footer') ?>
