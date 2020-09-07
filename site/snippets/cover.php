<?php if ($page->hasCover()) : ?>
<figure class="inline-block lg:ml-12 rounded-lg">
    <?= $page->getCover()->createImage('rounded-t-lg', 'cover') ?>
    <figcaption class="small-caption"><?= $page->getCover()->caption()->html() ?></figcaption>
</figure>
<?php endif ?>
