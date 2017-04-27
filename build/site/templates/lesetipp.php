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
  <?php $count = 1; foreach ($lesetipps as $lesetipp) : ?>
    <section style="clear: both">
      <div class="one-third center">
        <figure>
          <?php $image = $lesetipp->cover()->toFile(); ?>
          <img src="<?= $image->url() ?>" title="<?= $image->desc()->html() ?>" alt="<?= $image->alt()->html() ?>" width="<?= $image->width() ?>" height="<?= $image->height() ?>">
        </figure>
      </div>
      <div class="two-thirds">
        <?php if($count == 1) echo $page->verdict()->kirbytext() ?>
        <blockquote>
          <?= $lesetipp->titel()->html() ?><br>
          <?= $lesetipp->autor()->html() ?><br>
          <?= $lesetipp->verlag()->html() ?><br>
          ISBN <?= $lesetipp->isbn()->html() ?><br>
          <?= $lesetipp->preis()->html() ?> €; <?= $lesetipp->alter()->html() ?><br>
        </blockquote>
      </div>
    </section>
    <?php $count++;?>
  <?php endforeach ?>
  <p>
    Wenn Ihr Lust bekommen habt, <?php e($page->images()->count() > 1, 'diese Bücher', 'dieses Buch') ?> zu lesen, dann kommt bei uns vorbei oder bestellt das Buch in unserem <a href="/shop/">Online-Shop</a>!
  </p>
</article>

<?php snippet('prevnext') ?>

<?php snippet('footer') ?>
