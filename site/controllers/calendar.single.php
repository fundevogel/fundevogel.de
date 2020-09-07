<?php

return function ($page) {
    $siblings = $page->siblings(false)
                     ->filterBy('intendedTemplate', 'calendar.single');

    return compact(
        'siblings',
    );
};
