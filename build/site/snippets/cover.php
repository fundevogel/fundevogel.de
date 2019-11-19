<?php
    if ($image = $page->cover()->toFile()) :
    $thumb = $image->resize(460, null, 85);
?>
<figure class="fig">
  <img src="<?= $thumb->url() ?>" title="<?= $image->titleAttribute()->html() ?><?php e($image->source()->isNotEmpty(), ' - ' . $image->source()->html()) ?>" alt="<?= $image->altAttribute()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
  <figcaption class="bg--primary"><?= $image->caption()->html() ?></figcaption>
</figure>
<?php endif ?>
