<?php snippet('header') ?>

<section class="wrap">
  <div class="one-third--wide">
    <?= $page->kontaktinfos()->kirbytext() ?>
    <?= $page->oeffnungszeiten()->kirbytext() ?>
  </div>
  <div class="two-thirds--wide center">
    <figure class="fig has-hover">
      <?php
        $image = $page->image();
        $crop = $image->resize(630);
       ?>
      <img src="<?= $crop->url() ?>" data-jslghtbx="<?= $image->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
      <figcaption class="sketch bg--primary"><?= $image->desc()->html() ?></figcaption>
    </figure>
  </div>
</section>
<hr>
<section class="wrap">
  <header>
    <!-- <div class="wrap"> -->
    <h2>
      <?= $page->subtitle()->html() ?>
    </h2>
  </div>
  <!-- </header> -->
  <div class="one-third">
    <div class="center">
      <?= (new Asset("assets/images/bike.svg"))->content() ?>
    </div>
    <?= $page->bike()->kirbytext() ?>
  </div>
  <div class="one-third">
    <div class="center">
      <?= (new Asset("assets/images/auto.svg"))->content() ?>
    </div>
    <?= $page->auto()->kirbytext() ?>
  </div>
  <div class="one-third">
    <div class="center">
      <?= (new Asset("assets/images/tram.svg"))->content() ?>
    </div>
    <?= $page->tram()->kirbytext() ?>
  </div>
</section>

<?php snippet('footer') ?>
