<?php snippet('header') ?>

<section class="wrap">
  <?= $page->text()->kirbytext() ?>
  <figure class="fig has-hover">
    <?php
      $image = $page->image();
      $thumb = thumb($image, array('width' => 960, 'quality' => 85));
     ?>
    <img src="<?= $thumb->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $thumb->width() ?>" height="<?= $thumb->height() ?>">
    <figcaption class="sketch bg--primary"><?= $image->desc()->html() ?></figcaption>
  </figure>
</section>
<hr>

<section id="infinite-scroll" class="list" data-page="<?= $page->url() ?>" data-limit="<?= $limit ?>">
  <h2><?= l::get('home_ueberschrift-liste') ?></h2>

  <?php foreach($posts as $post) : ?>
    <?php snippet('post', compact('post')) ?>
  <?php endforeach ?>

</section>

<nav class="wrap post-nav">
  <button id="load-more" class="btn bg--primary" type="button" title="<?= l::get('home_mehr-anzeigen--title') ?>">
    <span class="btn--text"><?= l::get('home_mehr-anzeigen') ?></span>
  </button>
</nav>

<?php snippet('footer') ?>
