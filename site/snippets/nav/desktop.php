<nav class="spread-out flex-1 text-white text-shadow hidden lg:block">
    <ul class="flex items-center justify-between text-sm" role="menu" itemscope itemtype="https://schema.org/SiteNavigationElement">
        <?php
            $menuPages = [
                // 'assortment' => 'book-closed-filled',
                // 'lesetipps' => 'book-open-filled',
                // 'calendar' => 'calendar-filled',
            ];

            foreach($pages->listed()->onlyTranslated() as $item) :
            $identifier = (string) $item->intendedTemplate();
            $hasSubmenu = in_array($identifier, array_keys($menuPages));
        ?>
        <li class="px-2 relative" role="menuitem">
            <a
                class="<?php e($hasSubmenu, 'js-singleton ', 'js-tippy ') ?>flex items-center text-white relative outline-none<?php e($item->isOpen(), ' is-active') ?>"
                href="<?= $item->url() ?>"
                title="<?php e($item->isHomePage(), t('Menü-Startseite'), $item->title()->html()) ?>"
                data-template="js-<?php e($hasSubmenu, $identifier, 'undefined') ?>"
                itemprop="url"
            >
                <span itemprop="name"><?= t('Menü-' . $item->id()) ?></span>
            </a>
            <?php if ($hasSubmenu) : ?>
            <div id="js-<?= $identifier ?>" class="px-6 py-4 border-4 border-red-light border-dashed bg-yellow-light rounded-lg hidden">
                <a class="flex items-center text-red-medium hover:text-red-dark hover:underline" href="<?= $item->url() ?>">
                    <?= useSVG($item->title(), '-mb-1 w-6 h-6 fill-current', $menuPages[$identifier]) ?>
                    <h5 class="ml-2 font-bold font-small-caps text-lg"><?= $item->title()->html() ?></h5>
                </a>
                <?php snippet('nav/submenus/' . $identifier, compact('item', 'identifier')) ?>
            </div>
            <?php endif ?>
        </li>
        <?php endforeach ?>
    </ul>
</nav>
<div class="spread-out lg:ml-6 lg:pl-8 flex-none flex justify-between text-sm lg:border-l-2 border-red-light">
    <a
        class="js-tippy mr-4 hidden lg:flex items-center text-white relative outline-none"
        href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>"
        title="<?= t('Menü-shop') ?>"
        data-template="js-undefined"
        target="_blank"
        rel="noopener"
    >
        <?= useSVG(t('Menü-shop'), 'w-6 h-6 fill-current', 'cart') ?>
        <span class="px-2">Shop</span>
    </a>

    <?php snippet('nav/languages') ?>
</div>
