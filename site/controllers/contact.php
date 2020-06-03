<?php

return function ($page) {
    $image = $page->image();
    $thumb = $image->thumb('contact.map');

    return compact(
        'image',
        'thumb',
    );
};
