<?php snippet('header') ?>

<header class="wrap">
  <div class="one-half--wide">
    <?= $page->fundevogel()->kirbytext() ?>
  </div>
  <div class="one-half--wide teaser">
    <figure class="fig fig--slick-slider has-hover">
      <div class="slick-carousel" data-slick='{"lazyLoad": "ondemand", "autoplay": true, "arrows": false, "fade": true, "cssEase": "linear"}'>
        <?php $images = $page->images(); foreach ($images as $img) : ?>
          <?php $crop = $img->crop(460, 400); ?>
          <div><img data-lazy="<?= $crop->url() ?>" data-jslghtbx="<?= $img->url() ?>" title="<?= $img->desc()->html() ?>" alt="<?= $img->alt()->html() ?>" data-jslghtbx-group="fundevogel-carousel"></div>
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
