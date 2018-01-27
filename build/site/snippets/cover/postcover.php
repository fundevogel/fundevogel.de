<?php
  $id = $post->uid();
  if ($item) :
  if (@$gallery) { $thumb = $item->crop(200, null, 85); }
  else { $thumb = $item->isLandscape() ? $item->crop(250, null, 85) : $item->resize(250, null, 85); }
?>
<figure>
  <a href="<?= $item->url() ?>"<?php e(@$gallery, ' data-fancybox="' . $id . '"', ' data-fancybox') ?> data-caption="<?= $item->caption()->html() ?>">
    <img src="<?= $thumb->url() ?>" title="<?= $item->caption()->html() ?>" alt="<?= $item->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
  </a>
</figure>
<?php endif ?>
