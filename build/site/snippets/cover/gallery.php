<figure class="fig fig--slider has-hover">
  <div class="lightgallery gallery">
    <?php
      foreach ($page->images() as $image) :
      $thumb = $image->crop(460, 400, 85);
    ?>
    <a href="<?= $image->url() ?>" data-lightgallery>
      <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
    </a>
    <?php endforeach ?>
  </div>
  <figcaption class="sketch bg--primary">
    <?= $page->caption()->html() ?>
  </figcaption>
</figure>
<noscript>
  <figure class="fig has-hover">
    <?php
      $image = $page->image();
      $thumb = $image->crop(460, 400, 85);
    ?>
    <a href="<?= $image->url() ?>">
      <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
    </a>
    <figcaption class="sketch bg--primary">
      <?= $page->caption()->html() ?>
    </figcaption>
  </figure>
</noscript>
