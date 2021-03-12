<?php

return function ($page) {
    $book = $page->book()->toPage();

    return compact('book');
};
