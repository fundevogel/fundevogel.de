<aside class="container">
    <div class="mt-12 card is-dashed">
        <h3 class="mb-4 underline"><?= t('Über LesePeter') ?></h3>
        <div class="flex items-center">
            <div class="flex-1">
                <?= (new Field(null, 'desc', $award['description']))->kirbytext() ?>
            </div>
            <div class="flex-none">
                <?php $image = new Asset('assets/images/lesepeter.png') ?>
                <img
                    class="js-tippy ml-6 w-auto h-48 lg:h-64 hidden md:block cursor-help"
                    src="<?= $image->url() ?>"
                    title="Daumen hoch für gute Bücher!" alt="LesePeter-Logo"
                    width="<?= $image->width() ?>"
                    height="<?= $image->height() ?>"
                    data-tippy-theme="fundevogel red"
                >
            </div>
        </div>
    </div>
</aside>
