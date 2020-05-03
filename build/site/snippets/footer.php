                </main>

                <footer class="py-8 flex-none relative bg-red-medium" role="contentinfo">
                    <div class="zigzag-border w-full absolute z-10"></div>
                    <div class="text-center text-white">
                        <div class="container">
                            <h4 class="mb-4 sm:text-xl md:text-2xl lg:text-3xl">- <?= $site->title()->html() ?> -</h4>
                            <p class="mb-8 text-sm md:text-lg leading-relaxed">
                                - Marienstr. 13 - 79098 Freiburg -<br>
                                - <?= t('footer_telefon') ?>.: 0761/25218 - <?= t('footer_telefax') ?>: 0761/30041 -
                            </p>
                        </div>
                    </div>
                    <div class="container">
                        <div class="text-sm text-center md:flex justify-between spread-out">
                            <div class="flex flex-col md:flex-row mb-4">
                                <a class="flex justify-center items-center mb-2 sm:mr-3 outline-none" href="mailto:<?= $site->mail()->html() ?>" title="<?= t('footer_email') ?>">
                                    <?= $site->useSVG('E-Mail', 'w-6 h-6 fill-current') ?>
                                    <span class="px-2">Kontakt per Mail</span>
                                </a>
                                <a class="flex justify-center items-center mb-2 sm:mr-3 outline-none" href="https://github.com/Fundevogel" title="Fundevogel & Open Source">
                                    <?= $site->useSVG('GitHub', 'w-6 h-6 fill-current') ?>
                                    <span class="px-2">GitHub</span>
                                </a>
                            </div>
                            <nav class="flex justify-center mb-4" role="navigation">
                                <a class="outline-none" href="<?= url('unsere-agb') ?>" title="<?= t('footer_agb--title') ?>">
                                    <span><?= t('footer_agb') ?></span>
                                </a>
                                <span class="mx-2">|</span>
                                <a class="outline-none" href="<?= url('widerruf') ?>" title="<?= t('footer_widerruf--title') ?>">
                                    <span><?= t('footer_widerruf') ?></span>
                                </a>
                                <span class="mx-2">|</span>
                                <a class="outline-none" href="<?= url('datenschutz') ?>" title="<?= t('footer_datenschutz--title') ?>">
                                    <span><?= t('footer_datenschutz') ?></span>
                                </a>
                                <span class="mx-2">|</span>
                                <a class="outline-none" href="<?= url('impressum') ?>" title="<?= t('footer_impressum--title') ?>">
                                    <span><?= t('footer_impressum') ?></span>
                                </a>
                            </nav>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
