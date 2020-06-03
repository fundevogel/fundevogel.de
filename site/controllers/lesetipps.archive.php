<?php

return function ($page) {
    $editions = $page->parent()
                  ->files()
                  ->flip()
                  ->filterBy('extension', 'pdf');

    return compact(
        'editions',
    );
};
