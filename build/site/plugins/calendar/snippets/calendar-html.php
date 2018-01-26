<?php snippet('header') ?>

  <header class="wrap">
    <div class="one-half--wide">
      <?= $page->text()->kirbytext() ?>
      <?php if ($page->webcal_text()->isNotEmpty()): ?>
        <p class="center">
          <a class="download caption" href="<?= $page->webcal_url() ?>" title="<?= l::get('kalender_download--title') ?>!">
            <?= (new Asset("assets/images/download.svg"))->content() ?>
            <span><?= l::get('kalender_download') ?></span>
          </a>
        </p>
      <?php endif ?>
    </div>
    <div class="one-half--wide teaser">
      <figure class="fig">
        <?php
          $image = $page->image();
          $crop = $image->resize(460);
         ?>
        <img src="<?= $crop->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
        <figcaption class="bg--primary"><?= $image->caption()->html() ?></figcaption>
      </figure>
    </div>
  </header>
  <hr>

  <section class="list">
    <h2 class="center"><?= l::get('kalender_ueberschrift-liste') ?></h2>

      <?php $events = $page->events($own = true, $allies = array('children' => true, 'siblings' => true)); ?>
      <?php $events = $events->sortBy('begin_date', 'asc'); ?>
      <?php $events = $events->filter(function($child) { return $child->date(null, 'end_date') >= time(); }); ?>
      <?php $last = $events->count(); ?>
      <?php $count = 0; foreach ($events as $key => $event) : ?>
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
