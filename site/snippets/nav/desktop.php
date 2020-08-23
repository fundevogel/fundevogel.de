<ul class="flex justify-between" role="menu" itemscope itemtype="https://schema.org/SiteNavigationElement">
    <?php foreach($pages->listed()->onlyTranslated() as $item) : ?>
    <li class="px-2 relative" role="menuitem">
        <a
            class="js-tippy flex items-center text-sm text-white outline-none<?php e($item->isOpen(), ' is-active') ?>"
            href="<?= $item->url() ?>"
            title="<?php e($item->isHomePage(), t('Menü-Startseite'), $item->title()->html()) ?>"
            itemprop="url"
        >
            <span itemprop="name"><?= t('Menü-' . $item->id()) ?></span>
        </a>
    </li>
    <?php endforeach ?>

    <li class="pl-4 border-l-2 border-red-light relative" role="menuitem">
        <a
            class="js-tippy flex items-center text-sm text-white outline-none"
            href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>"
            title="<?= t('Menü-shop') ?>"
            target="_blank"
            rel="noopener"
            itemprop="url"
        >
            <?= useSVG(t('Menü-shop'), 'w-6 h-6 fill-current', 'cart') ?>
            <span class="px-2" itemprop="name">Shop</span>
        </a>
    </li>
</ul>
