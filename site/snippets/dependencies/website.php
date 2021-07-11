<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <div class="container">
            <div class="text-center">
                <?= useSVG(t('Über unsere Webseite'), 'title-icon', 'badge-filled') ?>
            </div>
            <h2 class="title"><?= t('Über unsere Webseite') ?></h2>
            <div class="flex flex-col lg:flex-row">
                <div class="mb-12 lg:mb-0 flex-none flex flex-col sm:flex-row lg:flex-col justify-center sm:justify-around lg:justify-center items-center order-last lg:order-first">
                    <?= svg($page->chart()->toFile()) ?>
                    <div class="mt-8 sm:mt-0 lg:mt-8 flex flex-col items-center">
                        <h3 class="text-orange-medium"><?= t('Programmiersprachen') ?></h3>
                        <ul class="table">
                            <?php foreach ($languages as $language) : ?>
                            <li>
                                <span class="js-label mr-2 w-4 h-4 inline-block rounded-full" data-color="<?= $language->color() ?>"></span>
                                <?= $language->share()->toFloat() * 100 ?> % <?= $language->title() ?>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="mb-16 lg:mb-0 md:ml-16 lg:ml-20 flex-1 flex flex-col justify-center">
                    <div class="lg:text-lg">
                        <?= $page->source()->kt() ?>
                    </div>
                    <div class="flex flex-col xl:flex-row xl:justify-between my-12 text-sm">
                        <div class="flex flex-col xs:flex-row xl:flex-col">
                            <div class="mb-4 flex-1 flex justify-content">
                                <div class="flex items-center">
                                    <?= useSVG('Content Management System', 'js-tippy lesetipp-icon', 'layout') ?>
                                    <span class="ml-4">
                                        Kirby CMS
                                    </span>
                                </div>
                            </div>
                            <?php if ($source['license']['short'] !== '') : ?>
                            <div class="mb-4 flex-1 flex items-center">
                                <?= useSVG(t('Lizenz'), 'js-tippy lesetipp-icon', 'shield') ?>
                                <span class="ml-4">
                                    <?= kirbytag(['short' => $source['license']['short'], 'desc' => $source['license']['long'], 'color' => 'orange']) ?>
                                </span>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="flex flex-col xs:flex-row xl:flex-col">
                            <div class="mb-4 flex-1 flex items-center">
                                <?= useSVG('Code Hosting', 'js-tippy lesetipp-icon', 'git') ?>
                                <span class="ml-4">
                                    GitHub
                                </span>
                            </div>
                            <div class="mb-4 flex-1 flex items-center">
                                <?= useSVG('Server Hosting', 'js-tippy lesetipp-icon', 'hdd') ?>
                                <span class="ml-4">
                                    Hetzner
                                </span>
                            </div>
                        </div>
                        <div class="flex flex-col xs:flex-row xl:flex-col">
                            <div class="mb-4 flex-1 flex items-center">
                                <?= useSVG('CSS Framework', 'js-tippy lesetipp-icon', 'tailwindcss') ?>
                                <span class="ml-4">
                                    TailwindCSS
                                </span>
                            </div>
                            <div class="mb-4 flex-1 flex items-center">
                                <?= useSVG('JS Framework', 'js-tippy lesetipp-icon', 'barbajs') ?>
                                <span class="ml-4">
                                    barbaJS
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col xl:flex-row justify-between xl:items-center">
                        <div class="flex">
                            <?php if ($source['loc'] !== '') : ?>
                            <div class="flex-1 xl:flex-none xl:mr-8 xl:text-center leading-tight">
                                <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= number_format($source['loc'], 0, ',', '.') ?></span>
                                <span class="block text-sm sm:text-lg"><?= t('Zeilen Code') ?></span>
                            </div>
                            <?php endif ?>
                            <?php if ($source['activity'] !== '') : ?>
                            <div class="flex-1 xl:flex-none xl:mr-8 xl:text-center leading-tight">
                                <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= $source['activity'] ?> commits</span>
                                <span class="block text-sm sm:text-lg"><?= t('pro Monat') ?></span>
                            </div>
                            <?php endif ?>
                            <?php if ($source['pagespeed'] !== '') : ?>
                            <div class="flex-1 xl:flex-none xl:mr-8 xl:text-center leading-tight">
                                <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= $source['pagespeed'] ?>/100</span>
                                <span class="block text-sm sm:text-lg">PageSpeed Score</span>
                            </div>
                            <?php endif ?>
                        </div>
                        <div class="flex mt-6 xl:mt-0">
                            <?php if ($source['observatory']['grade'] !== '') : ?>
                            <div class="flex-1 xl:flex-none xl:mr-8 xl:text-center leading-tight">
                                <span class="block text-lg sm:text-2xl text-orange-dark font-bold"><?= t('Note') . ' ' .  $source['observatory']['grade'] ?></span>
                                <span class="block text-sm sm:text-lg">Mozilla Observatory</span>
                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
