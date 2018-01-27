<figure class="fig fig--slick-slider has-hover">
  <div class="slick-carousel" data-slick='<?= json_encode($options) ?>'>
    <?php foreach ($images as $image) : ?>
      <?php $thumb = $image->crop(460, 400, 85); ?>
      <a href="<?= $image->url() ?>" data-fancybox="fundevogel-und-team" data-caption="<?= $image->caption()->html() ?>">
        <img<?php e($image == $first, ' src ="' . $thumb->url() . '"', ' data-lazy="' . $thumb->url() . '"') ?> title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
      </a>
    <?php endforeach ?>
  </div>
  <figcaption class="sketch bg--primary">
    <?= $page->caption()->html() ?>
  </figcaption>
</figure>
