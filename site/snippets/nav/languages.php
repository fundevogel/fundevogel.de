<div class="flex items-center z-50">
    <?= useSVG(t('Sprachauswahl'), 'w-6 h-6 fill-current', 'globe') ?>
    <nav class="ml-2 lg:ml-0 flex items-center">
        <?php
            foreach ($kirby->languages() as $language) :

            if ($page->isTranslated($language->code())) :
            $langTitle = implode(' ', [Str::upper($kirby->language()), 'nach', Str::upper($language->code())]);
        ?>
        <a class="js-tippy<?php e($kirby->language() == $language, ' hidden is-active ', ' flex justify-center ') ?>px-2 text-white outline-none <?= $language->code() ?>" href="<?= $page->url($language->code()) ?>" title="<?= t($langTitle) ?>">
            <span><?= $language->code() ?></span>
        </a>
        <?php
            endif;
            endforeach;
        ?>
    </nav>
</div>
