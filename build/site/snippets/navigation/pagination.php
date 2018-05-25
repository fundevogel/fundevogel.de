<nav class="wrap post-nav sketch">
  <?php if ($pagination->hasPrevPage()) : ?>
  <a class="btn left bg--primary" href="<?= $pagination->prevPageURL() ?>" rel="prev" title="<?= l::get('lesetipps_neuere-lesetipps--title') ?>">
    <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
    <span class="btn--text show-600-up"><?= l::get('lesetipps_neuere-lesetipps') ?></span>
  </a>
  <?php else : ?>
  <span class="btn left bg--primary is-disabled"></span>
  <?php
    endif;
    if ($pagination->hasNextPage()) :
  ?>
  <a class="btn right bg--primary" href="<?= $pagination->nextPageURL() ?>" rel="next" title="<?= l::get('lesetipps_aeltere-lesetipps--title') ?>">
    <span class="btn--text show-600-up"><?= l::get('lesetipps_aeltere-lesetipps') ?></span>
    <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
  </a>
  <?php else : ?>
  <span class="btn right bg--primary is-disabled"></span>
  <?php endif ?>
</nav>
