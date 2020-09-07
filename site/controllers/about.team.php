<?php

return function ($page) {
    $team = $page->team()->toStructure();

    return compact(
        'team',
    );
};
