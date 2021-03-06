<?php
    # Note: Once Kirby supports next-gen MIME types, like `image/avif`,
    # we may also use `F::extensionToMime($format->extension())`
?>
<picture>
    <?php
        $formats = ['webp'];

        if (in_array($preset, option('thumbs.avif', ['cover']))) {
            array_unshift($formats, 'avif');
        }

        $formats = $src->toFormats($formats);

        foreach ($formats as $format) :
        foreach ($sizes as $max) :

        $image = $format->thumb($preset . '.' . $max);
    ?>
    <source
        media="(min-width: <?=$max?>px)"
        type="image/<?= $image->extension() ?>"
        <?php if ($noLazy === true) : ?>
        srcset="<?= $image->url() ?>"
        <?php else : ?>
        data-srcset="<?= $image->url() ?>"
        <?php endif ?>
    >
    <?php
        endforeach;
        endforeach;

        foreach ($sizes as $max) :
        $image = $src->thumb($preset . '.' . $max);
    ?>
    <source
        media="(min-width: <?= $max?>px)"
        type="image/<?= $image->extension() ?>"
        <?php if ($noLazy === true) : ?>
        srcset="<?= $image->url() ?>"
        <?php else : ?>
        data-srcset="<?= $image->url() ?>"
        <?php endif ?>
    >
    <?php endforeach?>

    <?= $tag ?>
</picture>
