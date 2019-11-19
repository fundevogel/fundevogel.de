<?php

return function ($page) {
    $array = explode('-', $page->id());
    $identifier = $array[1];

    $cards = $page->cards()->toStructure();

    return compact(
        'identifier',
        'cards',
    );
};
