<?php
    $cover = $lesetipp->cover()->isNotEmpty() ? $lesetipp->cover()->toFile() : site()->fallback()->toFile();
?>
<article class="wrap">
  <div class="one-third center">
    <a class="" href="<?= $lesetipp->url() ?>">
      <?php snippet('templates/lesetipps.article.cover', compact('cover')) ?>
    </a>
  </div>
  <div class="two-thirds">
    <?php snippet('templates/lesetipps.preview.text', compact('lesetipp')) ?>
  </div>
</article>
