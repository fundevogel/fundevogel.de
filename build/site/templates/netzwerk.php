<?php snippet('header') ?>

<header>
  <div class="wrap">
    <div class="one-half--wide">
      <?= $page->text()->kirbytext() ?>
    </div>
    <div class="one-half--wide teaser">
      <p class="motto large-down">
        <?= $page->motto()->html() ?>
      </p>
      <figure class="fig">
        <?php
          $image = $page->image();
          $crop = $image->resize(460);
         ?>
        <img src="<?= $crop->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
        <figcaption class="bg--primary"><?= $image->desc()->html() ?></figcaption>
      </figure>
    </div>
  </div>
  <div class="wrap motto center show-large-up">
    <?= $page->motto()->kirbytext() ?>
  </div>
</header>
<hr>
<section class="wrap">
  <header class="center">
    <h3><?= $page->subtitle()->html() ?></h3>
  </header>
  <div id="macy" class="spread-out">
    <?php foreach($page->netzwerk()->toStructure() as $item) : ?>
      <article class="card card--outer">
        <div class="card--inner">
          <?= $item->desc()->kirbytext() ?>
        </div>
      </article>
    <?php endforeach ?>
  </div>
</section>

<?php snippet('footer') ?>
