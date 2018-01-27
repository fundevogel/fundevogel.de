<figure class="fig has-hover">
  <a href="<?= $image->url() ?>" data-fancybox data-caption="<?= $image->caption()->html() ?>">
    <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
  </a>
  <figcaption class="sketch bg--primary"><?= $image->caption()->html() ?></figcaption>
</figure>
