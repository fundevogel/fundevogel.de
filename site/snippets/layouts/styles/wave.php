<?php
    $heading = $layout->heading();
    $icon = $layout->icon();
?>
<aside class="wave">
    <?= useSeparator('orange-light', 'top-reversed') ?>
    <div class="inner">
        <?php if ($heading->isNotEmpty()) : ?>
        <?php if ($icon->isNotEmpty()) : ?>
        <div class="text-center">
            <?= useSVG($heading->html(), 'title-icon', $icon->value()) ?>
        </div>
        <?php endif ?>
        <h2 class="title text-orange-medium"><?= $heading->html() ?></h2>
        <?php endif ?>
        <?php snippet('layouts/styles/default', compact('layout')) ?>
    </div>
    <?= useSeparator('orange-light', 'bottom-reversed') ?>
</aside>
