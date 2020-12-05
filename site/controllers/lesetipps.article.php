<?php

return function ($site, $page) {
    $award = $page->getAward();
    $books = $page->books()->toPages();

    return compact(
        'books',
        'award',
    );
};
