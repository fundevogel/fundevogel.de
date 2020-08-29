<?php
    $count = 1;
    foreach ($lesetipps as $lesetipp) :
?>
<article class="flex flex-col md:flex-row">
    <div class="flex-none flex justify-center items-center">
        <a class="<?php e($lesetipp->hasAward()->bool(), 'mb-16 ', 'mb-8 ') ?>md:mb-0 rounded-lg group overflow-hidden" href="<?= $lesetipp->url() ?>">
            <?= $lesetipp->getBookCover('rounded-lg transition-transform duration-350 transform group-hover:scale-110') ?>
        </a>
    </div>
    <div class="md:ml-10 flex-1 flex flex-col justify-center relative">
        <?php
            if ($lesetipp->hasAward()->bool()) :
            $award = $lesetipp->getAward();
        ?>
        <?= useSVG($award['awardtitle'], 'js-tippy w-auto h-16 absolute -right-5 -top-5', $award['identifier']) ?>
        <?php endif ?>
        <time datetime="<?= $lesetipp->date()->toDate('Y-m-d') ?>"><?= $lesetipp->date()->toDate('d.m.Y') ?></time>
        <h3><a class="link" href="<?= $lesetipp->url() ?>"><?= $lesetipp->title()->html() ?></a></h3>
        <p class="lg:text-lg">
            <?= $lesetipp->text()->excerpt(300) ?><br>
            <?= $lesetipp->moreLink('link font-bold font-small-caps text-sm outline-none') ?>
        </p>
    </div>
</article>
<?php
    e($count < $perPage && $count != $lesetipps->count(), '<hr class="max-w-sm">');
    $count++;

    endforeach;
?>
