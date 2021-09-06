<?php

return function ($kirby, $page) {
    $groupedEvents = $kirby->collection('events/past')->group(function($event) {
        return $event->date()->toDate('Y');
    });

    $last = $groupedEvents->last();

    return compact(
        'groupedEvents',
        'last',
    );
};
