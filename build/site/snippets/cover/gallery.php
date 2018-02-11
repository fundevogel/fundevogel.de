<figure class="fig fig--gallery has-hover">
  <div class="lightgallery gallery">
    <?php
      foreach ($page->images() as $image) :
      $thumb = $image->crop(460, 400, 85);
    ?>
    <a href="<?= $image->url() ?>" data-lightgallery data-sub-html="<?= $image->caption()->html() ?>">
      <img src ="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
    </a>
    <?php endforeach ?>
  </div>
  <figcaption class="sketch bg--primary">
    <?= $page->caption()->html() ?>
  </figcaption>
</figure>
