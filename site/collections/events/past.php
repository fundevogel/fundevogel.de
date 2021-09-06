<?php

return function ($kirby) {
    $events = $kirby->collection('events/all');

    # Process events by ..
    return $events
        # (1) .. sorting by date
        ->filter(function ($child) {
            if ($child->multiple_days()->toBool() === true) {
                return $child->end_date()->toDate() < time();
            }

            return $child->date()->toDate() < time();

        # (2) .. filtering by date
        })->sortBy(function ($event) {
            return $event->date()->toDate();
        }, 'desc');
};
