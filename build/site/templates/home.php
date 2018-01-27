<?php snippet('header') ?>

<section class="wrap">
  <?= $page->text()->kt() ?>
  <?php snippet('cover/hero') ?>
</section>
<hr>
<section id="infinite-scroll" class="list" data-page="<?= $page->url() ?>" data-limit="<?= $limit ?>">
  <h2><?= l::get('home_ueberschrift-liste') ?></h2>
  <?php
    foreach($posts as $post) :
    $image = $post->image();
    $images = $post->images();
  ?>
  <article class="wrap">
    <?php if (count($images) == 1) : ?>
    <div class="one-third image-area">
      <?php snippet('cover/postcover', $image) ?>
    </div>
    <div class="two-thirds">
      <time datetime="<?= $post->date('Y-m-d') ?>"><?= $post->date('d.m.Y') ?></time><span class="subtitle"> - <?= $post->subtitle()->html() ?></span>
      <h3><?= $post->title()->html() ?></h3>
      <?= $post->text()->kirbytext() ?>
    </div>
    <?php else : ?>
    <time datetime="<?= $post->date('Y-m-d') ?>"><?= $post->date('d.m.Y') ?></time><span class="subtitle"> - <?= $post->subtitle()->html() ?></span>
    <h3><?= $post->title()->html() ?></h3>
    <?= $post->text()->kirbytext() ?>
    <div class="image-area">
      <?php foreach ($images as $image) : ?>
        <?php snippet('cover/postcover', array('post' => $post, 'item' => $image, 'gallery' => true)) ?>
      <?php endforeach ?>
    </div>
    <?php endif ?>
  </article>
  <?php e($post !== $last, '<hr>') ?>
  <?php endforeach ?>
</section>
<nav class="wrap post-nav">
  <button id="load-more" class="btn bg--primary" type="button" title="<?= l::get('home_mehr-anzeigen--title') ?>">
    <span class="btn--text"><?= l::get('home_mehr-anzeigen') ?></span>
  </button>
</nav>

<?php snippet('footer') ?>
