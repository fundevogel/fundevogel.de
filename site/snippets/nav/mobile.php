<div class="js-overlay fixed inset-0 bg-red-medium transform -translate-y-full z-50">
    <nav class="pt-12 h-full flex flex-col justify-center items-center font-normal text-xs xs:text-lg sm:text-2xl text-center">
        <?php foreach($pages->listed()->onlyTranslated() as $item) : ?>
        <a
            class="js-link w-full py-2<?php e($item->isOpen(), ' text-red-medium bg-white opacity-0', ' text-white hover:text-red-medium hover:bg-white opacity-0') ?>"
            href="<?= $item->url() ?>"
            title="<?php e($item->isHomePage(), t('menu-home'), $item->title()->html()) ?>"
        >
            <span><?= t('menu-' . $item->id()) ?></span>
        </a>
        <?php endforeach ?>

        <a
            class="js-link w-full py-2 text-white hover:text-red-medium hover:bg-white opacity-0"
            href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>"
            title="<?= t('menu-shop') ?>"
            target="_blank" rel="noopener"
        >
            Shop
        </a>
    </nav>
</div>
