<nav class="wrap post-nav sketch">
  <?php if ($pagination->hasPrevPage()) : ?>
  <a class="btn left bg--primary" href="<?= $pagination->prevPageURL() ?>" rel="prev" title="<?= t('lesetipps_neuere-lesetipps--title') ?>">
    <?= $site->useSVG(t('lesetipps_neuere-lesetipps'), 'arrow-left', 37, 32) ?>
    <span class="btn--text show-600-up"><?= t('lesetipps_neuere-lesetipps') ?></span>
  </a>
  <?php else : ?>
  <span class="btn left bg--primary is-disabled"></span>
  <?php
    endif;
    if ($pagination->hasNextPage()) :
  ?>
  <a class="btn right bg--primary" href="<?= $pagination->nextPageURL() ?>" rel="next" title="<?= t('lesetipps_aeltere-lesetipps--title') ?>">
    <span class="btn--text show-600-up"><?= t('lesetipps_aeltere-lesetipps') ?></span>
    <?= $site->useSVG(t('lesetipps_aeltere-lesetipps'), 'arrow-right', 40.5, 32) ?>
  </a>
  <?php else : ?>
  <span class="btn right bg--primary is-disabled"></span>
  <?php endif ?>
</nav>
