<picture>
    <?php
        $webp = $src->toWebp();
        $variants = $src->toVariants()->filterBy('extension', '!=', 'webp');
        $source = $src->toSource();

        foreach ($sizes as $max) :
        $image = $webp->thumb(A::join([$preset, $max], '.'));
    ?>
    <source
        media="(min-width: <?= $max ?>px)"
        type="image/webp"
        <?php if ($noLazy === true) : ?>
        srcset="<?= $image->url() ?>"
        <?php else : ?>
        data-srcset="<?= $image->url() ?>"
        data-aspectratio="<?= $image->width() / $image->height() ?>"
        <?php endif ?>
    >
    <?php
        endforeach;
        foreach ($variants as $variant) :

        foreach ($sizes as $max) :
        $image = $variant->thumb(A::join([$preset, $max], '.'));
    ?>
    <source
        media="(min-width: <?= $max ?>px)"
        type="image/<?= $variant->extension() ?>"
        <?php if ($noLazy === true) : ?>
        srcset="<?= $image->url() ?>"
        <?php else : ?>
        data-srcset="<?= $image->url() ?>"
        data-aspectratio="<?= $image->width() / $image->height() ?>"
        <?php endif ?>
    >
    <?php
        endforeach;
        endforeach;

        echo $tag;
    ?>
</picture>
