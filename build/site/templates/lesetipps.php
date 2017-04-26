<?php snippet('header') ?>

<?php if($pagination->page() == 1) : ?>

<header class="wrap">
  <div class="one-half--wide">
    <?= $page->intro()->kirbytext() ?>
  </div>
  <div class="one-half--wide recommendations center">
    <?php
      $spring = $page->image('lesetipps-fruehjahr.jpg');
      $autumn = $page->image('lesetipps-herbst.jpg');
    ?>
    <figure class="fig">
      <a href="<?= $page->file($page->pdf_spring())->url() ?>" target="_blank">
        <img src="<?= $spring->url() ?>" title="<?= $spring->desc() ?>" alt="<?= $spring->alt() ?>" width="155" height="235" />
        <figcaption class="bg--primary"><?= $spring->heading() ?></figcaption>
      </a>
    </figure>
    <figure class="fig">
      <a href="<?= $page->file($page->pdf_autumn())->url() ?>" target="_blank">
        <img src="<?= $autumn->url() ?>" title="<?= $autumn->desc() ?>" alt="<?= $spring->alt() ?>" width="155" height="235" />
        <figcaption class="bg--primary"><?= $autumn->heading() ?></figcaption>
      </a>
    </figure>
  </div>
</header>
<hr>

<?php endif ?>

<section class="list">
  <h2 class="center"><?= $page->subtitle()->html() ?></h2>

  <?php $count = 1; foreach($lesetipps as $lesetipp) : ?>

    <article class="wrap">

      <?php if($lesetipp->images()->count() == 1) : ?>

        <div class="one-third center">
          <a class="" href="<?= $lesetipp->url() ?>">
            <figure>
              <?php
                $image = $lesetipp->image();
                $crop = $image->resize(250);
               ?>
              <img src="<?= $crop->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
            </figure>
          </a>
        </div>
        <div class="two-thirds">
          <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time>
          <h3>
            <a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a>
          </h3>
          <p>
            <?= $lesetipp->intro()->kirbytext()->excerpt(40, 'words') ?>
            <a href="<?= $lesetipp->url() ?>">&rarr; Weiterlesen</a>
          </p>
        </div>

      <?php else : ?>

        <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time>
        <h3>
          <a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a>
        </h3>
        <p>
          <?= $lesetipp->intro()->kirbytext()->excerpt(40, 'words') ?>
          <a href="<?= $lesetipp->url() ?>">&rarr; Weiterlesen</a>
        </p>
        <div class="image-area">
          <a href="<?= $lesetipp->url() ?>">
            <?php $images = $lesetipp->images(); foreach ($images as $img) : ?>
              <?php $crop = $img->resize(200); ?>
              <figure>
                <img src="<?= $crop->url() ?>" title="<?= $img->desc()->html() ?>" alt="<?= $img->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
              </figure>
            <?php endforeach ?>
          </a>
        </div>

      <?php endif ?>

    </article>

    <?php if($count < $page->perpage()->int()) echo '<hr>' ?>
    <?php $count++; ?>

  <?php endforeach ?>



</section>

<?php snippet('pagination') ?>

<?php snippet('footer') ?>
