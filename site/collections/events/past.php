<?php

return function ($kirby) {
    # Process events by ..
    return $kirby->collection('events/all')
        # (1) .. filtering by date
        ->filter(function ($child) {
            if ($child->dateEnd()->isNotEmpty()) {
                return $child->dateEnd()->toDate() < time();
            }

            return $child->date()->toDate() < time();

        # (2) .. sorting by date
        })->sortBy(function ($event) {
            return $event->date()->toDate();
        }, 'desc');
};
