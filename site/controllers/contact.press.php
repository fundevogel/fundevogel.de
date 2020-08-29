<?php

return function ($page) {

    $grid = $page->grid()->toFiles();
    $dossier = $page->file('dossier.pdf');

    return compact(
        'grid',
        'dossier',
    );
};
