<?php
    if ($block->images()->isNotEmpty()) {
        $data = [
            'heading' => $block->heading(),
            'icon' => $block->icon(),
            'images' => $block->images()->toFiles(),
        ];

        snippet('components/gallery', $data);
    }
?>
