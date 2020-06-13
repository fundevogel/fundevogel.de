<?php
    $count = 1;
    foreach ($lesetipps as $lesetipp) :
?>
<?php
    $image = $lesetipp->cover()->isNotEmpty() ? $lesetipp->cover()->toFile() : $site->fallback()->toFile();
    $titleAttribute = $image->titleAttribute()->html();
    $altAttribute = $image->altAttribute()->html();

    $cover = $image->orientation() === 'portrait'
        ? $image->thumb('lesetipps.article.cover-normal')
        : $image->thumb('lesetipps.article.cover-square')
    ;

    $blurry = $image->orientation() === 'portrait'
        ? $image->thumb('lesetipps.article.cover.placeholder-normal')
        : $image->thumb('lesetipps.article.cover.placeholder-square')
    ;
?>
<article class="flex flex-col md:flex-row">
    <div class="flex-none flex justify-center">
        <a class="mb-6 md:mb-0" href="<?= $lesetipp->url() ?>">
            <img
                class="rounded-lg shadow-cover"
                <?php if ($count === 1) : ?>
                src="<?= $cover->url() ?>"
                <?php else : ?>
                src="<?= $blurry->url() ?>"
                data-layzr="<?= $cover->url() ?>"
                <?php endif ?>
                title="<?= $titleAttribute ?>"
                alt="<?= $altAttribute ?>"
                width="<?= $cover->width() ?>"
                height="<?= $cover->height() ?>"
            >
        </a>
    </div>
    <div class="flex-1 md:ml-10">
        <time datetime="<?= $lesetipp->date()->toDate('Y-m-d') ?>"><?= $lesetipp->date()->toDate('d.m.Y') ?></time>
        <h3><a href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a></h3>
        <p class="lg:text-lg">
            <?= $lesetipp->text()->excerpt(300) ?><br>
            <?= $lesetipp->moreLink('font-bold font-small-caps text-sm outline-none') ?>
        </p>
    </div>
</article>
<?php
    e($count < $perPage && $count != $lesetipps->count(), '<hr class="max-w-sm">');
    $count++;

    endforeach;
?>
