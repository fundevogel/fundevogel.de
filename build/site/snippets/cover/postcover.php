<?php
  $id = $post->uid();
  if ($image) :
  if (@$gallery) { $thumb = $image->crop(215, null, 85); }
  else { $thumb = $image->isLandscape() ? $image->crop(250, null, 85) : $image->resize(250, null, 85); }
  $crop = $image->resize(1280, null, 85);
?>
<figure data-lightgallery data-src="<?= $crop->url() ?>" data-sub-html="<?= $image->caption()->html() ?>">
  <img data-layzr="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
</figure>
<?php endif ?>
