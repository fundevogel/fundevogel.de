<?php

return function ($site) {
    $files = new Files();

    foreach ($site->find('lesetipps/neuerscheinungen')->children() as $year) {
        $files->add($year->files()->filterBy('extension', 'pdf'));
    }

    return $files;
};
