<nav class="wrap post-nav center">

  <?php if($pagination->hasPrevPage()) : ?>
    <a class="btn left bg--primary" href="<?= $pagination->prevPageURL() ?>" rel="prev" title="Neuere Lesetipps">
      <?= (new Asset("assets/images/arrow-left.svg"))->content() ?>
      <span class="btn--text show-small-up"><?php e($page->is('lesetipps'), 'Neuere Lesetipps', 'Neuere Einträge') ?></span>
    </a>
  <?php else: ?>
    <span class="btn left is-disabled"></span>
  <?php endif ?>

  <?php if($pagination->hasNextPage()) : ?>
    <a class="btn right bg--primary" href="<?= $pagination->nextPageURL() ?>" rel="next" title="Frühere Lesetipps">
      <span class="btn--text show-small-up"><?php e($page->is('lesetipps'), 'Frühere Lesetipps', 'Frühere Einträge') ?></span>
      <?= (new Asset("assets/images/arrow-right.svg"))->content() ?>
    </a>
  <?php else : ?>
    <span class="btn right is-disabled"></span>
  <?php endif ?>

</nav>
