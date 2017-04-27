<?php snippet('header') ?>

<section class="wrap">
  <?= $page->text()->kirbytext() ?>
  <figure class="fig has-hover">
    <?php
      $image = $page->image();
      $crop = $image->resize(960);
     ?>
    <img src="<?= $crop->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $crop->width() ?>" height="<?= $crop->height() ?>">
    <figcaption class="sketch bg--primary"><?= $image->desc()->html() ?></figcaption>
  </figure>
</section>
<hr>

<section id="infinite-scroll" class="list" data-page="<?= $page->url() ?>" data-limit="<?= $limit ?>">
  <h2 class="center"><?= $page->subtitle()->html() ?></h2>

  <?php foreach($posts as $post) : ?>
    <?php snippet('post', compact('post')) ?>
  <?php endforeach ?>

</section>

<nav class="wrap post-nav">
  <button id="load-more" class="btn bg--primary" type="button">
    <span class="btn--text"><?= $page->button()->html() ?></span>
  </button>
</nav>

<?php snippet('footer') ?>
