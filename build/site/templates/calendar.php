<?php snippet('header') ?>

  <header class="wrap">
    <div class="one-half--wide">
      <?= $page->text()->kirbytext() ?>
    </div>
    <div class="one-half--wide teaser">
      <?php snippet('cover') ?>
    </div>
  </header>
  <hr>
  <section class="list">
    <h2 class="center"><?= $subtitle ?></h2>
    <?php
    if (!$page->hasListedChildren()) {
        echo '<p class="center">' . t('kalender_keine-veranstaltungen') . '</p>';
    } else {
        foreach ($events as $event) {
            snippet('templates/calendar.event', compact('event', 'last'));
        }
    }
    ?>
  </section>

<?php snippet('footer') ?>
