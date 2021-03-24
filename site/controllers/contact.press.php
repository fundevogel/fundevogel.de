<?php

return function ($page) {
    $layouts = $page->layouts()->toLayouts();

    $grid = $page->grid()->toFiles();
    $dossier = $page->file('dossier.pdf');

    return compact('layouts', 'grid','dossier');
};
