<section class="container">
    <?= $page->details()->kt() ?>

    <div class="flex justify-around -ml-3 -mr-3">
        <?php foreach ($fields as $field => $array) : ?>
        <div class="flex-1 mx-3">
            <select class="js-select">
                <?php
                    $reset = params();
                    unset($reset[$field]);
                    $resetURL = url(Url::current(), ['params' => $reset]);
                ?>
                <option value="<?= $resetURL ?>"><?= t(implode(' ', [$field, 'auswählen'])) ?></option>
                <?php
                    foreach ($array as $item) :

                    if (A::isAssociative($array) === true) {
                        $item = $item->value();
                    }

                    $params = A::update(params(), [$field => rawurlencode($item)]);

                    // Reset page count when changing category
                    if ($isPaginated = param('page')) {
                        unset($params['page']);
                    }

                    var_dump(rawurldecode(param($field)));
                    var_dump($item);
                ?>
                    <option value="<?= url(Url::current(), ['params' => $params]) ?>"<?php e(rawurldecode(param($field)) === $item, ' selected') ?>><?= $item ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <?php endforeach ?>
    </div>

    <div class="mt-6 flex">
        <div class="flex-1">
            <form class="w-full pl-4 pr-2 py-2 bg-orange-light border-4 border-dashed border-orange-medium rounded-lg flex justify-between items-center relative">
                <input
                    class="w-full font-base text-orange-medium placeholder-orange-medium placeholder-opacity-100 bg-orange-light appearance-none outline-none focus:outline-none active:outline-none"
                    type="search"
                    name="q"
                    value="<?= html($query) ?>"
                    placeholder="<?= t('Alle Lesetipps durchsuchen') ?> ..."
                >
                <button class="mx-2 outline-none focus:outline-none active:outline-none" type="submit" value="Search">
                    <?= $site->useSVG('Suche', 'w-8 h-8 text-orange-medium fill-current', 'search') ?>
                </button>
            </form>
        </div>
        <div class="ml-6 block flex-none text-right">
            <a class="inline-block h-full flex items-center px-4 rounded-lg text-white text-shadow bg-red-light hover:bg-red-medium transition-all" href="<?= $page->url() ?>" title="<?= t('Alles zurücksetzen') ?>">
                <span class="sketch text-xl sm:text-3xl select-none"><?= t('Zurücksetzen') ?></span>
            </a>
        </div>
    </div>

</section>
