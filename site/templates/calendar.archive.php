<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php snippet('cover') ?>
            </div>
        </div>
    </header>
    <hr id="aktuelle-veranstaltungen">
    <section class="container">
        <h2 class="mb-12 text-center"><?= t('Alle vergangenen Veranstaltungen') ?></h2>
        <?php
            foreach($groupedEvents as $year => $events) : ?>
                <h3 class="mb-4 text-center"><?= $year ?></h2>
                <ul class="flex flex-col items-center">
                    <?php foreach($events as $event) : ?>
                    <li>
                        <?= $event->title() ?>
                        <time class="text-orange-medium" datetime="<?= $event->date()->toDate('Y-m-d') ?>"><?= $event->date()->toDate('d.m.Y') ?></time>
                    </li>
                    <?php endforeach ?>
                </ul>
                <?php e($events !== $last, '<hr class="max-w-sm">') ?>
        <?php
            endforeach
        ?>
    </section>
</article>

<?php snippet('footer') ?>
