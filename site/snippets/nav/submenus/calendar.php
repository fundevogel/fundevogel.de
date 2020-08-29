<p class="text-sm">
    Hier findet ihr alle Informationen zu den aktuellen Veranstaltungen und jährlichen Höhepunkten des Fundevogels.
</p>
<hr class="my-4 max-w-xs">
<ul class="mt-6 flex flex-col">
    <?php foreach($item->children()->filterBy('intendedTemplate', 'in', ['calendar.single', 'calendar.archive']) as $subitem) : ?>
        <a class="font-bold font-small-caps text-sm text-orange-medium hover:text-orange-dark" href="<?= $subitem->url() ?>">
            <?= $subitem->title()->html() ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>
