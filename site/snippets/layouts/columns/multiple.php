<section>
    <div class="container flex flex-wrap">
        <?php
            foreach ($layout->columns() as $column) :

            $padding = 'md:px-4';

            if ($column->isFirst()) {
                $padding = 'md:pr-4';
            }

            if ($column->isLast()) {
                $padding = 'md:pl-4';
            }
        ?>
        <div class="first:mt-0 mt-6 md:mt-0 <?= $padding ?> md:w-<?= $column->width() ?>">
            <?php
                foreach ($column->blocks() as $block) {
                    if (!$block->isHidden()) echo $block;
                }
            ?>
        </div>
        <?php endforeach ?>
    </div>
</section>
