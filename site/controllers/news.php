<?php

return function ($page) {
    $perPage = $page->perpage()->int();

    $newsTotal = $page
        ->children()
        ->listed()
        ->filterBy('intendedTemplate', 'in', [
            'news.toot',
            'news.event',
            'news.article',
            'news.recommendation',
        ])->flip();

    $newsPerPage = $newsTotal->paginate(($perPage >= 1) ? $perPage : 5);

    $nothingLeft = Html::tag('h3', t('Mehr haben wir nicht!'), ['class' => 'text-center']);

    return [
        'news' => $newsPerPage,
        'pagination' => $newsPerPage->pagination(),
        'articleLast' => $newsTotal->last(),
        'nothingLeft' => $nothingLeft,
    ];
};
