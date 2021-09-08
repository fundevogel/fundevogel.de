<?php

return function ($page) {
    $books = $page->children()->listed();

    return compact('books');
};
