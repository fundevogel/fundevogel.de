<!DOCTYPE html>
<html class="no-js" lang="<?= $kirby->language() ?>">

    <?php snippet('head') ?>

    <body class="font-light text-base text-black bg-yellow-light">
        <div data-barba="wrapper">
            <div data-barba="container" data-barba-namespace="<?= $page->template() ?>">
                <header class="mb-4 flex-none" role="banner">
                    <div class="w-full h-12 flex justify-between items-center shadow-nav fixed top-0 text-white text-shadow bg-red-medium z-40">
                        <div class="js-overlay flex flex-col justify-center fixed inset-0 bg-red-medium z-50" style="transform: translateY(-100%)">
                            <nav class="mt-12 sm:mt-16 flex flex-col items-center font-normal text-lg sm:text-2xl text-center">
                                <?php foreach($pages->listed() as $item) : ?>
                                    <a class="js-link w-full py-2<?php e($item->isOpen(), ' text-red-medium bg-white', ' text-white hover:text-red-medium hover:bg-white') ?>" href="<?= $item->url() ?>" title="<?php e($item->isHomePage(), t('startseite'), $item->title()->html()) ?>" style="opacity: 0; text-shadow:none">
                                    <?php
                                        $id = 'nav-' . $item->id();
                                        $translation = t($id);
                                    ?>
                                    <?= $translation ?>
                                    </a>
                                <?php endforeach ?>
                                <a class="js-link w-full py-2 text-white hover:text-red-medium hover:bg-white" href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>" title="Shop" target="_blank" style="opacity: 0; text-shadow:none">Shop</a>
                            </nav>
                        </div>
                        <button class="js-toggle py-6 pl-4 pr-8 text-white lg:hidden relative z-50" type="button" data-menu="<?= t('nav-menue') ?>">
                            <span></span>
                        </button>
                        <nav class="spread-out hidden lg:flex">
                            <?php foreach($pages->listed() as $item) : ?>
                                <div class="px-2 relative">
                                    <a class="text-sm text-white outline-none<?php e($item->isOpen(), ' is-active') ?>" href="<?= $item->url() ?>" title="<?php e($item->isHomePage(), t('startseite'), $item->title()->html()) ?>">
                                    <?php
                                        $id = 'nav-' . $item->id();
                                        $translation = t($id);
                                    ?>
                                    <span><?= $translation ?></span>
                                    <?php if ($item->id() === 'unser-sortiment') : ?>
                                    <i class="absolute leading-none py-1 px-2 text-sm text-white not-italic font-small-caps bg-orange-medium rounded-lg z-25 select-none" style="bottom: -1.5rem;right: -0.5rem;">
                                        <?= t('nav-neu') ?>
                                    </i>
                                    <?php endif ?>
                                    </a>
                                </div>
                            <?php endforeach ?>
                            <a class="text-sm text-white px-2 outline-none" href="<?php e($site->shop()->isNotEmpty(), $site->shop(), '#') ?>" title="Shop" target="_blank">
                                <span>Shop</span>
                            </a>
                        </nav>
                        <nav class="mr-4 flex spread-out z-50">
                            <?php foreach($kirby->languages() as $language) : ?>
                            <a class="js-tippy flex items-center last:ml-2 px-2 text-sm text-white outline-none <?= $language->code() ?><?php e($kirby->language() == $language, ' hidden is-active') ?>" href="<?= $page->url($language->code()) ?>" title="<?php $lang_string = 'i18-link--' . $kirby->language() . '-zu-' . $language->code(); echo t($lang_string) ?>">
                                <?= $site->useSVG($language->name(), 'w-6 h-6 rounded-full', $language->code()) ?>
                                <span class="ml-2 hidden sm:inline">
                                    <?= $language->name() ?>
                                </span>
                            </a>
                            <?php endforeach ?>
                        </nav>
                    </div>
                    <div class="mt-12 pt-4 bg-yellow-dark">
                        <div class="container">
                            <div class="flex items-end justify-center sm:justify-start">
                                <img
                                    class="w-24 md:w-32 lg:w-auto -mb-4 md:-mb-8 mr-4 hidden sm:inline z-30"
                                    src="<?= (new Asset('assets/images/logo.png'))->url() ?>"
                                    title="Lieber barfuß als ohne Buch" alt="Fundevogel-Logo"
                                    width="175"
                                    height="135"
                                >
                                <div class="flex flex-col items-center md:items-start leading-none">
                                    <h1 class="sketch tracking-wide <?php e($page->isHomePage(), ' text-7xl sm:text-site-heading', ' text-6xl sm:text-7xl lg:text-page-heading') ?>">
                                        <?php
                                        if ($page->isChildOf('lesetipps')) {
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
                                    <h3 class="text-black text-2xl sm:text-4xl sketch"><?= t('home_untertitel') ?></h3>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= $site->useSeparator('yellow-dark', 'bottom-reversed') ?>
                </header>

                <main class="flex-1" role="main">
