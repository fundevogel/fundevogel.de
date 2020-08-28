<p class="text-sm">
    Ob Neuerscheinung oder Klassiker - bei uns findet ihr die ganze Vielfalt der Kinder- und Jugendliteratur - und das passende Buch!
</p>
<hr class="my-4 max-w-xs">
<ul class="mt-6 flex flex-col">
    <?php foreach($item->children()->listed() as $subitem) : ?>
        <a class="font-bold font-small-caps text-sm text-orange-medium hover:text-orange-dark" href="<?= $subitem->url() ?>">
            <?= $subitem->title()->html() ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>
