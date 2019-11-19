<nav id="nav-menu" class="nav-menu">
  <ul class="inline-list spread-out">
    <?php foreach($pages->listed() as $item) : ?>
    <li>
      <a<?php e($item->isOpen(), ' class="is-active"') ?> href="<?= $item->url() ?>" title="<?php e($item->isHomePage(), t('startseite'), $item->title()->html()) ?>">
        <?php
          $id = 'nav-' . $item->id();
          $translation = t($id);
        ?>
        <span><?= $translation ?></span>
      </a>
    </li>
    <?php endforeach ?>
    <?php e($site->shop()->isNotEmpty(), '<li><a href="' . $site->shop() . '" title="Shop" target="_blank"><span>Shop</span></a></li>') ?>
  </ul>
</nav>
