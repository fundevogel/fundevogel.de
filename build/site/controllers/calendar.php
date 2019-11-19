<?php

return function ($site, $pages, $page) {
    $image = $page->cover()->toFile();
    $thumb = $image->resize(460);

    $subtitle = $page === page('kalender')
        ? t('kalender_ueberschrift-liste')
        : t('vergangene-veranstaltungen_ueberschrift-liste');

    $events = $page === page('kalender')
        ? $page->children()->listed()
        : $page->children()->listed()->flip();
    $last = $events->last();

    return compact(
        'image',
        'thumb',
        'subtitle',
        'events',
        'last'
    );
};
