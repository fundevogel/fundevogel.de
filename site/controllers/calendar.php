<?php

return function ($page) {
    $events = $page->children()
                   ->listed()
                   ->filterBy('intendedTemplate', 'calendar.event');

    $closedEvents = $events->filter(function ($event) {
        $closed = [
            'Schulinterne Veranstaltung',
            'Kindergarteninterne Veranstaltung',
            'Veranstaltung für angemeldete Schulklassen'
        ];

        if (in_array($event->category(), $closed)) {
            return $event;
        }
    });

    $openEvents = $events->without($closedEvents)->group(function($event) {
        $date = $event->date();

        if($date->toDate('Y-m-d') == date('Y-m-d')) return t('Heute');
        if($date->toDate() < strtotime('+7 day')) return t('Diese Woche');
        if($date->toDate() < strtotime('+30 day')) return t('Diesen Monat');

        return t('In der Ferne');
    });

    $annualEvents = $page->children()->filterBy('intendedTemplate', 'calendar.single');

    return compact(
        'openEvents',
        'closedEvents',
        'annualEvents',
        'events',
    );
};
