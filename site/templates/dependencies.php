<?php snippet('header') ?>

<header class="container">
    <div class="flex flex-col lg:flex-row">
        <div class="flex-1">
            <?= $page->text()->kt() ?>
        </div>
        <div class="mt-12 flex-none text-center">
            <?php snippet('cover') ?>
        </div>
    </div>
</header>

<?php if ($page->details()->isNotEmpty()) : ?>
<hr>
<?php snippet('layouts', ['layouts' => $page->details()->toLayouts()]) ?>
<?php endif ?>

<?php snippet('dependencies/website') ?>

<?php snippet('dependencies/lists') ?>

<?php snippet('dependencies/thanks') ?>

<?php if ($page->layouts()->isNotEmpty()) : ?>
<?php snippet('layouts', ['layouts' => $page->layouts()->toLayouts()]) ?>
<?php endif ?>

<?php snippet('footer') ?>
