<?php snippet('header') ?>

  <main class="main" role="main">

    <?php $events = $page->events($own = true, $allies = array('children' => true, 'siblings' => false)); ?>
    <?php $debug = $events->count() ?>
    <?php if ($events->count() > 0): ?>
      <section class="events">
        <?php foreach ($events as $key => $event): ?>
          <?php snippet('event-teaser', array('event' => $event)); ?>
        <?php endforeach ?>
      </section>
    <?php endif ?>

  </main>

<?php snippet('footer') ?>
