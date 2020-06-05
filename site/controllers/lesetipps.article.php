<?php

return function ($site, $page) {
    $image = $page->cover()->isNotEmpty() ? $page->cover()->toFile() : $site->fallback()->toFile();
    $titleAttribute = $image->titleAttribute()->html();
    $altAttribute = $image->altAttribute()->html();
    $cover = $image->thumb('lesetipps.article.cover');

    $age_list = explode(' ', $page->alter());
    $period = array_pop($age_list);
    $age = implode(' ', $age_list);

    $categories = $page->categories()->split();
    $topics = $page->topics()->split();

    return compact(
        'titleAttribute',
        'altAttribute',
        'cover',
        'period',
        'age',
        'categories',
        'topics',
    );
};
