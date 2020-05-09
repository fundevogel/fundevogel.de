<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kirbytext() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php snippet('cover') ?>
            </div>
        </div>
    </header>
    <hr>
    <section class="container">
        <h2 class="mb-12 text-center"><?= $subtitle ?></h2>
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
                        <h4><?= t('kalender_termin-ueberschrift') ?></h4>
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
        <p class="italic text-center"><?= t('kalender_keine-veranstaltungen') ?></p>
        <?php endif ?>
    </section>
    <aside class="my-20 overflow-hidden">
        <?= $site->useSeparator('orange-light', 'top-reversed') ?>
        <div class="pt-12 pb-8 lg:pb-4 bg-orange-light">
            <div class="container xl:px-0">
                <div class="text-center">
                    <?= $site->useSVG(t('kalender_fixpunkte'), 'inline-block mb-4 w-12 h-12 fill-current text-orange-medium', 'calendar') ?>
                </div>
                <h2 class="mb-12 text-5xl text-center text-orange-medium"><?= t('kalender_fixpunkte') ?></h2>
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-1/3 lg:mr-12 mb-6">
                        <h3 class="text-orange-medium">HerbstLESE</h3>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Veniam quidem quia minima dolore soluta deserunt mollitia,
                            nam nemo asperiores assumenda, sapiente sint libero,
                            expedita amet nulla.
                        </p>
                    </div>
                    <div class="lg:w-1/3 lg:mr-12 mb-6">
                        <h3 class="text-orange-medium">Welttag des Buches</h3>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Veniam quidem quia minima dolore soluta deserunt mollitia,
                            nam nemo asperiores assumenda, sapiente sint libero,
                            expedita amet nulla.
                        </p>
                    </div>
                    <div class="lg:w-1/3 lg:mr-12 mb-6">
                        <h3 class="text-orange-medium">Lirum Larum Lesefest</h3>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                            Veniam quidem quia minima dolore soluta deserunt mollitia,
                            nam nemo asperiores assumenda, sapiente sint libero,
                            expedita amet nulla.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?= $site->useSeparator('orange-light', 'bottom') ?>
    </aside>
    <?php if ($closedEvents) : ?>
    <hr>
    <section class="container">
        <h2 class="mb-12 text-center"><?= t('kalender_geschlossene-veranstaltungen') ?></h2>
        <div id="macy">
            <?php foreach ($closedEvents as $event) : ?>
            <div class="card">
                <h4><?= $event->title() ?></h4>
                <?php snippet('calendar/quick-view', compact('event')) ?>
            </div>
            <?php endforeach ?>
        </div>
    </section class="container">
    <?php endif ?>
</article>

<?php snippet('footer') ?>
