<?php
    if ($block->books()->isNotEmpty()) {
        $data = [
            'heading' => $block->heading(),
            'icon' => $block->icon(),
            'data' => $block->books()->toStructure(),
            'useDetails' => $block->useDetails()->bool(),
            'useTaxonomy' => $block->useTaxonomy()->bool(),
        ];

        snippet('components/book-wave', $data);
    }
?>
