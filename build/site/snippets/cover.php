<?php
    if ($image = $page->cover()->toFile()) :
    $thumb = $image->thumb('cover');
?>
<figure class="inline-block lg:ml-12 shadow-cover rounded-lg">
    <img
        class="rounded-t-lg" src="<?= $thumb->url() ?>"
        title="<?= $image->titleAttribute()->html() ?><?php e($image->source()->isNotEmpty(), ' - ' . $image->source()->html()) ?>"
        alt="<?= $image->altAttribute()->html() ?>"
        width="<?= $thumb->width() ?>"
        height="<?= $thumb->height() ?>"
    >
    <figcaption class="py-2 text-xs text-white text-shadow text-center bg-red-medium rounded-b-lg"><?= $image->caption()->html() ?></figcaption>
</figure>
<?php endif ?>
