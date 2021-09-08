<?php

return function ($kirby) {
    $editions = $kirby->collection('bibliolists/files')->flip();

    return compact('editions');
};
