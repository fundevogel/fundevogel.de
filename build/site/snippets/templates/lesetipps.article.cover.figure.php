<?php
  $thumb = $cover->thumb('lesetipps.article.cover');
  $src = @$lazy ? ' data-layzr' : ' src';
?>
<figure>
  <img<?= $src ?>="<?= $thumb->url() ?>" title="<?= $cover->titleAttribute()->html() ?>" alt="<?= $cover->altAttribute()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
</figure>
