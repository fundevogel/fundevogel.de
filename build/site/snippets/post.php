<article class="wrap">

  <?php if($post->images()->count() == 1) : ?>

    <div class="one-third image-area">
      <figure>
        <?php
          $image = $post->image(); if($image->width() > $image->height()) {
            $crop = $image->crop(250);
          } else {
            $crop = $image->resize(250);
          }
         ?>
        <img src="<?= $crop->url() ?>" data-jslghtbx="<?= $image->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
      </figure>
    </div>
    <div class="two-thirds">
      <time datetime="<?= $post->date('Y-m-d') ?>"><?= $post->date('d.m.Y') ?></time><span class="subtitle"> - <?= $post->subtitle()->html() ?></span>
      <h3><?= $post->title()->html() ?></h3>
      <?= $post->intro()->kirbytext() ?>
    </div>

  <?php else : ?>

    <time datetime="<?= $post->date('Y-m-d') ?>"><?= $post->date('d.m.Y') ?></time><span class="subtitle"> - <?= $post->subtitle()->html() ?></span>
    <h3><?= $post->title()->html() ?></h3>
    <?= $post->intro()->kirbytext() ?>
    <div class="image-area">
      <?php $images = $post->images(); foreach ($images as $img) : ?>
        <?php $crop = $img->crop(180); ?>
        <figure>
          <img src="<?= $crop->url() ?>" data-jslghtbx="<?= $img->url() ?>" title="<?= $img->desc()->html() ?>" alt="<?= $img->alt()->html() ?>" data-jslghtbx-group="<?= $post->slug() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
        </figure>
      <?php endforeach ?>
    </div>

  <?php endif ?>

</article>
<?php $last = $posts->last(); ?>
<?php if($post !== $last) echo '<hr>' ?>
