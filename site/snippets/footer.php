            </main>

            <footer class="py-8 flex-none relative text-white text-center text-shadow bg-red-medium" role="contentinfo">
                <div class="zigzag-border w-full absolute z-10"></div>
                <div class="container">
                    <h4 class="mb-4 sm:text-xl md:text-2xl lg:text-3xl">- <?= $site->title()->html() ?> -</h4>
                    <p class="mb-8 text-sm md:text-lg leading-relaxed">
                        - Marienstr. 13 - 79098 Freiburg -<br>
                        - <?= t('Telefon') ?>.: 0761/25218 - <?= t('Fax') ?>: 0761/30041 -
                    </p>
                </div>
                <div class="container">
                    <div class="text-sm md:flex justify-between spread-out">
                        <div class="flex flex-col md:flex-row mb-4">
                            <a class="js-tippy flex justify-center items-center mb-2 sm:mr-3 outline-none" href="mailto:<?= $site->mail()->html() ?>" title="<?= t('Schreiben Sie uns!') ?>">
                                <?= useSVG('E-Mail', 'w-6 h-6 fill-current', 'envelope') ?>
                                <span class="px-2"><?= t('Kontakt per Mail') ?></span>
                            </a>
                            <a class="js-tippy flex justify-center items-center mb-2 sm:mr-3 outline-none" href="https://github.com/Fundevogel" title="Fundevogel & Open Source">
                                <?= useSVG('GitHub', 'w-6 h-6 fill-current') ?>
                                <span class="px-2">GitHub</span>
                            </a>
                        </div>
                        <nav class="flex flex-wrap justify-center mb-4" role="navigation">
                            <a class="js-tippy outline-none" href="<?= url('unsere-agb') ?>" title="<?= t('Allgemeine Geschäftsbedingungen') ?>">
                                <span><?= t('AGB') ?></span>
                            </a>
                            <span class="mx-2 select-none">|</span>
                            <a class="js-tippy outline-none" href="<?= url('widerruf') ?>" title="<?= t('Unsere Widerrufsbelehrung') ?>">
                                <span><?= t('Widerruf') ?></span>
                            </a>
                            <span class="mx-2 select-none">|</span>
                            <a class="js-tippy outline-none" href="<?= url('datenschutz') ?>" title="<?= t('Unsere Datenschutzrichtlinien') ?>">
                                <span><?= t('Datenschutz') ?></span>
                            </a>
                            <span class="mx-2 select-none">|</span>
                            <a class="js-tippy outline-none" href="<?= url('impressum') ?>" title="<?= t('Unser Impressum') ?>">
                                <span><?= t('Impressum') ?></span>
                            </a>
                        </nav>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
