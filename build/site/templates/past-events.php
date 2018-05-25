<?php snippet('header') ?>

  <section class="list">
    <h2><?= $page->subtitle()->html() ?></h2>
    <?php foreach ($events as $event) { snippet('partials/event', compact('event', 'last')); } ?>
  </section>

<?php snippet('footer') ?>
