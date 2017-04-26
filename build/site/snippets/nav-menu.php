<ul class="inline-list spread-out">
  <?php foreach($pages->visible() as $item): ?>
    <li>
      <a class="<?= r($item->isOpen(), 'is-active') ?>" href="<?= $item->url() ?>" <?= r($page->isHomePage(), 'rel="home"') ?>>
        <span><?= $item->handle()->html() ?></span>
      </a>
    </li>
  <?php endforeach ?>
</ul>
