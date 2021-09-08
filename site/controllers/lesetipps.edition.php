<?php

return function ($page) {
    $chapters = $page->children()->listed();

    return compact('chapters');
};
