<?php snippet('header') ?>

<header class="wrap">
  <div class="one-half--wide">
    <?= $page->fundevogel()->kirbytext() ?>
  </div>
  <div class="one-half--wide teaser">
    <figure class="fig fig--slick-slider has-hover">
      <div class="slick-carousel" data-slick='{"lazyLoad": "ondemand", "autoplay": true, "arrows": false, "fade": true, "cssEase": "linear"}'>
        <?php
          $images = $page->images();
          $first = $images->first();
        ?>
        <?php foreach ($images as $image) : ?>
          <?php $thumb = thumb($image, array('width' => 460, 'height' => 400, 'quality' => 85, 'crop' => true)); ?>
          <a href="<?= $image->url() ?>" data-fancybox="fundevogel-und-team" data-caption="<?= $image->desc()->html() ?>">
            <img<?php if($image == $first) : ?> src ="<?= $thumb->url() ?>" <?php else : ?> data-lazy="<?= $thumb->url() ?>"<?php endif ?> title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
          </a>
        <?php endforeach ?>
      </div>
      <figcaption class="sketch bg--primary">
        <?= $page->caption()->html() ?>
      </figcaption>
    </figure>
  </div>
</header>
<hr>
<section class="wrap">
  <?= $page->about_us()->kirbytext() ?>
</section>
<hr>
<section class="wrap">
  <div class="one-half">
    <?= $page->left()->kirbytext() ?>
  </div>
  <div class="one-half">
    <?= $page->right()->kirbytext() ?>
  </div>
</section>

<?php snippet('footer') ?>
