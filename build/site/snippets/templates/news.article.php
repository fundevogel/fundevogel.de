<?php
  $image = $article->image();
  $images = $article->images();
?>
<article class="post">
  <div class="wrap">
    <?php if (count($images) === 1) : ?>
      <div class="one-third image-area lightgallery">
        <?php snippet('templates/news.article.image', compact('article', 'image')) ?>
      </div>
      <div class="two-thirds">
        <?php snippet('templates/news.article.text', compact('article')) ?>
      </div>
    <?php else : ?>
      <?php snippet('templates/news.article.text', compact('article')) ?>
      <div class="image-area lightgallery">
        <?php foreach ($images as $image) : ?>
          <?php snippet('templates/news.article.image', compact('article', 'image')) ?>
        <?php endforeach ?>
      </div>
    <?php endif ?>
  </div>
  <?php e($article !== $articleLast, '<hr>', $nothingLeft) ?>
</article>
