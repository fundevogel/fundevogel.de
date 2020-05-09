<?php

return function ($site, $page) {
    $cover = $page->cover()->isNotEmpty() ? $page->cover()->toFile() : $site->fallback()->toFile();
    $thumb = $cover->thumb('lesetipps.article.cover');

    $age_list = explode(' ', $page->alter());
    $period = array_pop($age_list);
    $age = implode(' ', $age_list);

    return compact(
        'cover',
        'thumb',
        'age',
        'period'
    );
};
