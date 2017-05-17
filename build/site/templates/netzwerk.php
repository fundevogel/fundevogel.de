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
          $thumb = thumb($image, array('width' => 460, 'quality' => 85));
         ?>
        <img src="<?= $thumb->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
        <figcaption class="bg--primary"><?= $image->desc()->html() ?></figcaption>
      </figure>
    </div>
  </div>
  <div class="wrap motto center show-large-up">
    <?= $page->motto()->kirbytext() ?>
  </div>
</header>
<hr>
<section class="list wrap">
  <h2><?= l::get('netzwerk_ueberschrift-liste') ?>:</h2>

  <div id="macy" class="macy">
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
