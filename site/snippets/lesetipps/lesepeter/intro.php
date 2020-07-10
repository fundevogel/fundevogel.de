<div class="my-6 flex items-center">
    <div class="flex-none mr-6 hidden md:block">
        <?= useSVG('LesePeter ' . $page->lesepeter()->html(), 'js-tippy w-20 h-20', 'lesepeter') ?>
    </div>
    <div class="flex-1 flex items-center">
        <p class="italic">
            <?= I18n::template('Einleitung Lesepeter', null, ['link' => $page->leselink()->toUrl()])?>
        </p>
    </div>
</div>
