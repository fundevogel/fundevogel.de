<aside class="container">
    <div class="mt-12 card is-dashed">
        <h3 class="mb-4 underline"><?= t('Über Heinrich-Wolgast-Preis') ?></h3>
        <?= (new Field(null, 'desc', $award['description']))->kirbytext() ?>
    </div>
</aside>
