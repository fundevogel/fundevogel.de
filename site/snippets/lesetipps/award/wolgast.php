<h3 class="mb-4 underline"><?= t('Über Heinrich-Wolgast-Preis') ?></h3>
<?= (new Field(null, 'desc', $book->getAward()['description']))->kirbytext() ?>
