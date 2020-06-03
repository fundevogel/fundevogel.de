<?php snippet('header') ?>

<article class="mb-16">
    <section class="container">
        <h2>Fundevogel</h2>
        <div class="flex flex-col lg:flex-row">
            <div class="flex-1">
                <?= $page->left()->kt() ?>
            </div>
            <div class="flex-1 lg:ml-10">
                <?= $page->right()->kt() ?>
            </div>
        </div>
    </section>
</article>

<?php snippet('footer') ?>
