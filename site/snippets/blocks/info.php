<section class="container">
    <div class="mt-12 card is-dashed">
        <h3 class="mb-4 underline"><?php e($block->heading()->isNotEmpty(), $block->heading()->html(), t('Nützliche Infos')) ?></h3>
        <?= $block->info()->kt() ?>
    </div>
</section>
