<nav class="wrap post-nav sketch">
  <?php if ($page->hasNextListed()): ?>
  <a class="btn left bg--primary" href="<?= $page->nextListed()->url() ?>" rel="next" title="<?= $page->nextListed()->title()->html() ?>">
    <?= $site->useSVG(t('lesetipp_naechster-lesetipp'), 'arrow-left', 37, 32) ?>
    <span class="btn--text show-600-up"><?= t('lesetipp_naechster-lesetipp') ?></span>
  </a>
  <?php else : ?>
  <span class="btn left bg--primary is-disabled"></span>
  <?php
    endif;
    if ($page->hasPrevListed()) :
  ?>
  <a class="btn right bg--primary" href="<?= $page->prevListed()->url() ?>" rel="prev" title="<?= $page->prevListed()->title()->html() ?>">
    <span class="btn--text show-600-up"><?= t('lesetipp_letzter-lesetipp') ?></span>
    <?= $site->useSVG(t('lesetipp_letzter-lesetipp'), 'arrow-right', 40.5, 32) ?>
  </a>
  <?php else : ?>
  <span class="btn right bg--primary is-disabled"></span>
  <?php endif ?>
</nav>
