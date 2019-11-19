<?php
  if (!@$lightgallery) $image = $page->image();
  $thumb = $image->thumb('fundevogel.slides.image');
?>
<a href="<?= $image->url() ?>"<?php e(@$lightgallery, ' data-lightgallery') ?>>
  <img src="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
</a>
