<nav class="wrap post-nav sketch">
  <?php if ($pagination->hasPrevPage()) : ?>
  <a class="btn left bg--primary" href="<?= $pagination->prevPageURL() ?>" rel="prev" title="<?= t('home_frueheres--title') ?>">
    <?= $site->useSVG(t('home_frueheres'), 'arrow-left', 37, 32) ?>
    <span class="btn--text show-600-up"><?= t('home_frueheres') ?></span>
  </a>
  <?php
    endif;
    if ($pagination->hasNextPage()) :
  ?>
  <a class="btn right bg--primary load-more-target" href="<?= $pagination->nextPageURL() ?>" rel="next" title="<?= t('home_aelteres--title') ?>">
    <span class="btn--text show-600-up"><?= t('home_aelteres') ?></span>
    <?= $site->useSVG(t('home_aelteres'), 'arrow-right', 40.5, 32) ?>
  </a>
  <?php endif ?>

  <button class="btn bg--primary load-more" type="button" title="<?= t('home_mehr-anzeigen--title') ?>">
    <span class="btn--text"><?= t('home_mehr-anzeigen') ?></span>
  </button>
</nav>
