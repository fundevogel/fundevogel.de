<?php

return function ($page) {
    return [
        'images' => $page->gallery()->toFiles(),
        'caption' => $page->caption()->html(),
        'preset' => 'about.cover',
    ];
};
