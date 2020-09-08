<?php if ($page->hasCover()) : ?>
<figure class="js-coverlay inline-block lg:ml-12 rounded-lg relative">
    <div class="inset-0 w-full h-full absolute rounded-lg bg-gradient-to-tr from-red-medium to-orange-medium z-20"></div>
    <?= $page->getCover()->createImage('rounded-t-lg', 'cover') ?>
    <figcaption class="small-caption"><?= $page->getCover()->caption()->html() ?></figcaption>
</figure>
<?php endif ?>
