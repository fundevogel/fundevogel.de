<?php

return function ($page) {
    $images = $page->images();

    $siblings = $page->siblings(false)
                     ->filterBy('intendedTemplate', 'calendar.single');

    return compact(
        'images',
        'siblings',
    );
};
