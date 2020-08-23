<!DOCTYPE html>
<html class="no-js min-h-screen" lang="<?= $kirby->language() ?>">

    <?php snippet('head') ?>

    <body class="min-h-screen font-light text-sm sm:text-base text-black bg-yellow-light" data-barba="wrapper">
        <div class="min-h-screen flex flex-col" data-barba="container" data-barba-namespace="<?= $page->template() ?>">
            <header id="site-header" class="flex-none" role="banner" itemscope itemtype="https://schema.org/WPHeader">
                <div class="w-full h-12 flex justify-between items-center shadow-nav fixed top-0 text-white bg-red-medium z-40">
                    <!-- MOBILE -->
                    <div class="js-overlay flex flex-col justify-center fixed inset-0 bg-red-medium transform -translate-y-full z-50">
                        <nav class="mt-12 sm:mt-16 flex flex-col items-center font-normal text-xs xs:text-lg sm:text-2xl text-center">
                            <?php snippet('nav/mobile') ?>
                        </nav>
                    </div>

                    <!-- TOGGLE -->
                    <button class="js-toggle py-6 pl-4 pr-8 text-white lg:hidden relative z-50" type="button" data-menu="<?= t('Menü') ?>" aria-label="<?= t('Menü') ?>">
                        <span></span>
                    </button>

                    <!-- DESKTOP -->
                    <div class="container">
                        <nav class="spread-out text-white text-shadow hidden lg:block">
                            <?php snippet('nav/desktop') ?>
                        </nav>
                    </div>

                    <!-- LANGUAGES -->
                    <?php if ($page->hasTranslations()) : ?>
                    <nav class="spread-out mr-4 flex lg:hidden z-50">
                        <?php snippet('nav/languages') ?>
                    </nav>
                    <?php endif ?>
                </div>
            </header>

            <main class="flex-1" role="main">
                <header id="page-header" class="mt-12 mb-4">
                    <div class="py-4 md:pb-0 bg-yellow-dark">
                        <div class="container">
                            <div class="flex items-end justify-center md:justify-start">
                                <?php $image = new Asset('assets/images/logo.png'); ?>
                                <img
                                    class="w-32 lg:w-auto -mb-4 md:-mb-8 mr-4 hidden md:inline z-30"
                                    src="<?= $image->url() ?>"
                                    title="Lieber barfuß als ohne Buch" alt="Fundevogel-Logo"
                                    width="<?= $image->width() ?>"
                                    height="<?= $image->height() ?>"
                                >
                                <div class="flex flex-col items-center md:items-start leading-none">
                                    <h1 class="sketch tracking-wide<?php e($page->isHomePage(), ' text-6xl xs:text-page-heading sm:text-site-heading', ' text-center text-5xl sm:text-6xl lg:text-page-heading') ?>">
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
                                    <h3 class="sketch text-black text-2xl sm:text-4xl text-center"><?= t('Kinder- und Jugendbuchhandlung') ?></h3>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= useSeparator('yellow-dark', 'bottom-reversed') ?>
                </header>

                <?php snippet('nav/breadcrumbs') ?>

                <article class="mb-16">
