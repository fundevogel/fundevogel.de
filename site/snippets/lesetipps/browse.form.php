<section class="container px-2">
    <?= $page->details()->kt() ?>

    <div class="flex flex-col sm:flex-row">
        <?php
            $count = 0;
            foreach ($fields as $field => $array) :
        ?>
        <?php e($count === 0 || $count === 2, '<div class="sm:w-1/2 sm:first:mr-2 sm:last:ml-2 flex flex-col lg:flex-row">') ?>
            <select class="js-select mt-4 sm:first:mr-4 sm:last:ml-4">
                <?php
                    $reset = params();
                    unset($reset[$field]);
                    $resetURL = url(Url::current(), ['params' => $reset]);
                ?>
                <option value="<?= $resetURL ?>"><?= t(implode(' ', [$field, 'auswählen'])) ?></option>
                <?php
                    foreach ($array as $item) :
                    $params = A::update(params(), [$field => rawurlencode($item)]);

                    # Reset page count when changing category
                    if ($isPaginated = param('page')) {
                        unset($params['page']);
                    }
                ?>
                <option value="<?= url(Url::current(), ['params' => $params]) ?>"<?php e(rawurldecode(param($field)) === $item, ' selected') ?>><?= $item ?></option>
                <?php endforeach ?>
            </select>
        <?php e($count === 1 || $count === 3, '</div>') ?>
        <?php
            $count++;
            endforeach;
        ?>
    </div>

    <div class="mt-4 flex flex-col md:flex-row">
        <div class="flex-1">
            <form class="form-input pl-4 pr-2 flex justify-between items-center relative">
                <input
                    class="w-full font-base text-orange-medium placeholder-orange-medium placeholder-opacity-100 bg-orange-light appearance-none outline-none focus:outline-none active:outline-none"
                    type="search"
                    name="q"
                    value="<?= html($query) ?>"
                    placeholder="<?= t('Alle Lesetipps durchsuchen') ?> ..."
                >
                <button class="mx-2 outline-none focus:outline-none active:outline-none" type="submit" value="Search">
                    <?= useSVG('Suche', 'w-8 h-8 text-orange-medium fill-current', 'search') ?>
                </button>
            </form>
        </div>
        <div class="mt-4 md:mt-0 md:ml-4 h-16 md:h-auto flex-none">
            <a class="h-full flex justify-center items-center px-4 rounded-lg text-white text-shadow bg-red-light hover:bg-red-medium transition-all" href="<?= $page->url() ?>" title="<?= t('Alles zurücksetzen') ?>">
                <span class="sketch text-2xl select-none"><?= t('Zurücksetzen') ?></span>
            </a>
        </div>
    </div>

</section>
