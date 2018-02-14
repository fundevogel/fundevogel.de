<?php snippet('header') ?>

<article class="wrap lesetipp">
  <header>
    <time datetime="<?= $page->date('Y-m-d') ?>"><?= $page->date('d.m.Y') ?></time>
    <h2><?= $page->title()->html() ?></h2>
    <?= $page->text()->kt() ?>
  </header>
  <hr>
  <?php
    $count = 1; foreach ($lesetipps as $lesetipp) :
    $image = $lesetipp->cover()->toFile();
  ?>
  <section class="list">
    <article class="wrap">
      <div class="one-third center">
        <?php snippet('cover/bookcover', $image) ?>
      </div>
      <div class="two-thirds">
        <?php snippet('partials/biblio', $lesetipp) ?>
      </div>
    </article>
    <?php e($lesetipp !== $last, '<hr>') ?>
  </section>
  <?php if ($lesetipp == $last) : ?>
  <hr>
  <footer class="wrap">
    <?php e($page->conclusion()->isNotEmpty(), $page->conclusion()->kt()) ?>
    <p><?= l::get('lesetipp_hinweis-shop--1-5') ?> <?php e(count($lesetipps) > 1, l::get('lesetipp_hinweis-shop--2-5'), l::get('lesetipp_hinweis-shop--3-5')) ?> <?= l::get('lesetipp_hinweis-shop--4-5') ?> <a href="<?php e(count($lesetipps) == 1 && $lesetipp->shop()->isNotEmpty(), $lesetipp->shop(), $site->shop()) ?>" target="_blank"><?= l::get('lesetipp_hinweis-shop--5-5') ?></a>!</p>
  </footer>
  <?php endif ?>
  <?php
    $count++;
    endforeach
  ?>
</article>

<?php snippet('navigation/prevnext') ?>

<?php snippet('footer') ?>
