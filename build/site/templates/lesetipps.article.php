<?php snippet('header') ?>

<article class="wrap lesetipp">
  <header>
    <time datetime="<?= $page->date()->toDate('Y-m-d') ?>"><?= $page->date()->toDate('d.m.Y') ?></time>
    <h2><?= $page->title()->html() ?></h2>
    <?= $page->text()->kt() ?>
  </header>
  <section class="list">
    <hr>
    <article class="wrap">
      <div class="one-third center">
        <?php snippet('templates/lesetipps.article.cover', compact('cover')) ?>
      </div>
      <div class="two-thirds">
        <?php snippet('templates/lesetipps.article.book', ['lesetipp' => $page]) ?>
      </div>
    </article>
    <hr>
  </section>
  <footer class="wrap">
    <?php e($page->conclusion()->isNotEmpty(), $page->conclusion()->kt()) ?>
    <p><?= t('lesetipp_hinweis-shop--1-5') ?> <?= t('lesetipp_hinweis-shop--3-5') ?> <?= t('lesetipp_hinweis-shop--4-5') ?> <a href="<?php e($page->shop()->isNotEmpty(), $page->shop(), $site->shop()) ?>" target="_blank"><?= t('lesetipp_hinweis-shop--5-5') ?></a>!</p>
  </footer>
</article>

<?php snippet('navigation/prevnext') ?>

<?php snippet('footer') ?>
