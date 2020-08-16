<section class="container">
    <div class="mt-12 card is-dashed">
        <h3 class="mb-4 underline"><?php e($data->heading()->isNotEmpty(), $data->heading()->html(), t('Nützliche Infos')) ?></h3>
        <?= $data->info()->kt() ?>
    </div>
</section>
