<section>
    <?php
        $useContainer = $layout->style() != 'box';

        foreach ($layout->columns() as $column) {
            $wasCool = null;

            foreach ($column->blocks() as $block) {
                # Define cool blocks
                $isCool = in_array($block->type(), [
                    'heading',
                    'text',
                    'quote',
                    'list',
                ]);

                # Create containers only if told
                if ($useContainer) {
                    # Open container if current block is cool and
                    # 1) the previous one wasn't or
                    # 2) the current one is first in line
                    if (($isCool && !$wasCool) || ($isCool && $block->isFirst())) {
                        echo '<div class="container">';
                    }

                    # Close existing container if only previous container was cool
                    if (!$isCool && $wasCool) {
                        echo '</div>';
                    }
                }

                # Cool blocks don't bring their own containers ..
                if (!$block->isHidden()) echo $block;

                if ($useContainer) {
                    # Close container also if current block is cool and last in line
                    if ($isCool && $block->isLast()) {
                        echo '</div>';
                    }

                    # Set current block as the next previous one
                    $wasCool = $isCool;
                }
            }
        }
    ?>
</section>
