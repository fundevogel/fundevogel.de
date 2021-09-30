<?php

use Kirby\Cms\App;
use Kirby\Cms\File;

return function (App $kirby, File $file, array $options = []) {
    static $original;

    if ($file->template() === 'calendar') {
        return $file;
    }

    // if static $original is null, get the original component
    if ($original === null) {
        $original = $kirby->nativeComponent('file::version');
    }

    // and return it with the given options
    return $original($kirby, $file, $options);
};
