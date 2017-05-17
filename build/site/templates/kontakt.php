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
        $thumb = thumb($image, array('width' => 460, 'quality' => 85));
      ?>
      <a href="<?= $image->url() ?>" data-fancybox data-caption="<?= $image->desc()->html() ?>">
        <img src="<?= $thumb->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
      </a>
      <figcaption class="sketch bg--primary"><?= $image->desc()->html() ?></figcaption>
    </figure>
  </div>
</section>
<hr>
<section class="list wrap">
  <h2><?= l::get('kontakt_ueberschrift-liste') ?></h2>
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
