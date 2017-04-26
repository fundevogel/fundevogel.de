<ul class="inline-list spread-out">
  <?php foreach($site->languages() as $language) : ?>
    <li class="<?= $language->code() ?><?php e($site->language() == $language, ' is-active') ?>">
      <a href="<?= $page->url($language->code()) ?>">
        <?php $link = 'assets/images/flags/' . $language->code() . '.svg' ?>
        <?= (new Asset($link))->content() ?>
        <span class="hide-on-small">
          <?= $language->name() ?>
        </span>
      </a>
    </li>
  <?php endforeach ?>
</ul>
