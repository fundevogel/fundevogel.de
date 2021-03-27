<?php
    $data = [
        'text' => $block->text(),
        'author' => $block->citation(),
        'color' => $block->color(),
    ];

    snippet('components/quote', $data);
?>
