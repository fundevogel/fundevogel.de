<?php

use PHPCBIS\PHPCBIS;
use PHPCBIS\Helpers\Butler;


 ?>

<?php snippet('header') ?>

<header>
  <div class="wrap">
    <div class="one-half--wide">
      <?= $page->text()->kt() ?>
    </div>
    <div class="one-half--wide teaser">
      <?php if ($page == page('unser-netzwerk')) : ?>
        <p class="motto large-down">
          <?= $page->motto()->html() ?>
        </p>
      <?php endif ?>
      <?php snippet('cover') ?>
    </div>
  </div>
  <?php if ($page == page('unser-netzwerk')) : ?>
  <div class="wrap motto center show-large-up">
    <?= $page->motto()->kt() ?>
  </div>
  <?php endif ?>
</header>
<hr>
<section class="list wrap">
  <h2><?= t($identifier . '_ueberschrift-liste') ?>:</h2>
  <?php snippet('templates/grid-list.cards', $cards) ?>
</section>

<?php snippet('footer') ?>
