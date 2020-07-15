<div class="my-6 flex items-center">
    <div class="flex-none mr-4 hidden md:block">
        <?= useSVG($award['awardtitle'], 'js-tippy w-auto h-24', $award['identifier']) ?>
    </div>
    <div class="flex-1 flex items-center">
        <p class="mb-0 content italic">
            <?php if ($page->isAward()->bool()) : ?>
            <?= I18n::template('Einleitung ' . $award['award'], null, $award) ?>
            <?php else : ?>
            <?= I18n::template('Einleitung ' . $award['award'] . ' (Füchsle)', null, $award) ?>
            <?php endif ?>
        </p>
    </div>
</div>
