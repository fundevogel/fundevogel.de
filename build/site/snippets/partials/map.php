<figure class="fig has-hover" data-lightgallery data-src="<?= $image->url() ?>" data-sub-html="<?= $image->caption()->html() ?>">
  <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
  <figcaption class="sketch bg--primary"><?= $image->caption()->html() ?></figcaption>
</figure>
