<?php

return function ($site, $pages, $page) {
    $image = $page->cover()->toFile();
    $thumb = $image->resize(460);

    $subtitle = t('kalender_ueberschrift-liste');

    $events = $page->children()->listed();

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

        if($date->toDate('Y-m-d') == date('Y-m-d')) return t('kalender_heute');
        if($date->toDate() < strtotime('+7 day')) return t('kalender_diese-woche');
        if($date->toDate() < strtotime('+30 day')) return t('kalender_diesen-monat');

        return t('kalender_in-der-ferne');
    });

    return compact(
        'openEvents',
        'closedEvents',
        'image',
        'thumb',
        'subtitle',
        'events',
    );
};
