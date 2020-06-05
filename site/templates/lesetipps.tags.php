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
    <hr>
    <section class="container leading-relaxed">
        <h2 class="mb-12 text-center">Alle Themen</h2>
        <div class="flex flex-wrap justify-center leading-relaxed">
            <?php
                $count = 1;
                foreach ($topics as $character => $countedTopics) :
            ?>
            <span class="-mt-1 <?php e($count === 1, 'mr-2 ', 'mx-2 ') ?>text-red-medium text-xl font-small-caps font-bold"><?= implode(' ', [Str::upper($character), t('wie'), '...']) ?></span>
            <?php
                foreach ($countedTopics as $countedTopic) :
                $topic = $countedTopic[0];
                $quantity = $countedTopic[1];
            ?>
            <a class="js-tippy mx-2 inline border-b-2 border-transparent hover:border-orange-medium border-dashed" href="<?= url('lesetipps', ['params' => ['Thema' => rawurlencode($topic)]]) ?>" title="<?= tp('Buch/Bücher', [ 'count' => $quantity ]) ?>" data-tippy-theme="fundevogel orange">
                <?= html($topic) ?>
            </a>
            <?php endforeach ?>
            <?php
                $count++;
                endforeach;
            ?>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
