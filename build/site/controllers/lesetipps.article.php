<?php

return function ($site, $page) {
    $cover = $page->cover()->isNotEmpty() ? $page->cover()->toFile() : $site->fallback()->toFile();

    return compact(
        'cover',
    );
};
