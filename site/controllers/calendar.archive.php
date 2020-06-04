<?php

return function ($site, $pages, $page) {
    $image = $page->cover()->toFile();
    $thumb = $image->resize(460);

    $events = $page->children()->listed()->flip();
    $groupedEvents = $events->group(function($event) {
        return $event->date()->toDate('Y');
    });

    $last = $groupedEvents->last();

    return compact(
        'image',
        'thumb',
        'groupedEvents',
        'last'
    );
};
