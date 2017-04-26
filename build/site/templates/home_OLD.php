<?php snippet('header') ?>

<section class="wrap">
  <?= $page->intro()->kirbytext() ?>
  <figure class="fig has-hover">
    <?php
      $image = $page->image();
      $crop = $image->resize(960);
     ?>
    <img src="<?= $crop->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
    <figcaption class="sketch bg--primary"><?= $image->desc()->html() ?></figcaption>
  </figure>
</section>
<hr>

<section class="list">
  <h2 class="center"><?= $page->subtitle()->html() ?></h2>

  <?php foreach($lesetipps as $lesetipp) : ?>

    <article class="wrap">


    <?php if($lesetipp->images()->count() == 1) : ?>

      <div class="one-third center">
        <figure>
          <?php
            $image = $lesetipp->image();

            if($image->width() > $image->height()) {
              $crop = $image->crop(300);
            } else {
              $crop = $image->resize(300);
            }
           ?>
          <img src="<?= $crop->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
        </figure>
      </div>
      <div class="two-thirds">
        <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time><span class="subtitle"> - <?= $lesetipp->subtitle()->html() ?></span>
        <h3><?= $lesetipp->title()->html() ?></h3>
        <?= $lesetipp->intro()->kirbytext() ?>
      </div>

    <?php elseif($lesetipp->images()->count() == 2) : ?>

      <div class="one-half--wide center has-multiple-images">
        <?php $images = $lesetipp->images(); foreach ($images as $img) : ?>
          <?php $crop = $img->crop(200); ?>
          <figure>
            <img src="<?= $crop->url() ?>" data-jslghtbx="<?= $img->url() ?>" title="<?= $img->desc()->html() ?>" alt="<?= $img->alt()->html() ?>" data-jslghtbx-group="<?= $lesetipp->slug() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
          </figure>
        <?php endforeach ?>
      </div>
      <div class="one-half--wide">
        <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time><span class="subtitle"> - <?= $lesetipp->subtitle()->html() ?></span>
        <h3><?= $lesetipp->title()->html() ?></h3>
        <?= $lesetipp->intro()->kirbytext() ?>
      </div>

    <?php elseif($lesetipp->images()->count() > 2) : ?>

      <?php $images = $lesetipp->images(); foreach ($images as $img) : ?>
        <?php $crop = $img->crop(300); ?>
        <figure>
          <img src="<?= $crop->url() ?>" data-jslghtbx="<?= $img->url() ?>" title="<?= $img->desc()->html() ?>" alt="<?= $img->alt()->html() ?>" data-jslghtbx-group="<?= $lesetipp->id() ?>">
        </figure>
      <?php endforeach ?>

    <?php endif ?>


    </article>
    <hr>

  <?php endforeach ?>
</section>

<?php snippet('footer') ?>

<?php snippet('header') ?>

<section class="wrap">
  <?= $page->intro()->kirbytext() ?>
  <figure class="fig has-hover">
    <?php
      $image = $page->image();
      $crop = $image->resize(960);
     ?>
    <img src="<?= $crop->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
    <figcaption class="sketch bg--primary"><?= $image->desc()->html() ?></figcaption>
  </figure>
</section>
<hr>

<section class="list">
  <h2 class="center"><?= $page->subtitle()->html() ?></h2>

  <?php foreach($lesetipps as $lesetipp) : ?>

    <article class="wrap">


      <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time><span class="subtitle"> - <?= $lesetipp->subtitle()->html() ?></span>
      <h3><?= $lesetipp->title()->html() ?></h3>
      <?= $lesetipp->intro()->kirbytext() ?>
      <div class="image-area">
        <?php $images = $lesetipp->images(); foreach ($images as $img) : ?>
          <?php $crop = $img->crop(200); ?>
          <figure>
            <img src="<?= $crop->url() ?>" data-jslghtbx="<?= $img->url() ?>" title="<?= $img->desc()->html() ?>" alt="<?= $img->alt()->html() ?>" data-jslghtbx-group="<?= $lesetipp->slug() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
          </figure>
        <?php endforeach ?>
      </div>


    </article>
    <hr>

  <?php endforeach ?>
</section>

<?php snippet('footer') ?>
