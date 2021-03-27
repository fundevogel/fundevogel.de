<?php

return function ($page) {
    $layouts = $page->layouts()->toLayouts();

    $favorites = $page->favorites()->toStructure();

    $data = [
        'heading' => t('Auswahl unserer Lieblinge'),
        'icon' => 'book-closed-filled',
        'data' => $favorites,
    ];

    return compact('layouts', 'favorites', 'data');
};
