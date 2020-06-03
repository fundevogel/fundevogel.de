<?php

return function ($page) {
    $images = $page->images();
    $infoLinks = $page->infolinks()->toStructure();

    return compact(
        'images',
        'infoLinks',
    );
};
