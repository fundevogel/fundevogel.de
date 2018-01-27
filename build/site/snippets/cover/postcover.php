<?php
  $id = $post->uid();
  if ($image) :
  if (@$gallery) { $thumb = $image->crop(200, null, 85); }
  else { $thumb = $image->isLandscape() ? $image->crop(250, null, 85) : $image->resize(250, null, 85); }
  $crop = $image->resize(1280, null, 85);
?>
<figure>
  <a href="<?= $crop->url() ?>"<?php e(@$gallery, ' data-fancybox="' . $id . '"', ' data-fancybox') ?> data-caption="<?= $image->caption()->html() ?>">
    <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
  </a>
</figure>
<?php endif ?>
