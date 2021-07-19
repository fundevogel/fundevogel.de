<?php

return function ($page) {
    $layouts = $page->layouts()->toLayouts();

    $gallery = $page->gallery()->toFiles();
    $dossier = $page->file('dossier.pdf');

    return compact('layouts', 'gallery','dossier');
};
