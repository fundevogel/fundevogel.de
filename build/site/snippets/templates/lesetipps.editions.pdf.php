<figure class="fig">
  <a href="<?= $file->url() ?>" target="_blank">
    <img src="<?= $image->url() ?>" title="<?= $file->titleAttribute() ?>" alt="<?= $file->altAttribute() ?>" width="<?= $image->width() ?>" height="<?= $image->height() ?>">
    <figcaption class="bg--primary"><?= $file->edition() ?></figcaption>
  </a>
</figure>
