<?php snippet('header') ?>

<article class="mb-16">
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
        <h2 class="mb-12 text-center"><?= t('Wir stellen uns vor') ?></h2>
        <div class="js-masonry">
            <?php foreach ($team as $member) : ?>
            <div class="card">
                <div class="flex flex-col items-center">
                    <?php if ($member->back()->isNotEmpty()) : ?>
                    <figure class="<?php e($member->front()->isNotEmpty(), 'group mb-6 cursor-help', 'mb-6 cursor-not-allowed') ?>">
                        <?php if ($member->front()->isNotEmpty()) : ?>
                        <?= $member->back()->toFile()->createImage('block group-hover:hidden rounded-full animation-fade-in', 'about.team') ?>
                        <?= $member->front()->toFile()->createImage('hidden group-hover:block rounded-full animation-fade-in', 'about.team') ?>
                    <?php else : ?>
                    <?= $member->back()->toFile()->createImage('rounded-full', 'about.team') ?>
                    <?php endif ?>
                    </figure>
                    <?php endif ?>
                    <div class="mb-2 relative">
                        <h3 class="inline m-0"><?= $member->name() ?></h3>
                        <?php if ($member->isActive()->bool()) : ?>
                        <span class="badge ml-2 absolute -top-4">
                            <?= t('aktiv') ?>
                        </span>
                        <?php endif ?>
                    </div>
                    <div class="text-center">
                        <?= $member->desc()->kt() ?>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
