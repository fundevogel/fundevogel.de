<?php snippet('header') ?>

  <section class="list">
    <h2>
      <?= $page->subtitle()->html() ?>
    </h2>
    <?php $events = page('kalender')->events($own = true, $allies = array('children' => true, 'siblings' => true)); ?>
    <?php $events = $events->sortBy('begin_date', 'desc'); ?>
    <?php $events = $events->filter(function($child) { return $child->date(null, 'end_date') <= time(); }); ?>
    <?php $last = $events->count(); ?>
    <?php $count = 0; foreach ($events as $key => $event) : ?>
      <?php snippet('event-teaser', array('event' => $event)); ?>
      <?php $count++; ?>
      <?php if($last > $count) echo '<hr>' ?>
    <?php endforeach ?>

  </section>
  <nav class="wrap post-nav center">
    <a class="btn bg--primary" href="<?= page('kalender')->url() ?>" title="<?= l::get('kalender_kommende-veranstaltungen--title') ?>">
      <span class="btn--text show-small-up"><?= l::get('kalender_kommende-veranstaltungen') ?></span>
      <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
    </a>
  </nav>

<?php snippet('footer') ?>
