<div class="my-6 flex items-center">
    <div class="flex-none mr-6 hidden md:block">
        <?= useSVG('LesePeter ' . $page->lesepeter()->html(), 'js-tippy w-20 h-20', 'lesepeter') ?>
    </div>
    <div class="flex-1 flex items-center">
        <p class="italic">
            <?php if ($page->isLesepeter()->bool()) : ?>
            <?= I18n::template('Einleitung LesePeter (Rezension)', null, ['link' => $page->leselink()->toUrl()])?>
            <?php else : ?>
            <?= I18n::template('Einleitung LesePeter (Füchsle)', null, ['link' => $page->leselink()->toUrl()])?>
            <?php endif ?>
        </p>
    </div>
</div>
