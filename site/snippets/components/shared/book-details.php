<div class="flex flex-col my-8 text-sm">
    <div class="flex flex-col sm:flex-row">
        <div class="mb-4 flex-1 flex items-center">
            <?= useSVG(t('AutorIn'), 'js-tippy lesetipp-icon', 'bulb') ?>
            <span class="ml-4">
                <?= $book->author()->html() ?>
            </span>
        </div>
        <?php if ($book->illustrator()->isNotEmpty()) : ?>
        <div class="mb-4 flex-1 flex items-center">
            <?= useSVG(t('IllustratorIn'), 'js-tippy lesetipp-icon', 'palette') ?>
            <span class="ml-4">
                <?= $book->illustrator()->html() ?>
            </span>
        </div>
        <?php elseif ($book->narrator()->isNotEmpty()) : ?>
            <div class="mb-4 flex-1 flex items-center">
            <?= useSVG(t('SprecherIn'), 'js-tippy lesetipp-icon', 'microphone') ?>
            <span class="ml-4">
                <?= $book->narrator()->html() ?>
            </span>
        </div>
        <?php elseif ($book->translator()->isNotEmpty()) : ?>
        <div class="mb-4 flex-1 flex items-center">
            <?= useSVG(t('ÜbersetzerIn'), 'js-tippy lesetipp-icon', 'globe') ?>
            <span class="ml-4">
                <?= $book->translator()->html() ?>
            </span>
        </div>
        <?php elseif ($book->participants()->isNotEmpty()) : ?>
        <div class="mb-4 flex-1 flex items-center">
            <?= useSVG(t('Mitwirkende'), 'js-tippy lesetipp-icon', 'heart') ?>
            <span class="ml-4">
                <?= $book->participants()->html() ?>
            </span>
        </div>
        <?php endif ?>
    </div>
    <div class="flex flex-col sm:flex-row">
        <div class="mb-4 flex-1 flex items-center">
            <?= useSVG(t('Verlag'), 'js-tippy lesetipp-icon', 'truck', 'data-tippy-placement="bottom"') ?>
            <span class="ml-4">
                <?= $book->publisher()->html() ?>
            </span>
        </div>
        <div class="mb-4 flex-1 flex items-center">
            <?= useSVG('ISBN', 'js-tippy lesetipp-icon', 'book-open', 'data-tippy-placement="bottom"') ?>
            <span class="ml-4">
                <?= $book->isbn()->html() ?>
            </span>
        </div>
    </div>
</div>
<div class="flex flex-col xs:flex-row justify-between items-center">
    <?php
        $age_list = explode(' ', $book->age());
        $period = array_pop($age_list);
        $age = implode(' ', $age_list);
    ?>
    <div class="flex">
        <?php if ($age && $period) : ?>
        <div class="mr-6 sm:mr-8 text-center leading-tight">
            <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= html($age) ?></span>
            <span class="block text-sm sm:text-lg"><?= $period ?></span>
        </div>
        <?php endif ?>
        <?php if ($book->pageCount()->isNotEmpty()) : ?>
        <div class="mr-6 md:mr-8 text-center leading-tight">
            <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= $book->pageCount()->htm() ?></span>
            <span class="block text-sm sm:text-lg"><?= t('Seiten') ?></span>
        </div>
        <?php endif ?>
        <?php if ($book->duration()->isNotEmpty()) : ?>
        <div class="mr-6 md:mr-8 text-center leading-tight">
            <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= $book->duration()->htm() ?></span>
            <span class="block text-sm sm:text-lg"><?= t('Minuten') ?></span>
        </div>
        <?php endif ?>
        <?php if ($book->price()->isNotEmpty()) : ?>
        <div class="mr-6 md:mr-8 text-center leading-tight">
            <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= $book->price()->html() ?> €</span>
            <span class="block text-sm sm:text-lg"><?= t('Ladenpreis') ?></span>
        </div>
        <?php endif ?>
    </div>
    <div class="mt-12 xs:mt-0 flex-none">
        <?php if ($book->shop()->isNotEmpty() && $book->isAvailable()->bool()) : ?>
        <a class="py-3 px-5 sm:py-4 sm:px-6 rounded-full text-white text-shadow bg-red-light hover:bg-red-medium transition-all" href="<?= $book->shop()->toUrl() ?>" target="_blank">
            <span class="sketch text-2xl select-none"><?= t('Zum Shop') ?> !</span>
        </a>
        <?php else : ?>
        <a class="js-tippy py-3 px-5 sm:py-4 sm:px-6 rounded-full text-white text-shadow bg-red-light hover:bg-red-medium transition-all" href="mailto:<?= $site->mail() ?>" title="<?= t('Bitte besorgen') ?>" target="_blank" data-tippy-theme="fundevogel red">
            <span class="sketch text-2xl select-none"><?= t('Vergriffen') ?> !</span>
        </a>
        <?php endif ?>
    </div>
</div>
