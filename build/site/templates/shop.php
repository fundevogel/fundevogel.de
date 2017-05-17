<?php snippet('header') ?>

<section class="wrap">
  <h2><?= $page->subtitle()->html() ?></h2>
  <div class="flex-video">
    <iframe id="fundevogel-shop" title="Fundevogel-Shop" src="<?= $page->iframe()->html() ?>" name="fundevogel-shop" frameborder="0"></iframe>
  </div>
</section>

<?php snippet('footer') ?>
