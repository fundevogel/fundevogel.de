<?php

return function ($page) {
    $favorites = $page->favorites()->toStructure();

    return compact(
        'favorites',
    );
};
