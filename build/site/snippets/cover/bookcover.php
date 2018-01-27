<?php
  if ($item) :
  $thumb = $item->resize(250, null, 85);
?>
<figure>
  <img src="<?= $thumb->url() ?>" title="<?= $item->caption()->html() ?>" alt="<?= $item->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
</figure>
<?php endif ?>
