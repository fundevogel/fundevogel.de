<?php
    $webp = $src->toWebp();
    $variants = $src->toVariants()->filterBy('extension', '!=', 'webp');
    $source = $src->toSource();
?>

<picture>
    <?php foreach ($sizes as $max) : ?>
    <source
        media="(min-width: <?= $max ?>px)"
        type="image/webp"
        data-srcset="<?= $webp->thumb(A::join([$preset, $max], '.'))->url() ?>"
    >
    <?php endforeach?>

    <?php foreach ($variants as $variant) : ?>
    <?php foreach ($sizes as $max) : ?>
    <source
        media="(min-width: <?= $max ?>px)"
        type="image/<?= $variant->extension() ?>"
        data-srcset="<?= $variant->thumb(A::join([$preset, $max], '.'))->url() ?>"
    >
    <?php endforeach?>
    <?php endforeach?>

    <?= $tag ?>
</picture>
