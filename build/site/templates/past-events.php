<?php snippet('header') ?>

  <section class="list">
    <h2><?= $page->subtitle()->html() ?></h2>
    <?php
      foreach($pages->find('kalender/year-2018')->children() as $year) {
        $events = $year->events()->toStructure();
        $events = $events->filter(function($child) { return $child->date(null, 'end_date') <= time(); });
        $last = count($events);
        foreach($events as $event) {
          snippet('partials/event', ['event' => $event, 'year' => $year]);
          $count++;
          e($last > $count, '<hr>');
        }
      }
    ?>
  </section>
  <nav class="wrap post-nav center">
    <a class="btn bg--primary" href="<?= page('kalender')->url() ?>" title="<?= l::get('kalender_kommende-veranstaltungen--title') ?>">
      <span class="btn--text show-small-up"><?= l::get('kalender_kommende-veranstaltungen') ?></span>
      <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
    </a>
  </nav>

<?php snippet('footer') ?>
