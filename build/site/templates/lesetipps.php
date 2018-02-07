<?php snippet('header') ?>

<?php if ($pagination->page() == 1) : ?>
<header class="wrap">
  <div class="one-half--wide">
    <?= $page->text()->kt() ?>
  </div>
  <div class="one-half--wide recommendations center">
    <?php
      snippet('partials/biannual-pdf', ['early' => true]);
      snippet('partials/biannual-pdf');
    ?>
  </div>
</header>
<hr>
<?php endif ?>

<section class="list">
  <h2><?= l::get('lesetipps_ueberschrift-liste') ?></h2>
  <?php
    $count = 1; foreach($lesetipps as $lesetipp) :
    $image = $lesetipp->image();
    $images = $lesetipp->images();
    $excerpt = excerpt($lesetipp->text(), 40, 'words');
    $more = '<a href="' . $lesetipp->url() . '">&rarr; ' . l::get('lesetipps_weiterlesen') . '</a>';
  ?>
  <article class="wrap">
    <?php if (count($images) == 1) : ?>
    <div class="one-third center">
      <a class="" href="<?= $lesetipp->url() ?>">
        <?php snippet('cover/bookcover', $image) ?>
      </a>
    </div>
    <div class="two-thirds">
      <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time>
      <h3><a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a></h3>
      <p><?= $excerpt ?><br><?= $more ?></p>
    </div>
    <?php else : ?>
    <time datetime="<?= $lesetipp->date('Y-m-d') ?>"><?= $lesetipp->date('d.m.Y') ?></time>
    <h3><a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a></h3>
    <p><?= $excerpt ?><br><?= $more ?></p>
    <div class="image-area">
      <?php foreach ($images as $image) : ?>
      <a href="<?= $lesetipp->url() ?>">
        <?php snippet('cover/bookcover', $image) ?>
      </a>
      <?php endforeach ?>
    </div>
    <?php endif ?>
  </article>
  <?php
    e($count < $perpage, '<hr>');
    $count++;
    endforeach
  ?>
</section>

<?php snippet('pagination') ?>

<?php snippet('footer') ?>
