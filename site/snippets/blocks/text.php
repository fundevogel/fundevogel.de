<section class="container">
    <?php if ($data->show_columns()->bool()) : ?>
    <div class="flex flex-col md:flex-row">
        <div class="mb-6 md:mb-0 flex-1">
            <?= $data->text_left()->kt() ?>
        </div>
        <div class="flex-1 md:ml-10">
        <?= $data->text_right()->kt() ?>
        </div>
    </div>
    <?php else : ?>
    <?= $data->text_full()->kt() ?>
    <?php endif ?>
</section>
<?php if ($data->horizontal_line()->bool()) : ?>
<hr class="max-w-sm">
<?php endif ?>
