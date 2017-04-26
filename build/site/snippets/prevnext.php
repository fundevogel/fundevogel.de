<nav class="wrap post-nav center">

  <?php if($page->hasNextVisible()): ?>
    <a class="btn left bg--primary" href="<?= $page->nextVisible()->url() ?>" rel="next" title="<?= $page->nextVisible()->title()->html() ?>">
      <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
      <span class="btn--text show-small-up">Nächster Lesetipp</span>
    </a>
  <?php else : ?>
    <span class="btn left is-disabled"></span>
  <?php endif ?>


  <?php if($page->hasPrevVisible()): ?>
    <a class="btn right bg--primary" href="<?= $page->prevVisible()->url() ?>" rel="prev" title="<?= $page->prevVisible()->title()->html() ?>">
      <span class="btn--text show-small-up">Letzter Lesetipp</span>
      <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
    </a>
  <?php else : ?>
    <span class="btn right is-disabled"></span>
  <?php endif ?>

</nav>
