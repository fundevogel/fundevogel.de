<?php

return function ($page) {
    $perPage = $page->perpage()->int();

    $newsTotal = $page
        ->children()
        ->listed()
        ->filterBy('intendedTemplate', 'news.article')
        ->flip();

    $newsPerPage = $newsTotal->paginate(($perPage >= 1) ? $perPage : 5);

    $nothingLeft = Html::tag('h3', t('home_mehr-anzeigen--ende'), ['class' => 'text-center']);

    return [
        'news' => $newsPerPage,
        'pagination' => $newsPerPage->pagination(),
        'articleLast' => $newsTotal->last(),
        'nothingLeft' => $nothingLeft,
    ];
};
