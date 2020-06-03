<?php snippet('header') ?>

<article class="mb-16">
    <?php if ($pagination->page() == 1) : ?>
    <header class="container">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->text()->kt() ?>
            </div>
            <div class="mt-6 lg:mt-12 flex-none text-center">
                <?php foreach ($editions as $edition) : ?>
                <figure class="w-40 sm:w-auto inline-block lg:first:ml-12 last:ml-12 shadow-cover rounded-lg">
                    <a class="" href="<?= $edition->url() ?>" target="_blank">
                        <?= $edition->getCover('rounded-t-lg') ?>
                        <figcaption class="py-1 text-sm text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= $edition->edition() ?></figcaption>
                    </a>
                </figure>
                <?php endforeach ?>
            </div>
        </div>
    </header>
    <hr>
    <?php endif ?>
    <section class="container">
        <?php if (param('thema')) : ?>
            <h2 class="mb-12 flex items-center">
                <span class="mr-10 font-bold font-small-caps">Lesetipps zum Thema:</span>
                <a class="group py-1 px-2 inline-flex items-center text-white bg-red-light hover:bg-red-medium rounded-lg outline-none transition-all" href="<?= page('lesetipps/themen')->url() ?>">
                    <?= $site->useSVG('Close', 'w-8 h-8 p-1 stroke-current bg-red-medium group-hover:bg-red-dark rounded-lg transition-all', 'x') ?>
                    <span class="-mt-px mr-2 ml-4 sketch font-small-caps text-6xl text-white"><?= rawurldecode(param('thema')) ?></span>
                </a>
            </h2>
        <?php elseif (param('kategorie')) : ?>
            <h2 class="mb-12 flex items-center">
                <span class="mr-10 font-bold font-small-caps">Lesetipps der Kategorie:</span>
                <a class="group py-1 px-2 inline-flex items-center text-white bg-red-light hover:bg-red-medium rounded-lg outline-none transition-all" href="<?= page('lesetipps/themen')->url() ?>">
                    <?= $site->useSVG('Close', 'w-8 h-8 p-1 stroke-current bg-red-medium group-hover:bg-red-dark rounded-lg transition-all', 'x') ?>
                    <span class="-mt-px mr-2 ml-4 sketch font-small-caps text-6xl text-white"><?= rawurldecode(param('kategorie')) ?></span>
                </a>
            </h2>
        <?php else : ?>
        <h2 class="mb-12 text-center"><?= t('lesetipps_ueberschrift-liste') ?></h2>
        <?php endif ?>
        <?php
            $count = 1;
            foreach ($lesetipps as $lesetipp) :
        ?>
        <?php
            $image = $lesetipp->cover()->isNotEmpty() ? $lesetipp->cover()->toFile() : $site->fallback()->toFile();
            $titleAttribute = $image->titleAttribute()->html();
            $altAttribute = $image->altAttribute()->html();

            $cover = $image->thumb('lesetipps.article.cover');
            $blurry = $image->thumb('lesetipps.article.cover.placeholder');
        ?>
        <article class="flex flex-col md:flex-row">
            <div class="flex-none flex justify-center">
                <a class="mb-6 md:mb-0" href="<?= $lesetipp->url() ?>">
                    <img
                        class="rounded-lg shadow-cover"
                        <?php if ($count === 1) : ?>
                        src="<?= $cover->url() ?>"
                        <?php else : ?>
                        src="<?= $blurry->url() ?>"
                        data-layzr="<?= $cover->url() ?>"
                        <?php endif ?>
                        title="<?= $titleAttribute ?>"
                        alt="<?= $altAttribute ?>"
                        width="<?= $cover->width() ?>"
                        height="<?= $cover->height() ?>"
                    >
                </a>
            </div>
            <div class="flex-1 md:ml-10">
                <time datetime="<?= $lesetipp->date()->toDate('Y-m-d') ?>"><?= $lesetipp->date()->toDate('d.m.Y') ?></time>
                <h3><a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a></h3>
                <p class="lg:text-lg">
                    <?= $lesetipp->text()->excerpt(300) ?><br>
                    <?= $lesetipp->moreLink('font-bold font-small-caps text-sm outline-none') ?>
                </p>
            </div>
        </article>
        <?php
            e($count < $perPage && $count != $lesetipps->count(), '<hr class="max-w-sm">');
            $count++;

            endforeach;
        ?>
    </section>
</article>

<?php snippet('navigation/pagination') ?>

<?php snippet('footer') ?>
