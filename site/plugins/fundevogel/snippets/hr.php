<?php
    $size = 'xs';

    if ($block->size()->isNotEmpty()) {
        $size = $block->size()->value();
    }
?>
<hr class="max-w-<?= $size ?>">
