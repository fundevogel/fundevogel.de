<?php

return function ($kirby) {
    $editions = $kirby->collection('bibliolists')->flip();

    return compact('editions');
};
