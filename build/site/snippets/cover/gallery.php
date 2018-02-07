<figure class="fig fig--gallery has-hover">
  <div class="gallery">
    <?php
      foreach ($page->images() as $image) :
      $thumb = $image->crop(460, 400, 85);
    ?>
    <a href="<?= $image->url() ?>" data-fancybox="fundevogel-und-team" data-caption="<?= $image->caption()->html() ?>">
      <img src ="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
    </a>
    <?php endforeach ?>
  </div>
  <figcaption class="sketch bg--primary">
    <?= $page->caption()->html() ?>
  </figcaption>
</figure>
