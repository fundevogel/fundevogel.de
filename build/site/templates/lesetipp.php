<?php snippet('header') ?>

<article class="wrap lesetipp">
  <header>
    <time datetime="<?= $page->date('Y-m-d') ?>"><?= $page->date('d.m.Y') ?></time>
    <h2><?= $page->title()->html() ?></h2>
    <?= $page->text()->kirbytext() ?>
  </header>
  <hr>
  <?php $lesetipps = $page->angaben()->toStructure(); ?>
  <?php $last = $lesetipps->count(); ?>
  <?php $count = 0; foreach ($lesetipps as $lesetipp) : ?>
    <section style="clear: both">
      <div class="one-third center">
        <figure>
          <?php $image = $lesetipp->cover()->toFile(); ?>
          <img src="<?= $image->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $image->width() ?>" height="<?= $image->height() ?>">
        </figure>
      </div>
      <div class="two-thirds">
        <?= $lesetipp->verdict()->kirbytext() ?>
        <blockquote>
          <?= $lesetipp->titel()->html() ?><br>
          <?= $lesetipp->autor()->html() ?><br>
          <?= $lesetipp->verlag()->html() ?><br>
          ISBN <?= $lesetipp->isbn()->html() ?><br>
          <?= $lesetipp->preis()->html() ?> €<?php if($lesetipp->alter()->isNotEmpty()) : ?>; <?= $lesetipp->alter()->html() ?><?php endif ?>
        </blockquote>
      </div>
    </section>
    <?php $count++;?>
  <?php endforeach ?>
  <?php if($count > 1 && $page->conclusion()->isNotEmpty()) : ?>
    <p style="clear: both">
      <?= $page->conclusion()->html() ?>
    </p>
  <?php endif ?>
  <p>
    <?= l::get('lesetipp_hinweis-shop--1-5') ?> <?php e($page->images()->count() > 1, l::get('lesetipp_hinweis-shop--2-5'), l::get('lesetipp_hinweis-shop--3-5')) ?> <?= l::get('lesetipp_hinweis-shop--4-5') ?> <a href="/shop/"><?= l::get('lesetipp_hinweis-shop--5-5') ?></a>!
  </p>
</article>

<?php snippet('prevnext') ?>

<?php snippet('footer') ?>
