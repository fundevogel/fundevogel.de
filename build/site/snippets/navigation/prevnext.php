<nav class="wrap post-nav sketch">
  <?php if ($page->hasNextVisible()): ?>
  <a class="btn left bg--primary" href="<?= $page->nextVisible()->url() ?>" rel="next" title="<?= $page->nextVisible()->title()->html() ?>">
    <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
    <span class="btn--text show-600-up"><?= l::get('lesetipp_naechster-lesetipp') ?></span>
  </a>
  <?php else : ?>
  <span class="btn left bg--primary is-disabled"></span>
  <?php
    endif;
    if ($page->hasPrevVisible()) :
  ?>
  <a class="btn right bg--primary" href="<?= $page->prevVisible()->url() ?>" rel="prev" title="<?= $page->prevVisible()->title()->html() ?>">
    <span class="btn--text show-600-up"><?= l::get('lesetipp_letzter-lesetipp') ?></span>
    <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
  </a>
  <?php else : ?>
  <span class="btn right bg--primary is-disabled"></span>
  <?php endif ?>
</nav>
