<figure class="group relative rounded-lg overflow-hidden">
    <?= $page->getCover()->createImage('rounded-lg transition-all', 'news.hero', false, true) ?>
    <figcaption class="big-caption sketch group-hover:-translate-y-full"><?= $page->getCover()->caption()->html() ?></figcaption>
</figure>
