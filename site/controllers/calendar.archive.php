<?php

return function ($site, $pages, $page) {
    $events = $page->children()->listed()->flip();
    $groupedEvents = $events->group(function($event) {
        return $event->date()->toDate('Y');
    });

    $last = $groupedEvents->last();

    return compact(
        'groupedEvents',
        'last',
    );
};
