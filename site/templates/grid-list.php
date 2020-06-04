<?php snippet('header') ?>

<article class="mb-16">
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="pt-6 lg:pt-12 flex-none text-center">
                <?php if ($page == page('unser-netzwerk')) : ?>
                <p class="max-w-md mb-10 font-bold font-small-caps text-center text-red-medium inline-block lg:hidden">
                    <?= $page->motto()->html() ?>
                </p>
                <?php endif ?>
                <?php snippet('cover') ?>
            </div>
        </div>
        <?php if ($page == page('unser-netzwerk')) : ?>
        <div class="mt-12 text-center">
            <p class="max-w-md font-bold font-small-caps text-red-medium hidden lg:inline-block">
                <?= $page->motto()->html() ?>
            </p>
        </div>
        <?php endif ?>
    </header>
    <hr>
    <section class="container">
        <h2 class="mb-12 text-center"><?= t($identifier . '_ueberschrift-liste') ?></h2>
        <div id="macy">
            <?php foreach($cards as $card) : ?>
            <article class="card">
                <div class="card-inner">
                    <?= $card->entry()->kt() ?>
                </div>
            </article>
            <?php endforeach ?>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
