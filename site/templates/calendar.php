<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none text-center">
            <?php snippet('cover') ?>
        </div>
    </div>
</header>
<hr>
<section class="container">
    <h2 class="mb-12 text-center"><?= t('Alle Veranstaltungen im Überblick') ?></h2>
    <?php if ($openEvents->isNotEmpty()) : ?>
    <?php foreach($openEvents as $timeRange => $events) : ?>
    <h2 class="mb-8 text-center"><?= $timeRange ?></h2>
    <?php foreach($events as $event) : ?>
    <article class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <h3><?= $event->title()->html() ?></h3>
                <?= $event->text()->kt() ?>
            </div>
            <aside class="lg:ml-10 pt-4 lg:pt-10 lg:max-w-sm">
                <div class="card">
                    <h4><?= t('Termin im Überblick') ?></h4>
                    <?php snippet('calendar/quick-view', compact('event')) ?>
                </div>
            </aside>
        </div>
    </article>
    <?php e($event !== $events->last(), '<hr class="max-w-xs">') ?>
    <?php endforeach ?>
    <?php e($events !== $groups->last(), '<hr class="max-w-sm">') ?>
    <?php endforeach ?>
    <?php else : ?>
    <p class="italic text-center"><?= t('Keine Veranstaltungen') ?></p>
    <?php endif ?>
</section>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="pt-12 pb-6 lg:pb-4 bg-orange-light">
        <div class="container lg:px-8 xl:px-12">
            <div class="text-center">
                <?= useSVG(t('Jährliche Höhepunkte'), 'title-icon', 'calendar-filled') ?>
            </div>
            <h2 class="title"><?= t('Jährliche Höhepunkte') ?></h2>
            <div class="flex flex-col lg:flex-row">
                <?php
                    $count = 1;
                    foreach ($annualEvents as $annualEvent) :
                ?>
                <div class="<?php e($count === 2, 'lg:mx-12 xl:mx-16 ') ?>mb-8">
                    <div class="mb-8 flex justify-center">
                        <a class="rounded-full group overflow-hidden" href="<?= $annualEvent->url() ?>">
                            <?= $annualEvent->getPreview() ?>
                        </a>
                    </div>
                    <h3 class="text-orange-medium"><?= $annualEvent->title()->html() ?></h3>
                    <?= $annualEvent->short()->kt() ?>
                    <?= $annualEvent->moreLink('mt-4 block font-bold font-small-caps text-sm text-orange-medium hover:text-orange-dark outline-none') ?>
                </div>
                <?php
                    $count++;
                    endforeach
                ?>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom') ?>
</aside>
<?php if ($closedEvents->isNotEmpty()) : ?>
<section class="container">
    <h2 class="mb-12 text-center"><?= t('Geschlossene Veranstaltungen') ?></h2>
    <div class="js-masonry">
        <?php foreach ($closedEvents as $event) : ?>
        <div class="card">
            <h4><?= $event->title() ?></h4>
            <?php snippet('calendar/quick-view', compact('event')) ?>
        </div>
        <?php endforeach ?>
    </div>
</section class="container">
<?php endif ?>

<?php snippet('footer') ?>
