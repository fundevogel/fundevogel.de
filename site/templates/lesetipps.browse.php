<?php snippet('header') ?>

<article class="mb-16">
    <?php if ($pagination->page() === 1) : ?>
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
    <hr>
    <?php endif ?>
    <section class="container">
        <?= $page->details()->kt() ?>
        <form class="w-full pl-4 pr-2 py-2 bg-orange-light border-4 border-dashed border-orange-medium rounded-lg flex justify-between items-center relative">
            <input
                class="w-full h-10 font-base text-orange-medium placeholder-orange-medium placeholder-opacity-75 bg-orange-light appearance-none outline-none focus:outline-none active:outline-none"
                type="search"
                name="q"
                value="<?= html($query) ?>"
                placeholder="<?= t('Alle Lesetipps durchsuchen') ?> ..."
            >
            <button class="mx-2 outline-none focus:outline-none active:outline-none" type="submit" value="Search">
                <?= $site->useSVG('Suche', 'w-8 h-8 text-orange-medium fill-current', 'search') ?>
            </button>
        </form>
    </section>
    <?php if ($results->count() > 0) : ?>
    <hr>
    <section class="container">
        <h2 class="mb-12 text-center"><?= t('Alle Ergebnisse') ?></h2>
        <?php snippet('lesetipps/articles', ['lesetipps' => $results]) ?>
    </section>
    <?php endif ?>
</article>

<?php if ($results->count() > 0) : ?>
<?php snippet('navigation/pagination') ?>
<?php endif ?>

<?php snippet('footer') ?>
