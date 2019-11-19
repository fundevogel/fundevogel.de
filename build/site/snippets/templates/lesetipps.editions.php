<?php
    foreach ($fields as $field) {
        $file = $field->toFile();

        if ($file === null) continue;

        snippet('templates/lesetipps.editions.pdf', [
            'file' => $file,
            'image' => $file->getCover()
        ]);
    }
?>
