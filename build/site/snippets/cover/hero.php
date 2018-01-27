<?php
  if ($hero = $page->image('hero.jpg')) :
  $thumb = $hero->resize(960, null, 85);
?>
<figure class="fig has-hover">
  <img src="<?= $thumb->url() ?>" title="<?= $hero->caption()->html() ?>" alt="<?= $hero->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
  <figcaption class="sketch bg--primary"><?= $hero->caption()->html() ?></figcaption>
</figure>
<?php endif ?>
