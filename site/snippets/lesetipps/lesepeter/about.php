<aside class="container">
    <div class="mt-12 card is-dashed">
        <h3 class="mb-4 underline"><?= t('Was ist der "LesePeter"') ?></h3>
        <div class="flex items-center">
            <div class="flex-1">
                <?= $site->lesepeter()->kt() ?>
            </div>
            <div class="flex-none">
                <?php $image = new Asset('assets/images/lesepeter.png'); ?>
                <img
                    class="js-tippy ml-6 w-auto h-48 lg:h-64 hidden md:block"
                    src="<?= $image->url() ?>"
                    title="LesePeter!" alt="LesePeter-Logo"
                    width="<?= $image->width() ?>"
                    height="<?= $image->height() ?>"
                >
            </div>
        </div>
    </div>
</aside>
