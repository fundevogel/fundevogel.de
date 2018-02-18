<nav id="nav-menu" class="nav-menu">
  <ul class="inline-list spread-out">
    <?php
      // $translated = $pages->visible()->filterBy('translations', '1')->filter(function($p) {
      //   return $p->content(site()->language()->code())->exists();
      // });
    ?>
    <?php foreach($pages->visible() as $item) : ?>
    <li>
      <a<?php e($item->isOpen(), ' class="is-active"') ?> href="<?= $item->url() ?>" title="<?php e($item->isHomePage(), l::get('startseite'), $item->title()->html()) ?>">
        <?php
          $id = 'nav-' . $item->id();
          $translation = l($id);
        ?>
        <span><?= $translation ?></span>
      </a>
    </li>
    <?php endforeach ?>
    <?php e($site->shop()->isNotEmpty(), '<li><a href="' . $site->shop() . '" title="Shop" target="_blank"><span>Shop</span></a></li>') ?>
  </ul>
</nav>
