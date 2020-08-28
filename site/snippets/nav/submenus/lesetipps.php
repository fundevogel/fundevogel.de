<p class="text-sm">
    Hier teilen wir unsere Lesefreuden mit Euch und erzählen von Büchern, die uns besonders inspiriert und begeistert haben.
</p>
<hr class="my-4 max-w-xs">
<ul class="mt-6 flex flex-col">
    <?php foreach($item->children()->find('neuerscheinungen', 'themen', 'durchsuchen') as $subitem) : ?>
        <a class="font-bold font-small-caps text-sm text-orange-medium hover:text-orange-dark" href="<?= $subitem->url() ?>">
            <?= $subitem->title()->html() ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>
