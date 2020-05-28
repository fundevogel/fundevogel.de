<?php

return function ($page) {
    $examples = $page->examples()->toStructure();

    return compact(
        'examples',
    );
};
