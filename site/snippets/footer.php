                </article>
            </main>

            <footer id="site-footer" class="py-8 flex-none relative text-white text-center text-shadow bg-red-medium" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
                <div class="zigzag-border w-full absolute z-10"></div>
                <div class="container">
                    <h4 class="mb-4 text-lg sm:text-xl md:text-2xl lg:text-3xl">- <?= $site->title()->html() ?> -</h4>
                    <div class="mb-8 text-sm md:text-lg leading-relaxed">
                        <p>Marienstraße 13, 79098 Freiburg</p>
                        <div class="flex justify-center mb-4">
                            <div class="flex spread-out">
                                <span class="pr-1"><?= t('Telefon') ?>: </span>
                                <a class="js-tippy outline-none" href="tel:<?= $site->phone()->toPhone() ?>" title="<?= t('Ruft an!') ?>">
                                    <span><?= $site->phone() ?></span>
                                </a>
                            </div>
                            <span class="px-2">&middot;</span>
                            <span><?= t('Fax') ?>: <?= $site->fax() ?></span>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="spread-out">
                        <div class="text-sm flex flex-col lg:flex-row justify-center mb-4">
                            <a class="js-tippy flex justify-center items-center mb-2 sm:mr-3 outline-none" href="mailto:<?= $site->mail()->html() ?>" title="<?= t('Schreibt uns!') ?>">
                                <?= useSVG('E-Mail', 'w-6 h-6 fill-current', 'envelope') ?>
                                <span class="px-2"><?= t('Mail schreiben') ?></span>
                            </a>
                            <a class="js-tippy flex justify-center items-center mb-2 sm:mr-3 outline-none" href="<?php e($kirby->language()->code() === 'de', page('technisches')->url(), 'https://github.com/Fundevogel') ?>" title="Fundevogel & Open Source" target="<?php e($kirby->language()->code() !== 'de', '_blank') ?>">
                                <?= useSVG('GitHub', 'w-6 h-6 fill-current') ?>
                                <span class="px-2"><?= t('Unser Quellcode') ?></span>
                            </a>
                            <a class="js-tippy flex justify-center items-center mb-2 sm:mr-3 outline-none" href="<?= page('feeds')->url() ?>" title="<?= t('Lesetipps abonnieren') ?>">
                                <?= useSVG('Feed', 'w-6 h-6 fill-current') ?>
                                <span class="px-2"><?= t('Abonnieren') ?></span>
                            </a>
                            <?php if ($site->mastodon()->isNotEmpty()) : ?>
                            <a class="js-tippy flex justify-center items-center mb-2 sm:mr-3 outline-none" href="<?= $site->mastodon() ?>" title="<?= t('Mastodon') ?>" target="_blank" rel="me">
                                <?= useSVG('Mastodon', 'w-6 h-6 fill-current') ?>
                                <span class="px-2"><?= t('Gemeinsam dezentral') ?></span>
                            </a>
                            <?php endif ?>
                        </div>
                        <nav class="text-xs flex flex-wrap justify-center mb-4" role="navigation">
                            <?php if ($pgpKey = $site->file('0xCED8B32D46ADF2A5.asc')) : ?>
                            <a
                                class="js-tippy outline-none"
                                href="<?= $pgpKey->url() ?>"
                                title="<?= $pgpKey->content()->mail() ?>"
                                data-barba-prevent="self"
                            >
                                <span><?= $pgpKey->title()->html() ?></span>
                            </a>
                            <span class="mx-2 select-none">|</span>
                            <?php endif ?>
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
