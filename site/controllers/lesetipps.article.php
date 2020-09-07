<?php

return function ($site, $page) {
    $age_list = explode(' ', $page->age());
    $period = array_pop($age_list);
    $age = implode(' ', $age_list);

    $categories = $page->categories()->split();
    $topics = $page->topics()->split();

    $award = $page->getAward();

    return compact(
        'period',
        'age',
        'categories',
        'topics',
        'award',
    );
};
