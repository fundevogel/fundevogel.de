<?php

return function ($kirby) {
    # Filter by categories indicating a closed event
    return $kirby->collection('events/current')->filter(function ($event) {
        if (in_array($event->category(), [
            'Schulinterne Veranstaltung',
            'Kindergarteninterne Veranstaltung',
            'Veranstaltung für angemeldete Schulklassen'
        ]) === true) {
            return $event;
        }
    });
};
