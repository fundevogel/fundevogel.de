<?php

return function ($page) {
    $layouts = $page->layouts()->toLayouts();

    $siblings = $page->siblings(false)
                     ->filterBy('intendedTemplate', 'calendar.single');

    return compact('layouts','siblings');
};
