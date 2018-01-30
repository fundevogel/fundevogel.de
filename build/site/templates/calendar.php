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


      <?php
        foreach($pages->find('kalender/year-2018')->children() as $child) :
        $events = $child->events()->toStructure();
        var_dump($child);

        $last = count($events);
        foreach($events as $event) :
          snippet('partials/event', ['event' => $event]);
          $count++;
          e($last > $count, '<hr>');
        endforeach;
        endforeach;
      ?>





  </section>
  <nav class="wrap post-nav center">
    <a class="btn bg--primary" href="<?= page('vergangene-veranstaltungen')->url() ?>" title="<?= l::get('kalender_vergangene-veranstaltungen--title') ?>">
      <span class="btn--text show-small-up"><?= l::get('kalender_vergangene-veranstaltungen') ?></span>
      <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
    </a>
  </nav>

<?php snippet('footer') ?>
