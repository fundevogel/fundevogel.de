<ul class="inline-list spread-out">
  <?php
    $translatedPages = $pages->visible()->filterBy('translation_ready', '1')->filter(function($p) {
      return $p->content(site()->language()->code())->exists();
    });
  ?>
  <?php foreach($translatedPages as $item) : ?>
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
