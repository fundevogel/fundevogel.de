<time datetime="<?= $article->date()->toDate('Y-m-d') ?>">
  <?= $article->date()->toDate('d.m.Y') ?>
</time>
<?php e($article->subtitle()->isNotEmpty(), '<span class="subtitle">&mdash; ' . $article->subtitle()->html() . '</span>') ?>
<h3>
  <?= $article->title()->html() ?>
</h3>
<?= $article->text()->kirbytext() ?>
