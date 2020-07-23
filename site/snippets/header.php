<!DOCTYPE html>
<html class="no-js min-h-screen" lang="<?= $kirby->language() ?>">

    <?php snippet('head') ?>

    <body class="min-h-screen font-light text-base text-black bg-yellow-light" data-barba="wrapper">
        <div class="min-h-screen flex flex-col" data-barba="container" data-barba-namespace="<?= $page->template() ?>">
            <header class="mb-4 flex-none" role="banner">
                <div class="w-full h-12 flex justify-between items-center shadow-nav fixed top-0 text-white bg-red-medium z-40">
                    <div class="js-overlay flex flex-col justify-center fixed inset-0 bg-red-medium transform -translate-y-full z-50">
                        <nav class="mt-12 sm:mt-16 flex flex-col items-center font-normal text-lg sm:text-2xl text-center">
                            <?php foreach($pages->listed()->onlyTranslated() as $item) : ?>
                                <a class="js-link w-full py-2<?php e($item->isOpen(), ' text-red-medium bg-white', ' text-white hover:text-red-medium hover:bg-white opacity-0') ?>" href="<?= $item->url() ?>" title="<?php e($item->isHomePage(), t('Menü-Startseite'), $item->title()->html()) ?>">
                                    <span><?= t('Menü-' . $item->id()) ?></span>
                                </a>
                            <?php endforeach ?>
                            <a class="js-link w-full py-2 text-white hover:text-red-medium hover:bg-white opacity-0" href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>" title="<?= t('Menü-shop') ?>" target="_blank" rel="noopener">Shop</a>
                        </nav>
                    </div>
                    <button class="js-toggle py-6 pl-4 pr-8 text-white lg:hidden relative z-50" type="button" data-menu="<?= t('Menü') ?>" aria-label="<?= t('Menü') ?>">
                        <span></span>
                    </button>
                    <nav class="spread-out text-shadow hidden lg:flex">
                        <?php foreach($pages->listed()->onlyTranslated() as $item) : ?>
                            <div class="px-2 relative">
                                <a class="js-tippy text-sm text-white outline-none<?php e($item->isOpen(), ' is-active') ?>" href="<?= $item->url() ?>" title="<?php e($item->isHomePage(), t('Menü-Startseite'), $item->title()->html()) ?>">
                                    <span><?= t('Menü-' . $item->id()) ?></span>
                                </a>
                            </div>
                        <?php endforeach ?>
                        <div class="px-2 relative">
                            <a class="js-tippy text-sm text-white outline-none" href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>" title="<?= t('Menü-shop') ?>" target="_blank" rel="noopener">
                                <span>Shop</span>
                            </a>
                        </div>
                    </nav>
                    <?php if ($page->hasTranslations()) : ?>
                    <nav class="mr-4 flex spread-out z-50">
                        <?php
                            foreach ($kirby->languages() as $language) :

                            if ($page->isTranslated($language->code())) :
                            $langTitle = implode(' ', [Str::upper($kirby->language()), 'nach', Str::upper($language->code())]);
                        ?>
                        <a class="js-tippy <?php e($kirby->language() == $language, ' hidden is-active ', 'flex items-center ') ?>last:ml-2 px-2 text-sm text-white outline-none <?= $language->code() ?>" href="<?= $page->url($language->code()) ?>" title="<?= t($langTitle) ?>">
                            <?= useSVG($language->name(), 'w-6 h-6 rounded-full', $language->code()) ?>
                            <span class="ml-2 hidden sm:inline">
                                <?= $language->name() ?>
                            </span>
                        </a>
                        <?php
                            endif;
                            endforeach;
                        ?>
                    </nav>
                    <?php endif ?>
                </div>
                <div class="mt-12 pt-4 bg-yellow-dark">
                    <div class="container">
                        <div class="flex items-end justify-center sm:justify-start">
                            <?php $image = new Asset('assets/images/logo.png'); ?>
                            <img
                                class="w-24 md:w-32 lg:w-auto -mb-4 md:-mb-8 mr-4 hidden sm:inline z-30"
                                src="<?= $image->url() ?>"
                                title="Lieber barfuß als ohne Buch" alt="Fundevogel-Logo"
                                width="<?= $image->width() ?>"
                                height="<?= $image->height() ?>"
                            >
                            <div class="flex flex-col items-center md:items-start leading-none">
                                <h1 class="sketch tracking-wide <?php e($page->isHomePage(), ' text-7xl sm:text-site-heading', ' text-6xl sm:text-7xl lg:text-page-heading') ?>">
                                    <?php
                                        if ($page->intendedTemplate() == 'lesetipps.article') {
                                            echo page('lesetipps')->title()->html();
                                        } elseif ($page->slug() == 'vergangene-veranstaltungen') {
                                            echo 'Kalenderarchiv';
                                        } elseif ($page->isHomePage()) {
                                            echo 'Fundevogel';
                                        } else {
                                            echo $page->title()->html();
                                        }
                                    ?>
                                </h1>
                                <?php if ($page->isHomePage()) : ?>
                                <h3 class="text-black text-2xl sm:text-4xl sketch"><?= t('Kinder- und Jugendbuchhandlung') ?></h3>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= useSeparator('yellow-dark', 'bottom-reversed') ?>
            </header>

            <main class="flex-1" role="main">
