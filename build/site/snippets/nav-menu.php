<ul class="inline-list spread-out">
  <?php foreach($pages->visible()->filterBy('translation_ready', '1') as $item) : ?>
    <li>
      <a class="<?= r($item->isOpen(), 'is-active') ?>" href="<?= $item->url() ?>" <?= r($page->isHomePage(), 'rel="home"') ?> title="<?php e($item->is('home'), l::get('startseite'), $item->title()->html()) ?>">
        <?php
          $id = 'nav-' . $item->id();
          $trans = l($id);
        ?>
        <span><?= $trans ?></span>
      </a>
    </li>
  <?php endforeach ?>
</ul>
