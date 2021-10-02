<?php

return function ($kirby, $page) {
    # Open events
    $openEvents = $kirby->collection('events/open')->group(function($event) {
        $date = $event->date();

        # Group events by taking place ..
        # (1) .. today
        if ($date->toDate('Y-m-d') == date('Y-m-d')) {
            return t('Heute');
        }

        # (2) .. upcoming week
        if ($date->toDate() < strtotime('+7 day')) return t('Diese Woche');

        # (3) .. upcoming month
        if ($date->toDate() < strtotime('+30 day')) return t('Diesen Monat');

        # (4) .. in a future far, far away
        return t('In der Ferne');
    });

    return [
        'openEvents' => $openEvents,
        'closedEvents' => $kirby->collection('events/closed'),
        'annualEvents' => $kirby->collection('events/annual'),
    ];
};
