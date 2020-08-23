<?php
    foreach ($kirby->languages() as $language) :

    if ($page->isTranslated($language->code())) :
    $langTitle = implode(' ', [Str::upper($kirby->language()), 'nach', Str::upper($language->code())]);
?>
<a class="js-tippy <?php e($kirby->language() == $language, ' hidden is-active ', 'flex items-center ') ?>px-2 text-sm text-white outline-none <?= $language->code() ?>" href="<?= $page->url($language->code()) ?>" title="<?= t($langTitle) ?>">
    <?= useSVG($language->name(), 'w-6 h-6 rounded-full', $language->code()) ?>
    <span class="ml-2 hidden sm:inline">
        <?= $language->name() ?>
    </span>
</a>
<?php
    endif;
    endforeach;
?>
