<?php if (!$page->isHomePage()) : ?>
<nav class="mb-6">
    <div class="container">
        <ol class="flex items-center font-bold text-orange-medium text-xs" role="navigation" aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a class="hover:text-orange-dark hover:fill-orange-dark" href="<?= $site->homePage()->url() ?>" itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="<?= $site->homePage()->url() ?>">
                    <?= useSVG(t('Start'), 'w-5 h-5 fill-current', 'home') ?>
                    <span class="sr-only" itemprop="name"><?= t('Start') ?></span>
                </a>
                <meta itemprop="position" content="1">
            </li>
            <span class="mx-2 select-none">»</span>
            <?php
                $count = 2;
                foreach($site->breadcrumb()->slice(1) as $crumb) :
            ?>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <?php if ($crumb->isActive()) : ?>
                <span class="js-tippy cursor-help" title="<?= t('Du bist hier') ?>" itemprop="name" aria-current="page" data-tippy-theme="fundevogel red" data-tippy-placement="right"><?= $crumb->title()->html() ?></span>
                <meta itemprop="position" content="<?= $count ?>">
                <?php else : ?>
                <a class="hover:text-orange-dark" href="<?= $crumb->url() ?>" itemscope itemtype="https://schema.org/WebPage" itemprop="item" itemid="<?= $crumb->url() ?>">
                    <span itemprop="name"><?= $crumb->title()->html() ?></span>
                </a>
                <meta itemprop="position" content="<?= $count ?>">
                <?php endif ?>
            </li>
            <?php if (!$crumb->isActive()) : ?>
            <span class="mx-2 select-none">»</span>
            <?php endif ?>
            <?php
                $count++;
                endforeach;
            ?>
        </ol>
    </div>
</nav>
<?php endif ?>
