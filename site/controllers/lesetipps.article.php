<?php

return function ($site, $page) {
    $image = $page->cover()->isNotEmpty() ? $page->cover()->toFile() : $site->fallback()->toFile();
    $titleAttribute = $image->titleAttribute()->html();
    $altAttribute = $image->altAttribute()->html();
    $cover = $image->orientation() === 'portrait'
        ? $image->thumb('lesetipps.article.cover-normal')
        : $image->thumb('lesetipps.article.cover-square')
    ;

    $age_list = explode(' ', $page->age());
    $period = array_pop($age_list);
    $age = implode(' ', $age_list);

    $categories = $page->categories()->split();
    $topics = $page->topics()->split();

    $award = $page->getAward();

    return compact(
        'titleAttribute',
        'altAttribute',
        'cover',
        'period',
        'age',
        'categories',
        'topics',
        'award',
    );
};
