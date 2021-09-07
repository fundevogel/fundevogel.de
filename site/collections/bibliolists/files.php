<?php

return function ($kirby) {
    $files = new Files();

    foreach ($kirby->collection('bibliolists/volumes') as $volume) {
        $files->add($volume->files()->filterBy('extension', 'pdf'));
    }

    return $files;
};
