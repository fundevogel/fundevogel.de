<?php
  $image = $post->image();
  $images = $post->images();
?>
<article class="wrap<?php e(r::ajax(), ' ajaxd') ?>">
<?php if (count($images) == 1) : ?>
<div class="one-third image-area lightgallery">
  <?php snippet('cover/postcover', ['post' => $post, 'image' => $image, 'gallery' => false]) ?>
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
<div class="image-area lightgallery">
  <?php foreach ($images as $image) : ?>
    <?php snippet('cover/postcover', ['post' => $post, 'image' => $image, 'gallery' => true]) ?>
  <?php endforeach ?>
</div>
<?php endif ?>
</article>
<?php e($post !== $last, '<hr>') ?>
