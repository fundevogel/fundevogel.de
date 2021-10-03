<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <?php if ($page->hasCover()) : ?>
        <div class="mt-12 flex-none flex justify-center">
            <div>
                <a
                    class="lg:ml-12 group table relative"
                    href="<?= Str::replace(page('kalender/veranstaltungen')->url(), ['https', 'http'], ['webcal', 'webcal']) . '.ics' ?>"
                    data-barba-prevent="self"
                >
                    <figure class="inline-block rounded-lg">
                        <?= $page->getCover()->createImage('rounded-t-lg', 'cover', false, true) ?>
                        <figcaption class="small-caption"><?= $page->getCover()->caption()->html() ?></figcaption>
                    </figure>
                    <?php snippet('components/shared/gradient-overlay', [
                        'caption' => t('Aktuelle Veranstaltungen'),
                        'icon' => 'calendar-filled',
                        'details' => t('als iCal-Datei abonnieren')
                    ]) ?>
                </a>
            </div>
        </div>
        <?php endif ?>
    </div>
</header>
<hr>
<section class="container">
    <h2 id="<?= Str::lower(t('Veranstaltungen')) ?>" class="mb-12 text-center"><?= t('Alle Veranstaltungen im Überblick') ?></h2>
    <?php if ($openEvents->isNotEmpty()) : ?>
    <?php foreach($openEvents as $timeRange => $events) : ?>
    <h2 class="mb-8 text-center"><?= $timeRange ?></h2>
    <?php foreach($events as $event) : ?>
    <article class="">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <h3><?= $event->title()->html() ?></h3>
                <?= $event->text()->kt() ?>
            </div>
            <aside class="lg:ml-10 pt-4 lg:pt-10 w-full lg:max-w-xs">
                <?php snippet('calendar/quickview', compact('event')) ?>
            </aside>
        </div>
        <?php if ($event->details()->isNotEmpty()) : ?>
        <div class="mt-12">
            <?= $event->details()->kt() ?>
        </div>
        <?php endif ?>
        <?php if ($event->registrationRequired()->bool()) : ?>
        <aside class="mt-12 px-8 py-6 card is-dashed">
            <?php snippet('calendar/registration', compact('event')) ?>
        </aside>
        <?php endif ?>

    </article>
    <?php e($event !== $events->last(), '<hr class="max-w-xs">') ?>
    <?php endforeach ?>
    <?php e($event === $events->last() && $timeRange === t('In der Ferne'), '<hr class="max-w-sm">') ?>
    <?php endforeach ?>
    <?php else : ?>
    <p class="italic text-center"><?= t('Keine Veranstaltungen') ?></p>
    <?php endif ?>
</section>
<?php if ($annualEvents->isNotEmpty()) : ?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="pt-12 pb-6 lg:pb-4 bg-orange-light">
        <div class="container lg:px-8 xl:px-12">
            <div class="text-center">
                <?= useSVG(t('Jährliche Höhepunkte'), 'title-icon', 'calendar-filled') ?>
            </div>
            <h2 class="title text-orange-medium"><?= t('Jährliche Höhepunkte') ?></h2>
            <div class="flex flex-col lg:flex-row">
                <?php foreach ($annualEvents as $event) : ?>
                <div class="<?php e($event->num() == 2, 'lg:mx-12 xl:mx-16 ') ?>mb-8">
                    <div class="mb-8 flex justify-center">
                        <a class="rounded-full group overflow-hidden" href="<?= $event->url() ?>">
                            <?= $event->getPreview() ?>
                        </a>
                    </div>
                    <div class="text-center">
                        <h3>
                            <a class="text-orange-medium hover:text-orange-dark" href="<?= $event->url() ?>">
                                <?= $event->title()->html() ?>
                            </a>
                        </h3>
                        <?= $event->previewDescription()->kt() ?>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= useSeparator('orange-light', 'bottom') ?>
</aside>
<?php endif ?>
<?php if ($closedEvents->isNotEmpty()) : ?>
<section class="container">
    <h2 class="mb-12 text-center"><?= t('Geschlossene Veranstaltungen') ?></h2>
    <div class="js-masonry">
        <?php foreach ($kirby->collection('events/closed') as $event) : ?>
        <div class="card">
            <h4><?= $event->title() ?></h4>
            <?php snippet('calendar/quickview', compact('event')) ?>
        </div>
        <?php endforeach ?>
    </div>
</section class="container">
<?php endif ?>

<?php snippet('footer') ?>
