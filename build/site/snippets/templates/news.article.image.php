<?php
  $id = $article->uid();
  if ($image) :
  $croppedImage = $image->thumb('news.article.full');
  $thumb = $image->thumb('news.article.image');
?>
<figure data-lightgallery data-src="<?= $croppedImage->url() ?>" data-sub-html="<?= $image->caption()->html() ?>">
  <img data-layzr="<?= $thumb->url() ?>" title="<?= $image->caption()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
</figure>
<?php endif ?>
