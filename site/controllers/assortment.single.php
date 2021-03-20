<?php

return function ($page) {
    $favorites = $page->favorites()->toStructure();

    $data = [
        'heading' => t('Auswahl unserer Lieblinge'),
        'icon' => 'book-closed-filled',
        'data' => $favorites,
    ];

    return compact('favorites', 'data');
};
