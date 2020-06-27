<?php

return function ($page) {
    $images = $page->gallery()->toFiles();

    $siblings = $page->siblings(false)
                     ->filterBy('intendedTemplate', 'calendar.single');

    return compact(
        'images',
        'siblings',
    );
};
