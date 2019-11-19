<nav class="lang-menu">
  <ul class="inline-list spread-out">
    <?php foreach($kirby->languages() as $language) : ?>
      <li class="<?= $language->code() ?><?php e($kirby->language() == $language, ' is-active') ?>">
        <a href="<?= $page->url($language->code()) ?>" title="<?php $lang_string = 'i18-link--' . $kirby->language() . '-zu-' . $language->code(); echo t($lang_string) ?>">
          <?= $site->useSVG($language->name(), $language->code(), 20, 20) ?>
          <span class="hide-on-small">
            <?= $language->name() ?>
          </span>
        </a>
      </li>
    <?php endforeach ?>
  </ul>
</nav>
