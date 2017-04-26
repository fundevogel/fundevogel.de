<?php if($item->coverimage()->isNotEmpty()) : ?>
  <figure>
    <?php if($page->is('lesetipps')) : ?>
      <img src="<?= $item->coverimage()->toFile()->resize(250)->url(); ?>">
    <?php else : ?>
      <img src="<?= $item->coverimage()->toFile()->url(); ?>">
    <?php endif ?>
  </figure>
<?php endif ?>
