<?php if ($page->hasCover()) : ?>
<figure class="inline-block lg:ml-12 shadow-cover rounded-lg">
    <?= $page->getCover()->createImage('rounded-t-lg') ?>
    <figcaption class="py-2 text-xs text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= $page->getCover()->caption()->html() ?></figcaption>
</figure>
<?php endif ?>
