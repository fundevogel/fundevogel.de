<?php

return function ($site, $pages, $page) {
    $events = $page->children()->listed()->sortBy(function ($page) {
        return $page->date()->toDate();
    }, 'desc');

    $groupedEvents = $events->group(function($event) {
        return $event->date()->toDate('Y');
    });

    $last = $groupedEvents->last();

    return compact(
        'groupedEvents',
        'last',
    );
};
